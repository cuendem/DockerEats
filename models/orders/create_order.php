<?php

if(isset($_POST['buy-button'])) {
    // Create the base order
    $order_id = ordersController::createOrder($_POST);

    if (gettype($order_id) == 'integer') {
        // Order created
        // Create the containers and link their parts to them
        foreach ($_SESSION['cart'] as $i => $container) {
            $id_container = containerController::addContainer($order_id);

            foreach ($container as $i => $product) {
                $partId = partsController::addPart($id_container, $product);

                // Sales (parts)
                if (count($currentSales) > 0) {
                    $appliedSales = $product->isOnSale($currentSales);
                    if (count($appliedSales) > 0) {
                        foreach ($appliedSales as $i => $sale) {
                            salesController::addSalePartRelation($partId, $sale->getId_sale());
                        }
                    }
                }
            }
        }

        // Sales (order)
        if (count($currentSales) > 0) {
            foreach ($currentSales as $i => $sale) {
                if ($sale -> getScope() == 1) {
                    salesController::addSaleOrderRelation($order_id, $sale->getId_sale());
                }
            }
        }

        // Coupons
        if (isset($_SESSION['coupons']) && count($_SESSION['coupons']) > 0) {
            foreach ($_SESSION['coupons'] as $i => $coupon) {
                couponsController::addCouponOrderRelation($order_id, $coupon);
            }
        }

        unset($_SESSION['cart']);
        unset($_SESSION['coupons']);
    } else {
        // Something went wrong
        ?>
        <script>
            bufferedToast = {"text": "Error: <?=$order_id?>", "type": "error"};
        </script>
        <?php
    }
}
?>