<?php

include_once("models/products/Product.php");
include_once("config/dataBase.php");

class ProductsDAO {
    public static function get($id) {
        $con = DataBase::getInstance(); // Reuse the singleton connection

        // Prepare the SQL statement with LIKE
        $stmt = $con->prepare('SELECT * FROM PRODUCTS WHERE id_product LIKE ?');

        // Bind the parameter (using 's' for a string pattern)
        $stmt->bind_param('s', $id);

        // Execute the query
        $stmt->execute();
        $result = $stmt->get_result();

        $products = [];
        while ($product = $result->fetch_object("Product")) {
            $products[] = $product;
        }

        if (count($products) > 0) {
            return $products[0];
        } else {
            return null;
        }
    }

    public static function getAll($type = '%') {
        $con = DataBase::getInstance(); // Reuse the singleton connection

        // Prepare the SQL statement with LIKE
        $stmt = $con->prepare('SELECT * FROM PRODUCTS WHERE id_type LIKE ? ORDER BY id_type, name');

        // Bind the parameter (using 's' for a string pattern)
        $stmt->bind_param('s', $type);

        // Execute the query
        $stmt->execute();
        $result = $stmt->get_result();

        $products = [];
        while ($product = $result->fetch_object("Product")) {
            $products[] = $product;
        }

        return $products;
    }

    public static function getRandom($type = '%') {
        $con = DataBase::getInstance(); // Reuse the singleton connection

        // Prepare the SQL statement with LIKE
        $stmt = $con->prepare('SELECT * FROM PRODUCTS WHERE id_type LIKE ? ORDER BY id_type, name');

        // Bind the parameter (using 's' for a string pattern)
        $stmt->bind_param('s', $type);

        // Execute the query
        $stmt->execute();
        $result = $stmt->get_result();

        $products = [];
        while ($product = $result->fetch_object("Product")) {
            $products[] = $product;
        }

        return $products[array_rand($products)];
    }

    public static function getByCat($category, $type = '%') {
        $con = DataBase::getInstance(); // Reuse the singleton connection

        // Prepare the SQL statement with LIKE
        $stmt = $con->prepare(
            'SELECT P.id_product, P.id_type, P.name, P.price
            FROM PRODUCTS as P
            JOIN CATEGORIES_PRODUCTS as CP ON P.id_product = CP.id_product
            WHERE CP.id_category LIKE ? AND P.id_type LIKE ? AND P.deleted = 0
            ORDER BY P.id_type, P.name'
        );

        // Bind the parameter (using 's' for a string pattern)
        $stmt->bind_param('ss', $category, $type);

        // Execute the query
        $stmt->execute();
        $result = $stmt->get_result();

        $products = [];
        while ($product = $result->fetch_object("Product")) {
            $products[] = $product;
        }

        return $products;
    }

    public static function store($product) {
        $con = DataBase::getInstance(); // Reuse the singleton connection
        $stmt = $con->prepare('INSERT INTO PRODUCTS (id_type, id_category, name, price) VALUES (?, ?, ?, ?)');
        $stmt->bind_param('iisdi',$product->getId_type(),$product->getId_category(),$product->getName(),$product->getPrice());

        $stmt->execute();

        $lastID = $con->insert_id;

        return $lastID;
    }
}

?>