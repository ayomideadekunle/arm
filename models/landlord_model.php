<?php

// require './PHPMailer/PHPMailerAutoload.php';

class Landlord_Model extends Model {

    function __construct() {
        parent::__construct();
        global $DATABASE;
        $DATABASE = $this->db;
    }

// Get current loggedIn userid
    function currentUserid() {
        @session_start();

        $save = $_SESSION['id'];
        return $save;
    }

    // getting details method
    // get building info
    public function buildingInfo($id = '') {
        global $DATABASE;
        $param = array(
            ":buildingid" => $id
        );
        $getinfo_query = $DATABASE->select("SELECT * FROM building WHERE id = :buildingid", $param);
        return $getinfo_query;
    }

    // get tenant info
    public function tenantInfo($id = '') {
        global $DATABASE;
        $param = array(
            ":tenantid" => $id
        );
        $getinfo_query = $DATABASE->select("SELECT * FROM tenant WHERE id = :tenantid", $param);
        return $getinfo_query;
    }

    // get apartment info
    public function apartmentInfo($id = '') {
        global $DATABASE;
        $param = array(
            ":apartmentid" => $id
        );
        $getinfo_query = $DATABASE->select("SELECT * FROM apartment WHERE id = :apartmentid", $param);
        return $getinfo_query;
    }

    public function tenantProfile() {
        global $DATABASE;

        $id = $_SESSION['id'];
        $query = $DATABASE->select("SELECT * FROM tenant WHERE id = " . $id);
        return $query;
    }

    // fetch

    public function fetchApartments($id) {
        global $DATABASE;
        $response = $DATABASE->select("SELECT * FROM apartment WHERE building_id = '$id'");
        // $result = array();
        //  foreach ($response as $value) {
        //      // $result = $value['id'];
        //      // $result = $value['apartmentNumber'];
        //  }
        echo json_encode($response);
        // return $result;
    }

    // check if email exists

    public function email_exists($email) {
        global $DATABASE;

        $result = $DATABASE->select("SELECT * FROM `tenant` WHERE email = '$email'");
        echo json_encode($result);
    }

    public function tenant_exists($tenant_id) {
        global $DATABASE;
        $result = $DATABASE->select("select * from lease where tenant_id =" . $tenant_id);
        echo json_encode($result);
    }

// Create Method

    public function addBuilding() {
        global $DATABASE;
        $buildingData = array(
            'buildingName' => $_POST['buildingName'],
            'address' => $_POST['address'],
            'cityStateZip' => $_POST['cityStateZip'],
        );
        $DATABASE->insert('building', $buildingData);
    }

    public function mail_sending_template() {
        $sender_address = 'mwaliyayomide@gmail.com';
        $sender_name = "Raji Waliyu Adekunle";
        $recipient = "holhusheun@gmail.com";
        $recipient_name = "Omotunde John";
        $subject = 'First PHPMailer Message';
        $body = 'Hi! This is my first e-mail sent through PHPMailer.';

        $sendmail = new PHPMailer;
        $sendmail->setFrom($sender_address, $sender_name);
        $sendmail->addAddress($recipient, $recipient_name);
        $sendmail->Subject = $subject;
        $sendmail->Body = $body;
        if (!$sendmail->send()) {
            echo 'Message was not sent.';
            echo 'Mailer error: ' . $sendmail->ErrorInfo;
        } else {
            echo 'Message has been sent.';
        }
    }

    public function addAdmin() {
        global $DATABASE;
        $adminData = array(
            'username' => $_POST['username'],
            'email' => $_POST['email'],
            'password' => $_POST['password'],
        );
        $DATABASE->insert('admin', $adminData);
    }

    public function addTenant() {
        global $DATABASE;
        $tenantData = array(
            'firstname' => $_POST['firstname'],
            'lastname' => $_POST['lastname'],
            'email' => $_POST['email'],
            'phone' => $_POST['phone'],
            'currentAddress' => $_POST['currentAddress'],
            'cityStateZip' => $_POST['cityStateZip'],
            'password' => md5($_POST['password'])
        );
        $DATABASE->insert("tenant", $tenantData);
    }

    public function addApartment() {
        global $DATABASE;
        $apartmentData = array(
            'building_id' => $_POST['building_id'],
            'size' => $_POST['size'],
            'apartmentNumber' => $_POST['apartmentNumber'],
            'apartmentType' => $_POST['apartmentType'],
            'rentalFee' => $_POST['rentalFee'],
            'status' => 0
        );
        $DATABASE->insert('apartment', $apartmentData);
    }

