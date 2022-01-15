<?php

namespace Root\App\Models;

use Root\App\Models\Objects\CashOut;
class CashOutModel extends AbstractOperationModel
{

    /**
     * {@inheritDoc}
     * @see \Root\App\Models\AbstractDbOccurenceModel::create()
     * @param  CashOut $object
     */
    public function create($object): void
    {
        $cashOut = Schema::CASHOUT;
        Queries::addData(
            $this->getTableName(),
            [
                $cashOut['id'],
                $cashOut['user'],
                $cashOut['amount'],
                $cashOut['recordDate'],
                $cashOut['timeRecord'],
            ],
            [
                $object->getId(),
                $object->getUser()->getId(),
                $object->getAmount(),
                $object->getFormatedRecordDate(),
                $object->getFormatedTimeRecord()
            ]
        );
    }
    
    /**
     * validation de d'un CshOut
     * @param string $id
     * @param string $adminId
     */
    public function validate (string $id, string $adminId) : void {
        
        if ($this->checkValidated($id, true)) {
            throw new ModelException("Impossible d'effectuer cette operation car ce CashOut est deja valider");
        }
        
        try {
            Queries::updateData(
                $this->getTableName(),
                [
                    Schema::CASHOUT['validated'],
                ],
                "id = ?",
                [
                    $adminId,
                    $id
                ]
            );
            
        } catch (\PDOException $th) {
            throw new ModelException($th->getMessage());
        }
    }
    
    /**
     * 
     * @param string $id
     * @param bool $validated
     * @throws ModelException
     * @return bool
     */
    public function checkValidated (?string $id = null, bool $validated = false) : bool {
        $return = null;
        $args = [];
        
        if ($id !== null) {
            $args[] = $id;
        }
        try {
            $statement = Queries::executeQuery("SELECT * FROM {$this->getTableName()} WHERE ". ($id!=null? Schema::CASHOUT['id'].'=? AND ' : '').(Schema::CASHOUT['admin']).' IS '.($validated? 'NOT': ''). " NULL", $args);
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
     * renvoie les cashout. 
     * @param bool $validated : 
     * @param string $adminId
     * @throws ModelException
     * @return array|CashOut[]
     */
    public function findValidated (?bool $validated = false, ?string $adminId = null) : array {
        $return = [];
        $args = [];
        
        if ($adminId !== null) {
            $args[] = $adminId;
        }
        try {
            $statement = Queries::executeQuery("SELECT * FROM {$this->getTableName()}".(($validated !== null || $adminId !== null)? " WHERE " : ''). ($adminId!==null? Schema::CASHOUT['admin'].'=? AND ' : '').($validated !== null? ((Schema::CASHOUT['admin']).' IS '.($validated? 'NOT': ''). " NULL") : ''), $args);
            if ($row = $statement->fetch()) {
                $return[] = $this->getDBOccurence($row);
                while ($row = $statement->fetch()) {
                    $return[] = $this->getDBOccurence($row);
                }
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
     * {@inheritDoc}
     * @see \Root\App\Models\AbstractDbOccurenceModel::getTableName()
     */
    protected function getTableName(): string
    {
        return Schema::TABLE_SCHEMA['cashOut'];
    }

    /**
     * {@inheritDoc}
     * @see \Root\App\Models\AbstractDbOccurenceModel::getDBOccurence()
     */
    protected function getDBOccurence(array $keyValue)
    {
        $data = array();
        $keyVal = $keyValue;
        foreach (Schema::CASHOUT as $key => $value) {
            if (key_exists($value, $keyVal)) {
                $data[$key] = $keyVal[$value];
            }
        }
        return new CashOut($data);
    }
}
