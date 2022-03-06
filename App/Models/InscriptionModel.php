<?php

namespace Root\App\Models;

use Root\App\Models\Objects\Inscription;
use Root\App\Models\Objects\Parainage;
use Root\App\Models\Objects\Binary;
use Root\App\Models\Objects\User;
use Root\Core\GenerateId;
use Root\App\Models\Objects\Admin;

class InscriptionModel extends AbstractOperationModel
{
    /**
     * {@inheritDoc}
     * @see \Root\App\Models\AbstractDbOccurenceModel::create()
     * @param Inscription $object
     */
    public function create($object): void
    {
        Queries::addData(

            $this->getTableName(),
            [
                Schema::INSCRIPTION['id'],
                Schema::INSCRIPTION['user'],
                Schema::INSCRIPTION['amount'],
                Schema::INSCRIPTION['transactionOrigi'],
                Schema::INSCRIPTION['transactionCode'],
                Schema::INSCRIPTION['recordDate'],
                Schema::INSCRIPTION['timeRecord']
            ],
            [
                $object->getId(),
                $object->getUser()->getId(),
                $object->getAmount(),
                $object->getTransactionOrigi(),
                $object->getTransactionCode(),
                $object->getFormatedRecordDate(),
                $object->getFormatedTimeRecord()
            ]
        );
    }

    /**
     * recuperation des occurences
     */
    protected function getDBOccurence(array $keyValue)
    {
        $data = array();
        foreach (Schema::INSCRIPTION as $key => $value) {
            if (key_exists($value, $keyValue)) {
                $data[$key] = $keyValue[$value];
            }
        }
        return new Inscription($data);
    }

    /**
     * {@inheritDoc}
     * @see \Root\App\Models\AbstractDbOccurenceModel::getTableName()
     */
    protected function getTableName(): string
    {
        return Schema::TABLE_SCHEMA['inscription'];
    }

    /**
     * la mis en jour du capital investie n'est pas prise en charge
     * {@inheritDoc}
     * @see \Root\App\Models\AbstractOperationModel::update()
     */
    public function update($object, $id): void
    {
        throw new ModelException("Operation non pris en charge");
    }

