<?php 
    namespace Root\App\Models;
    use Root\Core\Queries ;
    use Root\Core\Schema ;
    class investmentModel extends Queries{
       
        public function insert(array $params){
            $schema=new Schema();
            $investment=$schema->investmentSchema;
            $table=$schema->DatabaseSchema;                       
            $this->create(
               $table["investment"],
               [                  
                  $investment["id"],
                  $investment["name"],
                  $investment["dateRecord"],
                  $investment["timeRecord"],
                  $investment["color"],
                  $investment["adminId"],
                  $investment["currency"],
               ],
               $params
            );
        }
        public function checkId(array $param){
            $schema=new Schema();
            $investment=$schema->investmentSchema;
            $table=$schema->DatabaseSchema;
            $query=$this->find(
                $table["investment"],
                "*",
               "{$investment["id"]}=?" ,
                $param
            );
            return $query->rowCount();
        }
        public function getById(array $param){
            $schema=new Schema();
            $investment=$schema->investmentSchema;
            $table=$schema->DatabaseSchema;
            $query=$this->find(
                $table["investment"],
                "*",
               "{$investment["id"]}=?" ,
                $param
            );
            return $query;
        }
        public function get(){
            $schema=new Schema();
            $investment=$schema->investmentSchema;
            $table=$schema->DatabaseSchema;
            $query=$this->find(
                $table["investment"],
                "*",
               "{$investment["id"]}!=?" ,
                ["@#$%^&**&^&^%$%#"]
            );
            return $query;
        }
    }
?>