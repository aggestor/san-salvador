<?php

namespace Root\App\Controllers;

use Root\App\Controllers\Validators\UserValidator;
use Root\App\Models\ModelFactory;
use Root\App\Models\Objects\Inscription;
use Root\App\Models\Objects\User;
use Root\App\Models\UserModel;

class UserController extends Controller
{
    /**
     * User Model
     * @var UserModel
     */
    private $userModel;

    public function __construct()
    {
        parent::__construct();
        $this->userModel = ModelFactory::getInstance()->getModel('User');
    }
    /**
     * traitement du login post et get
     *
     * @return void
     */
    public function login()
    {
        //return $this->view("pages.user.login", "layout_");

        if (!$this->redirectUser()) {
            if ($_SERVER['REQUEST_METHOD'] == "POST") {
                $validator = new UserValidator();
                $user = $validator->loginProcess();
                if ($validator->hasError() || $validator->getMessage() != null) {
                    $errors = $validator->getErrors();
                    return $this->view("pages.user.login", "layout_", ['user' => $user, 'errors' => $errors, 'caption' => $validator->getCaption(), 'message' => $validator->getMessage()]);
                }
                $_SESSION[self::SESSION_USERS] = $user;
                header('Location: /user/dashboard');
            }
            return $this->view("pages.user.login", "layout_");
        }
    }
    /**
     * pour la deconnection de l'utilisateur
     *
     * @return void
     */
    public function logout()
    {
        unset($_SESSION[self::SESSION_USERS]);
        header('Location:/login');
    }
    /**
     * fonction pour envoyer un mail lors de la demande de reinitialisation du mot de passe
     *
     * @return void
     */
    public function resetPasswordOnMail()
    {
        if (!$this->redirectUser()) {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $validator = new UserValidator();
                $user = $validator->resetPassword();
                if ($validator->hasError() || $validator->getMessage() != null) {
                    $errors = $validator->getErrors();
                    // var_dump($errors);
                    // exit();
                    return $this->view("pages.password.reset_pwd", "layout_", ['user' => $user, 'errors' => $errors, 'caption' => $validator->getCaption(), 'message' => $validator->getMessage()]);
                } else {
                    /**
                     * @var User
                     */
                    $mail = $user->getEmail();
                    $token = $user->getToken();
                    $id = $user->getId();
                    $domaineName = $_SERVER['HTTP_ORIGIN'] . '/';
                    $lien = $domaineName . "reset-$id-$token";
                    $nom = $user->getName();
                    $_SESSION['mail'] = $mail;
                    if ($this->envoieMail($mail, $lien, "Reinitialisation du mot de passe", "pages/mail/resetPwdMail", $nom)) {
                        Controller::redirect('/user/mail/success');
                    } else {
                        $_SESSION['action'] = 'reset';
                        Controller::redirect('/user/mail/resend');
                    }
                }
            }
            return $this->view("pages.password.reset_pwd", "layout_");
        }
    }
    /**
     * Reinitialisation du mot de passe
     *
     * @return void
     */
    public function resetPassword()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $validator = new UserValidator();
            $user = $validator->resetPasswordAfterValidation();
            if ($validator->hasError() || $validator->getMessage() != null) {
                $errors = $validator->getErrors();
                if ($user->getToken() != "" && $user->getId() == $_GET['id'] && $user->getToken() == $_GET['token']) {
                    return $this->view("pages.password.create_new_pwd", "layout_", ['user' => $user, 'errors' => $errors, 'caption' => $validator->getCaption(), 'message' => $validator->getMessage()]);
                } else {
                    return $this->view('pages.static.404');
                }
            } else {
                Controller::redirect("/user/password");
            }
        }
        /**
         * @var User $user
         */
        $user = $this->userModel->findById($_GET['id']);
        if ($user->getToken() != "" && $user->getToken() == $_GET['token']) {
            return $this->view("pages.password.create_new_pwd", "layout_");
        } else {
            return $this->view('pages.static.404');
        }
    }
    /**
     * creation du compte des utilisateurs
     *
     * @return void
     */
    public function create()
    {
        if (!$this->redirectUser()) {
            $validator = new UserValidator();
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $user = $validator->createAfterValidation();
                if ($validator->hasError() || $validator->getMessage() != null) {
                    $errors = $validator->getErrors();
                    return $this->view("pages.user.register", "layout_", ['user' => $user, 'errors' => $errors, 'caption' => $validator->getCaption(), 'message' => $validator->getMessage()]);
                }
                $mail = $user->getEmail();
                $token = $user->getToken();
                $id = $user->getId();
                $nom = $user->getName();
                $domaineName = $_SERVER['HTTP_ORIGIN'] . '/';
                $lien = $domaineName . "activation-$id-$token";
                $_SESSION['mail'] = $mail;
                if ($this->envoieMail($mail, $lien, "Activation du compte", "pages/mail/activationAccoutMail", $nom)) {
                    Controller::redirect('/user/mail/success');
                } else {
                    $_SESSION['action'] = 'activation';
                    Controller::redirect('/user/mail/resend');
                }
            }
            return $this->view("pages.user.register", "layout_");
        }
    }

    /**
     * Pour afficher le dashboard du l'utilisateur quand il sera connecter
     *
     * @return void
     */
    public function dashboard()
    {
        //var_dump($this->allUsersHasValidateInscription()); exit();
        if ($this->isUsers()) {
            if (!$this->userObject()->hasInscription()) {
                return $this->view("pages.user.hasNotSubscribedYet", "layout_",['user'=>$_SESSION[self::SESSION_USERS]]);
            } elseif ($this->existValidateInscription()) {
                //retourne une vue avec le message de veuillez votre inscription est en court de validation 
                return $this->view("pages.user.awaitUserPackValidation", "layout_");
            } else if ($this->existOneValidateInscription()) {
                return $this->view("pages.user.profile", "layout_", ['user' => $this->userObject()]);
            }
        }
        //var_dump($this->userObject()->hasPack()); exit();
    }

    public function profil()
    {
        if ($this->isUsers()) {
            return $this->view('pages.user.me', 'layout_', ['user' => $this->userObject()]);
        }
    }
    public function tree()
    {
        if ($this->isUsers()) {
            return $this->view('pages.user.tree', 'layout_',['user' => $this->allUsers()]);
        }
    }

    public function shareLink()
    {
        if ($this->isUsers()) {
            return $this->view('pages.user.sharelink', 'layout_',['user' => $this->userObject()] );
        }
    }
    public function mailResend()
    {
        $validator = new UserValidator();
        if ($this->sessionExist($_SESSION['action'])) {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $user = $validator->resendMail();
                if ($validator->hasError() || $validator->getMessage() != null) {
                    $errors = $validator->getErrors();
                    return $this->view("pages.static.mail_sent_error", "layout_", ['user' => $user, 'errors' => $errors, 'caption' => $validator->getCaption(), 'message' => $validator->getMessage()]);
                }
                $mail = $user->getEmail();
                $token = $user->getToken();
                $id = $user->getId();
                $nom = $user->getName();
                $domaineName = $_SERVER['HTTP_ORIGIN'] . '/';

                if ($_GET['action'] == 'activation') {
                    $lien = $domaineName . "activation-$id-$token";
                    if ($this->envoieMail($mail, $lien, "Activation du compte", "pages/mail/activationAccoutMail", $nom)) {
                        Controller::redirect('/user/mail/success');
                    } else {
                        $_SESSION['action'] = 'activation';
                        Controller::redirect('/user/mail/resend');
                    }
                } else if ($_GET['action'] == 'reset') {
                    $lien = $domaineName . "reset-$id-$token";
                    if ($this->envoieMail($mail, $lien, "Reinitialisation du mot de passe", "pages/mail/resetPwdMail", $nom)) {
                        Controller::redirect('/user/mail/success');
                    } else {
                        $_SESSION['action'] = 'reset';
                        Controller::redirect('/user/mail/resend');
                    }
                }
            }
            return $this->view("pages.static.mail_sent_error", "layout_");
        } else {
            Controller::redirect('/login');
        }
    }
    /**
     * Pour l'envoie du mail avec success
     *
     * @return void
     */
    public function mailSendSuccess()
    {
        return $this->view('pages.static.mail_sent_success', 'layout_', ['mail' => $_SESSION['mail']]);
    }

    /**
     * Pour la reinitialisation du mode passe avec success
     *
     * @return void
     */
    public function passwordSuccess()
    {
        return $this->view('pages.static.reset_pwd_success', 'layout_');
    }

    /**
     * Pour l'inscription fait avec success
     *
     * @return void
     */
    public function registerSuccess()
    {
        return $this->view('pages.static.registration_success', 'layout_');
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
        unset($_SESSION['mail'],$_SESSION['action']);
        $validator = new UserValidator();
        $user = $validator->activeAccountAfterValidation();
        if ($validator->hasError() || $validator->getMessage() != null) {
            //var_dump($validator->getErrors()); exit();
            return $this->view("pages.static.404");
        } else {
            $_SESSION[self::SESSION_USERS] = $user;
            $this->userModel->updateToken(null, $user->getId());
            Controller::redirect('/user/account');
        }
    }
    /**
     * Verifie si la session existe
     *
     * @return boolean
     */
    private function isUsers()
    {
        if (isset($_SESSION[self::SESSION_USERS]) && !empty($_SESSION[self::SESSION_USERS])) {
            return true;
        } else {
            header('Location:/login');
        }
    }
    /**
     * Redirection de l'utilisateur si la session users existe et differents de vide
     *
     * @return void
     */
    private function redirectUser()
    {
        if (isset($_SESSION[self::SESSION_USERS]) && !empty($_SESSION[self::SESSION_USERS])) {
            header('Location:/user/dashboard');
        }
    }
    public function cashOut(){
        if ($this->isUsers()) {
            return $this->view('pages.user.cashout', 'layout_', ['user' => $this->userObject()]);
        }

    }
}
