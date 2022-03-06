<?php

namespace Root\App\Models;

use Root\App\Models\Objects\CashOut;

class CashOutModel extends AbstractOperationModel
{

    /**
     * {@inheritDoc}
     * @see \Root\App\Models\AbstractDbOccurenceModel::create()
     * @param  CashOut $object
     */
    public function create($object): void
    {
        $cashOut = Schema::CASHOUT;
        Queries::addData(
            $this->getTableName(),
            [
                $cashOut['id'],
                $cashOut['user'],
                $cashOut['amount'],
                $cashOut['recordDate'],
                $cashOut['timeRecord'],
                $cashOut['destination']
            ],
            [
                $object->getId(),
                $object->getUser()->getId(),
                $object->getAmount(),
                $object->getFormatedRecordDate(),
                $object->getFormatedTimeRecord(),
                $object->getDestination()
            ]
        );
    }

    /**
     * validation de d'un CshOut
     * @param string $id
     * @param string $adminId
     */
    public function validate(string $id, string $adminId): void
    {
        if ($this->checkValidated($id, true)) {
            throw new ModelException("Impossible d'effectuer cette operation car ce CashOut est deja valider");
        }

        try {
            Queries::updateData(
                $this->getTableName(),
                [
                    Schema::CASHOUT['admin'],
                ],
                "id = ?",
                [
                    $adminId,
                    $id
                ]
            );
        } catch (\PDOException $th) {
            throw new ModelException($th->getMessage());
        }
    }

    /**
     * verification des cashout ayant les statut en 2 em parametre
     * @param string $adminId
     * @param bool $validated
     * @throws ModelException
     * @return bool
     */
    public function checkValidated(?string $adminId = null, bool $validated = false): bool
    {
        $return = false;
        $args = [];

        if ($adminId !== null) {
            $args[] = $adminId;
        }
        try {
            $statement = Queries::executeQuery("SELECT * FROM {$this->getTableName()} WHERE " . ($adminId !== null ? Schema::CASHOUT['admin'] . '=? ' : (Schema::CASHOUT['admin']) . ' IS ' . ($validated ? 'NOT' : '') . " NULL"), $args);
            if ($statement->fetch()) {
                $return = true;
            }
            $statement->closeCursor();
        } catch (\PDOException $e) {
            throw new ModelException("Une erreur est survenue lors de la communication avec la BDD: {$e->getMessage()}", intval($e->getCode()), $e);
        }

        return $return;
    }

    /**
     * comptage des cashouts
     * @param string $adminId
     * @param bool $validated
     * @throws ModelException
     * @return bool
     */
    public function countValidated(?string $adminId = null, bool $validated = false): bool
    {
        $return = 0;
        $args = [];

        if ($adminId !== null) {
            $args[] = $adminId;
        }
        try {
            $statement = Queries::executeQuery("SELECT COUNT(*) AS nombre FROM {$this->getTableName()} WHERE " .Schema::CASHOUT['admin'] . ($adminId !== null ?  '=? ' : ' IS ' . ($validated ? 'NOT' : '') . " NULL"), $args);
            if ($row = $statement->fetch()) {
                $return = $row['nombre'];
            }
            $statement->closeCursor();
        } catch (\PDOException $e) {
            throw new ModelException("Une erreur est survenue lors de la communication avec la BDD: {$e->getMessage()}", intval($e->getCode()), $e);
        }

        return $return;
    }

    /**
     * renvoie les cashouts correspondant aux crites de filtrage, dont voici une bref explication:
     * <br/>=> $validated, determine l'etat des occurences (deja valider ou en attente???)
     * <br/>=> $adminId, determie si on doit uniquement recuperrer les occurences qui ont ete valider par l'admin dont l'id est en 2 eme param
     * <br/>=> $limit et $offset, pour recuperer une intervale des occurences
     * @param bool $validated : le parametre $validated peut prendre 3 valeur, true, false et null
     * <br/> => true : les cashout deja valider
     * <br/> => fasle : les cashout en attante
     * <br/> => null : peut importe l'etat du cashout
     * @param string $adminId
     * @param int $limit
     * @param int $offset
     * @throws ModelException
     * @return CashOut[]
     */
    public function findValidated (bool $validated = false, ?string $adminId = null, ?int $limit = null, $offset = 0): array
    {
        $return = [];
        $args = [];

        if ($adminId !== null) {
            $args[] = $adminId;
        }
        $SQL= (($validated !== null || $adminId !== null) ? " WHERE " : '') ;
        $SQL .= ($adminId !== null ? Schema::CASHOUT['admin'] . '=?' : '');
        
        if($adminId === null)
            $SQL .= (Schema::CASHOUT['admin']) . ' IS ' . ($validated ? 'NOT' : '') . ' NULL ';

        $SQL_LIMIT = $limit !== null? "LIMIT {$limit} OFFSET {$offset}" : '';
        try {
            $statement = Queries::executeQuery("SELECT * FROM {$this->getTableName()} {$SQL} {$SQL_LIMIT}" , $args);
            if ($row = $statement->fetch()) {
                $return[] = $this->getDBOccurence($row);
                while ($row = $statement->fetch()) {
                    $return[] = $this->getDBOccurence($row);
                }
                $statement->closeCursor();
            } else {
                $statement->closeCursor();
                throw new ModelException("Aucun resultat pour la requette executer");
            }
        } catch (\PDOException $e) {
            throw new ModelException("Une erreur est survenue lors de la communication avec la BDD: {$e->getMessage()}", intval($e->getCode()), $e);
        }

        return $return;
    }

    /**
     * {@inheritDoc}
     * @see \Root\App\Models\AbstractDbOccurenceModel::getTableName()
     */
    protected function getTableName(): string
    {
        return Schema::TABLE_SCHEMA['cashOut'];
    }

    /**
     * {@inheritDoc}
     * @see \Root\App\Models\AbstractDbOccurenceModel::getDBOccurence()
     */
    protected function getDBOccurence(array $keyValue)
    {
        $data = array();
        $keyVal = $keyValue;
        foreach (Schema::CASHOUT as $key => $value) {
            if (key_exists($value, $keyVal)) {
                $data[$key] = $keyVal[$value];
            }
        }
        return new CashOut($data);
    }
}
