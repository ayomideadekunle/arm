<?php

class Database extends PDO {

    public function __construct($DB_TYPE, $DB_HOST, $DB_NAME, $DB_USER, $DB_PASS) {
        parent::__construct($DB_TYPE . ':host=' . $DB_HOST . ';dbname=' . $DB_NAME, $DB_USER, $DB_PASS);
//        parent::setAttribute(PDO::ATRR_ERRMODE, PDO::ERRMODE_EXCEPTIONS);
    }

    function select($query, $array = array()) {
        $con = $this->prepare($query);

        foreach ($array as $key => $value) {
            $con->bindValue($key, $value);
        }
        $con->execute();
        return $con->fetchAll(PDO::FETCH_ASSOC);
    }

//    function update($table, $array, $ref) {
//   $field=NULL;
//   foreach ($array as $key => $value) {
//    $field.="`$key`=:$key,";
//}
//$fieldfin=  rtrim($field,",");
//  //echo $field;
//   $myquery= "update $table set $fieldfin where id =$ref";
//   $con=  $this->prepare($myquery);
//   foreach ($array as $key => $value) {
//       $con->bindValue($key, $value);
//   }
//   $con->execute();
////   echo $myquery. "is successfull";
//    }


    public function update($table, $data, $where) {
        ksort($data);
        $fieldDetails = NULL;
        foreach ($data as $key => $value) {
            $fieldDetails .= "`$key`=:$key,";
        }
        $fieldDetails = rtrim($fieldDetails, ',');
//        print_r($fieldDetails);
//        print("UPDATE $table SET $fieldDetails WHERE $where");
        $sth = $this->prepare("UPDATE $table SET $fieldDetails WHERE $where");
        foreach ($data as $key => $value) {
            $sth->bindValue(":$key", $value);
//            print($value);
        }
        $sth->execute();
//        echo $sth;
    }

    public function delete($table, $where, $limit = 1) {
        return $this->exec("DELETE FROM $table WHERE $where LIMIT $limit");
    }

    function insert($table, $array) {
        //$array=array("name"=>"testing", "age"=>"150","dept"=>"comp","marital_status"=>"complicated");
        $key = array_keys($array);
//print_r($key);
        $ope = implode("`,`", $key);
        $yemi = "`" . $ope . "`";
        $ola = implode(",:", $key);
      $mide = ":" . $ola;
        //echo $mide;
        $wuraola = "insert into $table ($yemi) values($mide)";
//   echo $wuraola;
        $con = $this->prepare($wuraola);
        foreach ($array as $key => $value) {
            $con->bindValue($key, $value);
        }
//        echo $con;
        $con->execute();
        return $id = $this->select("select id from $table order by id DESC LIMIT 1 ");
//        echo($con->execute());
//        echo "successful";
    }

    function e($q) {
        $this->exec($q);
    }

    function startTransaction(){
      return $this->exec("START TRANSACTION");
    }

    function commitTransaction(){
      return $this->exec("COMMIT");
    }

}

?>
