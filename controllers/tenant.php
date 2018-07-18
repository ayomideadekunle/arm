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

    //  To be deleted
    // Create Method Controller

    public function handleMaintenanceRequest() {
        $this->model->sendMaintenanceRequest();
    }

    public function handleChngAptRequest() {
        $this->model->changeApartment();
    }

    public function handleContractRenewal() {
        $this->model->renewContract();
    }

    public function handleContractTermination() {
        $this->model->termination();
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

    public function contractTerminationCreatePage() {
        Session::init();
        if (Session::get("APTRENTALMGT_LOGGED_IN") == true) {
// render create page
        } else {
// render login page
        }
    }

    public function chngAptReqCreatePage() {
        Session::init();
        if (Session::get("APTRENTALMGT_LOGGED_IN") == true) {
// render create page
        } else {
// render login page
        }
    }

    public function contractRenewalCreatePage() {
        Session::init();
        if (Session::get("APTRENTALMGT_LOGGED_IN") == true) {
// render create page
        } else {
// render login page
        }
    }

    // Edit Form Pages

    public function mntReqEditPage() {
        Session::init();
        if (Session::get("APTRENTALMGT_LOGGED_IN") == true) {
            $this->view->mntncData = $this->model->findMaintenanceRequestById();
// render edit page
        } else {
// render login page
        }
    }

    public function chngAptReqEditPage() {
        Session::init();
        if (Session::get("APTRENTALMGT_LOGGED_IN") == true) {
            $this->view->chngAptData = $this->model->findChangeAptById();
// render edit page
        } else {
// render login page
        }
    }

    public function contractRenewalEditPage() {
        Session::init();
        if (Session::get("APTRENTALMGT_LOGGED_IN") == true) {
            $this->view->renewalData = $this->model->findRenewedContractById();
// render edit page
        } else {
// render login page
        }
    }

    public function contractTerminationEditPage() {
        Session::init();
        if (Session::get("APTRENTALMGT_LOGGED_IN") == true) {
            $this->view->terminationData = $this->model->findTerminatedContractById();
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

    public function editContractRenewal($id) {
        $this->model->updateRenewContract($id);
    }

    public function editContractTermination($id) {
        $this->model->updateTermination($id);
    }

    // List Pages

    public function maintenanceRequestist() {
        Session::init();
        if (Session::get("APTRENTALMGT_LOGGED_IN") == true) {
            $this->view->mntncRequests = $this->model->maintenanceRequests();
// render list page
        } else {
// render login page
        }
    }

    public function changeApartmentList() {
        Session::init();
        if (Session::get("APTRENTALMGT_LOGGED_IN") == true) {
            $this->view->aprtChngRequests = $this->model->changeOfApartmentRequests();
// render list page
        } else {
// render login page
        }
    }

    public function renewedContractList() {
        Session::init();
        if (Session::get("APTRENTALMGT_LOGGED_IN") == true) {
            $this->view->renewedContracts = $this->model->renewedContracts();
// render list page
        } else {
// render login page
        }
    }

    public function terminatedContractList() {
        Session::init();
        if (Session::get("APTRENTALMGT_LOGGED_IN") == true) {
            $this->view->terminatedContracts = $this->model->terminatedContracts();
// render list page
        } else {
// render login page
        }
    }

}
