<?php

class Landlord extends Controller {

    function __construct() {
        parent::__construct();
        $this->loadmodel("index");
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
            $this->view->success_msg = "Password changed successfully";
        } else {
            $this->view->error_msg = "Incorrect password";
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

    public function buildingEditPage() {
        Session::init();
        if (isset($_SESSION["APTRENTALMGT_LOGGED_IN"])) {
            $this->view->buildingData = $this->model->fndBuildingById();
// render edit page
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

    public function editBuiding() {
        $this->model->updateBuilding();
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

    public function maintenanceRequestist() {
        Session::init();
        if (isset($_SESSION["APTRENTALMGT_LOGGED_IN"])) {
            $this->view->mntncReqs = $this->model->maintenanceReqs();
// render list page
        } else {
// render login page
        }
    }

    public function changeApartmentList() {
        Session::init();
        if (isset($_SESSION["APTRENTALMGT_LOGGED_IN"])) {
            $this->view->aprtChngReqs = $this->model->changeOfApartmentReqs();
// render list page
        } else {
// render login page
        }
    }

    public function renewedContractList() {
        Session::init();
        if (isset($_SESSION["APTRENTALMGT_LOGGED_IN"])) {
            $this->view->renewdContracts = $this->model->rnwdContracts();
// render list page
        } else {
// render login page
        }
    }

    public function terminatedContractList() {
        Session::init();
        if (isset($_SESSION["APTRENTALMGT_LOGGED_IN"])) {
            $this->view->terminatedContracts = $this->model->terminatedCntracts();
// render list page
        } else {
// render login page
        }
    }

    public function secRefundList() {
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

    public function maintenanceCatList() {
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

    public function buildingList() {
        Session::init();
        if (isset($_SESSION["APTRENTALMGT_LOGGED_IN"])) {
            $this->view->buildings = $this->model->buildings();
// render list page
        } else {
// render login page
        }
    }

    public function apartmentList() {
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

    public function leaseContractList() {
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

    public function tenantList() {
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

}
