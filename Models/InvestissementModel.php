<?php 
    namespace App\Models;
    use App\Config\Queries ;
    use App\Config\Schema ;
    class InvestissementModel extends Queries{
        /**
         * cette methode insert permet d'enregistrer les informations sur le type d'investissement
         *
         * @param array $param le param c'est un tableau de valeur des informations
         * @return void retourne le resultat de l'execution de la requette
         */
        public function insert(array $params){
            $schema=new Schema();
            $investissement=$schema->investissement;
            $table=$schema->DatabaseSchema;                       
            $this->addData(
               $table["investissement"],
               [                  
                  $investissement["id"],
                  $investissement["name"],
                  $investissement["dateRecord"],
                  $investissement["timeRecord"],
                  $investissement["color"],
                  $investissement["userId"],
               ],
               $params
            );
        }
    }
?>