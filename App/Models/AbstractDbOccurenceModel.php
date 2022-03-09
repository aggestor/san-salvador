<?php

namespace Root\App\Models;


use Root\App\Models\Objects\DBOccurence;

/**
 *
 * @author Esaie MUHASA
 *        
 */
abstract class AbstractDbOccurenceModel
{
    /**
     * Le conteneur des models
     * @var ModelFactory
     */
    private $factory;

    /**
     * initialisation d'un model
     * @param ModelFactory $factory, fabrique de base du model
     */
    public function __construct(ModelFactory $factory)
    {
        $this->factory = $factory;
    }

    /**
     * @return \Root\App\Models\ModelFactory
     */
    public function getFactory(): ModelFactory
    {
        return $this->factory;
    }

    /**
     * verifie l'existance d'une valeur dans une colone
     * @param string $columnName
     * @param mixed $value
     * @return bool
     * @throws ModelException s'il ya erreur lors de la communication avec la BDD
     */
    public function check(string $columnName, $value): bool
    {

        $return = false;
        try {
            $statement = Queries::executeQuery("SELECT {$columnName} FROM {$this->getTableName()} WHERE {$columnName}=? LIMIT 1", array($value));

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
     * verification si l'identifiant existe dans la BDD
     * @param string $id
     * @return bool
     */
    public function checkById(string $id): bool
    {
        return $this->check("id", $id);
    }

    /**
     * y-t-il une historique pour l'intervale en parametre?????
     * @param \DateTime $dateMin
     * @param \DateTime $dateMax
     * @return bool
     * @throws ModelException 
     */
    public function checkByHistory(?\DateTime $dateMin, ?\DateTime $dateMax = null): bool
    {
        $return = false;
        try {

            $args = array($dateMin->format('Y-m-d'));
            if ($dateMax != null) {
                $args[] = $dateMax->format('Y-m-d');
            }
            $statement = Queries::executeQuery("SELECT id FROM {$this->getTableName()} WHERE record_date " . ($dateMax != null ? "BETWEEN (? AND ?)" : "= ?") . "  LIMIT 1", $args);
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
     * comptage de tout les occurences d'une table
     * @throws ModelException
     * @return int
     */
    public function count(): int
    {
        $nombre = 0;
        try {
            $statement = Queries::executeQuery("SELECT COUNT(*) AS nombre FROM {$this->getTableName()}", array());
            if ($row = $statement->fetch()) {
                $nombre = intval($row['nombre'], 10);
            }
            $statement->closeCursor();
        } catch (\PDOException $e) {
            throw new ModelException("Une erreur est survenue lors de la communication avec la BDD", intval($e->getCode()), $e);
        }
        return $nombre;
    }

    /**
     * Supression d'une occurence dans une table
     * @param string $id
     * @throws ModelException
     */
    public function delete(string $id): void
    {
        try {
            $statement = Queries::executeQuery("DELETE FROM {$this->getTableName()} WHERE id=?", array($id));
            $statement->closeCursor();
        } catch (\PDOException $e) {
            throw new ModelException("Une erreur est survenue lors de la communication avec la BDD", intval($e->getCode()), $e);
        }
    }

    /**
     * Execute une requette de selection. Le filtrage se fait sur une collone, dont le nom et la valeur sont en parametre
     * @param string $columnName nom de la collone dans la close WHERE
     * @param mixed $value valeur pour le champ en filtre
     * @throws ModelException
     * @return DBOccurence
     * 
     */
    public function find(string $columnName, $value)
    {
        $return = null;
        try {

            $statement = Queries::executeQuery("SELECT * FROM {$this->getTableName()} WHERE {$columnName}=? LIMIT 1", array($value));
            //var_dump($statement->fetch()); exit();
            if ($row = $statement->fetch()) {
                $return = $this->getDBOccurence($row);
                $statement->closeCursor();
            } else {
                $statement->closeCursor();
                return $return;
                // throw new ModelException("Aucun resultat pour la requette executer");
            }
        } catch (\PDOException $e) {
            throw new ModelException("Une erreur est survenue lors de la communication avec la BDD", intval($e->getCode()), $e);
        }

        return $return;
    }

    /**
     * recuperation de l'occurence dont l'ID est en parametre
     * @param string $id
     * @return DBOccurence
     * @throws ModelException
     */
    public function findById(string $id)
    {
        return $this->find("id", $id);
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
    public function findAll(?int $limit = null, int $offset = 0): array
    {
        $data = array();
        $recordDate = Schema::INSCRIPTION['recordDate'];
        try {
            $statement = Queries::executeQuery("SELECT * FROM {$this->getTableName()} ORDER BY {$recordDate} DESC " . ($limit != null ? "LIMIT {$limit} OFFSET {$offset}" : ""), array());
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

    /**
     * y-a-il des donnes pour cette intervale???
     * @param int $limit
     * @param int $offset
     * @throws ModelException
     * @return bool
     */
    public function checkAll(?int $limit = null, int $offset = 0): bool
    {
        $return = false;
        try {
            $statement = Queries::executeQuery("SELECT * FROM {$this->getTableName()} " . ($limit != null ? "LIMIT 1 OFFSET {$offset}" : ""), array());
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
     * Recuperation des operations en une intervale des dates
     * @param \DateTime $dateMin
     * @param \DateTime $dateMax
     * @return DBOccurence[]
     * @throws ModelException
     */
    public function findByHistory(?\DateTime $dateMin, ?\DateTime $dateMax = null): array
    {
        $data = array();
        try {

            $args = array($dateMin->format('Y-m-d'));
            if ($dateMax != null) {
                $args[] = $dateMax->format('Y-m-d');
            }
            $statement = Queries::executeQuery("SELECT * FROM {$this->getTableName()} WHERE record_date " . ($dateMax != null ? "BETWEEN (? AND ?)" : "= ?") . " ORDER BY record_date DESC ", $args);
            if ($row = $statement->fetch()) {
                $data[] = $this->getDBOccurence($row);
                while ($row = $statement->fetch()) {
                    $data[] = $this->getDBOccurence($row);
                }
                $statement->closeCursor();
            } else {
                $statement->closeCursor();
                throw new ModelException("Aucune operation " . ($dateMax != null ? "" : "en date") . " du {$dateMin->format('d/m/Y')} " . ($dateMax != null ? "au {$dateMax->format('d/m/Y')}" : ""));
            }
        } catch (\PDOException $e) {
            throw new ModelException("Une erreur est survenue lors de la communication avec la BDD", intval($e->getCode()), $e);
        }

        return $data;
    }

    /**
     * creation d'une occurence
     * @param DBOccurence $object
     */
    public abstract function create($object): void;

    /**
     * demande de creation dans une transaction externe
     * @param \PDO $pdo
     * @param DBOccurence $object
     * @throws ModelException
     */
    public function createInTransaction(\PDO $pdo, $object): void
    {
        throw new ModelException("Transaction non pris en charge");
    }

    /**
     * mis en jour d'une occurence dans la base de donnee
     * @param DBOccurence $object
     * @param string $id
     */
    public abstract function update($object, $id): void;

    /**
     * doit renvoyer le nom de la table
     * @return string
     */
    protected abstract function getTableName(): string;

    /**
     * revoie l'obect apres maping des element dans le tableau  associative
     * @param array $keyValue
     */
    protected abstract function getDBOccurence(array $keyValue);
}
