<?php

include_once("models/allergens/Allergen.php");
include_once("config/dataBase.php");

class AllergensDAO {
    public static function getByProduct($product = '%') {
        $con = DataBase::getInstance(); // Reuse the singleton connection

        $stmt = $con->prepare('SELECT a.* FROM ALLERGENS_PRODUCTS ap JOIN ALLERGENS a ON ap.id_allergen = a.id_allergen WHERE ap.id_product LIKE ?');
        $stmt->bind_param('s', $product);
        $stmt->execute();
        $result = $stmt->get_result();

        $allergens = [];
        while ($allergen = $result->fetch_object("Allergen")) {
            $allergens[] = $allergen;
        }

        return $allergens;
    }
}