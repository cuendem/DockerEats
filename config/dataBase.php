<?php

class DataBase {
    public static function connect($host='localhost', $user='root', $pass='1234', $db='dockereats', $port=3308) {
        $con = new mysqli($host, $user, $pass, $db, $port);

        if ($con === False) {
            die("ERROR: ".$con->connect_error);
        }

        return $con;
    }
}

?>