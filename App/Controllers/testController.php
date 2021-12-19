<?php
    namespace Root\App\Controllers;

    class TestController extends Controller{
        public function reset_pwd(){
            return $this->view("pages.password.reset_pwd", "layout_");
        }
        public function create_new_pwd(){
            return $this->view("pages.password.create_new_pwd", "layout_");
        }
        public function login_admin()
        {
            return $this->view("pages.admin.login", "layout_");
        }
        public function add_admin_test()
        {
            return $this->view("pages.admin.add_test", "layout_");
        }
        public function success()
        {
            return $this->view("pages.static.registration_success", "layout_");
        }
    }





?>