<?php

include_once("models/establishments/Establishment.php");
include_once("config/dataBase.php");

class EstablishmentsDAO {
    public static function getAll() {
        $con = DataBase::connect();

        $stmt = $con->prepare('SELECT * FROM ESTABLISHMENTS ORDER BY id_establishment');
        $stmt->execute();
        $result = $stmt->get_result();

        $establishments = [];
        while ($establishment = $result->fetch_object("Establishment")) {
            $establishments[] = $establishment;
        }

        $con->close();

        return $establishments;
    }

    public static function get($id) {
        $con = DataBase::connect();

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

        $con->close();

        if (count($establishments) > 0) {
            return $establishments[0];
        } else {
            return null;
        }
    }
}

?>