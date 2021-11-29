<?php
namespace Root\App\Controllers;

use Root\App\Models\userModel;
use Root\App\Controllers\Validator;
use Root\App\Controllers\Generate;

class UserController extends Controller
{
    public function register()
    {
    }
    public function login(int $id)
    {
    }

    static function add()
    {
        $uuid = new Generate;
        $id = $uuid->uuid();
        $name = htmlspecialchars($_POST['Name']);
        $email = htmlspecialchars($_POST['Email']);
        $phone = htmlspecialchars($_POST['Phone']);
        $password = htmlspecialchars(sha1($_POST['Password']));
        $verifPassword = htmlspecialchars(sha1($_POST['VerifPassword']));
        $sponsor = htmlspecialchars($_POST['Sponsor']);
        $side = htmlspecialchars($_POST['Side']);
        $validation = new Validator();
        if ($validation->isString($name) && $name != "") {
            if ($validation->isEmail($email) && $email != "") {
                if ($validation->isPhone($phone) && $phone != "") {
                    if (($password == $verifPassword) && $password != "") {
                        $user = new UserModel();
                        if ($user->checkEmail([$email]) == 0) {
                            if ($user->checkPhone([$phone]) == 0) {
                                while ($user->checkId([$id]) != 0) {
                                    $id = $uuid->uuid();
                                }
                                if ($user->insert(
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
                                )) {
                                    echo json_encode(["type" => "success", "message" => "Enregistrement effectuer"]);
                                } else {
                                    echo json_encode(["type" => "Failure", "message" => "Echec d'enregistrement"]);
                                }
                            } else {
                                echo json_encode(["type" => "Failure", "message" => "Ce numéro est dèjà utiliser"]);
                            }
                        } else {
                            echo json_encode(["type" => "Failure", "message" => "Cette adresse email est dèjà utiliser"]);
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
