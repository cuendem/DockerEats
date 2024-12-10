<?php

include_once("models/containers/Container.php");
include_once("config/dataBase.php");

class ContainersDAO {
    public static function getAll() {
        $con = DataBase::connect();

        // Prepare the SQL statement with LIKE
        $stmt = $con->prepare('SELECT * FROM ORDERS');

        // Execute the query
        $stmt->execute();
        $result = $stmt->get_result();

        $orders = [];
        while ($order = $result->fetch_object("Order")) {
            $orders[] = $order;
        }

        $con->close();

        return $orders;
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