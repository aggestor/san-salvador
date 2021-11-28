<?php
    namespace Root\App\Controllers;
    use Root\App\Models\userModel;
    use Root\App\Controllers\Validator;
    use Root\App\Controllers\Generate;
    use Exception;
 
    class UserController extends Controller {
        static function add($userName,$userEmail,$userPhoneNumber,$userPassword,$userConfirmPassword,$useSponsor,$userSide){
            try{
                $uuid=new Generate;
                $id= $uuid->uuid();
                $name=htmlspecialchars($userName);
                $email=htmlspecialchars($userEmail);
                $phone=htmlspecialchars($userPhoneNumber);
                $password=htmlspecialchars(sha1($userPassword));
                $verifPassword=htmlspecialchars(sha1($userConfirmPassword));
                $sponsor=htmlspecialchars($useSponsor);
                $side=htmlspecialchars($userSide);
                $validation=new Validator();
                if($validation->isString($name)){                   
                    if($validation->isEmail($email)){
                        if($validation->isPhone($phone)){ 
                            if($password==$verifPassword){
                                $user=new UserModel();                                
                                if($user->checkEmail([$email])==0){
                                    if($user->checkPhone([$phone])==0){
                                        while($user->checkId([$id])!=0){
                                            $id= $uuid->uuid();
                                        }
                                        $user->insert(
                                            [
                                                $id,
                                                $name,
                                                $email,
                                                $phone,
                                                $password,
                                                $sponsor,
                                                $side,
                                                0,
                                                "now()",
                                                "now()",
                                                0
                                            ]
                                            );
                                            echo json_encode(["type"=>"success","message"=>"Enregistrement effectuer"]); 
                                    }else{echo json_encode(["type"=>"Failure","message"=>"Ce numéro est dèjà utiliser"]);}                                   
                                }else{echo json_encode(["type"=>"Failure","message"=>"Cette adresse email est dèjà utiliser"]);}
                                }else{
                                echo json_encode(["type"=>"Failure","message"=>"les deux mot de passe ne sont pas identique"]);
                            }
                        }else{echo json_encode(["type"=>"Failure","message"=>"Le numéro de téléphone est invalide"]);} 
                    }else{echo json_encode(["type"=>"Failure","message"=>"Address email invalide"]);} 
                }else{echo json_encode(["type"=>"Failure","message"=>"Le nom doit être est texte"]);}
            }catch(Exception $e){
                echo json_encode(["type"=>"Failure","message"=>"Quelque chose s'est mal passé"]);
            }
            
        }
        static function signin($userName,$userPassword){
            try{
                $userName1=htmlspecialchars($userName);
                $password=htmlspecialchars(sha1($userPassword));
                if($userName){
                    if($password){
                        $user=new UserModel();
                        $getUser=$user->login([$userName1,0]);
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
            catch(Exception $e){
                echo json_encode(["type"=>"Failure","message"=>"Quelque chose s'est mal passé"]);
            }             
        }        
    } 
      
?>