    /**
     * validation d'une instcription.
     * c'est a ce moment que les bonus sont calculer.
     * @param string $id
     * @param Admin|string $admin l'administrateur validateur de l'inscription. 
     * Le parametre adminin doit:
     * <br/>- Soit une chaine de caractere qui represente son ID
     * <br/>- Soit une instance de la classe Admin. L'attribut $id de cette instance doit etre initialiser d'avence par l'id du dit Admin
     * @throws ModelException
     */
    public function validate(string $id, $admin): void
    {
        /**
         * @var \Root\App\Models\Objects\Inscription $inscription
         */
        $inscription = $this->findById($id);

        if ($inscription->isValidate()) {
            throw new ModelException("L'inscription au packet {$id} est déjà activité");
        }

        /**
         * @var \Root\App\Models\Objects\Inscription $inscription
         * @var \Root\App\Models\Objects\User $user
         * @var \Root\App\Models\UserModel $userModel
         */
        $userModel = $this->getFactory()->getModel("User");
        $user = $userModel->load($inscription->getUser()->getId());
        $user->setParent($userModel->load($user->getParent()->getId()));
        $user->setSponsor($userModel->findSponsor($user->getId()));

        try {
            $pdo = Queries::getPDOInstance();
            if (!$pdo->beginTransaction()) {
                throw new ModelException("Une erreur est survenue au demarrage de la transaction");
            }

            if ($userModel->hasSides($user->getParent()->getId())) { //si le parent aumoin un enfant
                $user->getParent()->setSides($userModel->loadDownlineLeftRightSides($user->getParent()->getId())); //recuperation des enfants du parent de l'actuel
            }

            $bonus = ($inscription->getAmount() / 100) * 10; // 10 % du montant investie
            $now = new \DateTime(); //heure actuel

            //bonsus binaire
            $foot  = $userModel->findBindingSide($user->getParent(), $user);
            // die("Left: {$user->getParent()->getLeftDownlineCapital()}. Right {$user->getParent()->getRightDownlineCapital()}. Foot: {$foot}");
            if (
                ($foot == User::FOOT_LEFT && ($user->getParent()->getLeftDownlineCapital() < $user->getParent()->getRightDownlineCapital()))
                || ($foot == User::FOOT_RIGHT && ($user->getParent()->getLeftDownlineCapital() > $user->getParent()->getRightDownlineCapital()))
            ) {

                // die("binaire");
                $binary = new Binary();
                $binary->setGenerator($inscription);
                $binary->setRecordDate($now);
                $binary->setTimeRecord($now);

                //pour la racine du systeme
                if ($userModel->isRoot($user->getParent())) {
                    $binary->setAmount($bonus);
                    $binary->setSurplus(0);
                    $this->sendBinary($pdo, $binary);
                }

                //on remonte de l'arbre pour donner le bonus binaire aux uplines
                $node = $user;
                $sponsorParent = $userModel->hasSponsor($user->getParent()->getId()) ? $userModel->findSponsor($user->getParent()->getId()) : null;
                while ($userModel->hasSponsor($node->getId()) && (!$userModel->isRoot($node->getId()) &&  $node->getSponsor()->getId() != $sponsorParent->getId())) {
                    $node = $userModel->findSponsor($node->getId());
                    $binary->setUser($userModel->load($node));

                    if ($node->isValidationEmail() && !$node->isLocked()) { //si le compte est toujours activer
                        if (($node->getMaxBonus() <= ($node->getBonus() + $bonus)) && $node->getSponsor() !== null) { //la racine n'ast pas de sponsor
                            $surplus =  $bonus + $node->getBonus() - $node->getMaxBonus();
                            $amount =  $bonus - $surplus;
                            $binary->setAmount($amount);
                            $binary->setSurplus($surplus);
                            //on block definitivement le compte
                            $userModel->lockAcount($pdo, $node->getId());
                        } else { //dans le cas ou le compte  n'est pas encore saturer
                            $binary->setAmount($bonus);
                            $binary->setSurplus(0);
                        }

                        // die("binaire {$binary->getAmount()}");
                        $this->sendBinary($pdo, $binary);
                    }
                }
                //--

            }

            // die("die");

            $parainage  = new Parainage();
            $parainage->setUser($user->getParent());
            $parainage->setGenerator($inscription);
            $parainage->setTimeRecord($now);
            $parainage->setRecordDate($now);

            if (($user->getParent()->getMaxBonus() <= ($user->getParent()->getBonus() + $bonus)) && ($user->getParent() !== null)) { //si son compte sera sauter
                $surplus =  $bonus + $user->getParent()->getBonus() - $user->getParent()->getMaxBonus();
                $amount =  $bonus - $surplus;
                $parainage->setAmount($amount);
                $parainage->setSurplus($surplus);

                //on block definitivement le compte
                $userModel->lockAcount($pdo, $user->getParent()->getId());
            } else {
                $parainage->setAmount($bonus);
                $parainage->setSurplus(0);
            }


            $this->sendParainage($pdo, $parainage);


            //finalisation des metadonnes de confirmation de l'inscription
            Queries::updateDataInTransaction(
                $pdo,
                $this->getTableName(),
                [
                    Schema::INSCRIPTION['confirmatDate'],
                    Schema::INSCRIPTION['confirmateTime'],
                    Schema::INSCRIPTION['validate'],
                    Schema::INSCRIPTION['admin']
                ],
                "id = ?",
                [
                    $now->format('Y-m-d'),
                    $now->format('H:i:s'),
                    1,
                    $admin,
                    $id
                ]
            );

            $pdo->commit(); //confirmation des operations
        } catch (\PDOException $e) {
            try {
                $pdo->rollBack();
            } catch (\Exception $e) {
            }
            throw new ModelException($e->getMessage(), intval($e->getCode(), 10), $e);
        }
    }

