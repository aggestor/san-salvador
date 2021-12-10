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
    public function create()
    {
        
        $name = strip_tags($_POST['userName']);
        $mail = strip_tags($_POST['userEmail']);
        $phone = strip_tags($_POST['PhoneNumber']);
        $pass = strip_tags($_POST['Password']);
        $side = strip_tags($_POST['userSide']);
        $sposor = strip_tags($_POST['userSponsor']);
        $pass_Confirm = strip_tags($_POST['ConfirmPassword']);

    }
    public function signIn()
    {
    }
    public function suscribPack(int $id)
    {
        
    }
}
