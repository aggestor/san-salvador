<?php
    namespace Root\App\Models;
    use Root\Core\Queries ;
    use Root\Core\Schema ;
    class UserModel extends Queries{
        /**
         * cette methode insert permet d'enregistrer les informations de l'utilisateur
         *
         * @param array $param le param c'est un tableau de valeur des informations de l'utilisateur
         * @return void retourne le resultat de l'execution de la requette
         */
        public function insert(array $params){
            $schema=new Schema();
            $user=$schema->user;
            $table=$schema->DatabaseSchema;                       
            $this->addData(
               $table["user"],
                [                  
                    $user["id"],
                    $user["name"],
                    $user["email"],
                    $user["phone"],
                    $user["password"],
                    $user["sponsor"],
                    $user["side"],
                    $user["status"],
                    $user["dateRecord"],
                    $user["timeRecord"],
                    $user["accountStatus"],
                ],
               $params
            );
        }
        public function checkEmail(array $param){
            $schema=new Schema();
            $user=$schema->user;
            $table=$schema->DatabaseSchema;
            $query=$this->getAll(
                $table["user"],
                $user["email"],
                $param
            );
            return $query()->rowCount();
        }
        public function checkPhone(array $param){
            $schema=new Schema();
            $user=$schema->user;
            $table=$schema->DatabaseSchema;
            $query=$this->getAll(
                $table["user"],
                $user["phone"],
                $param
            );
            return $query()->rowCount();
        }
        public function checkId(array $param){
            $schema=new Schema();
            $user=$schema->user;
            $table=$schema->DatabaseSchema;
            $query=$this->getAll(
                $table["user"],
                $user["id"],
                $param
            );
            return $query()->rowCount();
        }
        public function login(array $params){
            $schema=new Schema();
            $user=$schema->user;
            $table=$schema->DatabaseSchema;
            $query= $this->getSpecificFields(
                $table["user"],
                [                  
                    $user["id"],
                    $user["name"],
                    $user["email"],
                    $user["phone"],                  
                    $user["status"],                  
                    $user["accountStatus"],
                ],
                `{$user['name']}=? AND {$user['status']}=?`,
               $params
            );
            $count=$query()->rowCount();
            return[$count,$query];
        }        
    }
?>