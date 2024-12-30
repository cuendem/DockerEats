<?php

include_once("models/orders/Order.php");
include_once("config/dataBase.php");

class OrdersDAO {
    public static function getAll() {
        $con = DataBase::connect();

        // Prepare the SQL statement
        $stmt = $con->prepare("SELECT
            o.id_order,
            o.date_order,
            o.delivery_address,
            o.payment_type,
            o.card_number,
            o.expiration_date,
            o.cvc,
            o.card_holder,
            o.id_user,
            u.username,
            e.id_establishment,
            e.name AS establishment_name
        FROM
            ORDERS o
        LEFT JOIN USERS u ON o.id_user = u.id_user
        LEFT JOIN ESTABLISHMENTS e ON o.id_establishment = e.id_establishment
        ORDER BY o.id_order DESC");

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

    public static function getByUser($id) {
        $con = DataBase::connect();

        // Prepare the SQL statement
        $stmt = $con->prepare("SELECT
            o.id_order,
            o.date_order,
            o.delivery_address,
            o.payment_type,
            o.card_number,
            o.expiration_date,
            o.cvc,
            o.card_holder,
            o.id_user,
            u.username,
            e.id_establishment,
            e.name AS establishment_name
        FROM
            ORDERS o
        LEFT JOIN USERS u ON o.id_user = u.id_user
        LEFT JOIN ESTABLISHMENTS e ON o.id_establishment = e.id_establishment
        WHERE o.id_user = ?
        ORDER BY o.id_order DESC");
        $stmt->bind_param('i', $id);

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
        $payment_type = $order->getPayment_type();
        $card_number = $order->getCard_number();
        $expiration_date = $order->getExpiration_date();
        $cvc = $order->getCvc();
        $card_holder = $order->getCard_holder();

        $stmt = $con->prepare('INSERT INTO ORDERS (id_user, id_establishment, date_order, delivery_address, payment_type, card_number, expiration_date, cvc, card_holder) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)');
        $stmt->bind_param('iisssisis', $id_user, $id_establishment, $date_order, $delivery_address, $payment_type, $card_number, $expiration_date, $cvc, $card_holder);

        $stmt->execute();

        $lastID = $con->insert_id;

        $con->close();

        return $lastID;
    }
}

?>