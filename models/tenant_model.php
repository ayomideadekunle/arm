<?php

class Tenant_Model extends Model {

    function __construct() {
        parent::__construct();
        global $DATABASE;
        $DATABASE = $this->db;
    }

    function loggedInUser() {
        @session_start();
        $userid = $_SESSION['id'];
        return $userid;
    }
    
    function getEnddate(){
        $userid = $this->loggedInUser();
        $query_lease = $this->db->select("select * from lease");
        $enddate = $query_lease[0]['endDate'];
        return $enddate;
    }

    public function loggedInUserApartment() {
        $loggedInUser_id = $this->loggedInUser();
        $querytbl = $this->db->select("select * from lease where tenant_id =" . $loggedInUser_id);
        $apartment_id = $querytbl[0]['apartment_id'];
        return $apartment_id;
    }

    // Create Method
    public function sendMaintenanceRequest() {
        $tenant_id = $this->loggedInUser();
        $apartment_id = $this->loggedInUserApartment();

        $sent_date = date("Y:m:d");

        $maintenanceData = array(
            'tenant_id' => $tenant_id,
            'apartment_id' => $apartment_id,
            'category_id' => $_POST['category_id'],
            'request' => $_POST['request'],
            'sent_date' => $sent_date
        );
        $this->db->insert('maintenance', $maintenanceData);
//        print_r($maintenanceData);
    }

    public function changeApartment() {
        $tenant_id = $this->loggedInUser();
        $apartment_id = $this->loggedInUserApartment();

        $changeApartmentData = array(
            'tenant_id' => $tenant_id,
            'leavingAprtmentid' => $apartment_id,
            'newApartment' => $_POST['newApartment']
        );
        $this->db->insert('apartmentChange', $changeApartmentData);
    }

    public function renewContract() {
        $tenant_id = $this->loggedInUser();
        $apartment_id = $this->loggedInUserApartment();
        
        $endDate = $this->getEnddate();
        $add = $endDate + 1;

        $renewalData = array(
            'tenant_id' => $tenant_id,
            'apartmentid' => $apartment_id,
            'renewalDate' => $_POST['renewalDate'],
            'renewalPeriod' => $_POST['renewalPeriod']
        );
        $this->db->insert('renewal', $renewalData);
    }

    public function termination() {
        $tenant_id = $this->loggedInUser();
        $apartment_id = $this->loggedInUserApartment();

        $terminationData = array(
            'tenant_id' => $tenant_id,
            'apartment_id' => $apartment_id,
            'leavingDate' => $_POST['leavingDate'],
            'leavingReason' => $_POST['leavingReason']
        );
        $this->db->insert('termination', $terminationData);
    }

    // Update Method

    public function updateChangeApartment($id) {
        $tenant_id = $this->loggedInUser();
        $apartment_id = $this->loggedInUserApartment();

        $changeApartmentData = array(
            'tenant_id' => $tenant_id,
            'leavingApartmentid' => $apartment_id,
            'newApartment' => $_POST['newApartment']
        );
        $this->db->update('apartmentChange', $changeApartmentData, 'id=' . $id);
    }

    public function updateRenewContract($id) {
        $tenant_id = $this->loggedInUser();
        $apartment_id = $this->loggedInUserApartment();

        $renewalData = array(
            'tenant_id' => $tenant_id,
            'apartmentid' => $apartment_id,
            'renewalDate' => $_POST['renewalDate'],
            'renewalPeriod' => $_POST['renewalPeriod']
        );
        $this->db->update('renewal', $renewalData, "id=" . $id);
    }

    public function updateTermination($id) {
        $tenant_id = $this->loggedInUser();
        $apartment_id = $this->loggedInUserApartment();

        $terminationData = array(
            'tenant_id' => $tenant_id,
            'apartment_id' => $apartment_id,
            'leavingDate' => $_POST['leavingDate'],
            'leavingReason' => $_POST['leavingReason']
        );
        $this->db->update('termination', $terminationData, "id=" . $id);
    }

    public function updateSendMaintenanceRequest($id) {
        $tenant_id = $this->loggedInUser();
        $apartment_id = $this->loggedInUserApartment();
        $sent_date = date("Y:m:d");

        $maintenanceData = array(
            'tenant_id' => $tenant_id,
            'apartment_id' => $apartment_id,
            'category_id' => $_POST['category_id'],
            'request' => $_POST['request'],
            'sent_date' => $sent_date
        );
        $this->db->update('maintenance', $maintenanceData, "id=" . $id);
    }

    // Read Method

    public function maintenanceRequests() {
        $tenant_id = $this->loggedInUser();
        return $this->db->select("select * from maintenance where tenant_id =" . $tenant_id);
    }

    public function changeOfApartmentRequests() {
        $tenant_id = $this->loggedInUser();
        return $this->db->select("select * from apartmentChange where tenant_id =" . $tenant_id . "order by desc limit 1");
    }

    public function renewedContracts() {
        $tenant_id = $this->loggedInUser();
        return $this->db->select("select * from renewal where tenant_id =" . $tenant_id . "order by desc limit 1");
    }

    public function terminatedContracts() {
        $tenant_id = $this->loggedInUser();
        return $this->db->select("select * from termination where tenant_id =" . $tenant_id . "order by desc limit 1");
    }

    public function mntCats() {
        global $DATABASE;
        return $DATABASE->select("select * from maintenance_category");
    }

    // Read One Method

    public function findChangeAptById() {
        $id = $this->loggedInUser();
        return $this->db->select("select * from apartmentChange where id =" . $id);
    }

    public function findRenewedContractById() {
        $id = $this->loggedInUser();
        return $this->db->select("select * from renewal where id =" . $id);
    }

    public function findTerminatedContractById() {
        $id = $this->loggedInUser();
        return $this->db->select("select * from termination where id =" . $id);
    }

    public function findMaintenanceRequestById() {
        $id = $this->loggedInUser();
        return $this->db->select("select * from maintenance where id =" . $id);
    }

    // Delete Method

    public function delMaintenanceRequestById($id) {
        $this->db->delete("maintenance", "id =" . $id);
    }

    public function delRenewedContractById($id) {
        $this->db->delete("renewal", "id =" . $id);
    }

    public function delTerminatedContractById($id) {
        $this->db->delete("termination", "id =" . $id);
    }

    public function delChangeOfApartmentRequestById($id) {
        $this->db->delete("apartmentChange", "id =" . $id);
    }

}
