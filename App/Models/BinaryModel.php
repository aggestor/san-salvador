<?php

namespace Root\App\Models;

use Root\App\Models\Objects\Binary;

/**
 * 
 * @author Mike
 *
 */
class BinaryModel extends AbstractOperationModel{

    /**
     * {@inheritDoc}
     * @see \Root\App\Models\AbstractDbOccurenceModel::update()
     * @param Binary $object
     */
    public function create($object): void
    {
        try {            
            $this->createInTransaction(Queries::getPDOInstance(), $object);
        } catch (\PDOException $e) {
            throw new ModelException($e->getMessage(), intval($e->getCode(), 10), $e);
        }
    }

    /**
     * {@inheritDoc}
     * @see \Root\App\Models\AbstractDbOccurenceModel::createInTransaction()
     * @param Binary $object
     */
    public function createInTransaction(\PDO $pdo, $object): void
    {
        $Binary = Schema::BINARY;
        Queries::addDataInTransaction(
            $pdo,
            $this->getTableName(),
            [
                $Binary['id'],
                $Binary['user'],
                $Binary['generator'],
                $Binary['amount'],
                $Binary['surplus'],
                $Binary['recordDate'],
                $Binary['timeRecord']
            ],
            [
                $object->getId(),
                $object->getUser()->getId(),
                $object->getGenerator()->getId(),
                $object->getAmount(),
                $object->getSurplus(),
                $object->getFormatedRecordDate(),
                $object->getFormatedTimeRecord()
            ]
        );
    }

    /**
     * {@inheritDoc}
     * @see \Root\App\Models\AbstractDbOccurenceModel::getTableName()
     */
    protected function getTableName(): string
    {
        return Schema::TABLE_SCHEMA['binary'];
    }

    /**
     * {@inheritDoc}
     * @see \Root\App\Models\AbstractDbOccurenceModel::getDBOccurence()
     */
    protected function getDBOccurence(array $keyValue)
    {
        $data = array();
        foreach (Schema::BINARY  as $key => $value) {
            if (key_exists($value, $keyValue)) {
                $data[$key] = $keyValue[$value];
            }
        }
        return new Binary($data);
    }
}
