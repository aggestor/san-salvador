<?php

namespace Root\App\Controllers;

use Root\App\Controllers\Validators\UserValidator;

class UserController extends Controller
{
    /**
     * render view pour la page login
     *
     * @return void
     */
    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            die("ok");
        }
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
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $validator = new UserValidator();
            $user = $validator->createAfterValidation();
            $user->getEmail();
            if ($validator->hasError() || $validator->getMessage() != null) {
                $errors = $validator->getErrors();
                $mail = $this->errorsViews($errors, 'userEmail');
                var_dump($errors);
                die();
                return $this->view("pages.register", "layout_", ['user' => $user, 'errors' => $errors, 'caption' => $validator->getCaption(), 'message' => $validator->getMessage()]);
            }
        }
        return $this->view("pages.register", "layout_");
    }
    public function signIn()
    {
        var_dump($_SERVER['REQUEST_METHOD']);
    }
    public function suscribPack(int $id)
    {
    }
}
