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
}

?>