    public function leaseContract() {
        global $DATABASE;

        $leaseInfo = array(
            'tenant_id' => $_POST['tenant_id'],
            'apartment_id' => $_POST['apartment_id'],
            'startDate' => $_POST['startDate'],
            'endDate' => $_POST['endDate'],
            'balance' => $_POST['balance'],
            'securityDeposit' => $_POST['securityDeposit'],
            'period' => $_POST['period'],
            'rentalDate' => $_POST['rentalDate']
        );

        $query = "UPDATE apartment SET status = 1 WHERE id = " . $_POST['apartment_id'];

        $DATABASE->startTransaction();
        $DATABASE->insert('lease', $leaseInfo);
        $DATABASE->select($query);
        $DATABASE->commitTransaction();
    }

    public function addMaintenanceCat() {
        global $DATABASE;
        $catData = array(
            'categoryName' => $_POST['categoryName']
        );
        $DATABASE->insert('maintenance_category', $catData);
    }

    public function securityRefund() {
        global $DATABASE;
        $secRfdData = array(
            'refundAmount' => $_POST['refundAmount'],
            'refundReason' => $_POST['refundReason'],
            'date' => $_POST['date']
        );
        $DATABASE->insert('securityRefund', $secRfdData);
    }

// Update Method
    public function updateApartment($apartmentid = '') {
        global $DATABASE;

        $apartmentData = array(
            'building_id' => $_POST['building_id'],
            'size' => $_POST['size'],
            'apartmentNumber' => $_POST['apartmentNumber'],
            'apartmentType' => $_POST['apartmentType'],
            'rentalFee' => $_POST['rentalFee'],
            'status' => $_POST['status']
        );
        $DATABASE->update('apartment', $apartmentData, 'id=' . $apartmentid);
    }

    public function updateTenant($tenant_id = '') {
        global $DATABASE;
        $tenantData = array(
            'firstname' => $_POST['firstname'],
            'lastname' => $_POST['lastname'],
            'email' => $_POST['email'],
            'phone' => $_POST['phone'],
            'currentAddress' => $_POST['currentAddress'],
            'cityStateZip' => $_POST['cityStateZip'],
        );
        $DATABASE->update("tenant", $tenantData, 'id=' . $tenant_id);
    }

    public function chngPassword() {
        global $DATABASE;

        $response = false;

        $oldpassword = md5($_POST['oldpassword']);

        $newpassword = array(
            'password' => md5($_POST['password'])
        );
        $userid = $this->currentUserid();
        $checkIfUserExists = $DATABASE->select("SELECT * FROM tenant "
                . "WHERE id = " . $userid);

        if ($checkIfUserExists[0]['password'] == $oldpassword) {
//            echo 'Present';
            $chngPwdQuery = $DATABASE->update('tenant', $newpassword, 'id =' . $userid);
            $response = true;
            return $chngPwdQuery;
        } else {
//            echo 'Incorrect password';
            return $response;
        }
        // echo json_encode($checkIfUserExists);
    }

    public function checkPassword($password) {
        global $DATABASE;

        // $response = true;

        $userid = $this->currentUserid();
        $checkIfPasswordExists = $DATABASE->select("SELECT password FROM tenant WHERE id = " . $userid);
        if ($checkIfPasswordExists[0]['password'] == md5($password)) {
//           return response;
            echo json_encode($checkIfPasswordExists);
        }
        // return false;
    }

    public function updateBuilding() {
        global $DATABASE;

        $buildingData = array(
            'buildingName' => $_POST['buildingName'],
            'address' => $_POST['address'],
            'cityStateZip' => $_POST['cityStateZip'],
        );
        $DATABASE->update('building', $buildingData, 'id=' . $building_id);
    }

    public function updateMaintCat() {
        global $DATABASE;
        $cat_id = $this->currentUserid();

        $catData = array(
            'categoryName' => $_POST['categoryName']
        );
        $DATABASE->update('maintenance_category', $catData, 'id=' . $cat_id);
    }

    public function updateSecRfnd($secRfndId = '') {
        global $DATABASE;

        $secRfdData = array(
            'refundAmount' => $_POST['refundAmount'],
            'refundReason' => $_POST['refundReason'],
            'date' => $_POST['date']
        );
        $DATABASE->update('securityRefund', $secRfdData, 'id=' . $secRfndId);
    }

