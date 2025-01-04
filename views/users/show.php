<?php include_once('views/header.php') ?>
<main>
<section id="banner" class="container-fluid text-center mt-5">
    <div class="row">
        <div class="col d-flex flex-column align-items-center gap-3">
            <img class="pfpbig" src="<?=userController::getPfp($_SESSION['id_user'])?>" alt="<?=$_SESSION['username']?>">
            <h1>Welcome back, <?=$_SESSION['username']?>!</h1>
        </div>
    </div>
</section>
<section id="options" class="container-fluid mt-5">
    <div class="row mt-3 row-gap-4">
        <div class="col-xl-4">
            <a href="/build/" class="panel p-3 d-flex flex-column justify-content-between">
                <div class="d-flex flex-column gap-3">
                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M15.5777 3.38197L17.5777 4.43152C19.7294 5.56066 20.8052 6.12523 21.4026 7.13974C22 8.15425 22 9.41667 22 11.9415V12.0585C22 14.5833 22 15.8458 21.4026 16.8603C20.8052 17.8748 19.7294 18.4393 17.5777 19.5685L15.5777 20.618C13.8221 21.5393 12.9443 22 12 22C11.0557 22 10.1779 21.5393 8.42229 20.618L6.42229 19.5685C4.27063 18.4393 3.19479 17.8748 2.5974 16.8603C2 15.8458 2 14.5833 2 12.0585V11.9415C2 9.41667 2 8.15425 2.5974 7.13974C3.19479 6.12523 4.27063 5.56066 6.42229 4.43152L8.42229 3.38197C10.1779 2.46066 11.0557 2 12 2C12.9443 2 13.8221 2.46066 15.5777 3.38197Z" stroke="#1D63ED" stroke-width="1.5" stroke-linecap="round"></path> <path opacity="0.5" d="M21 7.5L12 12M12 12L3 7.5M12 12V21.5" stroke="#1D63ED" stroke-width="1.5" stroke-linecap="round"></path> </g></svg>
                    <div class="panel-info d-flex flex-column">
                        <span class="panel-title">Build a container</span>
                    </div>
                    <span class="panel-description">Let's get to work and build a container! Are you feeling hungry?</span>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <span class="link-text">Build a container</span>
                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="arrow"><path d="M5 12H19M19 12L12 5M19 12L12 19" stroke="#1D63ED" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                </div>
            </a>
        </div>
        <div class="col-xl-4">
            <a href="/orders/" class="panel p-3 d-flex flex-column justify-content-between">
                <div class="d-flex flex-column gap-3">
                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M7.50626 15.2647C7.61657 15.6639 8.02965 15.8982 8.4289 15.7879C8.82816 15.6776 9.06241 15.2645 8.9521 14.8652L7.50626 15.2647ZM6.07692 7.27442L6.79984 7.0747V7.0747L6.07692 7.27442ZM4.7037 5.91995L4.50319 6.64265L4.7037 5.91995ZM3.20051 4.72457C2.80138 4.61383 2.38804 4.84762 2.2773 5.24675C2.16656 5.64589 2.40035 6.05923 2.79949 6.16997L3.20051 4.72457ZM20.1886 15.7254C20.5895 15.6213 20.8301 15.2118 20.7259 14.8109C20.6217 14.41 20.2123 14.1695 19.8114 14.2737L20.1886 15.7254ZM10.1978 17.5588C10.5074 18.6795 9.82778 19.8618 8.62389 20.1747L9.00118 21.6265C10.9782 21.1127 12.1863 19.1239 11.6436 17.1594L10.1978 17.5588ZM8.62389 20.1747C7.41216 20.4896 6.19622 19.7863 5.88401 18.6562L4.43817 19.0556C4.97829 21.0107 7.03196 22.1383 9.00118 21.6265L8.62389 20.1747ZM5.88401 18.6562C5.57441 17.5355 6.254 16.3532 7.4579 16.0403L7.08061 14.5885C5.10356 15.1023 3.89544 17.0911 4.43817 19.0556L5.88401 18.6562ZM7.4579 16.0403C8.66962 15.7254 9.88556 16.4287 10.1978 17.5588L11.6436 17.1594C11.1035 15.2043 9.04982 14.0768 7.08061 14.5885L7.4579 16.0403ZM8.9521 14.8652L6.79984 7.0747L5.354 7.47414L7.50626 15.2647L8.9521 14.8652ZM4.90421 5.19725L3.20051 4.72457L2.79949 6.16997L4.50319 6.64265L4.90421 5.19725ZM6.79984 7.0747C6.54671 6.15847 5.8211 5.45164 4.90421 5.19725L4.50319 6.64265C4.92878 6.76073 5.24573 7.08223 5.354 7.47414L6.79984 7.0747ZM11.1093 18.085L20.1886 15.7254L19.8114 14.2737L10.732 16.6332L11.1093 18.085Z" fill="#1D63ED"></path> <path opacity="0.5" d="M9.56541 8.73049C9.0804 6.97492 8.8379 6.09714 9.24954 5.40562C9.66119 4.71409 10.5662 4.47889 12.3763 4.00849L14.2962 3.50955C16.1062 3.03915 17.0113 2.80394 17.7242 3.20319C18.4372 3.60244 18.6797 4.48023 19.1647 6.2358L19.6792 8.09786C20.1642 9.85343 20.4067 10.7312 19.995 11.4227C19.5834 12.1143 18.6784 12.3495 16.8683 12.8199L14.9484 13.3188C13.1384 13.7892 12.2333 14.0244 11.5203 13.6252C10.8073 13.2259 10.5648 12.3481 10.0798 10.5926L9.56541 8.73049Z" stroke="#1D63ED" stroke-width="1.5"></path> </g></svg>                    <div class="panel-info d-flex flex-column">
                        <span class="panel-title">See your orders</span>
                    </div>
                    <span class="panel-description">Keep track of your order history! You can even recover an order you already made!</span>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <span class="link-text">See your orders</span>
                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="arrow"><path d="M5 12H19M19 12L12 5M19 12L12 19" stroke="#1D63ED" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                </div>
            </a>
        </div>
        <div class="col-xl-4">
            <a href="/account/edit" class="panel p-3 d-flex flex-column justify-content-between">
                <div class="d-flex flex-column gap-3">
                <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <circle cx="9" cy="9" r="2" stroke="#1D63ED" stroke-width="1.5"></circle> <path d="M13 15C13 16.1046 13 17 9 17C5 17 5 16.1046 5 15C5 13.8954 6.79086 13 9 13C11.2091 13 13 13.8954 13 15Z" stroke="#1D63ED" stroke-width="1.5"></path> <path opacity="0.5" d="M2 12C2 8.22876 2 6.34315 3.17157 5.17157C4.34315 4 6.22876 4 10 4H14C17.7712 4 19.6569 4 20.8284 5.17157C22 6.34315 22 8.22876 22 12C22 15.7712 22 17.6569 20.8284 18.8284C19.6569 20 17.7712 20 14 20H10C6.22876 20 4.34315 20 3.17157 18.8284C2 17.6569 2 15.7712 2 12Z" stroke="#1D63ED" stroke-width="1.5"></path> <path d="M19 12H15" stroke="#1D63ED" stroke-width="1.5" stroke-linecap="round"></path> <path d="M19 9H14" stroke="#1D63ED" stroke-width="1.5" stroke-linecap="round"></path> <path opacity="0.9" d="M19 15H16" stroke="#1D63ED" stroke-width="1.5" stroke-linecap="round"></path> </g></svg>
                    <div class="panel-info d-flex flex-column">
                        <span class="panel-title">Edit your account</span>
                    </div>
                    <span class="panel-description">Change your user information on DockerEats</span>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <span class="link-text">Edit your account</span>
                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="arrow"><path d="M5 12H19M19 12L12 5M19 12L12 19" stroke="#1D63ED" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                </div>
            </a>
        </div>
    </div>
