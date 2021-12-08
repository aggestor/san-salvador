<?php
namespace Root\Model;   
use Root\Models\Queries;
use Root\Models\Objects\Parainage;
use Root\Models\Schema;
use Root\Models\AbstractOperationModel;

/**
 * @author Mike
 *
 */
class ParainageModel extends AbstractOperationModel{

    /**
     * {@inheritDoc}
     * @see \Root\Models\AbstractDbOccurenceModel::create()
     * @param Parainage $object
     */
    public function create($object) : void {           
        $parainage = Schema::RETURN_INVEST;
        Queries::addData (
           $this-> getTableName(),
            [
                $parainage['id'],
                $parainage['inscriptionId'],
                $parainage['generator'],
                $parainage['amount'],
                $parainage['dateRecord'],
                $parainage['timeRecord'],
                $parainage['surplus'],
            ],
            [
                $object->getId(),
                $object->getInscription(),
                $object->getGenerator(),
                $object->getAmount(),
                $object->getRecordDate(),
                $object->getRecordTime(),
                $object->getSurplus()                   
            ]
        );
    }
    
    /**
     * {@inheritDoc}
     * @see \Root\Models\AbstractDbOccurenceModel::getTableName()
     */
    protected function getTableName() : string {
        return Schema::TABLE_SCHEMA['parainage'];

    }
    
    /**
     * {@inheritDoc}
     * @see \Root\Models\AbstractDbOccurenceModel::getDBOccurence()
     */
    protected function getDBOccurence(array $keyValue)
    {
        $data = array();
        foreach ( Schema::PARAINAGE  as $key=>$value){
            if(key_exists($value,$keyValue)){
                $data[$key]=$keyValue[$key];
            }
        }
        return new Parainage($data);
    }
    
    /**
     * {@inheritDoc}
     * @see \Root\Models\AbstractOperationModel::getFieldsNames()
     */
    protected function getFieldsNames(): array
    {
        return Schema::PARAINAGE;
    }


}