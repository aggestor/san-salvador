<?php
    namespace Root\Models;
    use Root\App\Models\Queries;
    use Root\App\Models\Objects\Inscription;
    use Root\App\Models\Schema;
    use Root\App\Models\AbstractDbOccurenceModel;
    use Root\App\Models\ModelException;
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
                Schema::INSCRIPTION['transactionCode'],
                Schema::INSCRIPTION['recordDate'],
                Schema::INSCRIPTION['recordTime']
            ],
            [
                $object->getId(),
                $object->getUser()->getId(),
                $object->getPack()->getId(),
                $object->getAmount(),
                $object->getState() ? 1 : 0,
                $object->getTransactionOrigi(),
                $object->getTransactionCode(),                
                $object->getRecordDate()->format('Y-m-d'),
                $object->gettimeRecord()->format('H:i:s')
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
    protected function getTableName(): string
    {
        return Schema::TABLE_SCHEMA['inscription'];
    }

    public function update($object, $id): void
    {
        throw new ModelException("Operation non pris en charge");
    }
    /**
     * @return bool
     */
    public function checkIfExistActivePack(string $userId): bool
    {
        $return = false;
        try {
            $statement = Queries::executeQuery("SELECT * FROM {$this->getTableName()} WHERE  {Schema::INSCRIPTION['user']}=? AND {Schema::INSCRIPTION['state']}=?", array($userId,1));
            if ($statement->fetch()) {
                $return = true;
            }
            $statement->closeCursor();
        } catch (\PDOException $e) {
            throw new ModelException("Une erreur est survenue lors de la communication avec la BDD", intval($e->getCode(), 10), $e);
        }

        return $return;
    }
    /**
     * @return bool
     */
    public function checkIfExistInActivePack(string $userId): bool
    {
        $return = false;
        try {
            $statement = Queries::executeQuery("SELECT * FROM {$this->getTableName()} WHERE  {Schema::INSCRIPTION['user']}=? AND {Schema::INSCRIPTION['state']}=?", array($userId,0));
            if ($statement->fetch()) {
                $return = true;
            }
            $statement->closeCursor();
        } catch (\PDOException $e) {
            throw new ModelException("Une erreur est survenue lors de la communication avec la BDD", intval($e->getCode(), 10), $e);
        }

        return $return;
    }
        /**
     * revoie tout les informations des souscription en attante de validation
     * @param string $userId
     * @throws ModelException
     * @return array
     */
    public function findAwaitForValidation(string $userId): array
    {
        $return = array();
        try {
            $statement = Queries::executeQuery("SELECT * FROM {$this->getTableName()} WHERE { Schema::INSCRIPTION['user']}=? AND  { Schema::INSCRIPTION['validateInscription']}", array($userId,0));
            if ($row = $statement->fetch()) {
                $return[] = new INSCRIPTION($row);
                while ($row = $statement->fetch()) {
                    $return[] = new INSCRIPTION($row);
                }
                $statement->closeCursor();
            } else {
                $statement->closeCursor();
                $return=$return;
            }
        } catch (\PDOException $e) {
            throw new ModelException("Une erreur est survenue lors de la communication avec la BDD", intval($e->getCode()), $e);
        }
        return $return;
    }
        /**
     * revoie tout les informations des souscription deja valide
     * @param string $userId
     * @throws ModelException
     * @return array
     */
    public function findForValidation(string $userId): array
    {
        $return = array();
        try {
            $statement = Queries::executeQuery("SELECT * FROM {$this->getTableName()} WHERE { Schema::INSCRIPTION['user']}=? AND  { Schema::INSCRIPTION['validateInscription']}", array($userId,1));
            if ($row = $statement->fetch()) {
                $return[] = new INSCRIPTION($row);
                while ($row = $statement->fetch()) {
                    $return[] = new INSCRIPTION($row);
                }
                $statement->closeCursor();
            } else {
                $statement->closeCursor();
                $return=$return;
            }
        } catch (\PDOException $e) {
            throw new ModelException("Une erreur est survenue lors de la communication avec la BDD", intval($e->getCode()), $e);
        }
        return $return;
    }
}
