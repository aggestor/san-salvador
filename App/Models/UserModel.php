<?php

namespace Root\App\Models;

use Root\App\Models\Objects\Binary;
use Root\App\Models\Objects\CashOut;
use Root\App\Models\Objects\Inscription;
use Root\App\Models\Objects\Parainage;
use Root\App\Models\Objects\ReturnInvest;
use Root\App\Models\Objects\User;

/**
 *
 * @author Esaie MUHASA
 *        
 */
class UserModel extends AbstractMemberModel
{
    private static $OPERATIONS = [Parainage::class, CashOut::class, Inscription::class, ReturnInvest::class, Binary::class];

    /**
     * {@inheritDoc}
     * @see \Root\App\Models\AbstractDbOccurenceModel::create()
     * @param User $object
     */
    public function create($object): void
    {
        try {
            Queries::addData(
                $this->getTableName(),
                [
                    Schema::USER['id'],
                    Schema::USER['name'],
                    Schema::USER['sponsor'],
                    Schema::USER['parent'],
                    Schema::USER['email'],
                    Schema::USER['phone'],
                    Schema::USER['password'],
                    Schema::USER['side'],
                    Schema::USER['status'],
                    Schema::USER['validationEmail'],
                    Schema::USER['recordDate'],
                    Schema::USER['timeRecord'],
                    Schema::USER['photo'],
                    Schema::USER['token'],
                ],

                [
                    $object->getId(),
                    $object->getName(),
                    $object->getSponsor()->getId(),
                    $object->getParent()->getId(),
                    $object->getEmail(),
                    $object->getPhone(),
                    $object->getPassword(),
                    $object->getSide(),
                    $object->getStatus() ? 1 : 0,
                    $object->getValidationEmail() ? 1 : 0,
                    $object->getFormatedRecordDate(),
                    $object->getFormatedTimeRecord(),
                    $object->getPhoto(),
                    $object->getToken()
                ]
            );
        } catch (\PDOException $th) {
            throw new ModelException($th->getMessage());
        }
    }

    /**
     * {@inheritDoc}
     * @see \Root\App\Models\AbstractDbOccurenceModel::update()
     * @param User $object
     */
    public function update($object, $id): void
    {
        try {
            Queries::updateData(
                $this->getTableName(),
                [
                    Schema::USER['name'],
                    Schema::USER['phone'],
                    Schema::USER['modifDate'],
                    Schema::USER['motifTime'],
                ],
                "id = ?",
                [
                    $object->getName(),
                    $object->getPhone(),
                    $object->getFormatedLastModifDate(),
                    $object->getFormatedLastModifTime(),
                    $id
                ]
            );
        } catch (\PDOException $th) {
            throw new ModelException($th->getMessage());
        }
    }

    /**
     * modification de la photo d'un utilisateur
     * @param string $id
     * @param string $photoName
     */
    public function updatePhoto($id, string $photoName): void
    {
        try {
            Queries::updateData(
                $this->getTableName(),
                [Schema::USER['photo']],
                "id = ?",
                [$photoName, $id]
            );
        } catch (\PDOException $th) {
            throw new ModelException($th->getMessage());
        }
    }

    /**
     * mis en jour du mot de passe d'un utilisateur
     * @param string $id
     * @param string $password
     */
    public function updatePassword($id, string $password): void
    {
        try {
            Queries::updateData(
                $this->getTableName(),
                [Schema::USER['password']],
                "id = ?",
                [$password, $id]
            );
        } catch (\PDOException $th) {
            throw new ModelException($th->getMessage());
        }
    }

    /**
     * demande de validation du compte d'un utiilsateur,
     * cette methode est utiliser pour cofirmer la reception de l'email par l'utilisateur
     * @param string $id l'identifiant du compte utilisateur
     */
    public function validateAccount(string $id): void
    {
        try {
            Queries::updateData(
                $this->getTableName(),
                [Schema::USER['validationEmail']],
                "id = ?",
                [1, $id]
            );
        } catch (\PDOException $th) {
            throw new ModelException($th->getMessage());
        }
    }


