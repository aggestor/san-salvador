<?php

namespace Root\App\Controllers;

use Root\Core\EnabledCashOut;
use Root\App\Models\UserModel;
use Root\App\Models\ModelFactory;
use Root\App\Models\Objects\User;
use Root\App\Models\Objects\Inscription;
use Root\App\Controllers\Validators\UserValidator;
use Root\Core\TreeFormatter;

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
        if (!$this->redirectUser()) {
            if ($_SERVER['REQUEST_METHOD'] == "POST") {
                $validator = new UserValidator();
                $user = $validator->loginProcess();
                if ($validator->hasError() || $validator->getMessage() != null) {
                    $errors = $validator->getErrors();
                    //var_dump($validator->getMessage(),$errors);exit();
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
                    //$mail "Reinitialisation du mot de passe", "pages/mail/resetPwdMail"
                    if ($this->envoieMail($mail, "Reinitialisation du mot de passe", "pages/mail/resetPwdMail", ['nom' => $nom, 'lien' => $lien])) {
                        Controller::redirect('/mail/success');
                    } else {
                        $_SESSION['action'] = 'reset';
                        Controller::redirect('/mail/resend');
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
                Controller::destroyAllSession();
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
                    //var_dump($validator->getMessage(), $errors);exit();
                    return $this->view("pages.user.register", "layout_", ['user' => $user, 'errors' => $errors, 'caption' => $validator->getCaption(), 'message' => $validator->getMessage()]);
                }
                $mail = $user->getEmail();
                $token = $user->getToken();
                $id = $user->getId();
                $nom = $user->getName();
                $domaineName = $_SERVER['HTTP_ORIGIN'] . '/';
                $lien = $domaineName . "activation-$id-$token";
                $_SESSION['mail'] = $mail;
                //$mail,"Reinitialisation du mot de passe","pages/mail/resetPwdMail",['nom'=>$nom,'lien'=>$lien]
                if ($this->envoieMail($mail, "Activation du compte", "pages/mail/activationAccoutMail", ['nom' => $nom, 'lien' => $lien])) {
                    Controller::redirect('/mail/success');
                } else {
                    $_SESSION['action'] = 'activation';
                    Controller::redirect('/mail/resend');
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
        if ($this->isUsers()) {
            $user = $this->userObject();
            $user->setSides($this->userModel->loadDownlineLeftRightSides($user->getId()));
            $capitauxGauche = $user->getLeftDownlineCapital();
            $capitauxDroite = $user->getRightDownlineCapital();
            $this->control();
            //var_dump($this->existOneValidateInscription());exit();
            if ($this->existOneValidateInscription()) {
                return $this->view("pages.user.profile", "layout_", ['user' => $this->userObject(), 'gauche' => $capitauxGauche, 'droite' => $capitauxDroite]);
            }
        }
    }

    /**
     * Affichage du profil de l'utilisateur
     *
     * @return void
     */
    public function profil()
    {
        if ($this->isUsers()) {
            $this->control();
            if ($this->existOneValidateInscription()) {
                return $this->view('pages.user.me', 'layout_', ['user' => $this->userObject()]);
            }
        }
    }

    /**
     * Mise en jour du profil de l'utilisateur
     *
     * @return void
     */
    public function update()
    {
        if ($this->isUsers()) {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $validator = new UserValidator();
                $user = $validator->updateAfterValidation();
                if ($validator->hasError() || $validator->getMessage() != null) {
                    $errors = $validator->getErrors();
                    // var_dump($errors, $validator->getMessage());
                    // exit();
                    return $this->view('pages.user.edit', 'layout_', ['user' => $this->userObject(), 'errors' => $errors]);
                }
                Controller::redirect('/user/me');
            }
            return $this->view('pages.user.edit', 'layout_', ['user' => $this->userObject()]);
        }
    }

    /**
     * Affichage du reseau de l'utilsateur
     *
     * @return void
     */
    public function tree()
    {
        if ($this->isUsers()) {
            $this->control();
            if ($this->existOneValidateInscription()) {
                return $this->view('pages.user.tree', 'layout_', ['user' => $this->userObject()]);
            }
        }
    }

    /**
     * Affichage des historique de retrait de l'utilisateur 
     *
     * @return void
     */
    public function history()
    {
        if ($this->isUsers()) {
            $cashOutNotValideUser = $this->viewAllHistoryCashOutForUser();
            $cashOutValideUser = $this->viewAllHistoryCashOutForUser(true);
            $this->control();
            if ($this->existOneValidateInscription()) {
                return $this->view('pages.user.history', 'layout_', ['user' => $this->userObject(), 'valide' => $cashOutValideUser, 'nonValide' => $cashOutNotValideUser]);
            }
        }
    }
    public function treeData()
    {
        if ($this->isUsers()) {
            $format = new TreeFormatter();
            $tree = $format->format();
            echo $tree;
        }
    }

    /**
     * Partage du lien de parrainnage
     *
     * @return void
     */
    public function shareLink()
    {
        if ($this->isUsers()) {
            $this->control();
            if ($this->existOneValidateInscription()) {
                return $this->view('pages.user.sharelink', 'layout_', ['user' => $this->userObject()]);
            }
        }
    }

    /**
     * Mail resend
     *
     * @return void
     */
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
                    //$mail,"Reinitialisation du mot de passe","pages/mail/resetPwdMail",['nom'=>$nom,'lien'=>$lien]
                    if ($this->envoieMail($mail, "Activation du compte", "pages/mail/activationAccoutMail", ['nom' => $nom, 'lien' => $lien])) {
                        Controller::redirect('/mail/success');
                    } else {
                        $_SESSION['action'] = 'activation';
                        Controller::redirect('/mail/resend');
                    }
                } else if ($_GET['action'] == 'reset') {
                    $lien = $domaineName . "reset-$id-$token";
                    if ($this->envoieMail($mail, "Reinitialisation du mot de passe", "pages/mail/resetPwdMail", ['nom' => $nom, 'lien' => $lien])) {
                        Controller::redirect('/mail/success');
                    } else {
                        $_SESSION['action'] = 'reset';
                        Controller::redirect('/mail/resend');
                    }
                }
            }
            return $this->view("pages.static.mail_sent_error", "layout_");
        } else {
            Controller::redirect('/login');
        }
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

    /**
     * Activation du compte utilisateur
     *
     * @return void
     */
    public function accountActivation()
    {
        Controller::destroyAllSession();
        $validator = new UserValidator();
        $user = $validator->activeAccountAfterValidation();
        if ($validator->hasError() || $validator->getMessage() != null) {
            // var_dump($validator->getMessage()); exit();
            return $this->view("pages.static.404");
        } else {
            $_SESSION[self::SESSION_USERS] = $user;
            $this->userModel->updateToken(null, $user->getId());
            Controller::redirect('/user/account');
        }
    }

    public function contact()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $validator = new UserValidator();
            $contact = $validator->sendContactMessageAfterValidation();
            if ($validator->hasError() || $validator->getMessage()) {
                $errors = $validator->getErrors();
                //var_dump($validator->getMessage(),$errors);exit;
                return $this->view('pages.user.contact', 'layouts', ['errors' => $errors]);
            }
        }
        return $this->view('pages.user.contact');
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
}
