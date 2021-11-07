<?php
    namespace Root\App\Controllers;
    use Root\App\Models\AdminModel;
    use Root\App\Controllers\Validator;
    if(isset($_POST['Action'])){
        class AdminController extends adminModel{
            public function add(){
                $id="";
                $name=htmlspecialchars($_POST['name']);
                $password=htmlspecialchars(sha1($_POST['password']));
                $confirmPassword=htmlspecialchars(sha1($_POST['confirmPassword']));
                $validatotion=new Validator();
                if($validatotion->isString($name)){
                    if(($password==$confirmPassword)&&$validatotion->isNotEmpty($name)){
                        if($this->insert([$id,$name,$password,`now()`,`now()`])){
                            echo json_encode(["type"=>"Success","message"=>"Enregistrement effectuer"]);
                        }else{echo json_encode(["type"=>"Failure","message"=>"Echec d'enregistrement"]);}
                    }else{echo json_encode(["type"=>"Failure","message"=>"Les mot de pass sont pas identique"]);}                
                }else{echo json_encode(["type"=>"Failure","message"=>"Le nom doit être un texte et non nul"]);}
            }
        }
    }
?>