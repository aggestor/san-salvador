<?php

namespace Root\App\Controllers;

use Root\App\Controllers\Validators\AdiminValidator;

class adminController extends Controller
{
    public function index()
    {
        if ($this->isAdmin()) {
            return $this->view('pages.admin.dashboard', 'layout_admin');
        }
    }
    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $validator = new AdiminValidator();
            $admin = $validator->createAfterValidation();
            if ($validator->hasError() || $validator->getMessage() != null) {
                $errors = $validator->getErrors();

                var_dump($errors);
                exit();

                return; // view admin en avec error 
            }
        }
        return; //view admin en get
    }
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
        
    }
    public function accountActivation()
    {
    }
    private function isAdmin()
    {
        if (isset($_SESSION['admin']) && !empty($_SESSION['admin'])) {
            return true;
        } else {
            header('Location:/login');
        }
        return $this->view("pages.admin.login", "layout_");
    }
}
