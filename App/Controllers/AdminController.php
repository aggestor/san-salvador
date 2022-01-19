<?php

namespace Root\App\Controllers;

use Root\App\Controllers\Validators\AdiminValidator;
use Root\App\Models\AdminModel;
use Root\App\Models\ModelFactory;
use Root\App\Models\Objects\Admin;

class AdminController extends Controller
{
    /**
     * Undocumented variable
     *
     * @var AdminModel
     */
    private $adminModel;


    public function __construct()
    {
        parent::__construct();
        $this->adminModel = ModelFactory::getInstance()->getModel('Admin');
    }
    /**
     * Dashboard admin
     *
     * @return void
     */
    public function index()
    {
        if ($this->isAdmin()) {
            return $this->view('pages.admin.dashboard', 'layout_admin');
        }
    }
    /**
     * Creation de l'admin
     *
     * @return void
     */
    public function create()
    {
        if (!$this->redirectAdmin()) {

            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $validator = new AdiminValidator();
                $admin = $validator->createAfterValidation();
                if ($validator->hasError() || $validator->getMessage() != null) {
                    $errors = $validator->getErrors();
                    return $this->view("pages.admin.add_test", "layout_admin", ['admin' => $admin, 'errors' => $errors, 'caption' => $validator->getCaption(), 'message' => $validator->getMessage()]);
                }
                $mail = $admin->getEmail();
                $token = $admin->getToken();
                $id = $admin->getId();
                $nom = $admin->getName();
                $domaineName = $_SERVER['HTTP_ORIGIN'] . '/';
                $lien = $domaineName . "admin/activation-$id-$token";
                if ($this->envoieMail($mail, $lien, "Activation et finalisation de la creation du compte", "pages/mail/activationAccoutMail", $nom)) {
                    Controller::redirect('/user/mail/success');
                } else {
                    //view de echec lors de l'envoie du mail
                }
            }
            return $this->view('pages.admin.add_test', 'layout_admin');
        }
    }
    /**
     * Connexion de l'admin
     *
     * @return void
     */
    public function login()
    {
        if (!$this->redirectAdmin()) {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $validator = new AdiminValidator();
                $admin = $validator->loginProcess();

                if ($validator->hasError() || $validator->getMessage() != null) {
                    $errors = $validator->getErrors();
                    return $this->view("pages.admin.login", "layout_", ['admin' => $admin, 'errors' => $errors, 'caption' => $validator->getCaption(), 'message' => $validator->getMessage()]);
                } else {
                    $_SESSION[self::SESSION_ADMIN] = $admin;
                    header('Location:/admin/dashboard');
                }
            }
            return $this->view('pages.admin.login', 'layout_');
        }
    }
    /**
     * Validation du compte admin
     *
     * @return void
     */
    public function accountActivation()
    {
        if (!$this->redirectAdmin()) {
            $validator = new AdiminValidator();
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $admin = $validator->activeAccountAfterValidation();
                if ($validator->hasError() || $validator->getMessage() != null) {
                    $errors = $validator->getErrors();
                    if ($admin->getToken() != "" && $admin->getId() == $_GET['id']) {
                        return $this->view("pages.password.create_new_pwd", "layout_admin", ['admin' => $admin, 'errors' => $errors, 'caption' => $validator->getCaption(), 'message' => $validator->getMessage()]);
                    } else {
                        return $this->view("pages.static.404");
                    }
                } else {
                    $_SESSION[self::SESSION_ADMIN] = $admin;
                    header('Location:/admin/dashboard');
                }
            }
            /**
             * @var Admin
             */
            $admin = $this->adminModel->findById($_GET['id']);
            if ($admin->getToken() != "") {
                return $this->view("pages.password.create_new_pwd", "layout_");
            } else {
                return $this->view("pages.static.404");
            }
        }
    }

    /**
     * pour la validation des inscriptions en attente
     *
     * @return void
     */
    public function activeInscriptions()
    {
        if ($this->isAdmin()) {
            $this->activeInscription();
            header("location:" . $_SERVER['HTTP_REFERER']);
        }
    }

    /**
     * Pour l'affichage des inscription en attente de de validation
     *
     * @return void
     */
    public function viewAllNonActiveInscription()
    {
        if ($this->isAdmin()) {
            return $this->view('pages.admin.viewAllNotValidateInscription', 'layout_admin', ['nonValidate' => $this->allNonValidateInscription()]);
        }
    }
    /**
     * Gestion des operations des admin
     *
     * @return void
     */
    public function administratorDashboard()
    {
        if ($this->isAdmin()) {
            $allAdmin = $this->adminModel->findAll();
            return $this->view('pages.admin.administratorsDashboard', 'layout_admin', ['allAdmin' => $allAdmin]);
        }
    }
    /**
     * All Pack Operation
     *
     * @return void
     */
    public function allPacks()
    {
        if ($this->isAdmin()) {
            $pack = $this->getAllPck();
            return $this->view('pages.admin.viewAllNotValidateInscription', 'layout_admin', ['allPack' => $pack]);
        }
    }

    /**
     * All users operation
     * @return void
     */
    public function allUsers()
    {

        if ($this->isAdmin()) {
            $totalCount = $this->countValidateInscription();
            @$page = !empty($_GET['page']) ? $_GET['page'] : 1;
            $nombre_element_par_page = 10;
            $nombre_pages = ceil($totalCount / $nombre_element_par_page);
            $debut = ($page - 1) * $nombre_element_par_page;
            $users = $this->allUsersHasValidateInscription($debut, $nombre_element_par_page);
            var_dump($users);exit();
            if ($_GET['page'] > $nombre_pages) {
                return $this->view("pages.static.404");
            }
            return $this->view('pages.admin.viewAllUsers', 'layout_admin', ['allUsers' => $users, 'nombrePage' => $nombre_pages]);
        }
    }
    /**
     * Methode pour retourne tous les cashout en attente de validation
     *
     * @return void
     */
    public function viewAllNonValideCashOut()
    {
        if ($this->isAdmin()) {
            $cashOut = $this->viewAllCashOutNotValide();
            //non de la vue je l'attend ici
            return $this->view('pages.admin.viewAllNotValidateCashout', 'layout_admin', ['cashOut' => $cashOut]);
        }
    }

    /**
     * Methode pour active un cashout
     *
     * @return void
     */
    public function validationCashOut()
    {
        if ($this->isAdmin()) {
            $this->activeCashOut();
            header("location:" . $_SERVER['HTTP_REFERER']);
        }
    }
    /**
     * Verification de la sessios admin
     *
     * @return boolean
     */
    private function isAdmin()
    {
        if (isset($_SESSION[self::SESSION_ADMIN]) && !empty($_SESSION[self::SESSION_ADMIN])) {
            return true;
        } else {
            header('Location:/admin/login');
        }
    }
    /**
     * deconnexion de l'admin
     *
     * @return void
     */
    public function destroy()
    {
        unset($_SESSION[self::SESSION_ADMIN]);
        header('Location:/admin/login');
    }

    /**
     * Redirection de l'admin si la session admin existe et differents de vide
     *
     * @return void
     */
    private function redirectAdmin()
    {
        if (isset($_SESSION[self::SESSION_ADMIN]) && !empty($_SESSION[self::SESSION_ADMIN])) {
            header('Location:/admin/dashboard');
        }
    }
    public function currencies(){
        if($this->isAdmin()){
            return $this->view("pages.admin.currencies", "layout_admin");
        }
    }
}
