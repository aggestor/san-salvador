<?php

namespace Root\App\Controllers;
class adminController extends Controller
{
    public function index()
    {
        return $this->view('pages.admin.dashboard', 'layout_admin');
    }
    public function create()
    {
    }
    private function isAdmin()
    {
        // if (Validator::sessionExist($_SESSION['admin'])) {
        //     return true;
        // } else {
        //     $_SESSION['errorAdmin'] = "Impossible d'acceder a cette partie du site";
        //     header('Location: /login');
        //     exit();
        // }
    }
    public function delete(int $id)
    {
    }
    public function destroy()
    {
    }
    public function addPacket()
    {
    }
    public function login()
    {
        return $this->view("pages.admin.login", "layout_");
    }
}
