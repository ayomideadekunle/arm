<?php

class Admin extends Controller {

    function __construct() {
        parent::__construct();
        $this->loadModel("index");
    }

    public function index() {
        Session::init();
        if (isset($_SESSION["APTRENTALMGT_LOGGED_IN"])) {
            $this->view->render('navigation/header');
            // $this->view->render('admin/apartment/index');
            $this->view->render('navigation/footer');
        } else {
            $this->view->render('admin');
        }
    }

}
