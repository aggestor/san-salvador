<?php
    namespace Root\App\Controllers;
    use Root\App\Models\userModel;
    use Root\App\Controllers\Validator;
    use Root\App\Controllers\Generate;
    if(isset($_POST['Action'])){
        class UserController extends userModel {
            public function add(){
                $uuid=new Generate;
                $id= $uuid->uuid();
                $name=htmlspecialchars($_POST['Name']);
                $email=htmlspecialchars($_POST['Email']);
                $phone=htmlspecialchars($_POST['Phone']);
                $password=htmlspecialchars(sha1($_POST['Password']));
                $verifPassword=htmlspecialchars(sha1($_POST['VerifPassword']));
                $sponsor=htmlspecialchars($_POST['Sponsor']);
                $side=htmlspecialchars($_POST['Side']);
                $validation=new Validator();
                if($validation->isString($name)&& $name !=""){                   
                    if($validation->isEmail($email)&& $email !=""){
                        if($validation->isPhone($phone)&& $phone !=""){ 
                            if(($password==$verifPassword)&& $password !=""){                                
                                if($this->checkEmail([$email])==0){
                                    if($this->checkPhone([$phone])==0){
                                        while($this->checkId([$id])!=0){
                                            $id= $uuid->uuid();
                                        }
                                        if( $this->insert(
                                            [
                                                $id,
                                                $name,
                                                $email,
                                                $phone,
                                                $password,
                                                $sponsor,
                                                $side,
                                                0,
                                                `now()`,
                                                `now()`,
                                                0
                                            ]
                                        )){
                                           echo json_encode(["type"=>"Success","message"=>"Enregistrement effectuer"]); 
                                        }else{echo json_encode(["type"=>"Failure","message"=>"Echec d'enregistrement"]);}
                                    }else{echo json_encode(["type"=>"Failure","message"=>"Ce numéro est dèjà utiliser"]);}                                   
                                }else{echo json_encode(["type"=>"Failure","message"=>"Cette adresse email est dèjà utiliser"]);}
                              }else{
                                echo json_encode(["type"=>"Failure","message"=>"les deux mot de passe ne sont pas identique"]);
                            }
                        }else{echo json_encode(["type"=>"Failure","message"=>"Le numéro de téléphone est invalide"]);} 
                    }else{echo json_encode(["type"=>"Failure","message"=>"Address email invalide"]);} 
                }else{echo json_encode(["type"=>"Failure","message"=>"Le nom doit être est texte"]);}
            }
            public function signin(){
                
            }
        } 
    }
?>