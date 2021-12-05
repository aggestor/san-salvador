<?php
    namespace Root\App\Controllers;
    use Root\App\Models\userModel;
    use Root\App\Controllers\Validator;
    use Root\App\Controllers\Generate;
    use Exception;
 
    class UserController extends Controller {
        public function login(){
            return $this->view("pages.login","layout_");
        }
        public function profile(){
            return $this->view("pages.user.profile","layout_");
        }
        public function pwd_reset(){
            return $this->view("pages.reset_pwd","layout_");
        }
        public function register()
        {
            return $this->view("pages.register", "layout_");
        }
        public function create()
        {
            $error = [];
            $id = $this->generate_id(11);
            $name = strip_tags($_POST['userName']);
            $mail = strip_tags($_POST['userEmail']);
            $phone = strip_tags($_POST['PhoneNumber']);
            $pass = strip_tags($_POST['Password']);
            $side = strip_tags($_POST['userSide']);
            $sposor = strip_tags($_POST['userSponsor']);
            $pass_Confirm = strip_tags($_POST['ConfirmPassword']);
            if (!empty($id)) {
                $userMode = new UserModel();
                $ids = $userMode->find($id);
                while ($ids) {
                    $id = $this->generate_id(11);
                }
            }
            if (empty($name)) {
                $error['userName'] = "Veuillez renseigner ce champs!!";
            } else {
                $userModel = new UserModel();
                $user = $userModel->findByName($name);
                if ($user) {
                    $error['userName'] = "Ce nom d'utilisateur est deja utiliser pour une autre personne!!";
                }
            }
            if (empty($mail)) {
                $error['userEmail'] = "Veuillez renseigner ce champs!!";
            } else {
                $userModel = new UserModel();
                $user = $userModel->findByMail($mail);
                if ($user) {
                    $error['userEmail'] = "Cet email est deja utiliser pour une autre personne!!";
                } elseif (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
                    $error['userEmail'] = "Cet email est invalide!!";
                }
            }
            if (empty($phone)) {
                $error['PhoneNumber'] = "Veuillez renseigner ce champs!!";
            } else {
                $userModel = new UserModel();
                $user = $userModel->findByPhone($phone);
                if ($user) {
                    $error['PhoneNumber'] = "Ce numero de telephone est deja utiliser pour une autre personne!!";
                }
            }
            if (empty($pass) || empty($pass_Confirm)) {
                $error['Password'] = "Veuillez renseigner ce champs!!";
            } elseif ($pass != $pass_Confirm) {
                $error['Password'] = "Les deux mot de passe doivent etre identique!!";
            }
            if (!empty($error)) {
                $_SESSION['message'] = $error;
                return $this->view("pages.register", "layout_");
            } else {
                unset($_SESSION["message"]);
                $userModel = new UserModel();
                $passhas = password_hash($pass, PASSWORD_ARGON2I);
                $add = $userModel->setId($id)->setUser_name($name)
                    ->setEmail($mail)->setPhone($phone)
                    ->setUser_password($passhas)->setSponsor($sposor)->setSide($side);
                $add->create();
                // creation de la session user
                $idUser = $userModel->find($id);
                $donnees = $userModel->hydrate($idUser);
                $donnees->setSession();
                var_dump($_SESSION['users']);
            }
        }
  }
