<?php

include_once("models/orders/Order.php");
include_once("config/dataBase.php");

class OrdersDAO {
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

        $id_user = $order->getId_user();
        $id_establishment = $order->getId_establishment();
        $date_order = $order->getDate_order();
        $delivery_address = $order->getDelivery_address();
        $cart = $order->getCart();

        $stmt = $con->prepare('INSERT INTO ORDERS (id_user, id_establishment, date_order, delivery_address, cart) VALUES (?, ?, ?, ?, ?)');
        $stmt->bind_param('iisss', $id_user, $id_establishment, $date_order, $delivery_address, $cart);

        $stmt->execute();

        $lastID = $con->insert_id;

        $con->close();

        return $lastID;
    }
}

?>