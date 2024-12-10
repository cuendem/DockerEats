<?php

include_once("models/orders/OrdersDAO.php");
include_once("models/containers/ContainersDAO.php");
include_once("models/parts/PartsDAO.php");

class ordersController {
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

        return OrdersDAO::store($newOrder);
    }

    public static function addContainer($order, $container) {
        $container_id = ContainersDAO::store($order);

        foreach ($container as $i => $id) {
            $part = new Part();
            $part->setId_container($container_id);
            $part->setId_product($id->getId_product());
            PartsDAO::store($part);
        }
    }
}

?>