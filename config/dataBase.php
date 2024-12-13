<?php

class DataBase {
    public static function connect($host = 'localhost', $user = 'root', $pass = '1234', $db = 'dockereats', $port = 3308) {
        $con = new mysqli($host, $user, $pass, $db, $port);

        if ($con->connect_error) {
            die("ERROR: " . $con->connect_error);
        }

        return $con;
    }

    public static function getAllTables($host = 'localhost', $user = 'root', $pass = '1234', $db = 'dockereats', $port = 3308) {
        $con = self::connect($host, $user, $pass, $db, $port);

        $tables = [];
        $result = $con->query("SHOW TABLES");

        if ($result) {
            while ($row = $result->fetch_array()) {
                $tables[] = $row[0];
            }
        }

        $con->close();
        return $tables;
    }
}

?>