<?php

class Tenant extends Controller {

    function __construct() {
        parent::__construct();
    }

    // Dashboard Page

    public function index() {
        Session::init();
        if (Session::get("APTRENTALMGT_LOGGED_IN") == true) {
// display dashboard
        } else {
// display login page
        }
    }

    // Create Method Controller

    public function handleMaintenanceRequest() {
        $this->model->sendMaintenanceRequest();
    }

    public function handleChngAptRequest() {
        $this->model->changeApartment();
    }

    public function handleContractTermination(){
        $this->model->handleTermination();
    }

    // Create Form Pages

    public function requestmaintenance() {
        Session::init();
        if (Session::get("APTRENTALMGT_LOGGED_IN") == true) {
            $this->view->categories = $this->model->mntCats();
// render create page
            $this->view->render('navigation/header');
            $this->view->render('tenant/maintenance/create');
            $this->view->render('navigation/footer');
        } else {
// render login page
        }
    }

    public function request() {
        Session::init();
        if (Session::get("APTRENTALMGT_LOGGED_IN") == true) {
            $this->view->requestcats = $this->model->requestCategories();
            $this->view->apartments = $this->model->loadApartments();
// render create page
            $this->view->render('navigation/header');
            $this->view->render('tenant/request/create');
            $this->view->render('navigation/footer');
        } else {
// render login page
        }
    }

    // Edit Form Pages

    public function chngAptReqEditPage() {
        Session::init();
        if (Session::get("APTRENTALMGT_LOGGED_IN") == true) {
            $this->view->chngAptData = $this->model->findChangeAptById();
// render edit page
        } else {
// render login page
        }
    }

    // Update Method Controller

    public function editMaintenanceRequest($id) {
        $this->model->updateSendMaintenanceRequest($id);
    }

    public function editChngAptRequest($id) {
        $this->model->updateChangeApartment($id);
    }

}
