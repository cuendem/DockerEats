<?php

include_once("models/sales/Sale.php");
include_once("config/dataBase.php");

class SalesDAO {
    public static function getAll() {
        $con = DataBase::getInstance(); // Reuse the singleton connection

        // Prepare the SQL statement with LIKE
        $stmt = $con->prepare('SELECT s.*, c.name AS category_name FROM SALES s
        LEFT JOIN CATEGORIES c ON s.category_affected = c.id_category
        ORDER BY s.date_start DESC, s.id_sale DESC');
        

        // Execute the query
        $stmt->execute();
        $result = $stmt->get_result();

        $sales = [];
        while ($sale = $result->fetch_object("Sale")) {
            $sales[] = $sale;
        }

        return $sales;
    }

    public static function getAllAvailable($date, $scope = '%') {
        $con = DataBase::getInstance(); // Reuse the singleton connection

        // Prepare the SQL statement with LIKE and date validity checks
        $stmt = $con->prepare('SELECT s.*, c.name AS category_name FROM SALES s
        LEFT JOIN CATEGORIES c ON s.category_affected = c.id_category
        WHERE date_start <= ? AND (date_end IS NULL OR date_end >= ?) AND scope LIKE ?
        ORDER BY s.date_start DESC, s.id_sale DESC');

        // Bind the parameter (using 's' for a string pattern)
        $stmt->bind_param('sss', $date, $date, $scope);

        // Execute the query
        $stmt->execute();
        $result = $stmt->get_result();

        $sales = [];
        while ($sale = $result->fetch_object("Sale")) {
            $sales[] = $sale;
        }

        // Return the valid sales, or null if none found
        return count($sales) > 0 ? $sales : null;
    }

    public static function addSaleOrderRelation($order_id, $sale_id) {
        $con = DataBase::getInstance(); // Reuse the singleton connection

        // Prepare the SQL statement
        $stmt = $con->prepare('INSERT INTO SALES_ORDERS (id_sale, id_order) VALUES (?, ?)');

        // Bind the parameters
        $stmt->bind_param('ii', $sale_id, $order_id);

        // Execute the query
        $stmt->execute();
    }

    public static function addSalePartRelation($part_id, $sale_id) {
        $con = DataBase::getInstance(); // Reuse the singleton connection

        // Prepare the SQL statement
        $stmt = $con->prepare('INSERT INTO SALES_CONTAINER_PARTS (id_sale, id_part) VALUES (?, ?)');

        // Bind the parameters
        $stmt->bind_param('ii', $sale_id, $part_id);

        // Execute the query
        $stmt->execute();
    }

    public static function getOrderSales($order_id) {
        $con = DataBase::getInstance(); // Reuse the singleton connection

        // Prepare the SQL statement
        $stmt = $con->prepare('SELECT s.*, c.name AS category_name FROM SALES s
        LEFT JOIN CATEGORIES c ON s.category_affected = c.id_category
        JOIN SALES_ORDERS as so ON s.id_sale = so.id_sale WHERE so.id_order = ?
        ORDER BY s.date_start DESC, s.id_sale DESC');

        // Bind the parameter
        $stmt->bind_param('i', $order_id);

        // Execute the query
        $stmt->execute();
        $result = $stmt->get_result();

        $sales = [];
        while ($sale = $result->fetch_object("Sale")) {
            $sales[] = $sale;
        }

        return $sales;
    }

    public static function getByPart($part_id) {
        $con = DataBase::getInstance(); // Reuse the singleton connection

        // Prepare the SQL statement
        $stmt = $con->prepare('SELECT s.*, c.name AS category_name FROM SALES s
        LEFT JOIN CATEGORIES c ON s.category_affected = c.id_category
        JOIN SALES_CONTAINER_PARTS as scp ON s.id_sale = scp.id_sale WHERE scp.id_part = ?
        ORDER BY s.date_start DESC, s.id_sale DESC');

        // Bind the parameter
        $stmt->bind_param('i', $part_id);

        // Execute the query
        $stmt->execute();
        $result = $stmt->get_result();

        $sales = [];
        while ($sale = $result->fetch_object("Sale")) {
            $sales[] = $sale;
        }

        return $sales;
    }
}

?>