<?php

namespace Root\App\Controllers;

use Root\Core\Validator;

class adminController extends Controller
{
    public function index()
    {
        if ($this->isAdmin()) {
            return $this->view('pages.dashbord', 'layout_admin');
        }
    }
    public function create()
    {

    }
    private function isAdmin()
    {
        if (Validator::sessionExist($_SESSION['admin'])) {
            return true;
        } else {
            $_SESSION['errorAdmin'] = "Impossible d'acceder a cette partie du site";
            header('Location: /login');
            exit();
        }
    }
    public function delete(int $id)
    {
    }
    public function destroy()
    {
        
    }
    public function addPacket(int $id)
    {

    }
    public function signIn()
    {

    }
}
