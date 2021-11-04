<?php 
    namespace App\Config;
    class Queries extends Db{
        protected $table;
        private $database;
        
        /**
         * la methode myQuery permet d'ecrire une requette sql
         *
         * @param string $query est la requette sql
         * @param array|null $args c'est un tableu de valeurs
         * @return void retourne le resultat de la requette
         */
        protected function myQuery(string $query,array $args = null){
            $database = Db::getInstance();    
            if ($args !=null) {
                $sql_statement=$database->prepare($query);
                $sql_statement->execute($args);
                return $sql_statement;            
            }
        }
        
        /**
         * la methode addData perment l'ecrire une nouvelle donnée dans une table
         *
         * @param string $table est le nom de la table ou sera enregistrer les information
         * @param array $fields c'est tableau des champs ou seront enregistrer les information
         * @param array $args c'est un tableu de valeurs
         * @return void retourne le resultat de la requette
         */
        protected function addData(string $table,array $fields,array $args){
            $fields_array=[];
            $values=[];
            foreach($fields as $field=>$value){
                $fields_array[]=$value ;
                $values[]="?";            
            }
            $fields_list= implode(',',$fields_array);
            $value_list=implode(',',$values);
            return $this->myQuery(`INSERT INTO {$table}({$fields_list}) VALUES({$value_list})`,$args);
        }
        
        /**
         * La methode updateData permet de faire la modication des information
         *
         * @param string $table nom de la table qui subit la modification
         * @param array $fields les champs a modifier
         * @param string $whereCloseField l'identifiant de l'information a modifier
         * @param array $args un tableau qui contient les valeurs des informations a modifier et ce lui de l'identifiant
         * @return void retourne le resultat de la requette
         */
        protected function updateData(string $table,array $fields,string $whereCloseField,array $args){
            $fields_array=[];
            $values=[];
            foreach($fields as $field=>$value){
                $fields_array[]="$value=?" ;
                $values[]=$value;            
            }
            $fields_list= implode(',',$fields_array); 
            $whereField_liste="$whereCloseField=?";
            return $this->myQuery("UPDATE {$table} SET {$fields_list} WHERE {.$whereField_liste}",$args);
        }
        
        /**
         * la methode getAll permet la selection de tout les informations dans une table a reference d'un identifiant
         *
         * @param string $table nom de la table ou sera selectionner les information
         * @param string $whereField nom de l'identifiant de la selection
         * @param array $args valeur de l'identifiant
         * @return void retourne le resultat de la requette
         */
        protected function getAll(string $table,string $whereField,array $args){
            return $this->myQuery("SELECT * FROM {$table} WHERE {$whereField}",$args);
        }
        /**
        * la fonction getSpecificField permet la selection des elements specific dans une table 
        * il prend a paramettre le nom de la table({table}) du type texte,
        * la liste des champs a selectionner de type tableau ,
        *l'identifiant de l'element a selectioner de type texte,
        *et un tableau de valeur
        */
        /**
         * la methode getSpecificField permet la selection des elements specific dans une table
         *
         * @param string $table nom de la table ou sera selectionner les information
         * @param array $fields c'est un tableau des champs specific a selectionner
         * @param string $whereField nom de l'identifiant de la selection
         * @param array $args valeur de l'identifiant
         * @return void retourne le resultat de la requette
         */
        protected function getSpecificFields(string $table,array $fields, string $whereField,array $args){
            $fields_array=[];        
            foreach($fields as $field=>$value){
                $fields_array[]=$value ;                     
            }
            $fields_list= implode(',',$fields_array);        
            return $this->myQuery("SELECT {$fields_list} FROM {$table} WHERE {$whereField}",$args);
        }        
     }
?>