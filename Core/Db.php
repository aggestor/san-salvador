<?php 
//     namespace Root\Core;

// use PDO;
// use PDOException;

// class Db extends PDO{   
//         private static $instance;    
//         private const host = "localhost";
//         private const user = "root";
//         private const password = "";
//         private const db = "phantom";
        
    
//         public function connect(){
//             $_connection_link = "mysql:host=". self::host. ";dbname=". self::db;
    
//             try {
//                 parent::($_connection_link, self::user, self::password);
//                 $this->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, "SET NAMES utf8");
//                 $this->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
//                 $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//             } catch (PDOException $th) {
//                 die($th->getMessage());
//             }
//         }
//         public static function getInstance():self {
//             if(self::$instance == NULL){
//                 self::$instance = new self();
//             }
//             return self::$instance;
//         }
//     }
?>