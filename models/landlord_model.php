<?php

// require './PHPMailer/PHPMailerAutoload.php';

class Landlord_Model extends Model
{

    public function __construct()
    {
        parent::__construct();
        global $DATABASE;
        $DATABASE = $this->db;
    }

    // getting details method

    public function loggedInUser()
    {
        @session_start();
        $userid = $_SESSION['id'];
        return $userid;
    }

    // get building info
    public function buildingInfo($id = '')
    {
        global $DATABASE;
        $param = array(
            ":buildingid" => $id,
        );
        $getinfo_query = $DATABASE->select("SELECT * FROM building WHERE id = :buildingid", $param);
        return $getinfo_query;
    }

    // get tenant info
    public function tenantInfo($id = '')
    {
        global $DATABASE;
        $param = array(
            ":tenantid" => $id,
        );
        $getinfo_query = $DATABASE->select("SELECT * FROM users WHERE id = :tenantid", $param);
        return $getinfo_query;
    }
    // get maintenance category info
    public function maintenanceCatInfo($id = '')
    {
        global $DATABASE;
        $param = array(
            ":catid" => $id,
        );
        $getinfo_query = $DATABASE->select("SELECT * FROM maintenance_category WHERE id = :catid", $param);
        return $getinfo_query;
    }

    // get apartment info
    public function apartmentInfo($id = '')
    {
        global $DATABASE;
        $param = array(
            ":apartmentid" => $id,
        );
        $getinfo_query = $DATABASE->select("SELECT * FROM apartment WHERE id = :apartmentid", $param);
        return $getinfo_query;
    }

    public function grantRequest($id)
    {
        global $DATABASE;
        $q = "select * from apartmentChange where id = " . $id;
        $run_q = $DATABASE->select($q);
        // print_r($run_q);
        // foreach ($run_q as $key => $value) {
        $lease_id = $run_q[0]["lease_id"];
        $leaving_Apartment = $run_q[0]["leavingAprtmentid"];
        $new_apartment = $run_q[0]["newApartment"];
        $tenant_id = $run_q[0]["tenant_id"];

        // $aptInfos = $this->apartmentInfo($leaving_Apartment['leavingAprtmentid']);
        // $apts = $aptInfo($leaving_Apartment['leavingAprtmentid']);
        // foreach($aptInfos as $apt){
        //     echo $apt["apartmentNumber"];
        // }

        $sender = "waLkEr Apartment Management";
        $message = "Your request for change of apartment has been granted";
        $subject = "Apartment Change Request";
        $date = date("Y-m-d H:i:s");

        $messageData = array(
            'user' => $tenant_id,
            'sender' => $sender,
            'message' => $message,
            'subject' => $subject,
            'date' => $date,
        );

        $update_lease_tbl = "update lease set apartment_id = " . $new_apartment . " where id = '$lease_id'";
        // echo $update_lease_tbl;
        $grant_query = "update apartmentChange set status = 1 where id = '$id'";

        $DATABASE->startTransaction();
        $run_query = $DATABASE->select($grant_query);
        $DATABASE->select($update_lease_tbl);
        $DATABASE->insert("notification", $messageData);
        $DATABASE->commitTransaction();
        // }
    }

    public function rejectRequest($id)
    {
        global $DATABASE;
        $q = "select * from apartmentChange where id = " . $id;
        $run_q = $DATABASE->select($q);

        $leaving_Apartment = $run_q[0]["leavingAprtmentid"];
        $new_apartment = $run_q[0]["newApartment"];
        $tenant_id = $run_q[0]["tenant_id"];

        $sender = "waLkEr Apartment Management";
        $message = "Your request for change of apartment has been rejected";
        $subject = "Apartment Change Request";
        $date = date("Y-m-d H:i:s");

        $messageData = array(
            'user' => $tenant_id,
            'sender' => $sender,
            'message' => $message,
            'subject' => $subject,
            'date' => $date,
        );

        $DATABASE->startTransaction();
        $reject_query = "update apartmentChange set status = 2 where id = '$id'";
        $run_query = $DATABASE->select($reject_query);
        $DATABASE->insert("notification", $messageData);
        $DATABASE->commitTransaction();
    }

