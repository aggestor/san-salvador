<?php
namespace Root\Model;   
use Root\Models\Queries;
use Root\Models\Objects\CashOut;
use Root\Models\Schema;
use Root\Models\AbstractOperationModel;

class CashOutModel extends AbstractOperationModel{

    /**
     * {@inheritDoc}
     * @see \Root\Models\AbstractDbOccurenceModel::create()
     * @param  CashOut $object
     */
    public function create($object) : void {           
        $cashOut = Schema::CASHOUT;
        Queries::addData (
           $this-> getTableName(),
            [
                $cashOut['id'],
                $cashOut['inscriptionId'],
                $cashOut['amount'],
                $cashOut['dateRecord'],
                $cashOut['timeRecord'],
            ],
            [
                $object->getId(),
                $object->getInscription(),
                $object->getAmount(),
                $object->getRecordDate(),
                $object->getRecordTime()                  
            ]
        );
    }

    /**
     * {@inheritDoc}
     * @see \Root\Models\AbstractDbOccurenceModel::getTableName()
     */
    protected function getTableName() : string {
        return Schema::CASHOUT['cashOut'];

    }
    
    /**
     * {@inheritDoc}
     * @see \Root\Models\AbstractDbOccurenceModel::getDBOccurence()
     */
    protected function getDBOccurence(array $keyValue)
    {
        $data = array();
        foreach ( Schema::CASHOUT  as $key=>$value){
            if(key_exists($value,$keyValue)){
                $data[$key]=$keyValue[$key];
            }
        }
        return new CashOut($data);
    }
    
    /**
     * {@inheritDoc}
     * @see \Root\Models\AbstractOperationModel::getFieldsNames()
     */
    protected function getFieldsNames(): array
    {
        return Schema::CASHOUT;
    }

}
