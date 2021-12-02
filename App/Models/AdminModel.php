<?php
    namespace Root\App\Models;
    use Root\Core\Queries ;
    use Root\Core\Schema ;

    class AdminModel extends Queries{
        public function insert(array $params) {
            $schema=new Schema();
            $admin=$schema->adminSchema;
            $table=$schema->DatabaseSchema;
            $this->create(
                $table['admmin'],
                [
                    $admin['id'],
                    $admin['name'],
                    $admin['password'],
                    $admin['dateRecord'],
                    $admin['timeRecord']
                ],
                $params
            );
        }
        public function checkId(array $param){
            $schema=new Schema();
            $admin=$schema->adminSchema;
            $table=$schema->DatabaseSchema;
            $query=$this->find(
                $table["admin"],
                "*",
                "{$admin["id"]}=?",
                $param
            );
            return $query->rowCount();
        }
        public function login(array $params){
            $schema=new Schema();
            $admin=$schema->adminSchema;
            $table=$schema->DatabaseSchema;
            $query= $this->find(
                $table["admin"],
                [                  
                    $admin["id"],
                    $admin["name"],,                  
                    $admin["password"],
                ],
                "{$admin['name']}=? ",
               $params
            );
            $count=$query->rowCount();
            return[$count,$query];
        } 
    }
?>