<?php
namespace Root\App\Models;
use Root\App\Models\Queries;
use Root\App\Models\Objects\Pack;
use Root\App\Models\Schema;
use Root\App\Models\AbstractDbOccurenceModel;

class PackModel extends Pack{

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
    /**
     * ce nom existe????
     * @param string $name
     * @return bool
     * @throws ModelException s'il y a erreur lors la communication avec ladd
     */
    public function checkByName (string $name) : bool {
        $AbstractDbOccurenceModel=new AbstractDbOccurenceModel();
        return $AbstractDbOccurenceModel->check(Schema::PACK['name'], $name);
   }
   /**
     * Revoie le pack dont vous avez besoin
     * @param string $name
     * @return \Root\Models\Objects\Pack
     */
    public function findByName (string $name) {
        $AbstractDbOccurenceModel=new AbstractDbOccurenceModel();
        return $AbstractDbOccurenceModel->find(Schema::PACK['name'], $name);
    }
   /**
     * Revoie le pack dont vous avez besoin
     * @param string $name
     * @return \Root\Models\Objects\Pack
     */
    public function findById (string $id) {
        $AbstractDbOccurenceModel=new AbstractDbOccurenceModel();
        return $AbstractDbOccurenceModel->find(Schema::PACK['id'], $id);
    }
   /**
     * Revoie tous le pack
     * @return \Root\Models\Objects\Pack
     */
    public function findAll () {
        $AbstractDbOccurenceModel=new AbstractDbOccurenceModel();
        return $AbstractDbOccurenceModel->findAll();
    }

}
