<?php

include_once("models/coupons/Coupon.php");
include_once("config/dataBase.php");

class CouponsDAO {
    public static function getAll() {
        $con = DataBase::connect();

        // Prepare the SQL statement with LIKE
        $stmt = $con->prepare('SELECT * FROM COUPONS');

        // Execute the query
        $stmt->execute();
        $result = $stmt->get_result();

        $coupons = [];
        while ($coupon = $result->fetch_object("Coupon")) {
            $coupons[] = $coupon;
        }

        $con->close();

        return $coupons;
    }

    public static function getAvailable($code) {
        $con = DataBase::connect();
    
        // Prepare the SQL statement with LIKE and date validity checks
        $stmt = $con->prepare('SELECT * FROM COUPONS WHERE code LIKE ? AND date_start <= CURDATE() AND (date_end IS NULL OR date_end >= CURDATE())');
    
        // Bind the parameter (using 's' for a string pattern)
        $stmt->bind_param('s', $code);
    
        // Execute the query
        $stmt->execute();
        $result = $stmt->get_result();
    
        $coupons = [];
        while ($coupon = $result->fetch_object("Coupon")) {
            $coupons[] = $coupon;
        }
    
        $con->close();
    
        // Return the first valid coupon, or null if none found
        return count($coupons) > 0 ? $coupons[0] : null;
    }

    public static function storeCouponOrderRelation($id_order, $coupon) {
        $con = DataBase::connect();

        $id_coupon = $coupon->getId_coupon();

        $stmt = $con->prepare('INSERT INTO COUPONS_ORDERS (id_coupon, id_order) VALUES (?, ?)');
        $stmt->bind_param('ii', $id_coupon, $id_order);
        $stmt->execute();
        $con->close();
    }
}

?>