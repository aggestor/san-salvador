<?php

namespace Root\App\Models;

use Root\App\Models\Objects\Admin;
use Root\App\Models\Objects\Binary;
use Root\App\Models\Objects\Inscription;
use Root\App\Models\Objects\Parainage;
use Root\App\Models\Objects\User;
use Root\Core\GenerateId;

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
<<<<<<< HEAD
                Schema::INSCRIPTION['timeRecord']
=======
                Schema::INSCRIPTION['timeRecord'],
>>>>>>> 5d214b9eab98d01129f6cec74b0127227079eaa2
            ],
            [
                $object->getId(),
                $object->getUser()->getId(),
                $object->getAmount(),
                $object->getTransactionOrigi(),
                $object->getTransactionCode(),
                $object->getFormatedRecordDate(),
                $object->getFormatedTimeRecord(),
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
         * @var \Root\App\Models\Objects\User $user
         * @var \Root\App\Models\UserModel $userModel
         */
        $userModel = $this->getFactory()->getModel("User");

        $inscription = $this->findById($id);
        $user = $userModel->load($inscription->getUser()->getId());
        $user->setParent($userModel->load($user->getParent()->getId()));
        $user->setSponsor($userModel->findSponsor($user->getId()));

        try {
            $pdo = Queries::getPDOInstance();
            if (!$pdo->beginTransaction()) {
                throw new ModelException("Une erreur est survenue au demarrage de la transaction");
            }

            if ($userModel->countLeftRightSides($user->getParent()->getId())) { //si le parent a aumoin un enfant
                $user->getParent()->setSides($userModel->findDownlineLeftRightSides($user->getParent()->getId())); //recuperation des enfants du parent de l'actuel
            }
            // $user->getParent()->refresh();
            // $user->refresh();

            $bonus = ($inscription->getAmount() / 100) * 10; // 10 % du montant investie
            $now = new \DateTime(); //heure actuel

            //bonsus binaire
            if (
                ($user->getFoot() == User::FOOT_LEFT && ($user->getParent()->getLeftDownlineCapital() < $user->getParent()->getRightDownlineCapital()))
                || ($user->getFoot() == User::FOOT_RIGHT && ($user->getParent()->getLeftDownlineCapital() < $user->getParent()->getRightDownlineCapital()))
            ) {

                $binary = new Binary();
                $binary->setGenerator($inscription);
                $binary->setRecordDate($now);
                $binary->setTimeRecord($now);

                //on remonte de l'arbre pour donner le bonus binaire aux uplines
                $node = $user;
                while ($userModel->hasSponsor($node->getId()) && $node->getSponsor()->getId() != $user->getParent()->getId()) {
                    $node = $userModel->findSponsor($node->getId());

                    $binary->setUser($node);
                    if ($node->isEnable() && !$node->isLocked()) { //si le compte est toujours activer

                        if ($node->getMaxBonus() <= ($node->getBonus() + $bonus)) {
                            $surplus = $bonus + $node->getBonus() - $node->getMaxBonus();
                            $amount = $bonus - $surplus;
                            $binary->setAmount($amount);
                            $binary->setSurplus($surplus);
                            //on block definitivement le compte
                            $userModel->lockAcount($pdo, $node->getId());
                        } else { //dans le cas ou le compte  n'est pas encore saturer
                            $binary->setAmount($bonus);
                            $binary->setSurplus(0);
                        }

                        $this->sendBinary($pdo, $binary);
                    }
                }
                //--

            }
            // echo "<pre>";
            // var_dump($user->getParent());
            // echo "</pre>";
            // exit();

            var_dump("ok", $user->getParent()->getCapital());exit();

            $parainage = new Parainage();
            $parainage->setUser($user->getParent());
            $parainage->setGenerator($inscription);
            $parainage->setTimeRecord($now);
            $parainage->setRecordDate($now);

            if ($user->getParent()->getMaxBonus() <= ($user->getParent()->getBonus() + $bonus)) { //si son compte sera sauter
                $surplus = $bonus + $user->getParent()->getBonus() - $user->getParent()->getMaxBonus();
                $amount = $bonus - $surplus;
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
                    Schema::INSCRIPTION['admin'],
                ],
                "id = ?",
                [
                    $now->format('Y-m-d'),
                    $now->format('H:i:s'),
                    1,
                    $admin,
                    $id,
                ]
            );

            $pdo->commit(); //confirmation des operations
        } catch (\PDOException $e) {
            try {
                $pdo->rollBack();
            } catch (\Exception $e) {}
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
     * verifie s'il existe une inscription a un a pack en  attente d'acivation
     * @return bool
     */
    public function checkAwait($userId = null): bool
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
     * revoie tout les informations des souscription en attante de validation
     * @throws ModelException
     * @return Inscription[]
     */
    public function findAwait($userId = null): array
    {
        $return = array();
        try {
            $statement = "";
            $user = Schema::INSCRIPTION['user'];
            $validation = Schema::INSCRIPTION['validate'];
            if ($userId === null) {
                $statement = Queries::executeQuery("SELECT * FROM {$this->getTableName()} WHERE {$validation} = 0 ", array());
            } else {
                $statement = Queries::executeQuery("SELECT * FROM {$this->getTableName()} WHERE {$user}=? AND {$validation} = 0 ", array($userId));
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
     * revoie tout les informations des souscription deja valide
     * @param string $userId
     * @throws ModelException
     * @return array
     */
    public function findValidated($userId = null): array
    {
        $return = null;
        try {
            $user = Schema::INSCRIPTION['user'];
            $validation = Schema::INSCRIPTION['validate'];
            $state = Schema::INSCRIPTION['state'];
            if (is_null($userId)) {
                $statement = Queries::executeQuery("SELECT * FROM {$this->getTableName()} WHERE {$validation}=?", array($userId, 1));
            } else {

                //$statement = Queries::executeQuery("SELECT * FROM {$this->getTableName()} WHERE {$user}=? AND {$validation}=? AND {$state}=?", [$userId, 1, 1]);
                $statement = Queries::executeQuery("SELECT * FROM {$this->getTableName()} WHERE " . $user . "=? AND " . $validation . " = ? AND " . $state . "=?", array($userId, 1, 1));
            }
            if ($row = $statement->fetch()) {

                $return[] = $this->getDBOccurence($row);
                while ($row = $statement->fetch()) {
                    $return[] = $this->getDBOccurence($row);
                }

                $statement->closeCursor();
            } else {
                $statement->closeCursor();
                throw new ModelException("Aucun resultat pour votre requette");
            }
        } catch (\PDOException $e) {
            throw new ModelException("Une erreur est survenue lors de la communication avec la BDD", intval($e->getCode()), $e);
        }
        return $return;
    }

}
