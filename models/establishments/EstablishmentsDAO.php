<?php

include_once("models/establishments/Establishment.php");
include_once("config/dataBase.php");

class EstablishmentsDAO {
    public static function getAll() {
        $con = DataBase::getInstance(); // Reuse the singleton connection

        $stmt = $con->prepare('SELECT * FROM ESTABLISHMENTS ORDER BY id_establishment');
        $stmt->execute();
        $result = $stmt->get_result();

        $establishments = [];
        while ($establishment = $result->fetch_object("Establishment")) {
            $establishments[] = $establishment;
        }

        return $establishments;
    }

    public static function get($id) {
        $con = DataBase::getInstance(); // Reuse the singleton connection

        // Prepare the SQL statement with LIKE
        $stmt = $con->prepare('SELECT * FROM ESTABLISHMENTS WHERE id_establishment LIKE ?');

        // Bind the parameter
        $stmt->bind_param('i', $id);

        // Execute the query
        $stmt->execute();
        $result = $stmt->get_result();

        $establishments = [];
        while ($establishment = $result->fetch_object("Establishment")) {
            $establishments[] = $establishment;
        }

        if (count($establishments) > 0) {
            return $establishments[0];
        } else {
            return null;
        }
    }
}

?>