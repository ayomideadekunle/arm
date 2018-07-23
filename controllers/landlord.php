<?php

class Landlord extends Controller {

    function __construct() {
        parent::__construct();
        $this->loadmodel("index");
        $this->view->js = array("admin/lease/script.js");
    }

    // Dashboard Page

    public function index() {
        Session::init();
        if (isset($_SESSION["APTRENTALMGT_LOGGED_IN"])) {
            $this->view->tenants = $this->model->tenants();
            $this->view->buildings = $this->model->buildings();
            $this->view->apartments = $this->model->apartments();
            $this->view->leaseContracts = $this->model->leaseContracts();
// display dashboard
            $this->view->render('navigation/header');
            $this->view->render('admin/lease/index');
            $this->view->render('navigation/footer');
        } else {
// display login page
        }
    }

    public function fetchApartments($id) {
        // if (isset($_GET['id'])) {
        $this->model->fetchApartments($id);
        // }
    }

    public function tenantExists($id) {
        $this->model->tenant_exists($id);
    }

    public function checkEmailExists($email) {
        $this->model->email_exists($email);
    }

    public function passwordExists($password) {
        $this->model->checkPassword($password);
    }

    public function change_pwd() {
        $changePwdModel = $this->model->chngPassword();
        if ($changePwdModel == true) {
//            $success_msg = "Password changed successfully";
            echo "Password changed successfully";
        } else {
//            $error_msg = "Incorrect password";
            echo "Incorrect password";
//            header("http://arm/landlord/tenantProfile");
        }
    }

    // Create Method Controller

    public function handleCreateBuilding() {
        $this->model->addBuilding();
    }

    public function handleCreateApartment() {
        $this->model->addApartment();
    }

    public function handleCreateTenant() {
        $this->model->addTenant();
    }

    public function handleLeaseContract() {
        $this->model->leaseContract();
    }

    public function handleCreateMntCat() {
        $this->model->addMaintenanceCat();
    }

    public function handleSecurityRefund() {
        $this->model->securityRefund();
    }

    // Edit Form Pages

    public function buildingEditPage($id) {
        Session::init();
        if (isset($_SESSION["APTRENTALMGT_LOGGED_IN"])) {
            $this->view->buildingData = $this->model->fndBuildingById($id);
// render edit page
            $this->view->render('admin/building/edit');
        } else {
// render login page
        }
    }

    public function apartmentEditPage($id) {
        Session::init();
        if (isset($_SESSION["APTRENTALMGT_LOGGED_IN"])) {
            $this->view->buildings = $this->model->buildings();
            $this->view->apartmentData = $this->model->fndApartmentById($id);
// render edit page
//            $this->view->render('navigation/header');
            $this->view->render('admin/apartment/edit');
//            $this->view->render('navigation/footer');
        } else {
// render login page
        }
    }

    public function tenantEditPage($apartment_id) {
        Session::init();
        if (isset($_SESSION["APTRENTALMGT_LOGGED_IN"])) {
            $this->view->tenantData = $this->model->fndTenantById($apartment_id);
// render edit page
//            $this->view->render('navigation/header');
            $this->view->render('admin/tenant/edit');
//            $this->view->render('navigation/footer');
        } else {
// render login page
        }
    }

    public function leaseContractEditPage($id) {
        Session::init();
        if (isset($_SESSION["APTRENTALMGT_LOGGED_IN"])) {
            $this->view->tenants = $this->model->tenants();
            $this->view->buildings = $this->model->buildings();
            $this->view->apartments = $this->model->apartments();
            $this->view->leaseData = $this->model->fndLeaseContractById($id);
// render edit page
            $this->view->render('admin/lease/edit');
        } else {
// render login page
        }
    }

    public function maintenanceCatEditPage($id) {
        Session::init();
        if (isset($_SESSION["APTRENTALMGT_LOGGED_IN"])) {
            $this->view->mntcCatData = $this->model->fndMaintenanceCatById($id);
// render edit page
            $this->view->render('admin/maintenance-category/edit');
        } else {
// render login page
        }
    }

    public function securityRefundEditPage($id) {
        Session::init();
        if (isset($_SESSION["APTRENTALMGT_LOGGED_IN"])) {
            $this->view->secRefundData = $this->model->fndSecurityRefundById($id);
// render edit page
            $this->view->render("admin/security-refund/edit");
        } else {
// render login page
        }
    }

    // Update Method Controller

    public function editMaintenanceCat($id) {
        $this->model->updateMaintCat($id);
    }

    public function editSecurityRefund($id) {
        $this->model->updateSecRfnd($id);
    }

    public function editBuiding($id) {
        $this->model->updateBuilding($id);
    }

    public function editApartment($id) {
        $this->model->updateApartment($id);
    }

    public function editTenant($id) {
        $this->model->updateTenant($id);
    }

    public function editLeaseContract($id) {
        $this->model->updateLeaseContract($id);
    }

