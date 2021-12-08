<?php
namespace Root\Model;   
use Root\Models\Queries;
use Root\Models\Objects\Pack;
use Root\Models\Schema;
use Root\Models\AbstractDbOccurenceModel;

class PackModel extends AbstractDbOccurenceModel{

    /**
     * {@inheritDoc}
     * @see \Root\Models\AbstractDbOccurenceModel::create()
     * @param Pack $object
     */
    public function create($object) : void {
        $pack = Schema::PACK;
        Queries::addData (
           $this-> getTableName(),
            [
                $pack['id'],
                $pack['name'],
                $pack['currency'],
                $pack['mountMin'],
                $pack['mountMax'],
                $pack['image'],
                $pack['adminId'],
                $pack['dateRecord'],
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
                $object->getAdmin(),
                $object->getRecordDate(),
                $object->getRecordTime(),
                $object->getLevel()
            ]
        );
    }

    /**
     * mis en jour d'un occurence dont l'ID est en 2em parametre de cette methode
     * {@inheritDoc}
     * @see \Root\Models\AbstractDbOccurenceModel::update()
     * @param Pack $object
     */
    public  function update($object,  $id) : void {
        $pack = Schema::PACK;
        Queries::updateData(
            $this-> getTableName(),
            [                    
                $pack['name'],
                $pack['currency'],
                $pack['mountMin'],
                $pack['mountMax'],
                $pack['image'],
                $pack['adminId'],
                $pack['dateRecord'],
                $pack['timeRecord'],
                $pack['leval'],
                $pack['modifDate'],
                $pack['modifTime'],
            ],
            "{$pack['id']}=?",
            [
                $object->getName(),
                $object->getAcurracy(),
                $object->getAmountMin(),
                $object->getAmountMax(),
                $object->getImage(),
                $object->getAdmin(),
                $object->getRecordDate(),
                $object->getRecordTime(),
                $object->getLevel(),
                $object->getLastModifDate(),
                $object->getLastModifTime(),
                $object->getId()
            ]
        );
    }

    /**
     * {@inheritDoc}
     * @see \Root\Models\AbstractDbOccurenceModel::getTableName()
     */
    protected function getTableName() : string {
        return Schema::TABLE_SCHEMA['pack'];

    }
    
    /**
     * {@inheritDoc}
     * @see \Root\Models\AbstractDbOccurenceModel::getDBOcurence()
     */
    protected function getDBOccurence(array $keyValue)
    {
        $data = array();
        foreach (Schema::PACK  as $key=>$value){
            if(key_exists($value,$keyValue)){
                $data[$key]=$keyValue[$key];
            }
        }
        return new Pack($data);
    }

}
