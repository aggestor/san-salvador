<?php 
    namespace Root\App\Models;
    use Root\Core\Queries ;
    use Root\Core\Schema ;
    class investmentModel extends Queries{
        /**
         * cette methode insert permet d'enregistrer les informations sur le type d'investissement
         *
         * @param array $param le param c'est un tableau de valeur des informations
         * @return void retourne le resultat de l'execution de la requette
         */
        public function insert(array $params){
            $schema=new Schema();
            $investment=$schema->investment;
            $table=$schema->DatabaseSchema;                       
            $this->addData(
               $table["investment"],
               [                  
                  $investment["id"],
                  $investment["name"],
                  $investment["dateRecord"],
                  $investment["timeRecord"],
                  $investment["color"],
                  $investment["userId"],
               ],
               $params
            );
        }
    }
?>