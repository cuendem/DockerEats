<?php

include_once("models/parts/PartsDAO.php");
include_once("models/parts/Part.php");

class partsController {
    public static function addPart($container_id, $product) {
        $part = new Part();
        $part->setId_container($container_id);
        $part->setId_product($product->getId_product());
        return PartsDAO::store($part);
    }
}

?>