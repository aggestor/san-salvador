<?php

namespace Root\App\Models;

use Root\App\Models\Objects\ReturnInvest;

class ReturnInvestModel extends AbstractOperationModel
{

    /**
     * La methode create permet l'insertion d'une nouvelle occurence data la table ReturnInvest
     * il prend a paramettre une objet ReturnInvest
     * {@inheritDoc}
     * @see \Root\App\Models\AbstractDbOccurenceModel::create()
     * @param ReturnInvest $object
     */
    public function create($object): void
    {
        $ReturnInvest = Schema::RETURN_INVEST;
        Queries::addData(
            $this->getTableName(),
            [
                $ReturnInvest['id'],
                $ReturnInvest['inscriptionId'],
                $ReturnInvest['amount'],
                $ReturnInvest['recordDate'],
                $ReturnInvest['timeRecord'],
                $ReturnInvest['surplus'],
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
     * @see \Root\App\Models\AbstractDbOccurenceModel::getTableName()
     */
    protected function getTableName(): string
    {
        return Schema::TABLE_SCHEMA['returnInvest'];
    }

    /**
     * {@inheritDoc}
     * @see \Root\App\Models\AbstractDbOccurenceModel::getDBOccurence()
     */
    protected function getDBOccurence(array $keyValue)
    {
        $data = array();
        foreach (Schema::RETURN_INVEST  as $key => $value) {
            if (key_exists($value, $keyValue)) {
                $data[$key] = $keyValue[$value];
            }
        }
        return new ReturnInvest($data);
    }

}
