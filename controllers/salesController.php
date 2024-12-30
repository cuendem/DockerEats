<?php

include_once("models/sales/SalesDAO.php");
include_once("models/sales/Sale.php");

class salesController {
    public function index() {
        $pageid = "sales";
        $view = "views/sales/list.php";
        $title = "Sales";
        $sales = SalesDAO::getAllAvailable(date('Y-m-d'));
        include_once("views/main.php");
    }

    public static function addSaleOrderRelation($order_id, $sale_id) {
        SalesDAO::addSaleOrderRelation($order_id, $sale_id);
    }

    public static function addSalePartRelation($part_id, $sale_id) {
        SalesDAO::addSalePartRelation($part_id, $sale_id);
    }
}

?>