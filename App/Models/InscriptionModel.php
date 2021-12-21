<?php
    namespace Root\Models;
    use Root\App\Models\Queries;
    use Root\App\Models\Objects\Inscription;
    use Root\App\Models\Schema;
    use Root\App\Models\AbstractDbOccurenceModel;
    class InscriptionModel extends AbstractDbOccurenceModel{
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
                    Schema::INSCRIPTION['transactionCode']
                ],                
                [
                    $object->getId(),
                    $object->getUser(),
                    $object->getPack(),
                    $object->getAmount(),
                    $object->getState() ? 1 : 0,
                    $object->getTransactionOrigi(),
                    $object->getTransactionCode()                    
                ]
            );
        }

    /**
     * Confirmation de l'inscription
     * {@inheritDoc}
     * @see \Root\Models\AbstractDbOccurenceModel::update()
     * @param INSCRIPTION $object
     */
    public  function update($object,  $id) : void {
       
        Queries::updateData(
            $this-> getTableName(),
            [                  
                Schema::INSCRIPTION['validateInscription'],                
                Schema::INSCRIPTION['adminId'],
                Schema::INSCRIPTION['confirmatDate'],
                Schema::INSCRIPTION['confirmateTime'],
            ],
            "id=?",
            [
                $object->getValidate()? 1 : 0,
                $object->getAdmin(),
                $object->getConfirmationDate(),
                $object->getConfirmationTime(),
                $object->getId()
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
        protected function getTableName() : string
        {
            return Schema::TABLE_SCHEMA['inscription'];
        }
    }
?>