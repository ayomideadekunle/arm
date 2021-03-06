<?php

class Landlord extends Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->view->js = array("admin/lease/script.js");
  }

  // Dashboard Page

  public function index()
  {
    Session::init();
    if (isset($_SESSION["APTRENTALMGT_LOGGED_IN"]) && Session::get("role") == "admin") {
      // display dashboard
      $this->view->title = "Dashboard";
      $this->view->render('navigation/header');
      // $this->view->render('admin/lease/index');
      $this->view->render('navigation/footer');
    } else if(Session::get("APTRENTALMGT_LOGGED_IN") == true && Session::get("role") == "tenant"){
      // display login page
      $this->view->render("unathourized");
    } else {
      $this->view->render("admin");
    }
  }

  //test
  function notifyUser($id){
    $this->model->notifyOfRenewal($id);
  }

  public function fetchApartments($id)
  {
    // if (isset($_GET['id'])) {
    $this->model->fetchApartments($id);
    // }
  }

  public function tenantExists($id)
  {
    $this->model->tenant_exists($id);
  }

  public function checkEmailExists($email)
  {
    $this->model->email_exists($email);
  }

  // Create Method Controller

  public function handleCreateBuilding()
  {
    $this->model->addBuilding();
  }

  public function handleCreateApartment()
  {
    $this->model->addApartment();
  }

  public function handleCreateTenant()
  {
    $this->model->addTenant();
  }

  public function handleLeaseContract()
  {
    $this->model->leaseContract();
  }

  public function handleCreateMntCat()
  {
    $this->model->addMaintenanceCat();
  }

  public function handleSecurityRefund()
  {
    $this->model->securityRefund();
  }

  // Edit Form Pages

  public function buildingEditPage($id)
  {
    Session::init();
    if (isset($_SESSION["APTRENTALMGT_LOGGED_IN"])) {
      $this->view->buildingData = $this->model->fndBuildingById($id);
      // render edit page
      $this->view->title = "Edit Building";
      $this->view->render('admin/building/edit');
    } else if(Session::get("APTRENTALMGT_LOGGED_IN") == true && Session::get("role") == "tenant"){
      // display login page
      $this->view->render("unathourized");
    } else {
      // render login page
      $this->view->render("admin");
    }
  }

  public function apartmentEditPage($id)
  {
    Session::init();
    if (isset($_SESSION["APTRENTALMGT_LOGGED_IN"])) {
      $this->view->buildings = $this->model->buildings();
      $this->view->apartmentData = $this->model->fndApartmentById($id);
      // render edit page
      $this->view->title = "Edit Apartment";
      $this->view->render('admin/apartment/edit');
    } else if(Session::get("APTRENTALMGT_LOGGED_IN") == true && Session::get("role") == "tenant"){
      // display login page
      $this->view->render("unathourized");
    } else {
      // render login page
      $this->view->render("admin");
    }
  }

  public function tenantEditPage($apartment_id)
  {
    Session::init();
    if (isset($_SESSION["APTRENTALMGT_LOGGED_IN"])) {
      $this->view->tenantData = $this->model->fndTenantById($apartment_id);
      // render edit page
      $this->view->title = "Edit Tenant";
      $this->view->render('admin/tenant/edit');
    } else if(Session::get("APTRENTALMGT_LOGGED_IN") == true && Session::get("role") == "tenant"){
      // display login page
      $this->view->render("unathourized");
    } else {
      // render login page
      $this->view->render("admin");
    }
  }

  public function leaseContractEditPage($id)
  {
    Session::init();
    if (isset($_SESSION["APTRENTALMGT_LOGGED_IN"])) {
      $this->view->tenants = $this->model->tenants();
      $this->view->buildings = $this->model->buildings();
      $this->view->apartments = $this->model->apartments();
      $this->view->leaseData = $this->model->fndLeaseContractById($id);
      // render edit page
      $this->view->title = "Edit Lease Contract";
      $this->view->render('admin/lease/edit');
    } else if(Session::get("APTRENTALMGT_LOGGED_IN") == true && Session::get("role") == "tenant"){
      // display login page
      $this->view->render("unathourized");
    } else {
      // render login page
      $this->view->render("admin");
    }
  }

  public function maintenanceCatEditPage($id)
  {
    Session::init();
    if (isset($_SESSION["APTRENTALMGT_LOGGED_IN"])) {
      $this->view->mntcCatData = $this->model->fndMaintenanceCatById($id);
      // render edit page
      $this->view->title = "Edit Maintenance Category";
      $this->view->render('admin/maintenance-category/edit');
    } else if(Session::get("APTRENTALMGT_LOGGED_IN") == true && Session::get("role") == "tenant"){
      // display login page
      $this->view->render("unathourized");
    } else {
      // render login page
      $this->view->render("admin");
    }
  }

  public function securityRefundEditPage($id)
  {
    Session::init();
    if (isset($_SESSION["APTRENTALMGT_LOGGED_IN"])) {
      $this->view->secRefundData = $this->model->fndSecurityRefundById($id);
      // render edit page
      $this->view->title = "Edit Security Refund";
      $this->view->render("admin/security-refund/edit");
    } else if(Session::get("APTRENTALMGT_LOGGED_IN") == true && Session::get("role") == "tenant"){
      // display login page
      $this->view->render("unathourized");
    } else {
      // render login page
      $this->view->render("admin");
    }
  }

  // Update Method Controller

  public function editMaintenanceCat($id)
  {
    $this->model->updateMaintCat($id);
  }

  public function editSecurityRefund($id)
  {
    $this->model->updateSecRfnd($id);
  }

  public function editBuiding($id)
  {
    $this->model->updateBuilding($id);
  }

  public function editApartment($id)
  {
    $this->model->updateApartment($id);
  }

  public function editTenant($id)
  {
    $this->model->updateTenant($id);
  }

  public function editLeaseContract($id)
  {
    $this->model->updateLeaseContract($id);
  }

  // List Pages

  public function maintenancerequests()
  {
    Session::init();
    if (isset($_SESSION["APTRENTALMGT_LOGGED_IN"])) {
      $this->view->mntncReqs = $this->model->maintenanceReqs();
      // render list page
      $this->view->title = "Maintenance Requests";
      $this->view->render("navigation/header");
      $this->view->render("admin/requests/index");
      $this->view->render("navigation/footer");
    } else if(Session::get("APTRENTALMGT_LOGGED_IN") == true && Session::get("role") == "tenant"){
      // display login page
      $this->view->render("unathourized");
    } else {
      // render login page
      $this->view->render("admin");
    }
  }

  public function apartment_change_requests()
  {
    Session::init();
    if (isset($_SESSION["APTRENTALMGT_LOGGED_IN"])) {
      $this->view->aprtChngReqs = $this->model->changeOfApartmentReqs();
      // render list page
      $this->view->title = "Change of Apartment Requests";
      $this->view->render("navigation/header");
      $this->view->render("admin/apartment-change/index");
      $this->view->render("navigation/footer");
    } else if(Session::get("APTRENTALMGT_LOGGED_IN") == true && Session::get("role") == "tenant"){
      // display login page
      $this->view->render("unathourized");
    } else {
      // render login page
      $this->view->render("admin");
    }
  }

  public function renewedContracts()
  {
    Session::init();
    if (isset($_SESSION["APTRENTALMGT_LOGGED_IN"])) {
      $this->view->renewdContracts = $this->model->rnwdContracts();
      // render list page
    } else if(Session::get("APTRENTALMGT_LOGGED_IN") == true && Session::get("role") == "tenant"){
      // display login page
      $this->view->render("unathourized");
    } else {
      // render login page
      $this->view->render("admin");
    }
  }

  public function terminatedContracts()
  {
    Session::init();
    if (isset($_SESSION["APTRENTALMGT_LOGGED_IN"])) {
      $this->view->terminatedContracts = $this->model->terminatedCntracts();
      // render list page
      $this->view->title = "Terminated Contracts";
      $this->view->render("navigation/header");
      $this->view->render("admin/terminated/index");
      $this->view->render("navigation/footer");
    } else if(Session::get("APTRENTALMGT_LOGGED_IN") == true && Session::get("role") == "tenant"){
      // display login page
      $this->view->render("unathourized");
    } else {
      // render login page
      $this->view->render("admin");
    }
  }

  public function securityRefunds()
  {
    Session::init();
    if (isset($_SESSION["APTRENTALMGT_LOGGED_IN"])) {
      $this->view->refunds = $this->model->securityRefunds();
      // render list page
      $this->view->title = "Security Refunds";
      $this->view->render("navigation/header");
      $this->view->render("admin/security-refund/index");
      $this->view->render("navigation/footer");
    } else if(Session::get("APTRENTALMGT_LOGGED_IN") == true && Session::get("role") == "tenant"){
      // display login page
      $this->view->render("unathourized");
    } else {
      // render login page
      $this->view->render("admin");
    }
  }

  public function maintenanceCategories()
  {
    Session::init();
    if (isset($_SESSION["APTRENTALMGT_LOGGED_IN"])) {
      $this->view->maintenanceCats = $this->model->maintenanceCats();
      // render list page
      $this->view->title = "Maintenance Categories";
      $this->view->render("navigation/header");
      $this->view->render("admin/maintenance-category/index");
      $this->view->render("navigation/footer");
    } else if(Session::get("APTRENTALMGT_LOGGED_IN") == true && Session::get("role") == "tenant"){
      // display login page
      $this->view->render("unathourized");
    } else {
      // render login page
      $this->view->render("admin");
    }
  }

  public function buildings()
  {
    Session::init();
    if (isset($_SESSION["APTRENTALMGT_LOGGED_IN"])) {
      $this->view->buildings = $this->model->buildings();
      // render list page
      $this->view->title = "Buildings";
      $this->view->render("navigation/header");
      $this->view->render("admin/building/index");
      $this->view->render("navigation/footer");
    } else if(Session::get("APTRENTALMGT_LOGGED_IN") == true && Session::get("role") == "tenant"){
      // display login page
      $this->view->render("unathourized");
    } else {
      // render login page
      $this->view->render("admin");
    }
  }

  public function apartments()
  {
    Session::init();
    if (isset($_SESSION["APTRENTALMGT_LOGGED_IN"])) {
      $this->view->apartments = $this->model->apartments();
      $this->view->buildings = $this->model->buildings();
      // render list page
      $this->view->title = "Apartments";
      $this->view->render('navigation/header');
      $this->view->render('admin/apartment/index');
      $this->view->render('navigation/footer');
    } else if(Session::get("APTRENTALMGT_LOGGED_IN") == true && Session::get("role") == "tenant"){
      // display login page
      $this->view->render("unathourized");
    } else {
      // render login page
      $this->view->render("admin");
    }
  }

  public function leaseContracts()
  {
    Session::init();
    if (isset($_SESSION["APTRENTALMGT_LOGGED_IN"])) {
      $this->view->tenants = $this->model->tenants();
      $this->view->apartments = $this->model->apartments();
      $this->view->buildings = $this->model->buildings();
      $this->view->leaseContracts = $this->model->leaseContracts();
      // render list page
      $this->view->title = "Lease Contracts";
      $this->view->render('navigation/header');
      $this->view->render('admin/lease/index');
      $this->view->render('navigation/footer');
    } else if(Session::get("APTRENTALMGT_LOGGED_IN") == true && Session::get("role") == "tenant"){
      // display login page
      $this->view->render("unathourized");
    } else {
      // render login page
      $this->view->render("admin");
    }
  }

  public function tenants()
  {
    Session::init();
    if (isset($_SESSION["APTRENTALMGT_LOGGED_IN"])) {
      $this->view->tenants = $this->model->tenants();
      // render list page
      $this->view->title = "Tenants";
      $this->view->render('navigation/header');
      $this->view->render('admin/tenant/index');
      $this->view->render('navigation/footer');
    } else if(Session::get("APTRENTALMGT_LOGGED_IN") == true && Session::get("role") == "tenant"){
      // display login page
      $this->view->render("unathourized");
    } else {
      // render login page
      $this->view->render("admin");
    }
  }

  public function sendMessage()
  {
    Session::init();
    if (isset($_SESSION['APTRENTALMGT_LOGGED_IN'])) {
      $this->view->tenants = $this->model->tenants();

      $this->view->title = "Send Message";
      $this->view->render("navigation/header");
      $this->view->render("admin/message/index");
      $this->view->render("navigation/footer");
    } else if(Session::get("APTRENTALMGT_LOGGED_IN") == true && Session::get("role") == "tenant"){
      // display login page
      $this->view->render("unathourized");
    } else {
      $this->view->render("admin");
    }
  }

  public function grant($id)
  {
    $this->model->grantRequest($id);
    // echo "Inside";
  }

  public function reject($id)
  {
    $this->model->rejectRequest($id);
  }

  public function notify()
  {
    $this->model->sendNotification();
  }

  // Delete Controller

  public function deleteapartment($id)
  {
    $this->model->delApartmentById($id);
  }

  public function deletetenant($id)
  {
    $this->model->delTenantById($id);
  }

  public function deleteLease($id)
  {
    $this->model->delLeaseContractById($id);
  }

  public function deleteRefund($id)
  {
    $this->model->delSecurityRefundById($id);
  }

  public function deleteMntCat($id)
  {
    $this->model->delMaintenanceCatById($id);
  }

  public function deleteBuilding($id)
  {
    $this->model->softDeleteBuilding($id);
  }

  public function deleteRequest($id)
  {
    $this->model->delMaintenanceRequestById($id);
  }

  public function deleteContract($id)
  {
    $this->model->delTerminatedContractById($id);
  }
}
