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
      $this->view->render('navigation/header');
      // $this->view->render('tenant/request/create');
      $this->view->render('navigation/footer');
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
      $this->view->categories = $this->model->mntCats();
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

  // public function loadMessage($message_id)
  // {
  //     $this->model->loadMessageByid($message_id);
  // }

  public function refresh()
  {
    $this->model->refreshInbox();
  }

  public function tenantProfile()
  {
    Session::init();
    if (isset($_SESSION["APTRENTALMGT_LOGGED_IN"])) {
      $this->view->tenant_info = $this->model->tenantProfile();
      $this->view->lease_info = $this->model->tenantContract();
      // render list page
      $this->view->title = "Profile";
      $this->view->render('navigation/header');
      $this->view->render('tenant/profile/index');
      $this->view->render('navigation/footer');
    } else {
      // render login page
      $this->view->render("admin");
    }
  }

  public function passwordExists($password)
  {
    $cmpare = $this->model->checkPassword($password);
    if($cmpare == true){
      echo "Correct";
    } else {
      echo "Incorrect";
    }
  }

  public function change_pwd()
  {
    $this->model->chngPassword();
  }

  public function checkEmail($email){
    // $email = $_GET["email"];
    $this->model->checkEmailex($email);
  }

  public function deleteMsg($id)
  {
    $this->model->deleteMessage($id);
  }

  public function renew(){
    $this->model->renewContract();
  }

}
