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
            e.name AS establishment_name,
            r.id_review,
            r.id_user AS review_id_user,
            r.comment,
            r.stars,
            r.published_date
        FROM
            ORDERS o
        LEFT JOIN USERS u ON o.id_user = u.id_user
        LEFT JOIN ESTABLISHMENTS e ON o.id_establishment = e.id_establishment
        LEFT JOIN REVIEWS r ON o.id_order = r.id_order
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

    public static function get($id) {
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
            e.name AS establishment_name,
            r.id_review,
            r.id_user AS review_id_user,
            r.comment,
            r.stars,
            r.published_date
        FROM
            ORDERS o
        LEFT JOIN USERS u ON o.id_user = u.id_user
        LEFT JOIN ESTABLISHMENTS e ON o.id_establishment = e.id_establishment
        LEFT JOIN REVIEWS r ON o.id_order = r.id_order
        WHERE o.id_order = ?");
        $stmt->bind_param('i', $id);

        // Execute the query
        $stmt->execute();
        $result = $stmt->get_result();

        $order = $result->fetch_object("Order");

        $con->close();

        return $order;
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
            e.name AS establishment_name,
            r.id_review,
            r.id_user AS review_id_user,
            r.comment,
            r.stars,
            r.published_date
        FROM
            ORDERS o
        LEFT JOIN USERS u ON o.id_user = u.id_user
        LEFT JOIN ESTABLISHMENTS e ON o.id_establishment = e.id_establishment
        LEFT JOIN REVIEWS r ON o.id_order = r.id_order
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

    public static function getLastByUser($id) {
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
            e.name AS establishment_name,
            r.id_review,
            r.id_user AS review_id_user,
            r.comment,
            r.stars,
            r.published_date
        FROM
            ORDERS o
        LEFT JOIN USERS u ON o.id_user = u.id_user
        LEFT JOIN ESTABLISHMENTS e ON o.id_establishment = e.id_establishment
        LEFT JOIN REVIEWS r ON o.id_order = r.id_order
        WHERE o.id_user = ?
        ORDER BY o.id_order DESC
        LIMIT 1");
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

    public static function getAmount() {
        $con = DataBase::connect();

        // Prepare the SQL statement
        $stmt = $con->prepare("SELECT COUNT(*) AS amount FROM ORDERS");
        $stmt->execute();
        $result = $stmt->get_result();

        $amount = $result->fetch_assoc()['amount'];

        $con->close();

        return $amount;
    }

    public static function storeReview($id_user, $id_order, $comment, $stars, $published_date) {
        $con = DataBase::connect();

        $stmt = $con->prepare('INSERT INTO REVIEWS (id_user, id_order, comment, stars, published_date) VALUES (?, ?, ?, ?, ?)');
        $stmt->bind_param('iisds', $id_user, $id_order, $comment, $stars, $published_date);

        $stmt->execute();

        $lastID = $con->insert_id;

        $con->close();

        return $lastID;
    }

    public static function updateReview($id_review, $id_user, $id_order, $comment, $stars) {
        $con = DataBase::connect();

        $stmt = $con->prepare('UPDATE REVIEWS SET id_user = ?, id_order = ?, comment = ?, stars = ? WHERE id_review = ?');
        $stmt->bind_param('iisdi', $id_user, $id_order, $comment, $stars, $id_review);

        $stmt->execute();

        $con->close();
    }

    public static function deleteReview($id_review) {
        $con = DataBase::connect();

        $stmt = $con->prepare('DELETE FROM REVIEWS WHERE id_review = ?');
        $stmt->bind_param('i', $id_review);

        $stmt->execute();

        $con->close();
    }

    public static function getRandomReviews() {
        $con = DataBase::connect();

        // Prepare the SQL statement
        $stmt = $con->prepare("SELECT
            r.*,
            u.username
        FROM
            REVIEWS r
        LEFT JOIN USERS u ON r.id_user = u.id_user
        ORDER BY RAND()
        LIMIT 6");

        // Execute the query
        $stmt->execute();
        $result = $stmt->get_result();

        $reviews = [];
        while ($review = $result->fetch_assoc()) {
            $reviews[] = $review;
        }

        $con->close();

        return $reviews;
    }
}

?>