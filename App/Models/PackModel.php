<?php

namespace Root\App\Models;

use Root\App\Models\Queries;
use Root\App\Models\Objects\Pack;
use Root\App\Models\Schema;
use Root\App\Models\AbstractDbOccurenceModel;

class PackModel extends AbstractDbOccurenceModel{

    /**
     * {@inheritDoc}
     * @see \Root\Models\AbstractDbOccurenceModel::create()
     * @param Pack $object
     */
    public function create($object): void
    {
        $pack = Schema::PACK;
        Queries::addData(
            $this->getTableName(),
            [
                $pack['id'],
                $pack['name'],
                $pack['currency'],
                $pack['mountMin'],
                $pack['mountMax'],
                $pack['image'],
                $pack['recordDate'],
                $pack['timeRecord'],
                $pack['leval']
            ],
            [
                $object->getId(),
                $object->getName(),
                $object->getAcurracy(),
                $object->getAmountMin(),
                $object->getAmountMax(),
                $object->getImage(),
                $object->getRecordDate()->format('Y-m-d'),
                $object->gettimeRecord()->format('H:i:s'),
                $object->getLevel()
            ]
        );
    }
    /**
     * {@inheritDoc}
     * @see \Root\Models\AbstractDbOccurenceModel::create()
     * @param Pack $object
     */
    public function update($object, $id): void
    {
        $pack = Schema::PACK;
        Queries::updateData(
            $this->getTableName(),
            [
                $pack['name'],
                $pack['acurracy'],
                $pack['amountMin'],
                $pack['amountMax'],
                $pack['image'],
                $pack['modifDate'],
                $pack['modifTime'],
                $pack['leval']
            ],
            "id=?",
            [

                $object->getName(),
                $object->getAcurracy(),
                $object->getAmountMin(),
                $object->getAmountMax(),
                $object->getImage(),
                $object->getLastModifDate(),
                $object->getLastModifTime(),
                $object->getLevel(),
                $id
            ]
        );
    }

  

    /**
     * {@inheritDoc}
     * @see \Root\Models\AbstractDbOccurenceModel::getTableName()
     */
    protected function getTableName(): string
    {
        return Schema::TABLE_SCHEMA['pack'];
    }

    /**
     * {@inheritDoc}
     * @see \Root\Models\AbstractDbOccurenceModel::getDBOcurence()
     */
    protected function getDBOccurence(array $keyValue)
    {
        $data = array();
        $keyVal = $keyValue;
        foreach (Schema::PACK as $key => $value) {

            if (key_exists($value, $keyVal)) {
                $data[$key] = $keyVal[$value];
            }
        }
//var_dump($data);exit();
        return new Pack($data);
    }
    /**
     * ce nom existe????
     * @param string $name
     * @return bool
     * @throws ModelException s'il y a erreur lors la communication avec ladd
     */
    public function checkByName(string $name): bool
    {
        return $this->check(Schema::PACK['name'], $name);
    }

    


}
