<?php

namespace Root\App\Models;


/**
 *
 * @author Esaie MUHASA
 *        
 */
class Queries
{

    private static $pdo;
    private const DBHOST = 'localhost';
    private const DBNAME = 'usalvage_usalva';
    private const DBPASSE = 'gTrad_242!';
    private const DBUSER = 'usalvage';

    /**
     */
    private function __construct()
    {
    }

    /**
     * revoie l'instance vers PDOs
     * @throws ModelException
     * @return \PDO
     */
    public static final function getPDOInstance(): ?\PDO
    {

        if (self::$pdo == null) {
            $dsn = 'mysql:dbname=' . self::DBNAME . '; host=' . self::DBHOST;
            try {
                $pdo = new \PDO($dsn, self::DBUSER, self::DBPASSE);
                $pdo->setAttribute(\PDO::MYSQL_ATTR_INIT_COMMAND, 'UTF-8');
                $pdo->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
                $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
                self::$pdo = $pdo;
            } catch (\PDOException $e) {
                throw new ModelException($e->getMessage(), intval($e->getCode()), $e);
            }
        }
        return self::$pdo;
    }

    /**
     * execution d'une requette d'enregistremet
     * @param string $table
     * @param array $fields
     * @param array $args
     * @return \PDOStatement
     */
    public static function addData(string $table, array $fields, array $args)
    {
        return self::addDataInTransaction(self::getPDOInstance(), $table, $fields, $args);
    }

    /**
     * creation d'une occurence dans une transaction
     * @param \PDO $pdo
     * @param string $table
     * @param array $fields
     * @param array $args
     * @return \PDOStatement
     */
    public static function addDataInTransaction(\PDO $pdo, string $table, array $fields, array $args)
    {
        $fields_array = [];
        $values = [];
        foreach ($fields as $value) {
            $fields_array[] = $value;
            $values[] = "?";
        }
        $fields_list = implode(', ', $fields_array);
        $value_list = implode(',', $values);
        return self::executeQueryInTransaction($pdo, "INSERT INTO {$table} ({$fields_list}) VALUES ({$value_list})", $args);
    }


    /**
     * execution d'une requette de mise en jours
     * @param string $table
     * @param array $fields
     * @param string $whereCloseField
     * @param array $args
     * @return \PDOStatement
     */
    public static function updateData(string $table, array $fields, string $whereCloseField, array $args)
    {
        return self::updateDataInTransaction(self::getPDOInstance(), $table, $fields, $whereCloseField, $args);
    }

    /**
     * execution d'une requette de mis en jour dans une transaction
     * @param \PDO $pdo
     * @param string $table
     * @param array $fields
     * @param string $whereCloseField
     * @param array $args
     * @return \PDOStatement
     */
    public static function updateDataInTransaction(\PDO $pdo, string $table, array $fields, string $whereCloseField, array $args)
    {
        $fields_array = [];
        foreach ($fields as $value) {
            $fields_array[] = "$value=?";
        }
        $fields_list = implode(',', $fields_array);
        $whereField_list = "$whereCloseField";


        return self::executeQueryInTransaction($pdo, "UPDATE {$table} SET {$fields_list} WHERE {$whereField_list}", $args);
    }

    /**
     * execution d'une requette de selection
     * @param string $table
     * @param string|array $fields
     * @param string $whereField
     * @param array $args
     * @return \PDOStatement
     */
    public static function getData(string $table, $fields, string $whereField, array $args)
    {
        $fields_array = [];
        if (is_array($fields)) {
            foreach ($fields as $value) {
                $fields_array[] = $value;
            }
            $fields_list = implode(',', $fields_array);
            return self::executeQuery("SELECT {$fields_list} FROM {$table} WHERE {$whereField}", $args);
        } else if (is_string($fields) && ($fields == "*" || $fields == "all")) {
            return  self::executeQuery("SELECT * FROM {$table} WHERE {$whereField}", $args);
        }
    }



    /**
     * La fonction pour l'execution de nos requettes (prepare ou query)
     * @param string $sql La requette
     * @param array|null $attribut les attributs de la requette
     * @return \PDOStatement
     */
    public static function executeQuery(string $sql, array $attribut = null)
    {
        return self::executeQueryInTransaction(self::getPDOInstance(), $sql, $attribut);
    }

    /**
     * Execution d'une requette dans une trasaction
     * @param \PDO $pdo
     * @param string $sql
     * @param array $attribut
     * @return \PDOStatement
     */
    public static function executeQueryInTransaction(\PDO $pdo, string $sql, array $attribut = null)
    {

        if ($attribut !== null) {
            $query = $pdo->prepare($sql);
            $query->execute($attribut);
            return $query;
        }

        $query = $pdo->query($sql);
        return $query;
    }
}
