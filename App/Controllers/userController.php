<?php
    namespace Root\App\Controllers;
    use Root\App\Models\userModel;
    use Root\App\Controllers\{Validator,Generate};
    use Exception;  
    class UserController extends userModel {
        static function add(){
            $uuid=new Generate;
            $id= Generate::uuid();
            $name=htmlspecialchars($_POST['Name']);
            $email=htmlspecialchars($_POST['Email']);
            $phone=htmlspecialchars($_POST['Phone']);
            $password=htmlspecialchars(sha1($_POST['Password']));
            $verifPassword=htmlspecialchars(sha1($_POST['VerifPassword']));
            $sponsor=htmlspecialchars($_POST['Sponsor']);
            $side=htmlspecialchars($_POST['Side']);
            if(Validator::isString($name)&& $name !=""){                   
                if(Validator::isEmail($email)&& $email !=""){
                    if(Validator::isPhone($phone)&& $phone !=""){ 
                        if(($password==$verifPassword)&& $password !=""){
                            $user=new UserModel();                                
                            if(UserModel::checkEmail([$email])==0){
                                if(UserModel::checkPhone([$phone])==0){
                                    try{
                                        while(UserModel::checkId([$id])!=0){
                                            $id= Generate::uuid();
                                        }
                                        UserModel::insert( [ $id,$name,$email,$phone,$password, $sponsor, $side,0,"now()", "now()", 0]); 
                                            echo json_encode(["type"=>"success","message"=>"Enregistrement effectuer"]); 
                                    }catch(Exception $e){
                                        echo json_encode(["type"=>"Failure","message"=>"Quelque chose s'est mal passé"]);
                                    }                                        
                                }else{echo json_encode(["type"=>"Failure","message"=>"Ce numéro est dèjà utiliser"]);}                                   
                            }else{echo json_encode(["type"=>"Failure","message"=>"Cette adresse email est dèjà utiliser"]);}
                            }else{
                            echo json_encode(["type"=>"Failure","message"=>"les deux mot de passe ne sont pas identique"]);
                        }
                    }else{echo json_encode(["type"=>"Failure","message"=>"Le numéro de téléphone est invalide"]);} 
                }else{echo json_encode(["type"=>"Failure","message"=>"Address email invalide"]);} 
            }else{echo json_encode(["type"=>"Failure","message"=>"Le nom doit être est texte"]);}
        }
        static function signin(){
            $userName=htmlspecialchars($_POST['userName']);
            $password=htmlspecialchars(sha1($_POST['password']));
            if($userName){
                if($password){
                    $user=new UserModel();
                    $getUser=UserModel::login([$userName,0]);
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
                            $_SESSION['user']['email'] = $res['email'];
                            $_SESSION['user']['phone'] = $res['phone'];
                            $_SESSION['user']['side'] = $res['side'];
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
                UserController::add();
                break;
                case 'signin':
                UserController::signin();
                break;                  
                default:
                # code...
                break;
            }
        }
    }
   
?>