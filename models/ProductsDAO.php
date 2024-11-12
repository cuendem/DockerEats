<?php

include_once("models/Product.php");
include_once("config/dataBase.php");

class ProductsDAO {
    public static function getAll($type = 0) {
        $con = DataBase::connect();

        $stmt = $con->prepare('SELECT * FROM PRODUCTS ORDER BY id_category');
        if ($type != 0) {
            $stmt = $con->prepare('SELECT * FROM PRODUCTS WHERE id_type = ? ORDER BY id_category');
            $stmt->bind_param('i',$type);
        }

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