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
                $object->getRecordDate(),
                $object->gettimeRecord()
            ]
        );
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
        foreach (Schema::CASHOUT  as $key => $value) {
            if (key_exists($value, $keyValue)) {
                $data[$key] = $keyValue[$key];
            }
        }
        return new CashOut($data);
    }
}
