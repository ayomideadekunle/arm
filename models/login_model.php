<?php

class Login_Model extends Model {

    function __construt() {
        parent::__construt();
    }

    public function userLogin() {
        $username = $_POST['email'];
        $password = md5($_POST['password']);

        $val = $this->db->select("select * from users");
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
                $_SESSION["username"] = $value["email"];

                echo $name;
                return FALSE;
            }
        }
        echo "0";
    }

}
