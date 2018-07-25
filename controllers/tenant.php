<?php

class Tenant extends Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    // Dashboard Page

    public function index()
    {
        Session::init();
        if (Session::get("APTRENTALMGT_LOGGED_IN") == true) {
// display dashboard
            $this->view->title = "Home";
        } else {
// display login page
        }
    }

    // Create Method Controller

    public function handleMaintenanceRequest()
    {
        $this->model->sendMaintenanceRequest();
    }

    public function handleChngAptRequest()
    {
        $this->model->changeApartment();
    }

    public function handleContractTermination()
    {
        $this->model->handleTermination();
    }

    // Create Form Pages

    public function request()
    {
        Session::init();
        if (Session::get("APTRENTALMGT_LOGGED_IN") == true) {
            $this->view->requestcats = $this->model->requestCategories();
            $this->view->apartments = $this->model->loadApartments();
// render create page
            $this->view->title = "Send Request";
            $this->view->render('navigation/header');
            $this->view->render('tenant/request/create');
            $this->view->render('navigation/footer');
        } else {
// render login page
        }
    }

    public function notifications()
    {
        Session::init();
        if (Session::get("APTRENTALMGT_LOGGED_IN") == true) {
            $this->view->notifications = $this->model->viewNotifications();
// render edit page
            $this->view->title = "Notifications";
            $this->view->render('navigation/header');
            $this->view->render('tenant/notification/index');
            $this->view->render('navigation/footer');
        } else {
// render login page
        }
    }

    public function checkApartment($apt_id)
    {
        $this->model->checkApartment($apt_id);
    }

    public function loadMessage($message_id)
    {
        $this->model->loadMessageByid($message_id);
        // $this->view->render("navigation/header");
        // $this->view->render("tenant/notification/message");
        // $this->view->render("navigation/footer");
    }

    // Test Page

    public function test()
    {
        Session::init();
        if (Session::get("APTRENTALMGT_LOGGED_IN") == true) {
            // $this->view->chngAptData = $this->model->findChangeAptById();
            $this->view->notifications = $this->model->viewNotifications();
            // render edit page
            $this->view->render('navigation/header');
            $this->view->render('tenant/notification/index');
            $this->view->render('navigation/footer');
        } else {
// render login page
        }
    }

}
