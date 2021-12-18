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
     * @see \Root\Models\AbstractDbOccurenceModel::update()
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
    public function checkForUser ($userId)  : bool {
        $inscriptionTableName = Schema::TABLE_SCHEMA['inscription'];
        $userIdName = Schema::INSCRIPTION['user'];
        $SQL = "SELECT {$this->getTableName()}.id AS id, {$inscriptionTableName}.{$userIdName} AS userId FROM {$this->getTableName()} INNER JOIN {$inscriptionTableName} ON {$this->getTableName()}.id_inscription = {$inscriptionTableName}.id WHERE userId = ?";
        
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
    public function findForUser ($userId)  : array {
        
        $inscriptionTableName = Schema::TABLE_SCHEMA['inscription'];
        $userIdName = Schema::INSCRIPTION['user'];
        
        $fields = $this->getFieldsNames();
        $fieldsTxt = "";
        $compter = 0;
       
        foreach ($fields as $v) {
            $fieldsTxt .= "{$this->getTableName()}.{$v} AS {$v}".($compter < count($fields)? ",":"");
        }
        $SQL = "SELECT {$fieldsTxt} FROM {$this->getTableName()} INNER JOIN {$inscriptionTableName} ON {$this->getTableName()}.id_inscription = {$inscriptionTableName}.id WHERE {$userIdName} = ?";
        
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
    
    /**
     * doit renvoyer la liste des champs de la table, conformement au Schema
     * @return array
     */
    protected abstract function getFieldsNames  () : array;

}

