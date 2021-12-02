<?php

namespace Root\Core;

use PDO;
use PDOException;


class Db extends PDO
{
    private static $intance;
    private const DBHOST = 'localhost';
    private const DBNAME = 'usalva';
    private const DBPASSE = '';
    private const DBUSER = 'root';

    private function __construct()
    {
        $dsn = 'mysql:dbname=' . self::DBNAME . '; host=' . self::DBHOST;
        try {
            parent::__construct($dsn, self::DBUSER, self::DBPASSE);
            $this->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, 'UTF-8');
            $this->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
            $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }
    /**
     *la fonction pour retourner une fois l'instance de notre class
     * si elle n'est pas instancier au paranvas 
     * Design Parten Singleton
     * @return Db
     */
    public static function getIstance()
    {
        if (self::$intance === null) {
            self::$intance = new self();
        }

        return self::$intance;
    }
}
