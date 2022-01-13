<?php

namespace Root\App\Models;

use Root\App\Models\Objects\Pack;

class PackModel extends AbstractDbOccurenceModel
{

    /**
     * {@inheritDoc}
     * @see \Root\App\Models\AbstractDbOccurenceModel::create()
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
                $pack['acurracy'],
                $pack['amountMin'],
                $pack['amountMax'],
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
     * @see \Root\App\Models\AbstractDbOccurenceModel::create()
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
     * @see \Root\App\Models\AbstractDbOccurenceModel::getTableName()
     */
    protected function getTableName(): string
    {
        return Schema::TABLE_SCHEMA['pack'];
    }

    /**
     * {@inheritDoc}
     * @see \Root\App\Models\AbstractDbOccurenceModel::getDBOcurence()
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

    /**
     * verifie s'il y a un pack pour le montant en parametre
     * @param int $amount
     * @throws ModelException
     * @return bool
     */
    public function checkByAmount(int $amount): bool
    {
        $return = false;
        $min = Schema::PACK['amountMin'];
        $max = Schema::PACK['amountMax'];

        try {
            $statement = Queries::executeQuery("SELECT * FROM {$this->getTableName()} WHERE {$min}<= ? AND {$max} >= ? LIMIT 1", array($amount, $amount));

            if ($statement->fetch()) {
                $return = true;
            }
            $statement->closeCursor();
        } catch (\PDOException $e) {
            throw new ModelException("Une erreur est survenue lors de la communication avec la BDD", intval($e->getCode()), $e);
        }

        return $return;
    }

    /**
     * renvoie le pack pour le montant en parametre
     * @param int $amount
     * @throws ModelException
     * @return Pack
     */
    public function findByAmount(int $amount): Pack
    {
        $return = null;
        $min = Schema::PACK['amountMin'];
        $max = Schema::PACK['amountMax'];

        try {
            $statement = Queries::executeQuery("SELECT * FROM {$this->getTableName()} WHERE {$min}<= ? AND {$max} >= ? LIMIT 1", array($amount, $amount));

            if ($row = $statement->fetch()) {
                $return = $this->getDBOccurence($row);
            } else {
                $statement->closeCursor();
                throw new ModelException("Aucun packet ne supporte le montant {$amount} USD");
            }

            $statement->closeCursor();
        } catch (\PDOException $e) {
            throw new ModelException("Une erreur est survenue lors de la communication avec la BDD", intval($e->getCode()), $e);
        }

        return $return;
    }

    /**
     * revoie une collection d'object
     * *il est possible de recuperer une intervale des donnees
     * @param int $limit
     * @param int $offset
     * @return DBOccurence[]
     * @throws ModelException s'il y a erreur lors de la communication avec la BDD
     * soit aucun resultat n'a ete retourner par la requette de selection
     */
    public function findAllPack(?int $limit = null, int $offset = 0): array
    {
        $data = array();
        $mount_min=Schema::PACK['amountMin'];
        try {
            $statement = Queries::executeQuery("SELECT * FROM {$this->getTableName()} ORDER BY {$mount_min} " . ($limit != null ? "LIMIT {$limit} OFFSET {$offset}" : ""), array());
            if ($row = $statement->fetch()) {
                $data[] = $this->getDBOccurence($row);
                while ($row = $statement->fetch()) {
                    $data[] = $this->getDBOccurence($row);
                }
                $statement->closeCursor();
            } else {
                $statement->closeCursor();
                throw new ModelException("Aucun resultat pour la requette executé");
            }
        } catch (\PDOException $e) {
            throw new ModelException("Une erreur est survenue lors de la communication avec la BDD", intval($e->getCode()), $e);
        }
        return $data;
    }
}
