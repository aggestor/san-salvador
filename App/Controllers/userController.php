<?php
namespace Root\App\Controllers;

use Root\Core\Validator;
use Root\App\Models\UserModel;

class UserController extends Controller
{
    /**
     * render view pour la page login
     *
     * @return void
     */
    public function login()
    {
        return $this->view("pages.login", "layout_");
    }
    /**
     * pour la deconnection de l'utilisateur
     *
     * @return void
     */
    public function logout()
    {
    }
    /**
     * Pour la connection de l'utilisateur post
     *
     * @return void
     */
    public function authentification()
    {
    }
    /**
     * render view pour la page de recuperation du mot de passe
     *
     * @return void
     */
    public function pwd_reset()
    {
        return $this->view("pages.reset_pwd", "layout_");
    }
    /**
     * pour recuperer le mot de passe 
     *
     * @return void
     */
    public function reset()
    {
    }
    /**
     * pour render view de la page d'enregistrement un utilisateur
     * @return void
     */
    public function register()
    {
        return $this->view("pages.register", "layout_");
    }
   public function profile()
    {
        return $this->view("pages.profile", "layout_");
    }
    public function create()
    {
        $error = [];
        (int)$id = $this->generate(11, "1234567890");
        $name = strip_tags($_POST['userName']);
        $mail = strip_tags($_POST['userEmail']);
        $phone = strip_tags($_POST['PhoneNumber']);
        $pass = strip_tags($_POST['Password']);
        $side = strip_tags($_POST['userSide']);
        $sposor = strip_tags($_POST['userSponsor']);
        $pass_Confirm = strip_tags($_POST['ConfirmPassword']);
        if (!empty($id)) {
            $userMode = new UserModel();
            $ids = $userMode->find((int)$id);
            while ($ids) {
                $id = new $id;
            }
        }
        if (Validator::isEmpty($name)) {
            $error['userName'] = "Veuillez renseigner ce champs!!";
        } else if (Validator::isExist($name)) {
            $error['userName'] = "Ce nom d'utilisateur est deja utiliser pour une autre personne!!";
        }
        if (Validator::isEmpty($mail)) {
            $error['userEmail'] = "Veuillez renseigner ce champs!!";
        } else {
            if (Validator::isExist($mail)) {
                $error['userEmail'] = "Cet email est deja utiliser pour une autre personne!!";
            } elseif (!Validator::isEmail($mail)) {
                $error['userEmail'] = "Cet email est invalide!!";
            }
        }
        if (Validator::isEmpty($phone)) {
            $error['PhoneNumber'] = "Veuillez renseigner ce champs!!";
        } else if (Validator::isExist($phone)) {
            $error['PhoneNumber'] = "Ce numero de telephone est deja utiliser pour une autre personne!!";
        }
        if (empty($pass) || empty($pass_Confirm)) {
            $error['Password'] = "Veuillez renseigner ce champs!!";
        } elseif ($pass != $pass_Confirm) {
            $error['Password'] = "Les deux mot de passe doivent etre identique!!";
        }
        if (Validator::isEmpty($error)) {
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
            $idUser = $userModel->find((int)$id);
            $donnees = $userModel->hydrate($idUser);
            $donnees->setSession();
            var_dump($_SESSION['users']);
        }
    }
    public function signIn()
    {
        $image = $this->addImage('password');
        var_dump($image);
    }
    public function suscribPack(int $id)
    {
        if (Validator::sessionExist($_SESSION['users'])) {
        }
    }
}