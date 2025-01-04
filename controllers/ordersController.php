<?php

include_once("models/orders/OrdersDAO.php");
include_once("models/parts/PartsDAO.php");

class ordersController {
    public function index() {
        include_once('models/protection.php');

        $pageid = "orders";
        $title = "Orders";
        $view = "views/orders/list.php";

        $orders = OrdersDAO::getByUser($_SESSION['id_user']);

        include_once("views/main.php");
    }

    public function recover() {
        $order = OrdersDAO::get($_GET['order']);
        $containers = $order->getContainers();

        unset($_SESSION['cart']);

        foreach ($containers as $i => $container) {
            $containerArray = [];
            $containerArray['main'] = $container->getPart(1, true);
            $containerArray['branch'] = $container->getPart(2, true);
            $containerArray['drink'] = $container->getPart(3, true);
            $containerArray['dessert'] = $container->getPart(4, true);
            $_SESSION['cart'][] = $containerArray;
        }

        logsController::log("Recovered order ".$_GET['order']);

        header('Location:/account/cart');
    }

    public function review() {
        include_once('models/protection.php');

        $pageid = "review";
        $title = "Write a review";
        $view = "views/orders/review.php";

        include_once("models/orders/create_review.php");

        $order = OrdersDAO::get($_GET['order']);

        if (!isset($order) || $order->getId_user() != $_SESSION['id_user'] || (isset($order->getReview_id_user) && $_SESSION['id_user'] != $order->getReview_id_user())) {
            header('Location:/');
        }

        include_once("views/main.php");
    }

    public static function createOrder($data) {
        // Delivery type
        if ($data['delivery-selected'] == 'true') {
            // Delivery
            if (isset($data['address'], $data['town'], $data['postalcode'], $data['city'], $data['country']) &&
                $data['address'] != "" &&
                $data['town'] != "" &&
                $data['postalcode'] != "" &&
                $data['city'] != "" &&
                $data['country'] != ""
            ) {
                $deliveryAddress = implode(', ', [$data['address'], $data['town'], $data['postalcode'], $data['city'], $data['country']]);
                $establishment = null;
            } else {
                // Missing data
                return 'Please fill out your address details';
            }
        } else if ($data['pickup-selected'] == 'true') {
            // Pickup
            $deliveryAddress = null;
            $establishment = $data['establishment'];
        } else {
            // Error
            return 'No delivery option picked';
        }

        // Payment options
        if ($data['payment-method'] == 'card') {
            if (isset($data['cardnumber'], $data['expirationdate'], $data['cvc'], $data['cardholder']) &&
                $data['cardnumber'] != "" &&
                $data['expirationdate'] != "" &&
                $data['cvc'] != "" &&
                $data['cardholder'] != ""
            ) {
                $cardNumber = $data['cardnumber'];
                $expirationDate = $data['expirationdate'];
                $cvc = $data['cvc'];
                $cardHolder = $data['cardholder'];
            } else {
                // Missing data
                return 'Please fill out your credit card details';
            }
        } else {
            $cardNumber = null;
            $expirationDate = null;
            $cvc = null;
            $cardHolder = null;
        }

        $newOrder = new Order();

        $newOrder->setId_user($_SESSION['id_user']);
        $newOrder->setId_establishment($establishment);
        $newOrder->setDelivery_address($deliveryAddress);
        $newOrder->setDate_order(date('Y-m-d'));

        $newOrder->setPayment_type($data['payment-method']);
        $newOrder->setCard_number($cardNumber);
        $newOrder->setExpiration_date($expirationDate);
        $newOrder->setCvc($cvc);
        $newOrder->setCard_holder($cardHolder);

        $id = OrdersDAO::store($newOrder);
        logsController::log("Created order $id");
        return $id;
    }
}

?>