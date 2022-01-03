<?php
namespace Root\App\Models;

use Root\App\Models\Objects\Operation;

/**
 *
 * @author Esaie MUHASA
 *        
 */
abstract class AbstractOperationModel extends AbstractDbOccurenceModel
{
    /**
     * {@inheritDoc}
     * @see \Root\App\Models\AbstractDbOccurenceModel::update()
     */
    public function update($object, $id): void
    {
        throw new ModelException("Operation non prise en charge");
    }
    
    /**
     * @param string $userId
     * @throws ModelException
     * @return bool
     */
    public function checkByUser ($userId)  : bool {
        $userIdName = Schema::INSCRIPTION['user'];
        $SQL = "SELECT * FROM {$this->getTableName()}  WHERE {$userIdName} = ?";
        
        $return = false;
        
        try {
            $statement = Queries::executeQuery($SQL, array($userId));
            if ($statement->fetch()) {
                $return = true;
            }
            $statement->closeCursor();
        } catch (\PDOException $e) {
            throw new ModelException($e->getMessage(), intval($e->getCode(), 10), $e);
        }
        
        return $return;
    }
    
    
    /**
     * revoie la collection des operation d'un utilisateur
     * @param string $userId
     * @throws ModelException
     * @return Operation[]
     */
    public function findByUser ($userId)  : array {
        
        $userIdName = Schema::INSCRIPTION['user'];

        $SQL = "SELECT * FROM {$this->getTableName()} WHERE {$userIdName} = ?";
        
        $return = array();
        
        try {
            $statement = Queries::executeQuery($SQL, array($userId));
            if ($row = $statement->fetch()) {
                $return[] = $this->getDBOccurence($row);
                while ($row = $statement->fetch()) {
                    $return[] = $this->getDBOccurence($row);
                }
                $statement->closeCursor();
            }else {
                $statement->closeCursor();
                throw new ModelException("Aucune operation dans le compte {$userId}");
            }
        } catch (\PDOException $e) {
            throw new ModelException($e->getMessage(), intval($e->getCode(), 10), $e);
        }
        
        return $return;
    }

}

