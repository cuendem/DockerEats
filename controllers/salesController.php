<?php

include_once("models/sales/SalesDAO.php");
include_once("models/sales/Sale.php");

class salesController {
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
}

?>