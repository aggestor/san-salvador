<?php
    namespace Root\App\Controllers;
    use Root\App\Models\AdminModel;
    use Root\App\Controllers\Validator;
    use Root\App\Controllers\Generate;
    if(isset($_POST['Action'])){
        class AdminController extends adminModel{
            static function add(){
                $uuid=new Generate;
                $id= $uuid->uuid();
                $name=htmlspecialchars($_POST['name']);
                $password=htmlspecialchars(sha1($_POST['password']));
                $confirmPassword=htmlspecialchars(sha1($_POST['confirmPassword']));
                $validatotion=new Validator();
                if($validatotion->isString($name)){
                    if(($password==$confirmPassword)&&$validatotion->isNotEmpty($name)){
                        $admin=new AdminModel();
                        while($admin->checkId([$id])!=0){
                            $id= $uuid->uuid();
                        }
                        if($admin->insert([$id,$name,$password,`now()`,`now()`])){
                            echo json_encode(["type"=>"success","message"=>"Enregistrement effectuer"]);
                        }else{echo json_encode(["type"=>"Failure","message"=>"Echec d'enregistrement"]);}
                    }else{echo json_encode(["type"=>"Failure","message"=>"Les mot de pass sont pas identique"]);}                
                }else{echo json_encode(["type"=>"Failure","message"=>"Le nom doit être un texte et non nul"]);}
            }
            static function signin(){
                $adminName=htmlspecialchars($_POST['adminName']);
                $password=htmlspecialchars(sha1($_POST['password']));
                if($adminName){
                    if($password){
                        $admin=new AdminModel();
                        $getUser=$admin->login([$adminName]);
                        if($getUser[0]==0){
                            echo json_encode(["type"=>"Failure","message"=>"Idendifiant incorrect"]);
                        }else{
                            $res=$getUser[1]->fetch();
                            if($res['password']!=$password){
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
            static  function verifyAction(){
                $postAction = htmlspecialchars($_POST['action']);
                switch ($postAction) {
                  case 'add':
                    AdminController::add();
                    break;
                  case 'signin':
                    AdminController::signin();
                    break;                  
                  default:
                    # code...
                    break;
                }
            }
        }
        AdminController::verifyAction();
    }
?>