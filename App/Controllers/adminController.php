<?php

namespace Root\App\Controllers;

use Root\App\Controllers\Validators\AdiminValidator;
use Root\App\Models\AdminModel;
use Root\App\Models\ModelFactory;

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
            $domaineName = $_SERVER['HTTP_ORIGIN'] . '/';
            $lien = $domaineName . "admin/activation-$id-$token";
            $this->envoieMail($mail, $lien);
        }
        return $this->view('pages.admin.add_test', 'layout_admin');
    }
    /**
     * Connexion de l'admin
     *
     * @return void
     */
    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $validator = new AdiminValidator();
            $admin = $validator->loginProcess();

            if ($validator->hasError() || $validator->getMessage() != null) {
                $error = $validator->getErrors();

                var_dump($error);
                exit();
            }
        }
        return $this->view('pages.admin.login', 'layout_admin');
    }
    /**
     * Validation du compte admin
     *
     * @return void
     */
    public function accountActivation()
    {
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
                $_SESSION['admin'] = $admin;
                header('Location:/admin/dashboard');
            }
        }
        if ($this->adminModel->findById($_GET['id'])->getToken() != "") {
            return $this->view("pages.password.create_new_pwd", "layout_");
        } else {
            return $this->view("pages.static.404");
        }
    }
    /**
     * Verification de la sessios admin
     *
     * @return boolean
     */
    private function isAdmin()
    {
        if (isset($_SESSION['admin']) && !empty($_SESSION['admin'])) {
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
        unset($_SESSION['admin']);
        header('Location:/admin/login');
    }
}
