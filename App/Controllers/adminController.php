<?php
    namespace Root\App\Controllers;
    use Root\App\Models\AdminModel;
    use Root\App\Controllers\Validator;
    use Root\App\Controllers\Generate;
    use Exception;
    class AdminController extends Controller{
        static function add($name,$password,$confirmPassword){
            try{
                $uuid=new Generate;
                $id= $uuid->uuid();
                $name1=htmlspecialchars($name);
                $password1=htmlspecialchars(sha1($password));           
                $validatotion=new Validator();
                if($validatotion->isString($name)){
                    if(($password==$confirmPassword)&&$validatotion->isNotEmpty($name)){
                        $admin=new AdminModel();
                        while($admin->checkId([$id])!=0){
                            $id= $uuid->uuid();
                        }
                        $admin->insert([$id,$name1,$password1,"now()","now()"]);
                        echo json_encode(["type"=>"success","message"=>"Enregistrement effectuer"]);                        
                    }else{echo json_encode(["type"=>"Failure","message"=>"Les mot de pass sont pas identique"]);}                
                }else{echo json_encode(["type"=>"Failure","message"=>"Le nom doit être un texte et non nul"]);}
            }
            catch(Exception $e){
                echo json_encode(["type"=>"Failure","message"=>"Quelque chose s'est mal passé"]);
            }
            
        }
        static function signin($name,$password){
            $adminName=htmlspecialchars($name);
            $adminPassword=htmlspecialchars(sha1($password));
            if($adminName){
                if($adminPassword){
                    $admin=new AdminModel();
                    $getUser=$admin->login([$adminName]);
                    if($getUser[0]==0){
                        echo json_encode(["type"=>"Failure","message"=>"Idendifiant incorrect"]);
                    }else{
                        $res=$getUser[1]->fetch();
                        if($res['password']!=$adminPassword){
                            echo json_encode(["type"=>"Failure","message"=>"Mot de passe incorrect"]);
                        }else{
                            session_start();
                            $_SESSION['user']['id'] = $res['id'];
                            $_SESSION['user']['nama'] = $res['name'];                                
                            echo json_encode(["type"=>"success","message"=>"utilisateur connecter"]);
                        }
                    }
                }else{echo json_encode(["type"=>"Failure","message"=>"Veillez donné votre mot de passe"]);}
            }else{echo json_encode(["type"=>"Failure","message"=>"Veillez donné votre pseudo"]);} 
        }
    }
     
?>