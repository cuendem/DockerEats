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

    public static function order($sales) {
        // Sort the sales using usort with a custom function
        usort($sales, function($a, $b) {
            // Get discount types for both sales
            $typeA = $a->getDiscount_type();
            $typeB = $b->getDiscount_type();

            // Put percentage based sales first
            if ($typeA == 2 && $typeB != 2) {
                return -1; // $a comes before $b
            } elseif ($typeA != 2 && $typeB == 2) {
                return 1; // $b comes before $a
            }
            return 0; // Otherwise, leave order unchanged
        });

        return $sales;
    }

    public static function addSaleOrderRelation($order_id, $sale_id) {
        SalesDAO::addSaleOrderRelation($order_id, $sale_id);
    }

    public static function addSalePartRelation($part_id, $sale_id) {
        SalesDAO::addSalePartRelation($part_id, $sale_id);
    }
}

?>