    // List Pages

    public function maintenancerequests() {
        Session::init();
        if (isset($_SESSION["APTRENTALMGT_LOGGED_IN"])) {
            $this->view->mntncReqs = $this->model->maintenanceReqs();
// render list page
            $this->view->render("navigation/header");
            $this->view->render("admin/requests/index");
            $this->view->render("navigation/footer");
        } else {
// render login page
        }
    }

    public function apartment_change_requests() {
        Session::init();
        if (isset($_SESSION["APTRENTALMGT_LOGGED_IN"])) {
            $this->view->aprtChngReqs = $this->model->changeOfApartmentReqs();
// render list page
            $this->view->render("navigation/header");
            $this->view->render("admin/apartment-change/index");
            $this->view->render("navigation/footer");
        } else {
// render login page
        }
    }

    public function renewedContracts() {
        Session::init();
        if (isset($_SESSION["APTRENTALMGT_LOGGED_IN"])) {
            $this->view->renewdContracts = $this->model->rnwdContracts();
// render list page
        } else {
// render login page
        }
    }

    public function terminatedContracts() {
        Session::init();
        if (isset($_SESSION["APTRENTALMGT_LOGGED_IN"])) {
            $this->view->terminatedContracts = $this->model->terminatedCntracts();
// render list page
        } else {
// render login page
        }
    }

    public function securityRefunds() {
        Session::init();
        if (isset($_SESSION["APTRENTALMGT_LOGGED_IN"])) {
            $this->view->refunds = $this->model->securityRefunds();
// render list page
            $this->view->render("navigation/header");
            $this->view->render("admin/security-refund/index");
            $this->view->render("navigation/footer");
        } else {
// render login page
        }
    }

    public function maintenanceCategories() {
        Session::init();
        if (isset($_SESSION["APTRENTALMGT_LOGGED_IN"])) {
            $this->view->maintenanceCats = $this->model->maintenanceCats();
// render list page
            $this->view->render("navigation/header");
            $this->view->render("admin/maintenance-category/index");
            $this->view->render("navigation/footer");
        } else {
// render login page
        }
    }

    public function buildings() {
        Session::init();
        if (isset($_SESSION["APTRENTALMGT_LOGGED_IN"])) {
            $this->view->buildings = $this->model->buildings();
// render list page
            $this->view->render("navigation/header");
            $this->view->render("admin/building/index");
            $this->view->render("navigation/footer");
        } else {
// render login page
        }
    }

    public function apartments() {
        Session::init();
        if (isset($_SESSION["APTRENTALMGT_LOGGED_IN"])) {
            $this->view->apartments = $this->model->apartments();
            $this->view->buildings = $this->model->buildings();
// render list page
            $this->view->render('navigation/header');
            $this->view->render('admin/apartment/index');
            $this->view->render('navigation/footer');
        } else {
// render login page
        }
    }

    public function leaseContracts() {
        Session::init();
        if (isset($_SESSION["APTRENTALMGT_LOGGED_IN"])) {
            $this->view->tenants = $this->model->tenants();
            $this->view->apartments = $this->model->apartments();
            $this->view->buildings = $this->model->buildings();
            $this->view->leaseContracts = $this->model->leaseContracts();
// render list page
            $this->view->render('navigation/header');
            $this->view->render('admin/lease/index');
            $this->view->render('navigation/footer');
        } else {
// render login page
        }
    }

    public function tenants() {
        Session::init();
        if (isset($_SESSION["APTRENTALMGT_LOGGED_IN"])) {
            $this->view->tenants = $this->model->tenants();
// render list page
            $this->view->render('navigation/header');
            $this->view->render('admin/tenant/index');
            $this->view->render('navigation/footer');
        } else {
// render login page
        }
    }

    public function tenantProfile() {
        Session::init();
        if (isset($_SESSION["APTRENTALMGT_LOGGED_IN"])) {
            $this->view->tenant_info = $this->model->tenantProfile();
// render list page
            $this->view->render('navigation/header');
            $this->view->render('tenant/profile/index');
            $this->view->render('navigation/footer');
        } else {
// render login page
        }
    }

    public function grant($id){
        $this->model->grantRequest($id);
        // echo "Inside";
    }

    public function reject($id){
        $this->model->rejectRequest($id);
    }

    // Delete Controller

    public function deleteapartment($id) {
        $this->model->delApartmentById($id);
    }

    public function deletetenant($id) {
        $this->model->delTenantById($id);
    }

    public function deleteLease($id) {
        $this->model->delLeaseContractById($id);
    }

    public function deleteRefund($id) {
        $this->model->delSecurityRefundById($id);
    }

    public function deleteMntCat($id) {
        $this->model->delMaintenanceCatById($id);
    }

    public function deleteBuilding($id) {
        $this->model->softDeleteBuilding($id);
    }

    public function deleteRequest($id){
        $this->model->delMaintenanceRequestById($id);
    }
}
