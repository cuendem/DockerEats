<?php

include_once("models/parts/Part.php");
include_once("config/dataBase.php");

class PartsDAO {
    public static function getAll() {
        $con = DataBase::getInstance(); // Reuse the singleton connection

        // Prepare the SQL statement with LIKE
        $stmt = $con->prepare('SELECT * FROM CONTAINER_PARTS');

        // Execute the query
        $stmt->execute();
        $result = $stmt->get_result();

        $parts = [];
        while ($part = $result->fetch_object("Part")) {
            $parts[] = $part;
        }

        return $parts;
    }

    public static function getFromContainer($id_container) {
        $con = DataBase::getInstance(); // Reuse the singleton connection

        // Prepare the SQL statement with LIKE
        $stmt = $con->prepare('SELECT * FROM CONTAINER_PARTS WHERE id_container LIKE ?');
        $stmt->bind_param('i', $id_container);

        // Execute the query
        $stmt->execute();
        $result = $stmt->get_result();

        $parts = [];
        while ($part = $result->fetch_object("Part")) {
            $parts[] = $part;
        }

        return $parts;
    }

    public static function store($part) {
        $con = DataBase::getInstance(); // Reuse the singleton connection

        $id_container = $part->getId_container();
        $id_product = $part->getId_product();

        $stmt = $con->prepare('INSERT INTO CONTAINER_PARTS (id_container, id_product) VALUES (?, ?)');
        $stmt->bind_param('ii', $id_container, $id_product);

        $stmt->execute();

        $lastID = $con->insert_id;

        return $lastID;
    }
}

?>