<?php

namespace Root\App\Controllers;

class StaticController extends Controller
{
    public function home()
    {
        return $this->view('Home.HomePage');
    }
    public function packages()
    {
        return $this->view('pages.packs');
    }
    public function help()
    {
        return $this->view('pages.help');
    }
    public function service()
    {
        return $this->view('pages.services');
    }
}
