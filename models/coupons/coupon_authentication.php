<?php

include_once('CouponsDAO.php');

if(isset($_POST['coupon-code'], $_POST['coupon-button']) && $_POST['coupon-code'] != '') {
    $coupon = CouponsDAO::getAvailable($_POST['coupon-code']);

    if (is_null($coupon)) {
        echo "This coupon is invalid or has expired.";
    } else {
        // Initialize the coupons session array if it doesn't exist
        if (!isset($_SESSION['coupons'])) {
            $_SESSION['coupons'] = [];
        }

        // Add the coupon only if it's not already in the array
        if (!in_array($coupon, $_SESSION['coupons'])) {
            $_SESSION['coupons'][] = $coupon;

            logsController::log("Used coupon ".$coupon->getCode());
        } else {
            echo "This coupon has already been used.";
        }
    }
}
?>