<?php

class Tenant_Model extends Model
{

    public function __construct()
    {
        parent::__construct();
        global $DATABASE;
        $DATABASE = $this->db;
    }

    public function loggedInUser()
    {
        @session_start();
        $userid = $_SESSION['id'];
        return $userid;
    }

    public function getEnddate()
    {
        $userid = $this->loggedInUser();
        $query_lease = $this->db->select("select * from lease");
        $enddate = $query_lease[0]['endDate'];
        return $enddate;
    }

    public function loadApartments()
    {
        $userid = $this->loggedInUser();

        global $DATABASE;
        $query = $DATABASE->select("select * from lease where tenant_id =" . $userid);
        $building = $query[0]['building_id'];

        $secquery = $DATABASE->select("select * from apartment where building_id = " . $building);
        return $secquery;
    }

    public function getLeaseId()
    {
        $userid = $this->loggedInUser();
        $getLeaseId = $this->db->select("select * from lease where tenant_id = " . $userid);
        $result = $getLeaseId[0]["id"];
        return $result;
    }

    public function loggedInUserApartment()
    {
        $loggedInUser_id = $this->loggedInUser();
        $querytbl = $this->db->select("select * from lease where tenant_id =" . $loggedInUser_id);
        $apartment_id = $querytbl[0]['apartment_id'];
        return $apartment_id;
    }

    // Create Method
    public function sendMaintenanceRequest()
    {
        $tenant_id = $this->loggedInUser();
        $apartment_id = $this->loggedInUserApartment();

        $sent_date = date("Y:m:d");

        $maintenanceData = array(
            'tenant_id' => $tenant_id,
            'apartment_id' => $apartment_id,
            'category_id' => $_POST['category_id'],
            'request' => $_POST['request'],
            'sent_date' => $sent_date,
        );
        $this->db->insert('maintenance', $maintenanceData);
//        print_r($maintenanceData);
    }

    public function changeApartment()
    {
        $tenant_id = $this->loggedInUser();
        $apartment_id = $this->loggedInUserApartment();
        $lease_id = $this->getLeaseId();

        $changeApartmentData = array(
            'lease_id' => $lease_id,
            'tenant_id' => $tenant_id,
            'leavingAprtmentid' => $apartment_id,
            'newApartment' => $_POST['newApartment'],
            'changeDate' => $_POST['changeDate'],
            'status' => 0,
        );

        // $update_lease_tbl = "update lease set apartment_id = " .$_POST['newApartment']. "where tenant_id = '$tenant_id'";
        // echo $update_lease_tbl;

        // $this->db->startTransaction();
        $this->db->insert('apartmentChange', $changeApartmentData);
        // $this->db->select($update_lease_tbl);
        // $this->db->commitTransaction();
    }

    public function renewContract()
    {
        $tenant_id = $this->loggedInUser();
        $apartment_id = $this->loggedInUserApartment();

        $endDate = $this->getEnddate();
//        $add = $endDate + 1;
        //        $endDate = '2013-03-06';
        $date = DateTime::createFromFormat('Y-m-d', $endDate);

        $date->modify('+1 day');
        $renewalDate = $date->format('Y-m-d');

        $renewalData = array(
            'tenant_id' => $tenant_id,
            'apartmentid' => $apartment_id,
            'renewalDate' => $renewalDate,
            'renewalPeriod' => $_POST['renewalPeriod'],
        );
        $this->db->insert('renewal', $renewalData);
//        echo $renewalDate;
        //        print_r($renewalData);
    }

    public function handleTermination()
    {
        global $DATABASE;
        $tenant_id = $this->loggedInUser();

        $update_lease_tbl = "update lease set status = 1 where tenant_id = '$tenant_id'";        

        $terminationData = array(
            'tenant_id' => $tenant_id,
            'leavingDate' => $_POST['leavingDate'],
            'leavingReason' => $_POST['leavingReason'],
            'status' => 1,
        );

        $this->db->startTransaction();        
        $DATABASE->insert("termination", $terminationData);
        $this->db->select($update_lease_tbl);
        $this->db->commitTransaction();
    }

    // Read Method

    public function changeOfApartmentRequests()
    {
        $tenant_id = $this->loggedInUser();
        return $this->db->select("select * from apartmentChange where tenant_id =" . $tenant_id . "order by desc limit 1");
    }

    public function requestCategories()
    {
        return $this->db->select("select * from requestcategory");
    }

    public function mntCats()
    {
        return $this->db->select("select * from maintenance_category");
    }

}