    /**
     * verouillage definitive d'un compte
     * N.B: eviter d'acceder a cette methode implicitement. seul les calculateurs de l'evolution du compte d'un
     * utilisateur on le droit d'y acceder pour verouiller le compte d'un user dans le cas ou le compte est saturer
     * @param \PDO $pdo
     * @param string $id
     * @throws ModelException
     */
    public function lockAcount(\PDO $pdo, $id): void
    {

        /**
         * @var \Root\App\Models\Objects\User $user
         */
        $user =  $this->findById($id);

        if ($user->getParent() === null) {
            return;
        }

        try {
            Queries::updateDataInTransaction(
                $pdo,
                $this->getTableName(),
                [Schema::USER['locked']],
                "id = ?",
                [1, $id]
            );
        } catch (\PDOException $th) {
            throw new ModelException($th->getMessage());
        }
    }

    /**
     * mis en jour du token de l'utilisateur,
     * le tocken est utile lors de la confirmation de l'email
     * et lors dela mis en jour s du mot de passe, apre oublie de cel-ci
     * @param string $token
     * @param string $id
     */
    public function updateToken($token, $id): void
    {
        try {
            Queries::updateData(
                $this->getTableName(),
                [Schema::USER['token']],
                "id = ?",
                [$token, $id]
            );
        } catch (\PDOException $th) {
            throw new ModelException($th->getMessage());
        }
    }

    /**
     * recuperation des utilisateurs dont leurs compte correspond au statut en parametre,
     * un compte est considerer comme veruiller, s'il a deja attein 300% de son capital investie
     * @param bool $lock, true pour de compte active, false pour les comptes verrouiller
     * @param int $limit
     * @param int $offset
     * @throws ModelException
     * @return User[]
     */
    public function findByLockState(bool $lock = false, ?int $limit = null, int $offset = 0): array
    {
        $data = [];
        try {
            $lockColumnName = Schema::USER['locked'];
            $statement = Queries::executeQuery("SELECT * FROM {$this->getTableName()} WHERE {$lockColumnName} = ?" . ($limit !== null ? " LIMIT {$limit} OFFSET {$offset}" : ''), [$lock ? '1' : '0']);
            if ($row = $statement->fetch()) {
                $data[] = $this->getDBOccurence($row);

                while ($row = $statement->fetch()) {
                    $data[] = $this->getDBOccurence($row);
                }

                $statement->closeCursor();
            } else {
                $statement->closeCursor();
                throw new ModelException("Aucun resultat pour la requette de selection executer");
            }
        } catch (\PDOException $e) {
            throw new ModelException("Une erreur est survenue lors de la communication avec la BDD", intval($e->getCode(), 10), $e);
        }
        return $data;
    }

