<?php 
    namespace App\Models;
    use App\Config\Queries ;
    use App\Config\Schema ;
    class insvestementModel extends Queries{
        /**
         * cette methode insert permet d'enregistrer les informations sur le type d'investissement
         *
         * @param array $param le param c'est un tableau de valeur des informations
         * @return void retourne le resultat de l'execution de la requette
         */
        public function insert(array $params){
            $schema=new Schema();
            $insvestement=$schema->insvestement;
            $table=$schema->DatabaseSchema;                       
            $this->addData(
               $table["insvestement"],
               [                  
                  $insvestement["id"],
                  $insvestement["name"],
                  $insvestement["dateRecord"],
                  $insvestement["timeRecord"],
                  $insvestement["color"],
                  $insvestement["userId"],
               ],
               $params
            );
        }
    }
?>