    /**
     * 
     * @param \PDO $pdo
     * @param Parainage $parainage
     */
    private function sendParainage(\PDO $pdo, Parainage $parainage): void
    {
        $id = GenerateId::generate();
        while ($this->getFactory()->getModel("Parainage")->checkById($id)) {
            $id = GenerateId::generate();
        }

        $parainage->setId($id);
        $this->getFactory()->getModel("Parainage")->createInTransaction($pdo, $parainage);
    }

    /**
     * evoie d'un bonus binaire
     * @param \PDO $pdo
     * @param Binary $binary
     */
    private function sendBinary(\PDO $pdo, Binary $binary): void
    {
        $id = GenerateId::generate();
        while ($this->getFactory()->getModel("Binary")->checkById($id)) {
            $id = GenerateId::generate();
        }

        $binary->setId($id);
        $this->getFactory()->getModel("Binary")->createInTransaction($pdo, $binary);
    }

    /**
     * verifie s'il existe une inscription a un pack activé
     * @return bool
     */
    public function checkValidated($userId = null): bool
    {
        $return = false;
        try {
            $user = Schema::INSCRIPTION['user'];
            $state = Schema::INSCRIPTION['validate'];
            if ($userId === null) {
                $statement = Queries::executeQuery("SELECT * FROM {$this->getTableName()} WHERE  {$state}=?", array(1));
            } else {
                $statement = Queries::executeQuery("SELECT * FROM {$this->getTableName()} WHERE  {$user}=? AND {$state}=?", array($userId, 1));
            }
            if ($statement->fetch()) {
                $return = true;
            }
            $statement->closeCursor();
        } catch (\PDOException $e) {
            throw new ModelException("Une erreur est survenue lors de la communication avec la BDD", intval($e->getCode(), 10), $e);
        }

        return $return;
    }

    /**
     * Verifie si l'utilisateur en parametre a aumoin une inscription deja activer
     * @param string|User $user, une instance de la classe user soit l'ID du user
     * @return bool
     * @throws ModelException s'il y a erreur lors de la communication avec la BDD
     */
    public function hasPack($user): bool
    {
        if ($user instanceof User && $user->canChoosePack()) {
            return $user->hasPack();
        }

        $id = ($user instanceof User) ? $user->getId() : $user;
        $userColumnName = Schema::INSCRIPTION['user'];
        $valisationColumnName = Schema::INSCRIPTION['validate'];

        try {
            $statement = Queries::executeQuery("SELECT * FROM {$this->getTableName()} WHERE {$userColumnName} = ? AND {$valisationColumnName} = 1", array($id));
            if ($statement->fetch()) {
                $statement->closeCursor();
                return true;
            }
            $statement->closeCursor();
        } catch (\PDOException $e) {
            throw new  ModelException($e->getMessage(), intval($e->getCode(), 10), $e);
        }

        return false;
    }

    /**
     * Verifie s'il existe une inscription en  attente d'acivation.
     * dans le cas ou $userId != null, la verification est uniquement fait sur le compte 
     * proprietaire de la valeur de $userId
     * @param string|null $userId l'id du compte d'un utilisateur
     * @return bool
     */
    public function checkAwait(?string $userId = null): bool
    {
        $return = false;
        try {
            $statement = "";
            $user = Schema::INSCRIPTION['user'];
            $state = Schema::INSCRIPTION['validate'];
            if ($userId === null) {
                $statement = Queries::executeQuery("SELECT * FROM {$this->getTableName()} WHERE {$state}= 0 ", array());
            } else {
                $statement = Queries::executeQuery("SELECT * FROM {$this->getTableName()} WHERE  {$user}=? AND {$state}= 0 ", array($userId));
            }
            if ($statement->fetch()) {
                $return = true;
            }
            $statement->closeCursor();
        } catch (\PDOException $e) {
            throw new ModelException("Une erreur est survenue lors de la communication avec la BDD", intval($e->getCode(), 10), $e);
        }

        return $return;
    }

