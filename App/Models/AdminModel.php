<?php

namespace Root\App\Models;

use Root\App\Models\Objects\Admin;

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
        
        try{
             Queries::addData(
                $this->getTableName(),
                [
                    Schema::ADMIN['id'],
                    Schema::ADMIN['name'],
                    Schema::ADMIN['email'],
                    Schema::ADMIN['dateRecord'],
                    Schema::ADMIN['timeRecord'],
                    Schema::ADMIN['validationEmail'],
                    Schema::ADMIN['status'],
                    Schema::ADMIN['token']
                ],

                [
                    $object->getId(),
                    $object->getName(),
                    $object->getEmail(),
                    $object->getRecordDate()->format('Y-m-d'),
                    $object->getRecordTime()->format('H:i:s'),
                    $object->getValidationMail() ? 1 : 0,
                    $object->getStatus() ? 1 : 0,
                    $object->getToken()
                ]
            ) 
         ;
        } catch (\PDOException $th) {
            throw new ModelException($th->getMessage());
        }
    }

    /**
     * {@inheritDoc}
     * @see \Root\Models\AbstractDbOccurenceModel::getDBOccurence()
     */
    protected function getDBOccurence(array $keyValue)
    {
        $data = array();
        foreach (Schema::ADMIN as $key => $value) {
            if (key_exists($value, $keyValue)) {
                $data[$key] = $keyValue[$value];
            }
        }
        return new Admin($data);
    }
    /**
     * mis en jour du mot de passe d'un l'admin
     * @param string $id
     * @param string $password
     */
    public function updatePassword($id, string $password): void
    {
        try{
            Queries::updateData(
                $this->getTableName(),
                [
                    Schema::ADMIN['password'],
                    Schema::ADMIN['validationEmail'],
                ],
                "id = ?",
                [$password,1, $id]
            );
        } catch (\PDOException $th) {
            throw new ModelException($th->getMessage());
        }
    }

    /**
     * mis en jour du token de l'admin
     * @param string $token
     * @param string $id
     */
    public function updateToken($token,$id): void
    {
        try{
            Queries::updateData(
                $this->getTableName(),
                [Schema::ADMIN['token']],
                "id = ?",
                [$token, $id]
            );
        } catch (\PDOException $th) {
            throw new ModelException($th->getMessage());
        }
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
