<?php

include_once("models/coupons/Coupon.php");
include_once("config/dataBase.php");

class CouponsDAO {
    public static function getAll() {
        $con = DataBase::getInstance(); // Reuse the singleton connection

        // Prepare the SQL statement with LIKE
        $stmt = $con->prepare('SELECT * FROM COUPONS ORDER BY date_start DESC, id_coupon DESC');

        // Execute the query
        $stmt->execute();
        $result = $stmt->get_result();

        $coupons = [];
        while ($coupon = $result->fetch_object("Coupon")) {
            $coupons[] = $coupon;
        }

        return $coupons;
    }

    public static function getAvailable($code) {
        $con = DataBase::getInstance(); // Reuse the singleton connection

        // Prepare the SQL statement with LIKE and date validity checks
        $stmt = $con->prepare('SELECT * FROM COUPONS WHERE code LIKE ? AND date_start <= CURDATE() AND (date_end IS NULL OR date_end >= CURDATE()) ORDER BY date_start DESC, id_coupon DESC');

        // Bind the parameter (using 's' for a string pattern)
        $stmt->bind_param('s', $code);

        // Execute the query
        $stmt->execute();
        $result = $stmt->get_result();

        $coupons = [];
        while ($coupon = $result->fetch_object("Coupon")) {
            $coupons[] = $coupon;
        }

        // Return the first valid coupon, or null if none found
        return count($coupons) > 0 ? $coupons[0] : null;
    }

    public static function storeCouponOrderRelation($id_order, $coupon) {
        $con = DataBase::getInstance(); // Reuse the singleton connection

        $id_coupon = $coupon->getId_coupon();

        $stmt = $con->prepare('INSERT INTO COUPONS_ORDERS (id_coupon, id_order) VALUES (?, ?)');
        $stmt->bind_param('ii', $id_coupon, $id_order);
        $stmt->execute();
    }

    public static function getOrderCoupons($id_order) {
        $con = DataBase::getInstance(); // Reuse the singleton connection

        $stmt = $con->prepare('
            SELECT c.*
            FROM COUPONS_ORDERS co
            JOIN COUPONS c ON co.id_coupon = c.id_coupon
            WHERE co.id_order LIKE ?
            ORDER BY c.date_start DESC, c.id_coupon DESC
        ');
        $stmt->bind_param('i', $id_order);

        // Execute the query
        $stmt->execute();
        $result = $stmt->get_result();

        $coupons = [];
        while ($coupon = $result->fetch_object("Coupon")) {
            $coupons[] = $coupon;
        }

        return $coupons;
    }
}

?>