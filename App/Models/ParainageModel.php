<?php

namespace Root\App\Models;

use Root\App\Models\Objects\Parainage;

/**
 * @author Mike
 *
 */
class ParainageModel extends AbstractOperationModel
{

    /**
     * {@inheritDoc}
     * @see \Root\App\Models\AbstractDbOccurenceModel::create()
     * @param Parainage $object
     */
    public function create($object): void
    {
        $this->createInTransaction(Queries::getPDOInstance(), $object);
    }

    /**
     * {@inheritDoc}
     * @see \Root\App\Models\AbstractDbOccurenceModel::createInTransaction()
     * @param Parainage $object
     */
    public function createInTransaction(\PDO $pdo, $object): void
    {
        $parainage = Schema::PARAINAGE;
        Queries::addDataInTransaction(
            $pdo,
            $this->getTableName(),
            [
                $parainage['id'],
                $parainage['user'],
                $parainage['generator'],
                $parainage['amount'],
                $parainage['recordDate'],
                $parainage['timeRecord'],
                $parainage['surplus'],
            ],
            [
                $object->getId(),
                $object->getUser()->getId(),
                $object->getGenerator()->getId(),
                $object->getAmount(),
                $object->getFormatedRecordDate(),
                $object->getFormatedTimeRecord(),
                $object->getSurplus()
            ]
        );
        
    }

    /**
     * {@inheritDoc}
     * @see \Root\App\Models\AbstractDbOccurenceModel::getTableName()
     */
    protected function getTableName(): string
    {
        return Schema::TABLE_SCHEMA['parainage'];
    }

    /**
     * {@inheritDoc}
     * @see \Root\App\Models\AbstractDbOccurenceModel::getDBOccurence()
     */
    protected function getDBOccurence(array $keyValue)
    {
        $data = array();
        foreach (Schema::PARAINAGE  as $key => $value) {
            if (key_exists($value, $keyValue)) {
                $data[$key] = $keyValue[$value];
            }
        }
        return new Parainage($data);
    }

}