    /**
     * verification des comptes ayant le status en premier parametre, dans l'intervale specifier en 2 eme 3 eme parametre
     * un compte est considerer veruiller lors qu'il a deja atteint 300% de son capital investie
     * @param boolean $lock
     * @param int $limit
     * @param int $offset
     * @return bool
     * @throws ModelException
     */
    public function checkByLockState(bool $lock = false, ?int $limit = null, int $offset = 0): bool
    {
        $return = false;
        try {
            $lockColumnName = Schema::USER['locked'];
            $statement = Queries::executeQuery("SELECT * FROM {$this->getTableName()} WHERE {$lockColumnName} = ?" . ($limit !== null ? " LIMIT {$limit} OFFSET {$offset}" : ''), [$lock ? '1' : '0']);
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
     * comptage de compte conforme au status en parametre
     * @param boolean $lock
     * @return int
     * @throws ModelException
     */
    public function countByLockState(bool $lock = false): int
    {
        $return = 0;
        try {
            $lockColumnName = Schema::USER['locked'];
            $statement = Queries::executeQuery("SELECT COUNT(id) AS nombre FROM {$this->getTableName()} WHERE {$lockColumnName} = " . ($lock ? '1' : '0')); //, [$lock? '1':'0']);
            if ($row = $statement->fetch()) {
                $return = $row['nombre'];
            }
            $statement->closeCursor();
        } catch (\PDOException $e) {
            throw new ModelException("Une erreur est survenue lors de la communication avec la BDD", intval($e->getCode(), 10), $e);
        }

        return $return;
    }

    /**
     * {@inheritDoc}
     * @see \Root\App\Models\AbstractDbOccurenceModel::getDBOccurence()
     * @return User
     */
    protected function getDBOccurence(array $keyValue)
    {
        $data = array();
        $keyVal = $keyValue;
        foreach (Schema::USER as $key => $value) {
            if (key_exists($value, $keyVal)) {
                $data[$key] = $keyVal[$value];
            }
        }
        return new User($data);
    }

    /**
     * {@inheritDoc}
     * @see \Root\App\Models\AbstractDbOccurenceModel::getTableName()
     */
    protected function getTableName(): string
    {
        return Schema::TABLE_SCHEMA['user'];
    }

    /**
     * comptage du nombre des users qui sont  dans le reseau d'un user
     * @param string $userId
     * @param int $side foot du User. pour faire abstraction au foot, une valeur null sufit (ce le comportement par defaut)
     * @throws ModelException
     * @return int
     */
    public function countDownLineStack(string $userId, ?int $side = null): int
    {
        if($side  != User::FOOT_LEFT && $side != User::FOOT_RIGHT && $side !== null){
            throw new ModelException("Side invalide => {$side}");
        }

        $count = 0;
        if ($side == User::FOOT_LEFT){
            if($this->hasLeftSide($userId)) {
                $count++;
                $user = $this->findLeftSide($userId);
                $count += $this->countDownLineStack($user->getId());
            }
        } elseif ($side == User::FOOT_LEFT){
            if($this->hasRightSide($userId)) {
                $count++;
                $user = $this->findRightSide($userId);
                $count += $this->countDownLineStack($user->getId());
            }
        } else {
            $count += $this->countDownLineStack($userId, User::FOOT_LEFT);
            $count += $this->countDownLineStack($userId, User::FOOT_RIGHT);
        }
        return $count;
    }

    /**
     * revoie le nombre d'anfant directe de l'utilisateur en parametre
     * comptage des enfants directement en dessous d'un user
     * un compte utilisteur ne put avoie que deux enfants
     * @param string $userId
     * @return int
     * @throws ModelException
     */
    public function countSides(string $userId): int
    {
        $count = 0;
        try {
            $sponsor = Schema::USER['sponsor'];
            $statement = Queries::executeQuery("SELECT COUNT({$sponsor}) AS nombre FROM {$this->getTableName()} WHERE {$sponsor} = ? ", [$userId]);
            if ($row = $statement->fetch()) {
                $count = $row['nombre'];
            }
            $statement->closeCursor();
        } catch (\PDOException $th) {
            throw new ModelException($th->getMessage());
        }
        return $count;
    }

    /**
     * comptage des anfants du reseau d'un utilisateur sur son pied droid
     * @param string $userId
     * @return int
     * @throws ModelException
     */
    public function countDownlineRightStack(string $userId): int
    {
        return $this->countDownLineStack($userId, User::FOOT_RIGHT);
    }

    /**
     * comptage des anfant du reseau d'un utilisateur sur le pied gauche
     * @param string $userId
     * @return int
     * @throws ModelException
     */
    public function countDownlineLeftStack(string $userId): int
    {
        return $this->countDownLineStack($userId, User::FOOT_LEFT);
    }

    /**
     * revoie une collection des piles des utilisateurs en dessous d'un utilisateur 
     * @param string $userId
     * @return User[]|array
     * @throws ModelException
     */
    public function findDownlineLeftRightSides(string $userId): array
    {
        $data = array();
        if ($this->hasLeftSide($userId)) {
            $data[] = $this->findDownlineLeftSide($userId);
        }

        if ($this->hasRightSide($userId)) {
            $data[] = $this->findDownlineRightSide($userId);
        }
        return $data;
    }

    /**
     * renvoie la reacine de l'arbre 
     * @throws ModelException
     * @return User
     */
    public function findRoot(): User
    {
        $return = null;
        try {
            $statement = Queries::executeQuery("SELECT * FROM {$this->getTableName()} WHERE " . (Schema::USER['sponsor']) . ' IS NULL AND ' . (Schema::USER['parent']) . " IS NULL", array());
            if ($row = $statement->fetch()) {
                $return = $this->getDBOccurence($row);
                $statement->closeCursor();
            } else {
                $statement->closeCursor();
                throw new ModelException("Aucun resultat pour la requette executer");
            }
        } catch (\PDOException $e) {
            throw new ModelException("Une erreur est survenue lors de la communication avec la BDD", intval($e->getCode()), $e);
        }

        return $return;
    }

    /**
     * verifie si la reacine existe
     * @throws ModelException
     * @return bool
     */
    public function checkRoot(): bool
    {
        $return = false;
        try {
            $statement = Queries::executeQuery("SELECT * FROM {$this->getTableName()} WHERE " . (Schema::USER['sponsor']) . ' IS NULL AND ' . (Schema::USER['parent']) . " IS NULL", array());
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
     * On verifie si l'utilisateur en parametre est bien la racine.
     * @param string|User $user l'identifiant  de l'utilisateur ou l'utilisateur carement
     * @return bool
     */
    public function isRoot ($user) : bool {
        $return = false;
        $userId = ($user instanceof User) ? $user->getId() : $user;
        try  {
            $statement = Queries::executeQuery("SELECT * FROM {$this->getTableName()} WHERE id = ? AND " . (Schema::USER['sponsor']) . ' IS NULL AND ' . (Schema::USER['parent']) . " IS NULL", array($userId));
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
     * Renvoie la pile des utilisateurs du reseau de l'utilisateur dont l'id est en premier parametre,
     * sur le side en deuxieme parametre.
     * Lors du chargement des informations du compte, il est possible de recuperer directement tout les operations deja effectuer par le compte
     * soit de s'en foudre. ce le role du parametre $load.
     * @param string $userId
     * @param int $side
     * @param bool $load
     * @throws ModelException
     * @return User
     */
    private function getDownlineSide(string $userId, int $side, bool $load): User
    {
        $user = null;
        switch ($side) {
            case User::FOOT_LEFT: {
                if ($this->hasLeftSide($userId)) {
                    $user = $this->findLeftSide($userId);
                } else {
                    throw new ModelException("aucun downline pour sur le pied {$side} de {$userId}");
                }
            }break;

            case User::FOOT_RIGHT: {
                if ($this->hasRightSide($userId)) {
                    $user = $this->findRightSide($userId);
                } else {
                    throw new ModelException("aucun downline pour sur le pied {$side} de {$userId}");
                }
            }break;

            default: {
                throw new ModelException("Side inconue => {$side}");
            }
        }

        if ($load) { //pour le chargement de tout les informations des comptes des utilisateurs
            if ($this->hasSides($user->getId())) {
                $user->setSides($this->loadDownlineLeftRightSides($user->getId()));
            }
            $user = $this->load($user);
            $user->refreshNode();
        } else { // 
            if ($this->hasSides($user->getId())) {
                $user->setSides($this->findDownlineLeftRightSides($user->getId()));
            }
        }
        return $user;
    }

    /**
     * renvoie la pile des anfants sur le peid en deuxieme parametre
     * @param string $userId
     * @param int $side
     * @throws ModelException
     * @return User
     */
    public function findDownlineSide(string $userId, int $side): User
    {
        return $this->getDownlineSide($userId, $side, false);
    }

    /**
     * renvoie l'enfant sur le pied gauche de l'utiilisateur en parametre
     * @param string $userId
     * @return User
     * @throws ModelException
     */
    public function findDownlineLeftSide(string $userId): User
    {
        return $this->findDownlineSide($userId, User::FOOT_LEFT);
    }

    /**
     * Renvoie la pile des enfant en droit de l'utilisateur en parametre 
     * @param string $userId
     * @return User
     * @throws ModelException
     */
    public function findDownlineRightSide(string $userId): User
    {
        return $this->findDownlineSide($userId, User::FOOT_RIGHT);
    }


    /**
     * revoie tout les anfants en dessous d'un utilisateur
     * @param string $userId
     * @throws ModelException
     * @return User[]
     */
    public function findLeftRightSides(string $userId): array
    {
        $return = array();
        try {
            $statement = Queries::executeQuery("SELECT * FROM {$this->getTableName()} WHERE " . Schema::USER['sponsor'] . "=? ", array($userId));
            if ($row = $statement->fetch()) {
                $return[] = $this->getDBOccurence($row);
                while ($row = $statement->fetch()) {
                    $return[] = $this->getDBOccurence($row);
                }
                $statement->closeCursor();
            } else {
                $statement->closeCursor();
                throw new ModelException("aucun utilisateur sponsoriser par {$userId}");
            }
        } catch (\PDOException $e) {
            throw new ModelException("Une erreur est survenue lors de la communication avec la BDD", intval($e->getCode()), $e);
        }

        return $return;
    }

    /**
     * REvoei l'anfant qui est sur le pied d'un utilsateur
     * @param string $userId
     * @param int $side
     * @throws ModelException
     * @return User
     */
    public function findSide(string $userId, int $side): User
    {
        $return = null;
        try {
            $statement = Queries::executeQuery("SELECT * FROM {$this->getTableName()} WHERE " . Schema::USER['sponsor'] . "=? AND " . Schema::USER['side'] . " = ?", array($userId, $side));
            if ($row = $statement->fetch()) {
                $return = $this->getDBOccurence($row);
                $statement->closeCursor();
            } else {
                $statement->closeCursor();
                throw new ModelException("aucun utilisateur sponsoriser par {$userId} sur le pied {$side}");
            }
        } catch (\PDOException $e) {
            throw new ModelException("Une erreur est survenue lors de la communication avec la BDD", intval($e->getCode()), $e);
        }

        return $return;
    }

    /**
     * revoie l'anfant sur le pied gauche de l'utilisateur en parametre
     * @param string $userId
     * @return User
     */
    public function findLeftSide(string $userId): User
    {
        return $this->findSide($userId, User::FOOT_LEFT);
    }

    /**
     * revoie l'anfant sur le pied droit d'un utilisateur
     * @param string $userId
     * @return User
     */
    public function findRightSide(string $userId): User
    {
        return $this->findSide($userId, User::FOOT_RIGHT);
    }

    /**
     * renvoir le sponsor directe d'un utilisateur
     * @param string $userId
     * @return User
     */
    public function findSponsor(string $userId)
    {
        $user = $this->findById($userId);
        if($user->getSponsor() == null){
            throw new ModelException("Le compte {$user->getId()} n'as pas de sponsor");
        }
        return $this->findById($user->getSponsor()->getId());
    }

    /**
     * revoie le parent le parent de l'utilisateur en parametre
     * @param string $userId
     * @return User
     */
    public function findParent(string $userId)
    {
        $user = $this->findById($userId);
        if($user->getParent() == null){
            throw new ModelException("Le compte {$user->getId()} n'as pas de parent");
        }
        return $this->findById($user->getParent()->getId());
    }

    /**
     * verification si un utilisateur deja sposoriser aumoin une personne
     * @param string $userId
     * @return bool
     */
    public function hasSides(string $userId): bool
    {
        return  $this->check(Schema::USER['sponsor'], $userId);
    }

    /**
     * est-ce que cet utilisateur a un utilisateur sur le pied en parametre??
     * @param string $userId
     * @param int $side
     * @throws ModelException
     * @return bool
     */
    public function hasSide(string $userId, int $side): bool
    {
        $return = false;
        try {
            $statement = Queries::executeQuery("SELECT " . Schema::USER['sponsor'] . " FROM {$this->getTableName()} WHERE " . Schema::USER['sponsor'] . "=? AND " . Schema::USER['side'] . " = ?", array($userId, $side));
            if ($statement->fetch()) {
                $return = true;
            }
            $statement->closeCursor();
        } catch (\PDOException $e) {
            throw new ModelException("Une erreur est survenue lors de la communication avec la BDD", intval($e->getCode()), $e);
        }

        return $return;
    }


    /**
     * verification si l'utilisateur a un afant su le pied gauche
     * @param string $userId
     * @return bool
     */
    public function hasLeftSide(string $userId): bool
    {
        return $this->hasSide($userId, User::FOOT_LEFT);
    }

    /**
     * verfication si un utilisateur a un afant su le pied droit
     * @param string $userId
     * @return bool
     */
    public function hasRightSide(string $userId): bool
    {
        return $this->hasSide($userId, User::FOOT_RIGHT);
    }

    /**
     * Verification si la personne a un parent
     * @param string $userId
     * @return bool
     */
    public function hasParent(string $userId): bool
    {
        $user = $this->findById($userId);
        return ($user->getParent() != null);
    }

    /**
     * verification si la personne a un sponsor
     * @param string $userId
     * @return bool
     */
    public function hasSponsor(string $userId): bool
    {
        $user = $this->findById($userId);
        return ($user->getSponsor() != null);
    }

    /**
     * renvoie la pile des anfants de l'utilisateur en parametre, et charge directement les informations pour chaque compte
     * @param string $userId
     * @throws ModelException
     * @return User[]
     */
    public function loadDownlineLeftRightSides(string $userId): array
    {
        $data = array();
        if ($this->hasLeftSide($userId)) {
            $data[] = $this->loadDownlineLeftSide($userId);
        }

        if ($this->hasRightSide($userId)) {
            $data[] = $this->loadDownlineRightSide($userId);
        }
        return $data;
    }



    /**
     * chargement complet d'un
     * @param string $userId
     * @param int $side
     * @return User
     * @throws ModelException
     */
    public function loadDownlineSide(string $userId, int $side): User
    {
        return $this->getDownlineSide($userId, $side, true);
    }


    /**
     * Revoie la pile des anfants du pied gauche et charge directement tout les informations concernant leurs comptes
     * @param string $userId
     * @return User
     */
    public function loadDownlineLeftSide(string $userId): User
    {
        return $this->loadDownlineSide($userId, User::FOOT_LEFT);
    }

    /**
     * Renvoie la pile des enfant en droit de l'utilisateur en parametre, et charge directement tout les informations des leurs comptes
     * @param string $userId
     * @return User
     * @throws ModelException
     */
    public function loadDownlineRightSide(string $userId): User
    {
        return $this->loadDownlineSide($userId, User::FOOT_RIGHT);
    }

    /**
     * recuperation du foot sur le quel c trouve un User dans un reseau d'un User
     * @param string|User $parent le parent du reseau
     * @param string|User $child l'enfant appartenant au reseau du parant en premier parametre
     * @return int le foot sur lequel ce trouve l'enfant dans le reseau du parent
     * @throws ModelException dans le cas où l'enfant n'appartien pas au reseau du parent
     */
    public function findBindingSide ($parent, $child) : int {
        $childId = ($child instanceof User)? $child->getId() : $child;

        $user = ($parent instanceof User)? $parent : $this->findById($parent);
        /**
         * @var User $userChild
         */
        $userChild = ($child instanceof User)? $child : $this->findById($child);

        if($userChild->getSponsor()->getId() == $user->getId())
            return $userChild->getSide();

        while($this->hasSponsor($childId)) {
            $node = $this->findSponsor($childId);
            if ($node->getSponsor() != null && $user->getId() == $node->getSponsor()->getId()) {
                return $node->getSide();
            }
            $childId = $node->getId();
        }
        throw new ModelException("Impossible de determier la position du user dans le reseau");
    }

    /**
     * Chargment du compte d'un utiilsateur
     * @param User|string $user une instace de la classe user, soit l'identifiant de l'utiilsateur du compte
     * @return User
     */
    public function load($user): User
    {
        $data = ($user instanceof User) ? ($user) : (is_string($user) ? $this->findById($user) : null);

        if ($data === null) {
            throw new ModelException("Argument invalide en parametre de la methode load");
        }

        $operations = [];

        foreach (self::$OPERATIONS as $name) {
            /**
             * @var \Root\App\Models\AbstractOperationModel $model
             */
            $ref = new \ReflectionClass($name);
            $model = $this->getFactory()->getModel($ref->getShortName());
            if ($model->checkByUser($data->getId())) {
                $operations = array_merge($model->findByUser($data->getId()), $operations);
            }
        }

        $data->setOperations($operations);
        $data->initPacks($this->getFactory()->getModel("Pack")->findAll());
        $data->refresh();

        return $data;
    }

    /**
     * revoie la collection des compte pour l'itervalle choisie.
     * le compte est revoyer avec le tout les operations du compte
     * @param int $limit
     * @param int $offset
     * @return User[]
     */
    public function loadAll(?int $limit = null, int $offset = 0): array
    {
        if ($this->checkAll($limit, $offset)) {
            $packs = $this->getFactory()->getModel("Pack")->findAll();

            $all = $this->findAll($limit, $offset);

            foreach ($all as $user) {
                $operations = [];

                foreach (self::$OPERATIONS as $name) {
                    /**
                     * @var \Root\App\Models\AbstractOperationModel $model
                     */
                    $ref = new \ReflectionClass($name);
                    $model = $this->getFactory()->getModel($ref->getShortName());

                    if ($model->checkByUser($user->getId())) {
                        $operations = array_merge($model->findByUser($user->getId()), $operations);
                    }
                }

                $user->setOperations($operations);
                $user->initPacks($packs);
                $user->refresh();
            }

            return $all;
        }

        throw new ModelException("Aucun compte pour l'intervale choisie");
    }

    /**
     * Comptage des utilisateurs qui ont deja investie
     * @return int
     * @throws ModelException dans le cas où il y a une erreur lors de la communication avec le SGBD
     */
    public function countCertifieds () : int  {
        $count  = 0;
        $tableName = Schema::TABLE_SCHEMA['inscription'];
        $userIdCollname = Schema::INSCRIPTION['user'];
        $SQL = "SELECT COUNT(*) AS nombre FROM {$this->getTableName()} WHERE id IN(SELECT DISTINCT {$userIdCollname} FROM {$tableName})";
        try {
            $statement = Queries::executeQuery($SQL);
            if($row = $statement->fetch()){
                $count = $row['nombre'];
            }
            $statement->closeCursor();
        } catch (\PDOException $e) {
            throw new ModelException($e->getMessage(), intval($e->getCode(), 10), $e);
        }
        return $count;
    }

    /**
     * verifie s'il y a des utilisateurs qui ont deja investie
     * $limit et $offset permet de limiter la zone de teste
     * @param int|null $limit 
     * @param int $offset 
     * @return bool
     * @throws ModelException
     */
    public function checkCertifieds (?int $limit = null, int $offset = 0) : bool {
        $check  = false;
        $tableName = Schema::TABLE_SCHEMA['inscription'];
        $userIdCollname = Schema::INSCRIPTION['user'];
        $SQL_LIMIT = $limit !== null? "LIMIT {$limit} OFFSET {$offset}":"";
        $SQL = "SELECT * FROM {$this->getTableName()} WHERE id IN(SELECT DISTINCT {$userIdCollname} FROM {$tableName}) {$SQL_LIMIT}";
        try {
            $statement = Queries::executeQuery($SQL);
            if($statement->fetch()){
                $check = true;
            }
            $statement->closeCursor();
        } catch (\PDOException $e) {
            throw new ModelException($e->getMessage(), intval($e->getCode(), 10), $e);
        }
        return $check;
    }

    /**
     * Selection des utilisateurs qui ont deja investie
     * @param int|null $limit pour limiter les resultat lors de la selection
     * @param int $offset pour sauter un nombre x de resultant dans la selection
     * @return User[]
     * @throws ModelException dans le cas où il y a une erreur lors de la communication avec le SGBD
     * ou s'il n'y a aucun resultat pour l'intervale de selection.
     */
    public function findCertifieds (?int $limit = null, int $offset = 0) : array {
        $users  = [];
        $tableName = Schema::TABLE_SCHEMA['inscription'];
        $userIdCollname = Schema::INSCRIPTION['user'];
        $SQL_LIMIT = $limit !== null? "LIMIT {$limit} OFFSET {$offset}":"";
        $SQL = "SELECT * FROM {$this->getTableName()} WHERE id IN(SELECT DISTINCT {$userIdCollname} FROM {$tableName}) {$SQL_LIMIT}";
        try {
            $statement = Queries::executeQuery($SQL);
            while ($row = $statement->fetch()) {
                $users[] = $this->getDBOccurence($row);
            }
            $statement->closeCursor();
        } catch (\PDOException $e) {
            throw new ModelException($e->getMessage(), intval($e->getCode(), 10), $e);
        }

        if(empty($users)){
            throw new ModelException("Aucun resultat pour l'intervale de selection. {$SQL_LIMIT}");
        }
        return $users;
    }
}
