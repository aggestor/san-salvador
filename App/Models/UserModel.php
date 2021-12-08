<?php
namespace Root\Models;

use Root\Models\Objects\User;

/**
 *
 * @author Esaie MUHASA
 *        
 */
class UserModel extends AbstractMemberModel
{
    /**
     * {@inheritDoc}
     * @see \Root\Models\AbstractDbOccurenceModel::create()
     * @param User $object
     */
    public function create($object): void
    {
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
                Schema::USER['dateRecord'],
                Schema::USER['timeRecord'],
                Schema::USER['photo'],
            ],
            
            [
                $object->getId(),
                $object->getName(),
                $object->getSponsor()->getId(),
                $object->getParent()->getId(),
                $object->getEmail(),
                $object->getPhone(),
                $object->getPassword(),
                $object->getStatus()? 1 : 0,
                $object->getValidationMail()? 1 : 0,
                $object->getRecordDate()->format('Y-m-d'),
                $object->getRecordTime()->format('H:i:s'),
                $object->getPhoto()
            ]
        );
    }

    /**
     * {@inheritDoc}
     * @see \Root\Models\AbstractDbOccurenceModel::update()
     * @param User $object
     */
    public function update($object, $id): void
    {
        Queries::updateData(
            $this->getTableName(),
            [
                Schema::USER['name'],
                Schema::USER['phone'],
                Schema::USER['lastModifDate'],
                Schema::USER['lastModifTime'],
            ],
            "id = ?",
            [
                $object->getName(),
                $object->getPhone(),
                $object->getLastModifDate()->format('Y-m-d'),
                $object->getLastModifTime()->format('H:i:s'),
                $object->getId()
            ]
        );
    }


    /**
     * {@inheritDoc}
     * @see \Root\Models\AbstractDbOccurenceModel::getDBOccurence()
     * @return User
     */
    protected function getDBOccurence(array $keyValue)
    {
        $data = array();
        foreach (Schema::USER as $key => $value) {
            if (key_exists($value, $keyValue)) {
                $data[$key] = $keyValue[$value];
            }
        }
        return new User($data);
    }

    /**
     * {@inheritDoc}
     * @see \Root\Models\AbstractDbOccurenceModel::getTableName()
     */
    protected function getTableName() : string
    {
        return Schema::TABLE_SCHEMA['user'];
    }
    
    /**
     * @param string $userId
     * @return int
     */
    public function countLeftRightSides (string $userId) : int {
        $count = 0;
        
        if ($this->hasSides($userId)) {
            $count += $this->countLeftSide($userId);
            $count += $this->countRightSide($userId);
        }
        
        return $count;
    }
    
    /**
     * comptage des nombre des 
     * @param string $userId
     * @param int $side
     * @throws ModelException
     * @return int
     */
    public function countSide (string $userId, int $side) : int {
        $count = 0;
        switch ($side) {
            case User::FOOT_LEFT:{                
                if ($this->hasLeftSide($userId)) {
                    $user = $this->findLeftSide($userId);
                    $count++;
                    
                    if ($this->hasSides($user->getId())) {
                        $count += $this->countLeftRightSides($user->getId());
                    }
                }
            } break;
            
            case User::FOOT_RIGHT: {                
                if ($this->hasRightSide($userId)) {
                    $user = $this->findRightSide($userId);
                    $count++;
                    
                    if ($this->hasSides($user->getId())) {
                        $count += $this->countLeftRightSides($user->getId());
                    }
                }
                return 0;
            } break;
            
            default : {                
                throw new ModelException("Side inconue => {$side}");
            }
        }
        
        return $count;
    }
    
    /**
     * comptage des anfants d'un utilisateur sur son pied droid
     * @param string $userId
     * @return int
     */
    public function countRightSide (string $userId) : int {
        return $this->countSide($userId, User::FOOT_RIGHT);
    }
    
    /**
     * comptage des anfant d'un utilisateur sur le pied gauche
     * @param string $userId
     * @return int
     */
    public function countLeftSide (string $userId) : int {
        return $this->countSide($userId, User::FOOT_LEFT);
    }
    
    /**
     * revoie une collection des piles des utilisateurs en dessous d'un utilisateur 
     * @param string $userId
     * @return array
     */
    public function findDownlineLeftRightSides (string $userId) : array {
        $data = array();
        if ($this->hasLeftSide($userId)) {
            $data[] = $this->findDownlineRightSide($userId);
        }
        
        if ($this->hasRightSide($userId)) {
            $data[] = $this->findDownlineLeftSide($userId);
        }
        return $data;
    }
    
    public function findRoot ($userId) : User {
        
    }
    
    /**
     * 
     * @param string $userId
     * @param int $side
     * @return User
     */
    public function findDownlineSide (string $userId, int $side) : User {
        $user = null;
        switch ($side) {
            case User::FOOT_LEFT:{
                if ($this->hasLeftSide($userId)) {
                    $user = $this->findLeftSide($userId);
                }else {
                    throw new ModelException("aucun downline pour sur le pied {$side} de {$userId}");
                }
            } break;
            
            case User::FOOT_RIGHT: {
                if ($this->hasRightSide($userId)) {
                    $user = $this->findRightSide($userId);                    
                } else {
                    throw new ModelException("aucun downline pour sur le pied {$side} de {$userId}");
                }
            } break;
            
            default : {
                throw new ModelException("Side inconue => {$side}");
            }
        }
        
        if ($this->hasSides($user->getId())) {
            $user->setSides($this->findDownlineLeftRightSides($user->getId()));
        }
        return $user;
    }
    
    /**
     * renvoie l'enfant sur le pied gauche de l'utiilisateur en parametre
     * @param string $userId
     * @return User
     */
    public function findDownlineLeftSide (string $userId) : User {
        return $this->findDownlineSide($userId, User::FOOT_LEFT);
    }
    
    /**
     * Renvoie la pile des enfant en droit de l'utilisateur en parametre 
     * @param string $userId
     * @return User
     */
    public function findDownlineRightSide (string $userId) : User {
        return $this->findDownlineSide($userId, User::FOOT_RIGHT);
    }
    
    /**
     * revoie tout les anfants en dessous d'un utilisateur
     * @param string $userId
     * @throws ModelException
     * @return array
     */
    public function findLeftRightSides (string $userId) : array {
        $return = array();
        try {
            $statement = Queries::executeQuery("SELECT * FROM {$this->getTableName()} WHERE ".Schema::USER['sponsor']."=? ", array($userId));
            if ($row = $statement->fetch()) {
                $return[] = new User($row);
                while ($row = $statement->fetch()) {
                    $return[] = new User($row);
                }
                $statement->closeCursor();
            }else {
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
    public function findSide (string $userId, int $side) : User {
        $return = null;
        try {
            $statement = Queries::executeQuery("SELECT * FROM {$this->getTableName()} WHERE ".Schema::USER['sponsor']."=? AND ".Schema::USER['side']." = ?", array($userId, $side));
            if ($row = $statement->fetch()) {
                $return = new User($row);
                $statement->closeCursor();
            }else {
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
    public function findLeftSide (string $userId) : User {
        return $this->findSide($userId, User::FOOT_LEFT);
    }
    
    /**
     * revoie l'anfant sur le pied droit d'un utilisateur
     * @param string $userId
     * @return User
     */
    public function findRightSide (string $userId) : User {
        return $this->findSide($userId, User::FOOT_RIGHT);        
    }
    
    /**
     * revoir le sponsor directe d'un utilisateur
     * @param string $userId
     * @return User
     */
    public function findSponsor (string $userId) : User {
        $user = $this->findById($userId);
        return $this->findById($user->getSponsort()->getId());
    }
    
    /**
     * revoie le parent le parent de l'utilisateur en parametre
     * @param string $userId
     * @return User
     */
    public function findParent (string $userId) : User {
        $user = $this->findById($userId);
        return $this->findById($user->getParent()->getId());
    }
    
    /**
     * verifcation si un utilisateur deja sposoriser aumoin une personne
     * @param string $userId
     * @return bool
     */
    public function hasSides (string $userId) : bool {
        return  $this->check("sponsor", $userId);
    }
    
    /**
     * est-ce que cet utilisateur a un utilisateur sur le pied en parametre??
     * @param string $userId
     * @param int $side
     * @throws ModelException
     * @return bool
     */
    public function hasSide (string $userId, int $side) : bool {
        $return = false;
        try {
            $statement = Queries::executeQuery("SELECT ".Schema::USER['sponsor']." FROM {$this->getTableName()} WHERE ".Schema::USER['sponsor']."=? AND ".Schema::USER['side']." = ?", array($userId, $side));
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
    public function hasLeftSide (string $userId) : bool {
        return $this->hasSide($userId, User::FOOT_LEFT);
    }
    
    /**
     * verfication si un utilisateur a un afant su le pied droit
     * @param string $userId
     * @return bool
     */
    public function hasRightSide (string $userId) : bool {
        return $this->hasSide($userId, User::FOOT_RIGHT);
    }
    
    /**
     * Verification si la personne a un parent
     * @param string $userId
     * @return bool
     */
    public function hasParent (string $userId) : bool {
        $user = $this->findById($userId);
        
        if ($user->getParent() != null) {
            return true;
        }
        return false;
    }
    
    /**
     * verification si la personne a un sponsor
     * @param string $userId
     * @return bool
     */
    public function hasSponsor (string $userId) : bool {
        $user = $this->findById($userId);
        
        if ($user->getParent() != null) {
            return true;
        }
        return false;
    }

}

