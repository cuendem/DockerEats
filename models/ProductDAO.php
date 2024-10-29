<?php

include_once("models/Product.php");
include_once("config/dataBase.php");

class ProductDAO {
    public static function getAll($order = 'id') {
        $con = DataBase::connect();
        $stmt = $con->prepare('SELECT * FROM PRODUCTS');
        // $stmt->bind_param('s',$order);
        $stmt->execute();
        $result = $stmt->get_result();

        $products = [];
        while ($product = $result->fetch_object("Product")) {
            $products[] = $product;
        }

        $con->close();

        return $products;
    }

    public static function store($product) {
        $con = DataBase::connect();
        $stmt = $con->prepare('INSERT INTO PRODUCTS (id_type, id_category, name, price, times_bought) VALUES (?, ?, ?, ?, ?)');
        $stmt->bind_param('iisdi',$product->getId_type(),$product->getId_category(),$product->getName(),$product->getPrice(),$product->getTimes_bought());

        $stmt->execute();

        $lastID = $con->insert_id;

        $con->close();

        return $lastID;
    }
}

?>