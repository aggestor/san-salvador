<?php

namespace Root\App\Controllers;

use Root\App\Controllers\Validators\UserValidator;
use Root\App\Models\ModelFactory;
use Root\App\Models\Objects\User;
use Root\App\Models\UserModel;
use RuntimeException;

class UserController extends Controller
{
    /**
     * Undocumented variable
     *
     * @var UserModel
     */
    private $userModel;

    const FIELD_IMAGE = 'image';

    public function __construct()
    {
        $this->userModel = ModelFactory::getInstance()->getModel('User');
    }
    /**
     * traitement du login post et get
     *
     * @return void
     */
    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $validator = new UserValidator();
            $user = $validator->loginProcess();
            if ($validator->hasError() || $validator->getMessage() != null) {
                $errors = $validator->getErrors();
                return $this->view("pages.login", "layout_", ['user' => $user, 'errors' => $errors, 'caption' => $validator->getCaption(), 'message' => $validator->getMessage()]);
            }
            $_SESSION['users'] = $user;
            header('Location: /user/dashboard');
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
     * render view pour la page de recuperation du mot de passe
     *
     * @return void
     */
    public function pwd_reset()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $validator = new UserValidator();
            $user = $validator->resetPassword();
            if ($validator->hasError() || $validator->getMessage() != null) {
                $errors = $validator->getErrors();
                return $this->view("pages.reset_pwd", "layout_", ['user' => $user, 'errors' => $errors, 'caption' => $validator->getCaption(), 'message' => $validator->getMessage()]);
            } else {
                /**
                 * @var User
                 */
                $object = $this->userModel->findByMail($user->getEmail());
                $mail = $user->getEmail();
                $token = Controller::generate(60, "QWERTYUIOPASDFGHJKLZXCVBNMqweryuiopasdfghjklzxcvbnm1234567890");
                $id = $object->getId();
                $domaineName = $_SERVER['HTTP_ORIGIN'] . '/';
                $lien = $domaineName . "reset-$id-$token";
                $this->envoieMail($mail, $lien);
            }
        }
        return $this->view("pages.reset_pwd", "layout_");
    }

    public function resetPassword()
    {
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
     * creation du compte des utilisateurs
     *
     * @return void
     */
    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $validator = new UserValidator();
            $user = $validator->createAfterValidation();
            if ($validator->hasError() || $validator->getMessage() != null) {
                $errors = $validator->getErrors();
                var_dump($errors);
                exit();
                return $this->view("pages.register", "layout_", ['user' => $user, 'errors' => $errors, 'caption' => $validator->getCaption(), 'message' => $validator->getMessage()]);
            }
            $mail = $user->getEmail();
            $token = $user->getToken();
            $id = $user->getId();
            $domaineName = $_SERVER['HTTP_ORIGIN'] . '/';
            $lien = $domaineName . "activation-$id-$token";
            $this->envoieMail($mail, $lien);
        }
        return $this->view("pages.register", "layout_");
    }
    public function dashboard()
    {
        if ($this->isUsers()) {
            return $this->view("pages.user.profile", "layout_");
        }
    }
    public function suscribPack(int $id)
    {
    }
    /**
     * Activation du compte utilisateur
     *
     * @return void
     */
    public function accountActivation()
    {
        $validator = new UserValidator();
        $user = $validator->activeAccountAfterValidation();
        if ($validator->hasError() || $validator->getMessage() != null) {
            $errors = $validator->getErrors();
            var_dump($errors);
            exit();
        } else {
            var_dump($user);
            exit();
        }
    }
    private function isUsers()
    {
        if (isset($_SESSION['users']) && !empty($_SESSION['users'])) {
            return true;
        } else {
            header('Location:/login');
        }
    }
}
