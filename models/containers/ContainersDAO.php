<?php

include_once("models/containers/Container.php");
include_once("config/dataBase.php");

class ContainersDAO {
    public static function getAll() {
        $con = DataBase::connect();

        // Prepare the SQL statement with LIKE
        $stmt = $con->prepare('SELECT * FROM CONTAINERS');

        // Execute the query
        $stmt->execute();
        $result = $stmt->get_result();

        $containers = [];
        while ($container = $result->fetch_object("Container")) {
            $containers[] = $container;
        }

        $con->close();

        return $containers;
    }

    public static function getOrderContainers($id_order) {
        $con = DataBase::connect();

        // Prepare the SQL statement with LIKE
        $stmt = $con->prepare('SELECT * FROM CONTAINERS WHERE id_order LIKE ?');
        $stmt->bind_param('i', $id_order);

        // Execute the query
        $stmt->execute();
        $result = $stmt->get_result();

        $containers = [];
        while ($container = $result->fetch_object("Container")) {
            $containers[] = $container;
        }

        $con->close();

        return $containers;
    }

    public static function store($order) {
        $con = DataBase::connect();

        $stmt = $con->prepare('INSERT INTO CONTAINERS (id_order) VALUES (?)');
        $stmt->bind_param('i', $order);

        $stmt->execute();

        $lastID = $con->insert_id;

        $con->close();

        return $lastID;
    }
}

?>