    /**
     * renvoie une collection des souscription en attante de validation.
     * Dans le cas userId != null, alors le filtrage est fait uniquement pour les compte 
     * proprietaire de la valeur du $userId
     * @param int|null $limit
     * @param int $offset
     * @param string $userId
     * @throws ModelException
     * @return Inscription[]
     */
    public function findAwait(?int $limit = null, int $offset = 0, ?string $userId = null): array
    {
        $return = array();
        try {
            $statement = "";
            $user = Schema::INSCRIPTION['user'];
            $validation = Schema::INSCRIPTION['validate'];

            $SQL_END = ($limit != null) ? " LIMIT {$limit} OFSSET {$offset}" : "";
            if ($userId === null) {
                $statement = Queries::executeQuery("SELECT * FROM {$this->getTableName()} WHERE {$validation} = 0 ORDER BY record_date {$SQL_END}", array());
            } else {
                $statement = Queries::executeQuery("SELECT * FROM {$this->getTableName()} WHERE {$user}=? AND {$validation} = 0 {$SQL_END}", array($userId));
            }
            if ($row = $statement->fetch()) {
                $return[] = $this->getDBOccurence($row);
                while ($row = $statement->fetch()) {
                    $return[] = $this->getDBOccurence($row);
                }
                $statement->closeCursor();
            } else {
                $statement->closeCursor();
                throw new ModelException("Aucune inscription en attente");
            }
        } catch (\PDOException $e) {
            throw new ModelException("Une erreur est survenue lors de la communication avec la BDD", intval($e->getCode()), $e);
        }
        return $return;
    }

    /**
     * renvoie une collection des souscription deja valide
     * dans le cas ou $userId != null, alors les inscriptions renvoyer concerne le compte 
     * proprietaire de la valeur du $suerId
     * @param int $limit
     * @param int $offset
     * @param string $userId
     * @throws ModelException
     * @return array
     */
    public function findValidated(?int $limit = null, int $offset = 0, ?string $userId = null): array
    {
        $return = array();
        try {
            $user = Schema::INSCRIPTION['user'];
            $validation = Schema::INSCRIPTION['validate'];
            $SQL_END = ($limit != null) ? " LIMIT {$limit} OFSSET {$offset}" : "";
            if (is_null($userId) && !is_null($limit) && !is_null($limit)) {
                $statement = Queries::executeQuery("SELECT * FROM {$this->getTableName()} WHERE {$validation}=? ORDER BY record_date DESC LIMIT {$limit},{$offset}", array(1));
            } else {
                $statement = Queries::executeQuery("SELECT * FROM {$this->getTableName()} WHERE {$user}=? AND  {$validation}=? {$SQL_END}", array($userId, 1));
            }
            if ($row = $statement->fetch()) {
                $return[] = $this->getDBOccurence($row);
                while ($row = $statement->fetch()) {
                    $return[] = $this->getDBOccurence($row);
                }
                $statement->closeCursor();
            } else {
                $statement->closeCursor();
                $return = $return;
            }
        } catch (\PDOException $e) {
            throw new ModelException("Une erreur est survenue lors de la communication avec la BDD {$e->getMessage()}", intval($e->getCode()), $e);
        }
        return $return;
    }

    /**
     * comptage de tout les inscriptions deja valider ou en attante.
     * @param boolean $validated
     * => true= inscription deja valider, comportement par defaut.<br/>
     * => false= inscription en attente
     * @throws ModelException
     * @return int
     */
    public function countValidate(bool $validated = true): int
    {
        $nombre = 0;
        $validation = Schema::INSCRIPTION['validate'];
        try {
            $statement = Queries::executeQuery("SELECT COUNT(*) AS nombre FROM {$this->getTableName()} WHERE {$validation}= " . ($validated ? '1' : '0'), array());
            if ($row = $statement->fetch()) {
                $nombre = $row['nombre'];
            }
            $statement->closeCursor();
        } catch (\PDOException $e) {
            throw new ModelException("Une erreur est survenue lors de la communication avec la BDD", intval($e->getCode()), $e);
        }
        return $nombre;
    }
}