    public function updateLeaseContract($contract_id = '') {
        global $DATABASE;

        $leaseInfo = array(
            'tenant_id' => $_POST['tenant_id'],
            'apartment_id' => $_POST['apartment_id'],
            'startDate' => $_POST['startDate'],
            'endDate' => $_POST['endDate'],
            'balance' => $_POST['balance'],
            'securityDeposit' => $_POST['securityDeposit'],
            'period' => $_POST['period'],
            'rentalDate' => $_POST['rentalDate']
        );
        $query = "UPDATE apartment SET status = 1 WHERE id = " . $_POST['apartment_id'];

        $DATABASE->startTransaction();
        $DATABASE->update('lease', $leaseInfo, 'id=' . $contract_id);
        $DATABASE->select($query);
        $DATABASE->commitTransaction();
    }

// Read Method

    public function apartments() {
        global $DATABASE;
        return $DATABASE->select("select * from apartment");
    }

    public function maintenanceReqs() {
        global $DATABASE;
        return $DATABASE->select("select * from maintenance");
    }

    public function changeOfApartmentReqs() {
        global $DATABASE;
        return $DATABASE->select("select * from apartmentChange");
    }

    public function rnwdContracts() {
        global $DATABASE;
        return $DATABASE->select("select * from renewal");
    }

    public function buildings() {
        global $DATABASE;
        return $DATABASE->select("select * from building");
    }

    public function tenants() {
        global $DATABASE;
        return $DATABASE->select("select * from tenant");
    }

    public function leaseContracts() {
        global $DATABASE;
        return $DATABASE->select("select * from lease");
    }

    public function terminatedCntracts() {
        global $DATABASE;
        return $DATABASE->select("select * from termination");
    }

    public function securityRefunds() {
        global $DATABASE;
        return $DATABASE->select("select * from securityRefund");
    }

    public function maintenanceCats() {
        global $DATABASE;
        return $DATABASE->select("select * from maintenance_category");
    }

// Read One Method

    public function fndApartmentById($id) {
        global $DATABASE;
        return $DATABASE->select("select * from apartment where id =" . $id);
    }

    public function fndBuildingById($id) {
        global $DATABASE;
        return $DATABASE->select("select * from building where id =" . $id);
    }

    public function fndTenantById($id) {
        global $DATABASE;
        return $DATABASE->select("select * from tenant where id =" . $id);
    }

    public function fndLeaseContractById($id) {
        global $DATABASE;
        return $DATABASE->select("select * from lease where id =" . $id);
    }

    public function fndSecurityRefundById($id) {
        global $DATABASE;
        return $DATABASE->select("select * from securityRefund where id =" . $id);
    }

    public function fndMaintenanceCatById($id) {
        global $DATABASE;
        return $DATABASE->select("select * from maintenance_category where id =" . $id);
    }

// Delete Method

    public function delMaintenanceRequestById($id) {
        global $DATABASE;
        $DATABASE->delete("maintenance", "id =" . $id);
    }

    public function delTenantById($id) {
        global $DATABASE;
        $DATABASE->delete("tenant", "id =" . $id);
    }

    public function delRenewedContractById($id) {
        global $DATABASE;
        $DATABASE->delete("renewal", "id =" . $id);
    }

    public function delTerminatedContractById($id) {
        global $DATABASE;
        $DATABASE->delete("termination", "id =" . $id);
    }

    public function delChangeOfApartmentRequestById($id) {
        global $DATABASE;
        $DATABASE->delete("apartmentChange", "id =" . $id);
    }

    public function delApartmentById($id) {
        global $DATABASE;
        $DATABASE->delete("apartment", "id =" . $id);
    }

    public function delBuildingById($id) {
        global $DATABASE;
        $DATABASE->delete("building", "id =" . $id);
    }

    public function delLeaseContractById($id) {
        global $DATABASE;
        $DATABASE->delete("lease", "id =" . $id);
    }

    public function delSecurityRefundById($id) {
        global $DATABASE;
        $DATABASE->delete("securityRefund", "id =" . $id);
    }

    public function delMaintenanceCatById($id) {
        global $DATABASE;
        $DATABASE->delete("maintenance_category", "id =" . $id);
    }

}
