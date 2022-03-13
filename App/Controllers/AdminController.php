<?php

namespace Root\App\Controllers;

use Root\App\Controllers\Validators\AdiminValidator;
use Root\App\Models\AdminModel;
use Root\App\Models\ModelFactory;
use Root\App\Models\Objects\Admin;
use Root\App\Models\Objects\User;

class AdminController extends Controller
{
    /**
     * Undocumented variable
     *
     * @var AdminModel
     */
    private $adminModel;

    /**
     * User Model
     *
     * @var UserModel
     */
    private $userModel;

    /**
     * CashOut Model
     *
     * @var CashOutModel
     */
    private $cashOutModel;

    public function __construct()
    {
        parent::__construct();
        $this->adminModel = ModelFactory::getInstance()->getModel('Admin');
        $this->userModel = ModelFactory::getInstance()->getModel("User");
        $this->cashOutModel = ModelFactory::getInstance()->getModel("CashOut");
    }
    /**
     * Dashboard admin
     *
     * @return void
     */
    public function index()
    {
        //var_dump($this->totalAmountInvested());exit();
        if ($this->isAdmin()) {
            $amountBinary = $this->allBinary();;
            $amountInvest = $this->allReturnInvest();
            $amountParainnage = $this->allParainage();
            $amountSurplus = $this->allSurplus();
            $amountCashOutNotValidated = $this->amountAllCashOutNotValide();
            $amountCashOutValidated = $this->amountAllCashOutValide();
            $amountCapitalInvested = $this->totalAmountInvested();
            $amountCaisse = ($amountBinary + $amountInvest + $amountParainnage + $amountSurplus) - $amountCashOutValidated;
            return $this->view('pages.admin.dashboard', 'layout_admin', ['binaire' => $amountBinary, 'invest' => $amountInvest, 'parainnage' => $amountParainnage, 'surplus' => $amountSurplus, 'cashoutNotValidate' => $amountCashOutNotValidated, 'cashoutValidate' => $amountCashOutValidated, 'capital' => $amountCapitalInvested, 'caisse' => $amountCaisse]);
        }
    }
    /**
     * Creation de l'admin
     *
     * @return void
     */
    public function create()
    {
        if ($this->isAdmin()) {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $allAdmin = $this->adminModel->findAll();
                $validator = new AdiminValidator();
                $admin = $validator->createAfterValidation();
                if ($validator->hasError() || $validator->getMessage() != null) {
                    $errors = $validator->getErrors();
                    return $this->view("pages.admin.administratorsDashboard", "layout_admin", ['admin' => $admin, 'errors' => $errors, 'caption' => $validator->getCaption(), 'message' => $validator->getMessage(), 'allAdmin' => $allAdmin]);
                } else {
                    $mail = $admin->getEmail();
                    $token = $admin->getToken();
                    $id = $admin->getId();
                    $nom = $admin->getName();
                    $domaineName = $_SERVER['HTTP_ORIGIN'] . '/';
                    $lien = $domaineName . "admin/activation-$id-$token";
                    $_SESSION['mail'] = $mail;
                    if ($this->envoieMail($mail, "Activation et finalisation de la creation du compte", "pages/mail/activationAccoutMail", ['nom' => $nom, 'lien' => $lien])) {
                        Controller::redirect('/mail/success');
                    } else {
                        $_SESSION['action'] = 'activation';
                        Controller::redirect('/admin/mail/resend');
                    }
                }
            }
            return $this->view('pages.admin.administratorsDashboard', 'layout_admin');
        }
    }

    /**
     * Reset password on send mail
     *
     * @return void
     */
    public function resetPasswordOnMail()
    {
        if (!$this->redirectAdmin()) {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $validator = new AdiminValidator();
                $admin = $validator->resetPassword();
                if ($validator->hasError() || $validator->getMessage() != null) {
                    $errors = $validator->getErrors();
                    // var_dump($errors);
                    // exit();
                    return $this->view("pages.password.reset_pwd_admin", "layout_", ['admin' => $admin, 'errors' => $errors, 'caption' => $validator->getCaption(), 'message' => $validator->getMessage()]);
                } else {
                    /**
                     * @var Admin
                     */
                    $mail = $admin->getEmail();
                    $token = $admin->getToken();
                    $id = $admin->getId();
                    $domaineName = $_SERVER['HTTP_ORIGIN'] . '/';
                    $lien = $domaineName . "admin/reset-$id-$token";
                    $nom = $admin->getName();
                    $_SESSION['mail'] = $mail;

                    if ($this->envoieMail($mail, "Reinitialisation du mot de passe", "pages/mail/resetPwdMail", ['nom' => $nom, 'lien' => $lien])) {
                        Controller::redirect('/admin/mail/success');
                    } else {
                        $_SESSION['action'] = 'reset';
                        Controller::redirect('/admin/mail/resend');
                    }
                }
            }
            return $this->view("pages.password.reset_pwd_admin", "layout_");
        }
    }
    /**
     * Resend mail
     *
     * @return void
     */
    public function mailResend()
    {
        $validator = new AdiminValidator();
        if ($this->sessionExist($_SESSION['action'])) {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $admin = $validator->resendMail();
                if ($validator->hasError() || $validator->getMessage() != null) {
                    $errors = $validator->getErrors();
                    return $this->view("pages.admin.mail_sent_error", "layout_", ['admin' => $admin, 'errors' => $errors, 'caption' => $validator->getCaption(), 'message' => $validator->getMessage()]);
                }
                $mail = $admin->getEmail();
                $token = $admin->getToken();
                $id = $admin->getId();
                $nom = $admin->getName();
                $domaineName = $_SERVER['HTTP_ORIGIN'] . '/';
                if ($_GET['action'] == 'activation') {
                    $lien = $domaineName . "admin/activation-$id-$token";
                    if ($this->envoieMail($mail, "Activation du compte", "pages/mail/activationAccoutMail", ['nom' => $nom, 'lien' => $lien])) {
                        Controller::redirect('admin/mail/success');
                    } else {
                        $_SESSION['action'] = 'activation';
                        Controller::redirect($_SERVER['HTTP_REFERER']);
                    }
                } else if ($_GET['action'] == 'reset') {
                    $lien = $domaineName . "admin/reset-$id-$token";
                    if ($this->envoieMail($mail, "Reinitialisation du mot de passe", "pages/mail/resetPwdMail", ['nom' => $nom, 'lien' => $lien])) {
                        Controller::redirect('admin/mail/success');
                    } else {
                        $_SESSION['action'] = 'reset';
                        Controller::redirect($_SERVER['HTTP_REFERER']);
                    }
                }
            }
            return $this->view("pages.admin.mail_sent_error", "layout_");
        } else {
            Controller::redirect('/admin/login');
        }
    }

    /**
     * Reset password
     *
     * @return void
     */
    public function resetPassword()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $validator = new AdiminValidator();
            $admin = $validator->resetPasswordAfterValidation();
            if ($validator->hasError() || $validator->getMessage() != null) {
                $errors = $validator->getErrors();
                if ($admin->getToken() != "" && $admin->getId() == $_GET['id'] && $admin->getToken() == $_GET['token']) {
                    return $this->view("pages.password.create_new_pwd_admin", "layout_", ['user' => $admin, 'errors' => $errors, 'caption' => $validator->getCaption(), 'message' => $validator->getMessage()]);
                } else {
                    return $this->view('pages.static.404');
                }
            } else {
                Controller::destroyAllSession();
                Controller::redirect("/admin/password");
            }
        }
        /**
         * @var Admin $admin
         */
        $admin = $this->adminModel->findById($_GET['id']);
        if ($admin->getToken() != "" && $admin->getToken() == $_GET['token']) {
            return $this->view("pages.password.create_new_pwd_admin", "layout_");
        } else {
            return $this->view('pages.static.404');
        }
    }

    /**
     * Password success
     *
     * @return void
     */
    public function passwordSuccess()
    {
        return $this->view('pages.admin.reset_pwd_success', 'layout_');
    }

    /**
     * Mail succes
     *
     * @return void
     */
    public function mailSendSuccess()
    {
        return $this->view('pages.admin.mail_sent_success', 'layout_', ['mail' => $_SESSION['mail']]);
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
        Controller::destroyAllSession();
        $validator = new AdiminValidator();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $admin = $validator->activeAccountAfterValidation();
            if ($validator->hasError() || $validator->getMessage() != null) {
                $errors = $validator->getErrors();
                if ($admin->getToken() != "" && $admin->getId() == $_GET['id']) {
                    return $this->view("pages.password.create_new_pwd_admin", "layout_admin", ['admin' => $admin, 'errors' => $errors, 'caption' => $validator->getCaption(), 'message' => $validator->getMessage()]);
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
            return $this->view("pages.password.create_new_pwd_admin", "layout_");
        } else {
            return $this->view("pages.static.404");
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
            $totalCount = $this->countInscription(false);
            $page = !empty($_GET['page']) ? $_GET['page'] : 1;
            $nombre_element_par_page = 5;
            $data = Controller::drowData($totalCount, $page, $nombre_element_par_page);
            $inscription = $this->allNonValidateInscription($nombre_element_par_page, $data[0]);
            if ($_GET['page'] > $data[1]) {
                return $this->view('pages.admin.viewAllNotValidateInscription', 'layout_admin', ['message' => 1]);
            }
            return $this->view('pages.admin.viewAllNotValidateInscription', 'layout_admin', ['allInscription' => $inscription, 'nombrePage' => $data[1]]);
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
            $totalCount = $this->countInscription();
            $page = !empty($_GET['page']) ? $_GET['page'] : 1;
            $nombre_element_par_page = 5;
            $data = Controller::drowData($totalCount, $page, $nombre_element_par_page);
            //var_dump($data[0],$nombre_element_par_page);exit();
            $users = $this->allUsersHasValidateInscription($nombre_element_par_page, $data[0]);
            if ($_GET['page'] > $data[1]) {
                return $this->view("pages.static.404");
            }
            return $this->view('pages.admin.viewAllUsers', 'layout_admin', ['allUsers' => $users, 'nombrePage' => $data[1]]);
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
            $totalCount = $this->countCashOut();
            $page = !empty($_GET['page']) ? $_GET['page'] : 1;
            $nombre_element_par_page = 5;
            $data = Controller::drowData($totalCount, $page, $nombre_element_par_page);
            $cashOut = $this->viewAllCashOutNotValide($nombre_element_par_page, $data[0]);
            if ($_GET['page'] > $data[1]) {
                return $this->view('pages.admin.viewAllNotValidateCashout', 'layout_admin', ['message' => 1]);
            }
            $validator = new AdiminValidator();

            if ($validator->hasError() || $validator->getMessage() != null) {
                $errors = $validator->getErrors();
                return $this->view('pages.admin.viewAllNotValidateCashout', 'layout_admin', ['cashOut' => $cashOut, 'nombrePage' => $data[1], 'error' => $errors]);
            }
            return $this->view('pages.admin.viewAllNotValidateCashout', 'layout_admin', ['cashOut' => $cashOut, 'nombrePage' => $data[1]]);
        }
    }

    /**
     * Historique des touts les retraits deja valide
     *
     * @return void
     */
    public function history()
    {
        if ($this->isAdmin()) {
            $totalCount = $this->countCashOut(true);
            $page = !empty($_GET['page']) ? $_GET['page'] : 1;
            $nombre_element_par_page = 5;
            $data = Controller::drowData($totalCount, $page, $nombre_element_par_page);
            //$cashOut = $this->viewAllCashOutValidate($nombre_element_par_page, $data[0]);
            $cashOut = $this->viewAllCashOutValidate($nombre_element_par_page, $data[0]);
            if ($_GET['page'] > $data[1]) {
                return $this->view("pages.admin.history", "layout_admin", ['message' => 1]);
            }
            return $this->view("pages.admin.history", "layout_admin", ['cashOut' => $cashOut, 'nombrePage' => $data[1]]);
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
            $idCashOut = $_GET['cashout'];
            $idAdmin = $_SESSION[self::SESSION_ADMIN]->getId();
            $idUser = $_GET['user'];
            $validator = new AdiminValidator();
            $reference = $validator->refTransactionValideCashOut();

            if (!is_null($reference)) {
                /**
                 * @var CashOut
                 */
                $cashOut = $this->cashOutModel->findById($idCashOut);
                if ($this->cashOutModel->checkById($idCashOut)) {
                    if ($this->cashOutModel->checkValidated()) {
                        $cashOut->setUser($this->userModel->findById($idUser));

                        //Les information pour le mail
                        $nom = $cashOut->getUser()->getName();
                        $mail = $cashOut->getUser()->getEmail();
                        $montant = $cashOut->getAmount();
                        $destination = $cashOut->getDestination();

                        $this->envoieMail($mail, "Validation du retrait", "pages/mail/cashOutMailValide", ['nom' => $nom, 'montant' => $montant, 'destination' => $destination]);
                        $this->cashOutModel->validate($idCashOut, $idAdmin);
                        header("location:" . $_SERVER['HTTP_REFERER']);
                    }
                } else {
                    return $this->view("pages.static.404");
                }
            } else {
                return $this->viewAllNonValideCashOut();
                //Controller::redirect('/admin/validate/cashout-1');
            }
        }
    }

    /**
     * Methode pour annuler la demande de retrait
     *
     * @return void
     */
    public function annulationCashOut()
    {
        //ca c'{/admin/canceled/cashout-$params['cashOut']->getId()}
        if ($this->isAdmin()) {
            $this->cancelCashOut();
            header("location:" . $_SERVER['HTTP_REFERER']);
        }
    }

    /**
     * All operation systeme
     *
     * @return void
     */
    public function transaction()
    {
        if ($this->isAdmin()) {
            $binary = array_sum($this->allBinary());
            $returnInvest = array_sum($this->allReturnInvest());
            $parainage = array_sum($this->allParainage());
            //pense a cree cette view.
            return $this->view('pages.admin.viewAllNotValidateCashout', 'layout_admin', ['binary' => $binary, 'returnInvest' => $returnInvest, 'parainage' => $parainage]);
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
}
