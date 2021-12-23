<?php

namespace Root\App\Models;

use Root\App\Models\Queries;
use Root\App\Models\Objects\Binary;
use Root\App\Models\Schema;
use Root\App\Models\AbstractOperationModel;

/**
 * 
 * @author Mike
 *
 */
class BinaryModel extends Binary
{

    /**
     * {@inheritDoc}
     * @see \Root\Models\AbstractDbOccurenceModel::update()
     * @param Binary $object
     */
    public function create($object): void
    {
        $Binary = Schema::BINARY;
        Queries::addData(
            $this->getTableName(),
            [
                $Binary['id'],
                $Binary['inscriptionId'],
                $Binary['amount'],
                $Binary['mountMin'],
                $Binary['recordDate'],
                $Binary['timeRecord'],
                $Binary['surplus']
            ],
            [
                $object->getId(),
                $object->getInscription(),
                $object->getAmount(),
                $object->getRecordDate(),
                $object->gettimeRecord(),
                $object->getSurplus()
            ]
        );
    }

    /**
     * {@inheritDoc}
     * @see \Root\Models\AbstractDbOccurenceModel::getTableName()
     */
    protected function getTableName(): string
    {
        return Schema::TABLE_SCHEMA['binary'];
    }

    /**
     * {@inheritDoc}
     * @see \Root\Models\AbstractDbOccurenceModel::getDBOccurence()
     */
    protected function getDBOccurence(array $keyValue)
    {
        $data = array();
        foreach (Schema::BINARY  as $key => $value) {
            if (key_exists($value, $keyValue)) {
                $data[$key] = $keyValue[$key];
            }
        }
        return new Binary($data);
    }

    /**
     * {@inheritDoc}
     * @see \Root\Models\AbstractOperationModel::getFieldsNames()
     */
    protected function getFieldsNames(): array
    {
        return Schema::BINARY;
    }
}
