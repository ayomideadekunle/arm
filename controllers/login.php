<?php

class Login extends Controller {

    function __construct() {
        parent::__construct();
    }

    public function loginUser() {
        $this->model->userLogin();
        header("Location: " . URL);
    }

    public function logout() {
        Session::init();
        @session_destroy();
//        echo 'logged out';
        header("Location: http://arm/");
    }

}