</section>
<section id="last-order" class="container-fluid mt-5">
    <div class="row my-5">
        <div class="col text-center">
            <h2>Your last order</h2>
        </div>
    </div>
    <?php if (count($order) > 0) {
        $order = $order[0];
        $coupons = $order->getCoupons();
        $containers = $order->getContainers();
        $order_sales = $order->getSales(); ?>
        <div class="row">
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
                    $total_order_price = $total_order_price * (1 + tax / 100);

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

                    // Delivery fee
                    if (!is_null($order->getDelivery_address())) {
                        $total_order_price += delivery_tax;
                    }
                ?>
                <span class="price position-absolute bottom-0 end-0 py-2 px-3"><?=number_format(round($total_order_price * 100, 2) / 100, 2)?> €</span>
                <div class="position-absolute bottom-0 end-0 extra-buttons d-flex align-items-center gap-3">
                    <?php if ($order->getId_review()) { ?>
                        <a href="/orders/review/<?=$order->getId_order()?>" class="review-button bi bi-chat-left-text-fill" data-bs-toggle="tooltip" data-bs-custom-class="custom-tooltip" data-bs-title="Update this order's review"></a>
                    <?php } else { ?>
                        <a href="/orders/review/<?=$order->getId_order()?>" class="review-button bi bi-chat-left-text" data-bs-toggle="tooltip" data-bs-custom-class="custom-tooltip" data-bs-title="Create a review for this order"></a>
                    <?php } ?>
                    <a href="/orders/recover/<?=$order->getId_order()?>" class="copy bi bi-copy" data-bs-toggle="tooltip" data-bs-custom-class="custom-tooltip" data-bs-title="Copy this order to cart"></a>
                </div>
            </div>
        </div>
    <?php } else { ?>
        <div class="row">
            <div class="col no-results d-flex flex-column align-items-center my-5">
                <span>You have not made any orders.</span>
            </div>
        </div>
    <?php } ?>
</section>
</main>
<?php include_once('views/footer.php') ?>