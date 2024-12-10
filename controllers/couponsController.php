<?php

include_once("models/coupons/CouponsDAO.php");
include_once("models/coupons/Coupon.php");

class couponsController {
    public static function addCouponOrderRelation($order_id, $coupon) {
        CouponsDAO::storeCouponOrderRelation($order_id, $coupon);
    }
}

?>