<?php

class Login extends Controller {

    function __construct() {
        parent::__construct();
    }

    public function logInTenant() {
        $this->model->tenantLogin();
        header("Location: " . URL);
    }

    public function logInAdmin() {
        $this->model->adminLogin();
    }

    public function logout() {
        Session::init();
        @session_destroy();
//        echo 'logged out';
        header("Location: http://localhost/apartment-rental-mgt/");
    }

}
