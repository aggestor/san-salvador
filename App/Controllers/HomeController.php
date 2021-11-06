<?php

namespace Root\App\Controllers;

class HomeController extends Controller
{
    public function index()
    {
        return $this->view('Home.HomePage');
    }
    public function packages()
    {
        return $this->view('pages.packs');
    }
}
