<?php
    session_start();
    namespace Root\App\Controllers;
    use Root\App\Models\investmentModel;
    use Root\App\Controllers\Validator;
    if(isset($_POST['Action'])){
        class investmentController extends investmentModel{
            public function add(){
                $id="";
                $name=htmlspecialchars($_POST['Name']);
                $color=htmlspecialchars($_POST['color']);
                $currency=htmlspecialchars($_POST['currency']);
                $adminId=$_SESSION['admin']['adminId'];
                $validation=new Validator();
                if($adminId){
                    if($validation->isString($name) && $name !=""){
                        if($validation->isString($color) && $color !=""){
                            if($validation->isFloat($currency) && $currency !=""){
                               if($this->insert([
                                  $id,
                                  $name,
                                  `now()`,
                                  `now()`,
                                  $color,
                                  $adminId,
                                  $currency 
                                ])){
                                    echo json_encode(["type"=>"Success","message"=>"Enregistrement effectuer"]);
                               }else{echo json_encode(["type"=>"Failure","message"=>"Echec d'enregistrement"]);}
                            }else{echo json_encode(["type"=>"Failure","message"=>"Veillez specicier la couleur"]);}
                        }else{echo json_encode(["type"=>"Failure","message"=>"Veillez specicier la couleur"]);}                    
                    }else{echo json_encode(["type"=>"Failure","message"=>"Le nom doit être un texte et non nul"]);} 
                }else{echo json_encode(["type"=>"Failure","message"=>"Vous n'etait pas habilité a éffectuer cette operation"]);}            
            }
        }
    }
?>