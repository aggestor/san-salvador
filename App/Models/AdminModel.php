<?php
namespace Root\Models;

use Root\Models\Objects\Admin;

/**
 *
 * @author Esaie MUHASA
 *        
 */
class AdminModel extends AbstractMemberModel
{
    /**
     * {@inheritDoc}
     * @see \Root\Models\AbstractDbOccurenceModel::create()
     * @param Admin $object
     */
    public function create($object): void
    {
        Queries::addData(
            $this->getTableName(),
            [
                Schema::USER['id'],
                Schema::USER['name'],
                Schema::USER['email'],
                Schema::USER['password'],
                Schema::USER['dateRecord'],
                Schema::USER['timeRecord'],
                Schema::USER['validationEmail'],
                Schema::USER['status'],
            ],
            
            [
                $object->getId(),
                $object->getName(),
                $object->getEmail(),
                $object->getPassword(),
                $object->getRecordDate()->format('Y-m-d'),
                $object->getRecordTime()->format('H:i:s'),
                $object->getValidationMail()? 1 : 0,
                $object->getStatus()? 1 : 0
            ]
            );
    }

    /**
     * {@inheritDoc}
     * @see \Root\Models\AbstractDbOccurenceModel::getDBOccurence()
     */
    protected function getDBOccurence(array $keyValue)
    {
        $data = array();
        foreach (Schema::USER as $key => $value) {
            if (key_exists($value, $keyValue)) {
                $data[$key] = $keyValue[$value];
            }
        }
        return new Admin($data);
    }

    /**
     * {@inheritDoc}
     * @see \Root\Models\AbstractDbOccurenceModel::getTableName()
     */
    protected function getTableName(): string
    {
        return Schema::TABLE_SCHEMA['admin'];
    }

    /**
     * {@inheritDoc}
     * @see \Root\Models\AbstractDbOccurenceModel::update()
     */
    public function update($object, $id): void
    {
        // TODO Auto-generated method stub
        
    }

}

