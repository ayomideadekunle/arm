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
        $sth = $this->db->prepare("SELECT id FROM admin WHERE "
                . "username = :username AND password = :password");

        $sth->execute(array(
            ':username' => $_POST['username'],
            ':password' => md5($_POST['password'])
        ));

        $data = $sth->fetch();

        $count = $sth->rowCount();

        if ($count > 0) {
            Session::init();
            Session::set('APTRENTALMGT_LOGGED_IN', true);
            Session::set('id', $data['id']);
            Session::set('role', $data['role']);
            header('Location: ' . URL . 'admin');
        } else {
            header('Location: ' . URL . "redirect/login");
        }
    }

}
