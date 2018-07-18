<?php

class Login_Model extends Model {

    function __construt() {
        parent::__construt();
    }

    public function tenantLogin() {
        $username = $_POST['email'];
        $password = md5($_POST['password']);

        $val = $this->db->select("select * from tenant");
        foreach ($val as $key => $value) {
//            echo "connected";
            if ($username == $value['email'] && $password == $value['password']) {
                $name = "1";
                $fullname = $value["firstname"] . " " . $value["lastname"];
                @session_start();

                $_SESSION["id"] = $value["id"];
                $_SESSION["APTRENTALMGT_LOGGED_IN"] = "yeah";
                $_SESSION["role"] = $value["role"];
                $_SESSION["fullname"] = $fullname;

                echo $name;
                return FALSE;
            }
        }
        echo "0";
    }

    public function adminLogin() {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $val = $this->db->select("select * from admin ");

        foreach ($val as $key => $value) {
            if ($username == $value['username'] && $password == $value['password']) {
                $name = "1";
                @session_start();

                $_SESSION["admin_id"] = $value["id"];
                $_SESSION["username"] = $value["username"];
                $_SESSION["role"] = $value["role"];

                echo $name;
                return FALSE;
            }
        }
        echo "0";
    }

}