    // fetch

    public function fetchApartments($id)
    {
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

    public function email_exists($email)
    {
        global $DATABASE;

        $result = $DATABASE->select("SELECT * FROM `users` WHERE email = '$email'");
        echo json_encode($result);
    }

    public function tenant_exists($tenant_id)
    {
        global $DATABASE;
        $result = $DATABASE->select("select * from lease where tenant_id =" . $tenant_id);
        echo json_encode($result);
    }

    public function notifyOfRenewal($user_id)
    {
      global $DATABASE;
      $query_lease = $this->db->select("select * from lease where id = " .$user_id);
      $tenant_id = $query_lease[0]["tenant_id"];
      // echo json_encode($query_lease);

      $messageData = array(
            'user' => $tenant_id,
            'sender' => "waLkEr Apartment Management",
            'message' => "Your contract will soon be renewed",
            'subject' => "Renewal of Contract Notice",
            'date' => date("Y-m-d H:i:s")
          );

        $query = "update lease set isnotified = 1 where tenant_id = " .$user_id;

        $DATABASE->startTransaction();
        $run_query = $DATABASE->select($query);
        $DATABASE->insert("notification", $messageData);
        $DATABASE->commitTransaction();
    }

// Create Method

    public function addBuilding()
    {
        global $DATABASE;
        $buildingData = array(
            'buildingName' => $_POST['buildingName'],
            'address' => $_POST['address'],
            'cityStateZip' => $_POST['cityStateZip'],
        );
        $DATABASE->insert('building', $buildingData);
    }

    public function mail_sending_template()
    {
        $sender_address = $_POST['sender_email'];
        $sender_name = $_POST['sender_name'];
        $recipient = $_POST['recipient_email'];
        $recipient_name = $_POST['recipient_name'];
        $subject = $_POST['subject'];
        $body = $_POST['message'];

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

    public function addAdmin()
    {
        global $DATABASE;
        $adminData = array(
            'username' => $_POST['username'],
            'email' => $_POST['email'],
            'password' => $_POST['password'],
        );
        $DATABASE->insert('admin', $adminData);
    }

    public function addTenant()
    {
        global $DATABASE;
        $tenantData = array(
            'firstname' => $_POST['firstname'],
            'lastname' => $_POST['lastname'],
            'email' => $_POST['email'],
            'phone' => $_POST['phone'],
            'currentAddress' => $_POST['currentAddress'],
            'cityStateZip' => $_POST['cityStateZip'],
            'password' => md5($_POST['password']),
        );
        $DATABASE->insert("tenant", $tenantData);
    }

    public function addApartment()
    {
        global $DATABASE;
        $apartmentData = array(
            'building_id' => $_POST['building_id'],
            'size' => $_POST['size'],
            'apartmentNumber' => $_POST['apartmentNumber'],
            'apartmentType' => $_POST['apartmentType'],
            'rentalFee' => $_POST['rentalFee'],
            'status' => 0,
        );
        $DATABASE->insert('apartment', $apartmentData);
    }

    public function leaseContract()
    {
        global $DATABASE;

        $leaseInfo = array(
            'tenant_id' => $_POST['tenant_id'],
            'building_id' => $_POST['building_id'],
            'apartment_id' => $_POST['apartment_id'],
            'startDate' => $_POST['startDate'],
            'endDate' => $_POST['endDate'],
            'balance' => $_POST['balance'],
            'securityDeposit' => $_POST['securityDeposit'],
            'period' => $_POST['period'],
            'rentalDate' => $_POST['rentalDate'],
        );

        $query = "UPDATE apartment SET status = 1 WHERE id = " . $_POST['apartment_id'];

        $DATABASE->startTransaction();
        $DATABASE->insert('lease', $leaseInfo);
        $DATABASE->select($query);
        $DATABASE->commitTransaction();
//        print_r($leaseInfo);
    }

    public function addMaintenanceCat()
    {
        global $DATABASE;
        $catData = array(
            'categoryName' => $_POST['categoryName'],
        );
        $DATABASE->insert('maintenance_category', $catData);
    }

    public function securityRefund()
    {
        global $DATABASE;
        $secRfdData = array(
            'refundAmount' => $_POST['refundAmount'],
            'refundReason' => $_POST['refundReason'],
            'date' => $_POST['date'],
        );
        $DATABASE->insert('securityRefund', $secRfdData);
    }

    public function sendNotification()
    {
        global $DATABASE;
        $date = date("Y-m-d H:i:s");

        // $messageData = array(
        //     "user" => $_POST["user"],
        //     "subject" => $_POST["subject"],
        //     "message" => $_POST["message"],
        //     "date" => $date,
        // );

        $recipients = $_POST["user"];

        // $recipients = explode(', ', $recipient);
        foreach ($recipients as $recipient) {
            $recipients .= $recipient . ",";
            $DATABASE->insert("notification", array(
                "user" => $recipient,
                "sender" => "Admin",
                "subject" => $_POST["subject"],
                "message" => $_POST["message"],
                "date" => $date,
            ));
        }
    }

// Update Method
    public function updateApartment($apartmentid = '')
    {
        global $DATABASE;

        $apartmentData = array(
            'building_id' => $_POST['building_id'],
            'size' => $_POST['size'],
            'apartmentNumber' => $_POST['apartmentNumber'],
            'apartmentType' => $_POST['apartmentType'],
            'rentalFee' => $_POST['rentalFee'],
            'status' => $_POST['status'],
        );
        $DATABASE->update('apartment', $apartmentData, 'id=' . $apartmentid);
    }

    public function updateTenant($tenant_id = '')
    {
        global $DATABASE;
        $tenantData = array(
            'firstname' => $_POST['firstname'],
            'lastname' => $_POST['lastname'],
            'email' => $_POST['email'],
            'phone' => $_POST['phone'],
            'currentAddress' => $_POST['currentAddress'],
            'cityStateZip' => $_POST['cityStateZip'],
        );
        $DATABASE->update("users", $tenantData, 'id=' . $tenant_id);
    }

    public function updateBuilding($building_id = '')
    {
        global $DATABASE;

        $buildingData = array(
            'buildingName' => $_POST['buildingName'],
            'address' => $_POST['address'],
            'cityStateZip' => $_POST['cityStateZip'],
        );
        $DATABASE->update('building', $buildingData, 'id=' . $building_id);
    }

    public function updateMaintCat($cat_id = '')
    {
        global $DATABASE;

        $catData = array(
            'categoryName' => $_POST['categoryName'],
        );
        $DATABASE->update('maintenance_category', $catData, 'id=' . $cat_id);
    }

    public function updateSecRfnd($secRfndId = '')
    {
        global $DATABASE;

        $secRfdData = array(
            'refundAmount' => $_POST['refundAmount'],
            'refundReason' => $_POST['refundReason'],
            'date' => $_POST['date'],
        );
        $DATABASE->update('securityRefund', $secRfdData, 'id=' . $secRfndId);
    }

    public function updateLeaseContract($contract_id = '')
    {
        global $DATABASE;

        $leaseInfo = array(
            'tenant_id' => $_POST['tenant_id'],
            'apartment_id' => $_POST['apartment_id'],
            'startDate' => $_POST['startDate'],
            'endDate' => $_POST['endDate'],
            'balance' => $_POST['balance'],
            'securityDeposit' => $_POST['securityDeposit'],
            'period' => $_POST['period'],
            'rentalDate' => $_POST['rentalDate'],
            'status' => 0
        );
        $query = "UPDATE apartment SET status = 1 WHERE id = " . $_POST['apartment_id'];

        $DATABASE->startTransaction();
        $DATABASE->update('lease', $leaseInfo, 'id=' . $contract_id);
        $DATABASE->select($query);
        $DATABASE->commitTransaction();
    }

// Read Method

    public function apartments()
    {
        global $DATABASE;
        return $DATABASE->select("select * from apartment");
    }

    public function maintenanceReqs()
    {
        global $DATABASE;
        return $DATABASE->select("select * from maintenance");
    }

    public function changeOfApartmentReqs()
    {
        global $DATABASE;
        return $DATABASE->select("select * from apartmentChange");
    }

    public function rnwdContracts()
    {
        global $DATABASE;
        return $DATABASE->select("select * from renewal");
    }

    public function buildings()
    {
        global $DATABASE;
        return $DATABASE->select("select * from building where isDeleted = 0");
    }

    public function tenants()
    {
        global $DATABASE;
        return $DATABASE->select("select * from users");
    }

    public function leaseContracts()
    {
        global $DATABASE;
        return $DATABASE->select("select * from lease");
    }

    public function terminatedCntracts()
    {
        global $DATABASE;
        return $DATABASE->select("select * from termination");
    }

    public function securityRefunds()
    {
        global $DATABASE;
        return $DATABASE->select("select * from securityRefund");
    }

    public function maintenanceCats()
    {
        global $DATABASE;
        return $DATABASE->select("select * from maintenance_category");
    }

// Read One Method

    public function fndApartmentById($id)
    {
        global $DATABASE;
        return $DATABASE->select("select * from apartment where id =" . $id);
    }

    public function fndchngAptById($id)
    {
        global $DATABASE;
        return $DATABASE->select("select * from apartmentChange where id =" . $id);
    }

    public function fndBuildingById($id)
    {
        global $DATABASE;
        return $DATABASE->select("select * from building where id =" . $id);
    }

    public function fndTenantById($id)
    {
        global $DATABASE;
        return $DATABASE->select("select * from users where id =" . $id);
    }

    public function fndLeaseContractById($id)
    {
        global $DATABASE;
        return $DATABASE->select("select * from lease where id =" . $id);
    }

    public function fndSecurityRefundById($id)
    {
        global $DATABASE;
        return $DATABASE->select("select * from securityRefund where id =" . $id);
    }

    public function fndMaintenanceCatById($id)
    {
        global $DATABASE;
        return $DATABASE->select("select * from maintenance_category where id =" . $id);
    }

// Delete Method

    public function delMaintenanceRequestById($id)
    {
        global $DATABASE;
        $DATABASE->delete("maintenance", "id =" . $id);
    }

    public function delTenantById($id)
    {
        global $DATABASE;
        $DATABASE->delete("users", "id =" . $id);
    }

    public function delRenewedContractById($id)
    {
        global $DATABASE;
        $DATABASE->delete("renewal", "id =" . $id);
    }

    public function delTerminatedContractById($id)
    {
        global $DATABASE;
        $DATABASE->delete("termination", "id =" . $id);
    }

    public function delChangeOfApartmentRequestById($id)
    {
        global $DATABASE;
        $DATABASE->delete("apartmentChange", "id =" . $id);
    }

    public function delApartmentById($id)
    {
        global $DATABASE;
        $DATABASE->delete("apartment", "id =" . $id);
    }

    public function softDeleteBuilding($id)
    {
        global $DATABASE;

        $softDeletequery = "UPDATE building SET isDeleted = 1 WHERE id = '$id'";
        $DATABASE->select($softDeletequery);
    }

    public function delLeaseContractById($id)
    {
        global $DATABASE;
        $DATABASE->delete("lease", "id =" . $id);
    }

    public function delSecurityRefundById($id)
    {
        global $DATABASE;
        $DATABASE->delete("securityRefund", "id =" . $id);
    }

    public function delMaintenanceCatById($id)
    {
        global $DATABASE;
        $DATABASE->delete("maintenance_category", "id =" . $id);
    }

}
