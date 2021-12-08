<?php
<<<<<<< HEAD

namespace Root\App\Controllers;

use Root\Core\Validator;

class adminController extends Controller
{
    public function index()
    {
        if ($this->isAdmin()) {
            return $this->view('pages.dashbord', 'layout_admin');
=======
    namespace Root\App\Controllers;
    use Root\App\Models\AdminModel;
    use Root\App\Controllers\Validator;
    use Root\App\Controllers\Generate;
    use Exception;
    class AdminController extends Controller{
        public function dashboard(){
            return $this->view("pages.admin.dashboard", "layout_admin");
        }
        static function create(){
            try{
                $uuid=new Generate;
                $id= $uuid->uuid();
                $name=htmlspecialchars($_POST['adminName']);
                $password=htmlspecialchars(sha1($_POST['adminPassword']));           
                $confirmPassword=htmlspecialchars(sha1($_POST['adminConfirmPassword']));           
                $validatotion=new Validator();
                if($validatotion->isString($name)){
                    if(($password==$confirmPassword)&&$validatotion->isNotEmpty($name)){
                        $admin=new AdminModel();
                        while($admin->checkId([$id])!=0){
                            $id= $uuid->uuid();
                        }
                        $admin->insert([$id,$name,$password,"now()","now()"]);
                        echo json_encode(["type"=>"success","message"=>"Enregistrement effectuer"]);                        
                    }else{echo json_encode(["type"=>"Failure","message"=>"Les mot de pass sont pas identique"]);}                
                }else{echo json_encode(["type"=>"Failure","message"=>"Le nom doit être un texte et non nul"]);}
            }
            catch(Exception $e){
                echo json_encode(["type"=>"Failure","message"=>"Quelque chose s'est mal passé"]);
            }
            
>>>>>>> 81dd657c09e9d85795fe0213be409f25fe61753f
        }
    }
    public function create()
    {

    }
    private function isAdmin()
    {
        if (Validator::sessionExist($_SESSION['admin'])) {
            return true;
        } else {
            $_SESSION['errorAdmin'] = "Impossible d'acceder a cette partie du site";
            header('Location: /login');
            exit();
        }
    }
    public function delete(int $id)
    {
    }
    public function destroy()
    {
        
    }
    public function addPacket(int $id)
    {

    }
    public function signIn()
    {

    }
}
