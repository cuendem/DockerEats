<?php

include_once("models/categories/Category.php");
include_once("config/dataBase.php");

class CategoriesDAO {
    public static function get($id) {
        $con = DataBase::connect();

        $stmt = $con->prepare('SELECT * FROM CATEGORIES WHERE id_category = ?');
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();

        $category = $result->fetch_object("Category");

        $con->close();

        return $category;
    }

    public static function getAll() {
        $con = DataBase::connect();

        $stmt = $con->prepare('SELECT * FROM CATEGORIES ORDER BY name');
        $stmt->execute();
        $result = $stmt->get_result();

        $alcoholic = null;

        $categories = [];
        while ($category = $result->fetch_object("Category")) {
            if ($category->getId_category() == 10) {
                $alcoholic = $category;
            } else {
                $categories[] = $category;
            }
        }

        $categories[] = $alcoholic;

        $con->close();

        return $categories;
    }

    public static function getIDsByProduct($product = '%') {
        $con = DataBase::connect();

        $stmt = $con->prepare('SELECT id_category FROM CATEGORIES_PRODUCTS WHERE id_product LIKE ?');
        $stmt->bind_param('s', $product);
        $stmt->execute();
        $result = $stmt->get_result();

        $categories = [];
        while ($row = $result->fetch_assoc()) {
            $categories[] = $row['id_category'];
        }

        $con->close();

        return $categories;
    }

    public static function store($category) {
        $con = DataBase::connect();
        $stmt = $con->prepare('INSERT INTO CATEGORIES (name) VALUES (?)');
        $stmt->bind_param('s',$category->getName());

        $stmt->execute();

        $lastID = $con->insert_id;

        $con->close();

        return $lastID;
    }
}

?>