<?php

class Tenant extends Controller {

    function __construct() {
        parent::__construct();
    }

    // Dashboard Page

    public function index() {
        Session::init();
        if (Session::get("APTRENTALMGT_LOGGED_IN") == true) {
            // $this->view->fullName = $this->model->get_fullName();
            // to be deleted (testing purpose)
            // $this->view->aprtments = $this->model->apartments();
            // $this->view->building_infos = $this->model->buildingInfo();
// display dashboard
            $this->view->render('navigation/header');
            $this->view->render('admin/apartment/index');
            $this->view->render('navigation/footer');
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

    public function mntReqCreatePage() {
        Session::init();
        if (Session::get("APTRENTALMGT_LOGGED_IN") == true) {
            // $this->view->fullName = $this->model->get_fullName();
// render create page
        } else {
// render login page
        }
    }

    public function contractTerminationCreatePage() {
        Session::init();
        if (Session::get("APTRENTALMGT_LOGGED_IN") == true) {
            // $this->view->fullName = $this->model->get_fullName();
// render create page
        } else {
// render login page
        }
    }

    public function chngAptReqCreatePage() {
        Session::init();
        if (Session::get("APTRENTALMGT_LOGGED_IN") == true) {
            // $this->view->fullName = $this->model->get_fullName();
// render create page
        } else {
// render login page
        }
    }

    public function contractRenewalCreatePage() {
        Session::init();
        if (Session::get("APTRENTALMGT_LOGGED_IN") == true) {
            // $this->view->fullName = $this->model->get_fullName();
// render create page
        } else {
// render login page
        }
    }

    // Edit Form Pages

    public function mntReqEditPage() {
        Session::init();
        if (Session::get("APTRENTALMGT_LOGGED_IN") == true) {
            // $this->view->fullName = $this->model->get_fullName();
            $this->view->mntncData = $this->model->findMaintenanceRequestById();
// render edit page
        } else {
// render login page
        }
    }

    public function chngAptReqEditPage() {
        Session::init();
        if (Session::get("APTRENTALMGT_LOGGED_IN") == true) {
            // $this->view->fullName = $this->model->get_fullName();
            $this->view->chngAptData = $this->model->findChangeAptById();
// render edit page
        } else {
// render login page
        }
    }

    public function contractRenewalEditPage() {
        Session::init();
        if (Session::get("APTRENTALMGT_LOGGED_IN") == true) {
            // $this->view->fullName = $this->model->get_fullName();
            $this->view->renewalData = $this->model->findRenewedContractById();
// render edit page
        } else {
// render login page
        }
    }

    public function contractTerminationEditPage() {
        Session::init();
        if (Session::get("APTRENTALMGT_LOGGED_IN") == true) {
            // $this->view->fullName = $this->model->get_fullName();
            $this->view->terminationData = $this->model->findTerminatedContractById();
// render edit page
        } else {
// render login page
        }
    }

    // Update Method Controller

    public function editMaintenanceRequest() {
        $this->model->updateSendMaintenanceRequest();
    }

    public function editChngAptRequest() {
        $this->model->updateChangeApartment();
    }

    public function editContractRenewal() {
        $this->model->updateRenewContract();
    }

    public function editContractTermination() {
        $this->model->updateTermination();
    }

    // List Pages

    public function maintenanceRequestist() {
        Session::init();
        if (Session::get("APTRENTALMGT_LOGGED_IN") == true) {
            // $this->view->fullName = $this->model->get_fullName();
            $this->view->mntncRequests = $this->model->maintenanceRequests();
// render list page
        } else {
// render login page
        }
    }

    public function changeApartmentList() {
        Session::init();
        if (Session::get("APTRENTALMGT_LOGGED_IN") == true) {
            // $this->view->fullName = $this->model->get_fullName();
            $this->view->aprtChngRequests = $this->model->changeOfApartmentRequests();
// render list page
        } else {
// render login page
        }
    }

    public function renewedContractList() {
        Session::init();
        if (Session::get("APTRENTALMGT_LOGGED_IN") == true) {
            // $this->view->fullName = $this->model->get_fullName();
            $this->view->renewedContracts = $this->model->renewedContracts();
// render list page
        } else {
// render login page
        }
    }

    public function terminatedContractList() {
        Session::init();
        if (Session::get("APTRENTALMGT_LOGGED_IN") == true) {
            // $this->view->fullName = $this->model->get_fullName();
            $this->view->terminatedContracts = $this->model->terminatedContracts();
// render list page
        } else {
// render login page
        }
    }

}
