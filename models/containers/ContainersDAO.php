<?php

include_once("models/containers/Container.php");
include_once("config/dataBase.php");

class ContainersDAO {
    public static function getAll() {
        $con = DataBase::getInstance(); // Reuse the singleton connection

        // Prepare the SQL statement with LIKE
        $stmt = $con->prepare('SELECT * FROM CONTAINERS');

        // Execute the query
        $stmt->execute();
        $result = $stmt->get_result();

        $containers = [];
        while ($container = $result->fetch_object("Container")) {
            $containers[] = $container;
        }

        return $containers;
    }

    public static function getOrderContainers($id_order) {
        $con = DataBase::getInstance(); // Reuse the singleton connection

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

        return $containers;
    }

    public static function store($order) {
        $con = DataBase::getInstance(); // Reuse the singleton connection

        $stmt = $con->prepare('INSERT INTO CONTAINERS (id_order) VALUES (?)');
        $stmt->bind_param('i', $order);

        $stmt->execute();

        $lastID = $con->insert_id;

        return $lastID;
    }

    public static function getAmount() {
        $con = DataBase::getInstance(); // Reuse the singleton connection

        // Prepare the SQL statement
        $stmt = $con->prepare("SELECT COUNT(*) AS amount FROM CONTAINERS");

        // Execute the query
        $stmt->execute();
        $result = $stmt->get_result();

        $amount = $result->fetch_object()->amount;

        return $amount;
    }
}

?>