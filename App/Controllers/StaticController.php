<?php

namespace Root\App\Controllers;

class StaticController extends Controller
{
    public function home()
    {   
        return $this->view('pages.static.home_page', 'layouts');
    }
    public function help()
    {
        return $this->view('pages.static.help');
    }
    public function service()
    {
        return $this->view('pages.static.services');
    }
    public function with_us()
    {
        return $this->view('pages.static.with_us');
    }
    public function about()
    {
        return $this->view('pages.static.about');
    }
    
    public function security()
    {
        return $this->view('pages.static.security');
    }
    public function terms()
    {
        return $this->view('pages.static.terms');
    }
    public function politics()
    {
        return $this->view('pages.static.politics');
    }
    public function contracts()
    {
        return $this->view('pages.static.contracts');
    }
}
