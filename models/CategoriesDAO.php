<?php

include_once("models/Category.php");
include_once("config/dataBase.php");

class CategoriesDAO {
    public static function getAll() {
        $con = DataBase::connect();

        $stmt = $con->prepare('SELECT * FROM CATEGORIES ORDER BY name');
        $stmt->execute();
        $result = $stmt->get_result();

        $categories = [];
        while ($category = $result->fetch_object("Category")) {
            $categories[] = $category;
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