<?php
    namespace App\Models;
    use App\Config\Queries ;
    use App\Config\Schema ;
    class UserModel extends Queries{
        /**
         * cette methode insert permet d'enregistrer les informations de l'utilisateur
         *
         * @param array $param le param c'est un tableau de valeur des informations de l'utilisateur
         * @return void retourne le resultat de l'execution de la requette
         */
        public function insert(array $param){
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
        public function login(array $params){
            $schema=new Schema();
            $user=$schema->user;
            $table=$schema->DatabaseSchema;
            $query=$this->getSpecificField(
                $table["user"],
                [                  
                    $user["id"],
                    $user["name"],
                    $user["email"],
                    $user["phone"],                  
                    $user["status"],                  
                    $user["accountStatus"],
                ],
                `$user["email"]=? and $user["status"]=0`,
               $params
            );
            $count=$query->rowCount();
            return[$count,$query];
        }        
    }
?>