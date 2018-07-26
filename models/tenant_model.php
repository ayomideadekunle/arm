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

    public function get_time_difference_php($created_time)
    {
        date_default_timezone_set('West Africa'); //Change as per your default time
        $str = strtotime($created_time);
        $today = strtotime(date('Y-m-d H:i:s'));

        // It returns the time difference in Seconds...
        $time_differnce = $today - $str;

        // To Calculate the time difference in Years...
        $years = 60 * 60 * 24 * 365;

        // To Calculate the time difference in Months...
        $months = 60 * 60 * 24 * 30;

        // To Calculate the time difference in Days...
        $days = 60 * 60 * 24;

        // To Calculate the time difference in Hours...
        $hours = 60 * 60;

        // To Calculate the time difference in Minutes...
        $minutes = 60;

        if (intval($time_differnce / $years) > 1) {
            return intval($time_differnce / $years) . " years ago";
        } else if (intval($time_differnce / $years) > 0) {
            return intval($time_differnce / $years) . " year ago";
        } else if (intval($time_differnce / $months) > 1) {
            return intval($time_differnce / $months) . " months ago";
        } else if (intval(($time_differnce / $months)) > 0) {
            return intval(($time_differnce / $months)) . " month ago";
        } else if (intval(($time_differnce / $days)) > 1) {
            return intval(($time_differnce / $days)) . " days ago";
        } else if (intval(($time_differnce / $days)) > 0) {
            return intval(($time_differnce / $days)) . " day ago";
        } else if (intval(($time_differnce / $hours)) > 1) {
            return intval(($time_differnce / $hours)) . " hours ago";
        } else if (intval(($time_differnce / $hours)) > 0) {
            return intval(($time_differnce / $hours)) . " hour ago";
        } else if (intval(($time_differnce / $minutes)) > 1) {
            return intval(($time_differnce / $minutes)) . " minutes ago";
        } else if (intval(($time_differnce / $minutes)) > 0) {
            return intval(($time_differnce / $minutes)) . " minute ago";
        } else if (intval(($time_differnce)) > 1) {
            return intval(($time_differnce)) . " seconds ago";
        } else {
            return "few seconds ago";
        }
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

    public function checkApartment($apartment_id)
    {
        global $DATABASE;
        $loggedInUser_id = $this->loggedInUser();
        $result = $DATABASE->select("select * from lease where apartment_id = " . $apartment_id . " and tenant_id = " . $loggedInUser_id);
        echo json_encode($result);
    }

    public function viewNotifications()
    {
        global $DATABASE;
        $userid = $this->loggedInUser();
        $q = $DATABASE->select("select * from notification where user = " . $userid);
        return $q;
    }

    public function refreshInbox()
    {
        global $DATABASE;
        $userid = $this->loggedInUser();
        $q = $DATABASE->select("select * from notification where user = " . $userid);
        echo json_encode($q);
    }

    public function loadMessageByid($id)
    {
        global $DATABASE;
        $q = $DATABASE->select("select * from notification where id = " . $id);
        echo json_encode($q);
        // print_r($q);
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
            // 'status' => 1,
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
