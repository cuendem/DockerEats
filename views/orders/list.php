<?php include_once('views/header.php') ?>
<main>
<section id="banner" class="container-fluid text-center py-5">
    <h1>Orders</h1>
</section>
<section id="list" class="wave-separator container-fluid pt-5">
    <?php if (count($orders) <= 0) { ?>
        <div class="no-results d-flex flex-column align-items-center w-100 my-5">
            <span>You have not made any orders.</span>
        </div>
    <?php } else { foreach ($orders as $i => $order) {
        $coupons = $order->getCoupons();
        $containers = $order->getContainers();
        $order_sales = $order->getSales(); ?>
        <div class="row mb-5">
            <div class="order p-3 col-12 position-relative">
                <div class="userdata d-flex position-absolute top-0 start-0">
                    <img src="<?=userController::getPfp($order->getId_user())?>" alt="<?=$order->getUsername()?>">
                    <div class="userdatatext d-flex flex-column">
                        <span class="date"><?=$order->getDate()?></span>
                        <span class="username"><?=$order->getUsername()?></span>
                    </div>
                </div>
                <div class="orderpills p-3 d-flex gap-3 position-absolute top-0 end-0 d-none d-xl-flex">
                    <div class="orderpill d-flex align-items-center gap-1 px-3 py-2" data-bs-toggle="tooltip" data-bs-custom-class="custom-tooltip" data-bs-placement="bottom" data-bs-title="<?=$order->getDeliveryData()[2]?>">
                        <?=$order->getDeliveryData()[1]?>
                        <span class="flex-grow-1"><?=$order->getDeliveryData()[0]?></span>
                    </div>
                    <div class="orderpill d-flex align-items-center gap-1 px-3 py-2">
                        <?=$order->getPaymentData()[1]?>
                        <span class="flex-grow-1"><?=$order->getPaymentData()[0]?></span>
                    </div>
                    <?php if (count($coupons) > 0) { ?>
                        <div class="orderpill d-flex align-items-center gap-1 px-3 py-2" data-bs-toggle="tooltip" data-bs-custom-class="custom-tooltip" data-bs-placement="bottom" data-bs-title="<?php foreach ($coupons as $i => $coupon) {
                            echo $coupon->getSummary();
                            if ($i+1 != count($coupons)) {
                                echo ', ';
                            }
                        } ?>">
                            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path opacity="0.5" d="M4.72848 16.1369C3.18295 14.5914 2.41018 13.8186 2.12264 12.816C1.83509 11.8134 2.08083 10.7485 2.57231 8.61875L2.85574 7.39057C3.26922 5.59881 3.47597 4.70292 4.08944 4.08944C4.70292 3.47597 5.5988 3.26922 7.39057 2.85574L8.61875 2.57231C10.7485 2.08083 11.8134 1.83509 12.816 2.12264C13.8186 2.41018 14.5914 3.18295 16.1369 4.72848L17.9665 6.55812C20.6555 9.24711 22 10.5916 22 12.2623C22 13.933 20.6555 15.2775 17.9665 17.9665C15.2775 20.6555 13.933 22 12.2623 22C10.5916 22 9.24711 20.6555 6.55812 17.9665L4.72848 16.1369Z" stroke="#1D63ED" stroke-width="1.5"></path> <path d="M15.3893 15.3891C15.9751 14.8033 16.0542 13.9327 15.5661 13.4445C15.0779 12.9564 14.2073 13.0355 13.6215 13.6213C13.0358 14.2071 12.1652 14.2863 11.677 13.7981C11.1888 13.3099 11.268 12.4393 11.8538 11.8536M15.3893 15.3891L15.7429 15.7426M15.3893 15.3891C14.9883 15.7901 14.4539 15.9537 14 15.8604M11.5002 11.5L11.8538 11.8536M11.8538 11.8536C12.185 11.5223 12.6073 11.3531 13 11.3568" stroke="#1D63ED" stroke-width="1.5" stroke-linecap="round"></path> <circle cx="8.60699" cy="8.87891" r="2" transform="rotate(-45 8.60699 8.87891)" stroke="#1D63ED" stroke-width="1.5"></circle> </g></svg>
                            <span class="flex-grow-1"><?=count($coupons)?> Coupon<?=count($coupons) > 1 ? 's' : '' ?></span>
                        </div>
                    <?php } ?>
                </div>
                <div class="orderbottom d-flex gap-3 flex-wrap">
                    <?php $total_order_price = 0;
                    foreach ($containers as $i => $container) {
                        $container_price = $container->getPrice($order_sales);
                        $main = $container->getPart(1, true);
                        $branch = $container->getPart(2, true);
                        $drink = $container->getPart(3, true);
                        $dessert = $container->getPart(4, true) ?>
                        <div class="ordercontainer container m-0" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="custom-tooltip" data-bs-title="Total: <?=number_format($container_price, 2)?> €">
                            <div class="row row-cols-2">
                                <img class="dessert col p-0" src="/img/products/product<?=$dessert->getId_product()?>.webp" alt="<?=$dessert->getName()?>">
                                <img class="drink col p-0" src="/img/products/product<?=$drink->getId_product()?>.webp" alt="<?=$drink->getName()?>">
                                <img class="main col p-0" src="/img/products/product<?=$main->getId_product()?>.webp" alt="<?=$main->getName()?>">
                                <img class="branch col p-0" src="/img/products/product<?=$branch->getId_product()?>.webp" alt="<?=$branch->getName()?>">
                            </div>
                        </div>
                    <?php $total_order_price += $container_price;
                    } ?>
                </div>
                <?php
                    // Calculate total price with sales and coupons
                    // Apply taxes
                    $total_order_price = $total_order_price*1.08;

                    // Delivery fee
                    if (!is_null($order->getDelivery_address())) {
                        $total_order_price += 2.99;
                    }

                    // Apply sales
                    if (count($order_sales) > 0) {
                        $ordered_sales = Discount::order($order_sales);
                        foreach ($ordered_sales as $i => $sale) {
                            if ($sale -> getScope() == 1) {
                                if ($sale -> getDiscount_type() == 2) {
                                    // Percentage-based sale
                                    $total_order_price = $total_order_price*(1 - ($sale->getDiscount() / 100));
                                } else {
                                    // Base-based sale
                                    $total_order_price -= $sale->getDiscount();
                                }
                            }
                        }
                    }

                    // Apply coupons
                    if (count($coupons) > 0) {
                        $ordered_coupons = Discount::order($coupons);
                        foreach ($ordered_coupons as $i => $coupon) {
                            if ($coupon -> getDiscount_type() == 2) {
                                // Percentage-based coupon
                                $total_order_price = $total_order_price*(1 - ($coupon->getDiscount() / 100));
                            } else {
                                // Base-based coupon
                                $total_order_price -= $coupon->getDiscount();
                            }
                        }
                    }
                ?>
                <span class="price position-absolute bottom-0 end-0 py-2 px-3"><?=number_format(round($total_order_price * 100, 2) / 100, 2)?> €</span>
                <a href="/orders/recover/<?=$order->getId_order()?>" class="copy position-absolute bottom-0 end-0 bi bi-copy" data-bs-toggle="tooltip" data-bs-custom-class="custom-tooltip" data-bs-title="Copy this order to cart"></a>
            </div>
        </div>
    <?php }} ?>
</section>
</main>
<?php include_once('views/footer.php') ?>