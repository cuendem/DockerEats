<?php

if(isset($_POST['buy-button'])) {
    // Create the base order
    $order_id = ordersController::createOrder($_POST);

    if (gettype($order_id) == 'integer') {
        // Order created
        // Create the containers and link their parts to them
        foreach ($_SESSION['cart'] as $i => $container) {
            ordersController::addContainer($order_id, $container);
        }

        // Coupons
        if (isset($_SESSION['coupons']) && count($_SESSION['coupons']) > 0) {
            foreach ($_SESSION['coupons'] as $i => $coupon) {
                couponsController::addCouponOrderRelation($order_id, $coupon);
            }
        }

        unset($_SESSION['cart']);
        unset($_SESSION['coupons']);
    } else {
        // Something went wrong
        echo "Could not create order: $order_id";
    }
}
?>