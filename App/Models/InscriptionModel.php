<?php

namespace Root\App\Models;

use Root\App\Models\Objects\Inscription;

class InscriptionModel extends AbstractDbOccurenceModel
{
    /**
     * {@inheritDoc}
     * @see \Root\Models\AbstractDbOccurenceModel::create()
     * @param Inscription $object
     */
    public function create($object): void
    {
        Queries::addData(
            
            $this->getTableName(),
            [
                Schema::INSCRIPTION['id'],
                Schema::INSCRIPTION['user'],
                Schema::INSCRIPTION['packId'],
                Schema::INSCRIPTION['amount'],
                Schema::INSCRIPTION['state'],
                Schema::INSCRIPTION['transactionOrigin'],
                Schema::INSCRIPTION['transactionCode'],
                Schema::INSCRIPTION['recordDate'],
                Schema::INSCRIPTION['recordTime']
            ],
            [
                $object->getId(),
                $object->getUser()->getId(),
                $object->getPack()->getId(),
                $object->getAmount(),
                $object->getState() ? 1 : 0,
                $object->getTransactionOrigi(),
                $object->getTransactionCode(),                
                $object->getRecordDate()->format('Y-m-d'),
                $object->gettimeRecord()->format('H:i:s')
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

    public function update($object, $id): void
    {
        throw new ModelException("Operation non pris en charge");
    }
}
