<?php

namespace Root\App\Controllers;

class StaticController extends Controller
{
    public function home()
    {
        return $this->view('Home.HomePage', 'layouts');
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
    public function with_us()
    {
        return $this->view('pages.with_us');
    }
    public function about()
    {
        return $this->view('pages.about');
    }
    public function contact()
    {
        return $this->view('pages.contact');
    }
}
