<?php
    session_start();
    namespace Root\App\Controllers;
    use Root\App\Models\investmentModel;
    use Root\App\Controllers\{Validator,Generate};
    if(isset($_POST['Action'])){
        class investmentController extends investmentModel{
            static function add(){
                $id= Generate::uuid();
                $name=htmlspecialchars($_POST['Name']);
                $color=htmlspecialchars($_POST['color']);
                $currency=htmlspecialchars($_POST['currency']);
                $adminId=$_SESSION['admin']['adminId'];
                if($adminId){
                    if(Validator::isString($name) && $name !=""){
                        if(Validator::isString($color) && $color !=""){
                            if(Validator::isFloat($currency) && $currency !=""){
                                $invest=new InvestmentModel();
                                while($invest->checkId([$id])!=0){
                                    $id= Generate::uuid();
                                }
                               if($invest->insert([
                                  $id,
                                  $name,
                                  `now()`,
                                  `now()`,
                                  $color,
                                  $adminId,
                                  $currency 
                                ])){
                                    echo json_encode(["type"=>"success","message"=>"Enregistrement effectuer"]);
                               }else{echo json_encode(["type"=>"Failure","message"=>"Echec d'enregistrement"]);}
                            }else{echo json_encode(["type"=>"Failure","message"=>"Veillez specicier la couleur"]);}
                        }else{echo json_encode(["type"=>"Failure","message"=>"Veillez specicier la couleur"]);}                    
                    }else{echo json_encode(["type"=>"Failure","message"=>"Le nom doit être un texte et non nul"]);} 
                }else{echo json_encode(["type"=>"Failure","message"=>"Vous n'etait pas habilité a éffectuer cette operation"]);}            
            } 
            static  function verifyAction(){
                $postAction = htmlspecialchars($_POST['action']);
                switch ($postAction) {
                  case 'add':
                    AdminController::add();
                    break;                  
                  default:
                    # code...
                    break;
                }
            }           
        }
        investmentController::verifyAction();
    }
?>