<?php 
    namespace Root\Core;
    use Root\Core\Db;
    class Queries extends Db{
        static function get_query_data(string $query, array $args = [null]){
            if($query !== "" && $args !== null){
                $database = Db::getInstance();
                $sql_statement = $database->prepare($query);
                $sql_statement->execute($args);              
                return $sql_statement;
            }die('Query Should be a string and args an array of string');
        }
        /**
        * la methode create perment l'ecriture une nouvelle donnée dans une table
        *
        * @param string $table est le nom de la table ou sera enregistrer les information
        * @param array $fields c'est tableau des champs ou seront enregistrer les information
        * @param array $args c'est un tableu de valeurs
        */
       protected static function create(string $table,array $fields,array $args){
           $fields_array=[];
           $values=[];
           foreach($fields as $value){
               $fields_array[]=$value ;
               $values[]="?";            
           }
           $fields_list= implode(',',$fields_array);
           $value_list=implode(',',$values);
           return self::get_query_data("INSERT INTO $table($fields_list) VALUES($value_list)",$args);
       }
       /*
         * la methode find permet la selection des elements specific dans une table
        *
        * @param string $table nom de la table ou sera selectionner les information
        * @param array $fields c'est un tableau des champs specific a selectionner
        * @param string $whereField nom de l'identifiant de la selection
        * @param array $args valeur de l'identifiant
        * @return void retourne le resultat de la requette
        */
       protected static function find(string $table, $fields, string $whereField, array $args){
           $fields_array=[];   
           if(is_array($fields)){
               foreach($fields as $value){
                   $fields_array[]=$value ;                     
               }
               $fields_list= implode(',',$fields_array); 
               return self::get_query_data("SELECT {$fields_list} FROM {$table} WHERE {$whereField}", $args);

           }else if(is_string($fields) AND ($fields == "*" OR $fields == "all" )){
               return self::get_query_data("SELECT * FROM {$table} WHERE {$whereField}", $args);

           }       
       }
       /**
        * La methode update permet de faire la modication des information
        *
        * @param string $table nom de la table qui subit la modification
        * @param array $fields les champs a modifier
        * @param string $whereCloseField l'identifiant de l'information a modifier
        * @param array $args un tableau qui contient les valeurs des informations a modifier et ce lui de l'identifiant
        * @return void retourne le resultat de la requette
        */
       protected function update(string $table,array $fields,string $whereCloseField,array $args){
           $fields_array = [];
           $values = [];
           foreach($fields as $field => $value){
               $fields_array[] = "$value=?" ;
               $values[] = $value;            
           }
           $fields_list= implode(',',$fields_array); 
           $whereField_list="$whereCloseField=?";
           return self::get_query_data("UPDATE {$table} SET {$fields_list} WHERE {$whereField_list}",$args);
       }
       protected  static function remove(string $table,string $whereField,array $args){
           return self::get_query_data("DELETE FROM {$table} WHERE {$whereField}",$args);
       }      
    }
?>