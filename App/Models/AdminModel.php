<?php
    namespace Root\App\Models;
    use Root\Core\Queries ;
    use Root\Core\Schema ;

    class AdminModel extends Queries{
        public function insert(array $params) {
            $schema=new Schema();
            $admin=$schema->admin;
            $table=$schema->DatabaseSchema;
            $this->addData(
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
    }
?>