<?php

namespace Root\App\Models;

use Root\App\Models\Objects\ReturnInvest;
use Root\Core\GenerateId;

class ReturnInvestModel extends AbstractOperationModel
{

    /**
     * {@inheritDoc}
     * @see \Root\App\Models\AbstractDbOccurenceModel::create()
     * @param ReturnInvest $object
     */
    public function create($object): void
    {
        $this->createInTransaction(Queries::getPDOInstance(), $object);
    }
    
    /**
     * {@inheritDoc}
     * @see \Root\App\Models\AbstractDbOccurenceModel::createInTransaction()
     * @param ReturnInvest $object
     */
    public function createInTransaction(\PDO $pdo, $object): void{
        
        $id = $object->getId() != null ? $object->getId() : GenerateId::generate();
        while($this->checkById($id)) {//verification de l'unicite de l'id
            $id = GenerateId::generate();
        }

        $ReturnInvest = Schema::RETURN_INVEST;
        Queries::addData(
            $this->getTableName(),
            [
                $ReturnInvest['id'],
                $ReturnInvest['user'],
                $ReturnInvest['amount'],
                $ReturnInvest['recordDate'],
                $ReturnInvest['timeRecord'],
                $ReturnInvest['surplus'],
            ],
            [
                $id,
                $object->getUser()->getId(),
                $object->getAmount(),
                $object->getFormatedRecordDate(),
                $object->getFormatedTimeRecord(),
                $object->getSurplus()
            ]
        );

        $object->setId($id);
    }

    /**
     * Envoie du bonus journalier pour.
     * la collection en parametre est precalculer d'anvence.
     * En plus, si le compte doit etre veruiller, l'etat de l'attribut locked du user concerner doit etre mis en true
     * @param ReturnInvest[] $bonus
     * @return void
     * @throws ModelException s'il y a erreur lors de l'envoie des bonus
     */
    public function createAll (array $bonus) : void  {
        /**
         * @var UserModel $userModel
         */
        $userModel = $this->getFactory()->getModel('User');

        $pdo = Queries::getPDOInstance();

        try {

            if(!$pdo->beginTransaction()) {
                throw new ModelException("Une erreur est survenue lors de la creation de la transaction");
            }

            foreach ($bonus as $bn) {
                
                if($bn->getSurplus() != 0 || $bn->getUser()->isLocked()) {//pour les utilisateurs dont les comptes doivent etre veruiller
                    $userModel->lockAcount($pdo, $bn->getUser()->getId());
                }

                //finalement on enregistre le bonus
                $this->createInTransaction($pdo, $bn);
            }

            $pdo->commit();
        } catch (\PDOException $e) {
            try {
                $pdo->rollBack();
            } catch (\Exception $th) {}
            throw new ModelException($e->getMessage(), intval($e->getCode(), 10), $e);
        }
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
