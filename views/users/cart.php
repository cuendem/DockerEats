<?php include_once('views/header.php') ?>

<main>
<section id="banner" class="container-fluid text-center mt-5">
    <div class="row">
        <div class="col">
            <h1>Review your order</h1>
        </div>
    </div>
</section>

<section id="order" class="container-fluid">
    <form action="" method="post" class="row">
        <?php if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) { ?>
            <div class="col-md-12 col-lg-7 d-flex flex-column gap-4">
                <div class="containers">
                    <div class="section-title d-flex align-items-center gap-2">
                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M15.5777 3.38197L17.5777 4.43152C19.7294 5.56066 20.8052 6.12523 21.4026 7.13974C22 8.15425 22 9.41667 22 11.9415V12.0585C22 14.5833 22 15.8458 21.4026 16.8603C20.8052 17.8748 19.7294 18.4393 17.5777 19.5685L15.5777 20.618C13.8221 21.5393 12.9443 22 12 22C11.0557 22 10.1779 21.5393 8.42229 20.618L6.42229 19.5685C4.27063 18.4393 3.19479 17.8748 2.5974 16.8603C2 15.8458 2 14.5833 2 12.0585V11.9415C2 9.41667 2 8.15425 2.5974 7.13974C3.19479 6.12523 4.27063 5.56066 6.42229 4.43152L8.42229 3.38197C10.1779 2.46066 11.0557 2 12 2C12.9443 2 13.8221 2.46066 15.5777 3.38197Z" stroke="#1D63ED" stroke-width="1.5" stroke-linecap="round"></path> <path opacity="0.5" d="M21 7.5L12 12M12 12L3 7.5M12 12V21.5" stroke="#1D63ED" stroke-width="1.5" stroke-linecap="round"></path> </g></svg>
                        <h2>Containers</h2>
                    </div>
                    <div class="containers-list d-flex justify-content-center flex-wrap gap-4">
                        <?php $usedSales = [];
                        foreach ($_SESSION['cart'] as $i => $cart_container) { ?>
                            <div class="container-order d-flex flex-column align-items-end position-relative">
                                <div class="container-order-products d-flex flex-column w-100">
                                    <?php $contPrice = 0;
                                    foreach (['main', 'branch', 'drink', 'dessert'] as $j => $type) {
                                        $product = $cart_container[$type]; ?>
                                        <div class="<?=$type?> d-flex p-3 gap-3 w-100">
                                            <img src="/img/products/product<?=$product->getId_product()?>.webp" alt="<?=$product->getName()?>">
                                            <div class="content position-relative flex-grow-1">
                                                <?=productsController::getTypeIcon($j+1)?>
                                                <span class="product-name"><?=$product->getName()?></span>
                                                <div class="customs">
                                                    
                                                </div>
                                                <?php $appliedSale = $product->isOnSale($currentSales);
                                                if ($appliedSale) {
                                                    $finalProductPrice = $product->getDiscountedPrice($appliedSale); ?>
                                                    <div class="d-flex align-items-end gap-2 position-absolute bottom-0 end-0">
                                                        <span class="price crossed-out"><?=number_format($product->getPrice(), 2)?> €</span>
                                                        <span class="price discounted"><?=number_format($finalProductPrice, 2)?> €</span>
                                                    </div>
                                                    <?php
                                                    // Add the sale to the list of used sales in the order
                                                    if (!in_array($appliedSale, $usedSales)) {
                                                        array_push($usedSales, $appliedSale);
                                                    }
                                                    ?>
                                                <?php } else {
                                                    $finalProductPrice = $product->getPrice(); ?>
                                                    <span class="price position-absolute bottom-0 end-0"><?=number_format($finalProductPrice, 2)?> €</span>
                                                <?php } $contPrice += $finalProductPrice; ?>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                                <div class="bottom-tag d-flex align-items-center">
                                    <span class="total px-4 py-2"><?=number_format($contPrice, 2)?> €</span>
                                    <a href="/build/removefromcart/<?=$i?>" class="container-remove px-3 py-2 bi bi-trash-fill d-flex align-items-center h-100"></a>
                                </div>
                            </div>
                        <?php 
                        }
                        // Add order sales to used sales
                        foreach ($currentSales as $sale) {
                            if ($sale->getScope() == 1 && !in_array($sale, $usedSales)) {
                                array_push($usedSales, $sale);
                            }
                        }
                        ?>
                    </div>
                </div>
                <div class="delivery">
                    <div class="section-title d-flex align-items-center gap-2">
                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M7.50626 15.2647C7.61657 15.6639 8.02965 15.8982 8.4289 15.7879C8.82816 15.6776 9.06241 15.2645 8.9521 14.8652L7.50626 15.2647ZM6.07692 7.27442L6.79984 7.0747V7.0747L6.07692 7.27442ZM4.7037 5.91995L4.50319 6.64265L4.7037 5.91995ZM3.20051 4.72457C2.80138 4.61383 2.38804 4.84762 2.2773 5.24675C2.16656 5.64589 2.40035 6.05923 2.79949 6.16997L3.20051 4.72457ZM20.1886 15.7254C20.5895 15.6213 20.8301 15.2118 20.7259 14.8109C20.6217 14.41 20.2123 14.1695 19.8114 14.2737L20.1886 15.7254ZM10.1978 17.5588C10.5074 18.6795 9.82778 19.8618 8.62389 20.1747L9.00118 21.6265C10.9782 21.1127 12.1863 19.1239 11.6436 17.1594L10.1978 17.5588ZM8.62389 20.1747C7.41216 20.4896 6.19622 19.7863 5.88401 18.6562L4.43817 19.0556C4.97829 21.0107 7.03196 22.1383 9.00118 21.6265L8.62389 20.1747ZM5.88401 18.6562C5.57441 17.5355 6.254 16.3532 7.4579 16.0403L7.08061 14.5885C5.10356 15.1023 3.89544 17.0911 4.43817 19.0556L5.88401 18.6562ZM7.4579 16.0403C8.66962 15.7254 9.88556 16.4287 10.1978 17.5588L11.6436 17.1594C11.1035 15.2043 9.04982 14.0768 7.08061 14.5885L7.4579 16.0403ZM8.9521 14.8652L6.79984 7.0747L5.354 7.47414L7.50626 15.2647L8.9521 14.8652ZM4.90421 5.19725L3.20051 4.72457L2.79949 6.16997L4.50319 6.64265L4.90421 5.19725ZM6.79984 7.0747C6.54671 6.15847 5.8211 5.45164 4.90421 5.19725L4.50319 6.64265C4.92878 6.76073 5.24573 7.08223 5.354 7.47414L6.79984 7.0747ZM11.1093 18.085L20.1886 15.7254L19.8114 14.2737L10.732 16.6332L11.1093 18.085Z" fill="#1D63ED"></path> <path opacity="0.5" d="M9.56541 8.73049C9.0804 6.97492 8.8379 6.09714 9.24954 5.40562C9.66119 4.71409 10.5662 4.47889 12.3763 4.00849L14.2962 3.50955C16.1062 3.03915 17.0113 2.80394 17.7242 3.20319C18.4372 3.60244 18.6797 4.48023 19.1647 6.2358L19.6792 8.09786C20.1642 9.85343 20.4067 10.7312 19.995 11.4227C19.5834 12.1143 18.6784 12.3495 16.8683 12.8199L14.9484 13.3188C13.1384 13.7892 12.2333 14.0244 11.5203 13.6252C10.8073 13.2259 10.5648 12.3481 10.0798 10.5926L9.56541 8.73049Z" stroke="#1D63ED" stroke-width="1.5"></path> </g></svg>
                        <h2>Delivery</h2>
                    </div>
                    <div class="deliveries-list d-flex justify-content-center flex-wrap gap-4">
                        <div id="home-delivery" class="delivery-type text-center d-flex flex-column align-items-center justify-content-between gap-4 p-3 selected">
                            <div class="d-flex flex-column align-items-center">
                                <span class="lead">Home Delivery</span>
                                <span class="description">Receive your containers right at your doorstep</span>
                            </div>
                            <div class="inputs d-flex flex-column gap-2">
                                <input type="text" id="address" name="address" placeholder="Address..." autocomplete="street-address">
                                <div class="input-container d-flex gap-2">
                                    <input type="text" id="town" name="town" placeholder="Town..." autocomplete="address-level2">
                                    <input type="text" id="postalcode" name="postalcode" placeholder="Postal code..." autocomplete="postal-code">
                                </div>
                                <div class="input-container d-flex gap-2">
                                    <input type="text" id="city" name="city" placeholder="City..." autocomplete="address-level1">
                                    <input type="text" id="country" name="country" placeholder="Country..." autocomplete="country-name">
                                </div>
                                <input type="text" id="delivery-selected" name="delivery-selected" value="true" hidden>
                            </div>
                            <a href="#" id="select-delivery" class="mb-2 btn btn-selected">Selected</a>
                        </div>
                        <div id="pick-up" class="delivery-type text-center d-flex flex-column align-items-center justify-content-between gap-4 p-3">
                            <div class="d-flex flex-column align-items-center">
                                <span class="lead">Pick Up</span>
                                <span class="description">Come pick up your containers at one of our establishments</span>
                            </div>
                            <div class="inputs d-flex flex-column gap-2">
                                <label for="establishment">Select an establishment:</label>
                                <select id="establishment" name="establishment">
                                    <?php foreach (EstablishmentsDAO::getAll() as $i => $establishment) { ?>
                                        <option value="<?=$establishment->getId_establishment()?>"><?=$establishment->getOverview()?></option>
                                    <?php } ?>
                                </select>
                                <input type="text" id="pickup-selected" name="pickup-selected" value="false" hidden>
                            </div>
                            <a href="#" id="select-pickup" class="mb-2 btn btn-normal">Select</a>
                        </div>
                    </div>
                </div>
                <div class="coupons">
                    <div class="section-title d-flex align-items-center gap-2">
                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path opacity="0.5" d="M4.72848 16.1369C3.18295 14.5914 2.41018 13.8186 2.12264 12.816C1.83509 11.8134 2.08083 10.7485 2.57231 8.61875L2.85574 7.39057C3.26922 5.59881 3.47597 4.70292 4.08944 4.08944C4.70292 3.47597 5.5988 3.26922 7.39057 2.85574L8.61875 2.57231C10.7485 2.08083 11.8134 1.83509 12.816 2.12264C13.8186 2.41018 14.5914 3.18295 16.1369 4.72848L17.9665 6.55812C20.6555 9.24711 22 10.5916 22 12.2623C22 13.933 20.6555 15.2775 17.9665 17.9665C15.2775 20.6555 13.933 22 12.2623 22C10.5916 22 9.24711 20.6555 6.55812 17.9665L4.72848 16.1369Z" stroke="#1D63ED" stroke-width="1.5"></path> <path d="M15.3893 15.3891C15.9751 14.8033 16.0542 13.9327 15.5661 13.4445C15.0779 12.9564 14.2073 13.0355 13.6215 13.6213C13.0358 14.2071 12.1652 14.2863 11.677 13.7981C11.1888 13.3099 11.268 12.4393 11.8538 11.8536M15.3893 15.3891L15.7429 15.7426M15.3893 15.3891C14.9883 15.7901 14.4539 15.9537 14 15.8604M11.5002 11.5L11.8538 11.8536M11.8538 11.8536C12.185 11.5223 12.6073 11.3531 13 11.3568" stroke="#1D63ED" stroke-width="1.5" stroke-linecap="round"></path> <circle cx="8.60699" cy="8.87891" r="2" transform="rotate(-45 8.60699 8.87891)" stroke="#1D63ED" stroke-width="1.5"></circle> </g></svg>
                        <h2>Coupons</h2>
                    </div>
                    <div class="coupon-container d-flex flex-column align-items-center gap-4 p-3">
                        <div class="d-flex flex-column align-items-center">
                            <span class="lead">Enter a coupon</span>
                            <span class="description">Found one of our coupons? Enter it here to get a neat discount with your order!</span>
                        </div>
                        <div>
                            <input type="text" id="coupon-code" name="coupon-code" placeholder="Coupon...">
                            <input type="submit" name="coupon-button" value="Redeem">
                            <input type="submit" class="red" name="clear-coupons-button" value="Clear all coupons">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-lg-5 right">
                <div class="payment d-flex flex-column">
                    <div class="section-title d-flex align-items-center gap-2">
                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M2 10C2 7.17157 2 5.75736 2.87868 4.87868C3.75736 4 5.17157 4 8 4H13C15.8284 4 17.2426 4 18.1213 4.87868C19 5.75736 19 7.17157 19 10C19 12.8284 19 14.2426 18.1213 15.1213C17.2426 16 15.8284 16 13 16H8C5.17157 16 3.75736 16 2.87868 15.1213C2 14.2426 2 12.8284 2 10Z" stroke="#1D63ED" stroke-width="1.5"></path> <path opacity="0.5" d="M19.0003 7.07617C19.9754 7.17208 20.6317 7.38885 21.1216 7.87873C22.0003 8.75741 22.0003 10.1716 22.0003 13.0001C22.0003 15.8285 22.0003 17.2427 21.1216 18.1214C20.2429 19.0001 18.8287 19.0001 16.0003 19.0001H11.0003C8.17187 19.0001 6.75766 19.0001 5.87898 18.1214C5.38909 17.6315 5.17233 16.9751 5.07642 16" stroke="#1D63ED" stroke-width="1.5"></path> <path d="M13 10C13 11.3807 11.8807 12.5 10.5 12.5C9.11929 12.5 8 11.3807 8 10C8 8.61929 9.11929 7.5 10.5 7.5C11.8807 7.5 13 8.61929 13 10Z" stroke="#1D63ED" stroke-width="1.5"></path> <path opacity="0.5" d="M16 12L16 8" stroke="#1D63ED" stroke-width="1.5" stroke-linecap="round"></path> <path opacity="0.5" d="M5 12L5 8" stroke="#1D63ED" stroke-width="1.5" stroke-linecap="round"></path> </g></svg>
                        <h2>Payment</h2>
                    </div>
                    <div class="payment-container d-flex flex-column p-4 gap-4">
                        <div class="bill d-flex flex-column gap-2">
                            <?php $totalContPrice = 0;
                            foreach ($_SESSION['cart'] as $i => $cart_container) { 
                                $contPrice = 0; ?>
                                <div class="d-flex justify-content-between align-items-center gap-3">
                                    <span class="container-data d-flex align-items-center">Container <?=$i+1?></span>
                                    <hr class="flex-grow-1">
                                </div>
                                <?php foreach (['main', 'branch', 'drink', 'dessert'] as $type) {
                                    $product = $cart_container[$type]; ?>
                                    <div class="ms-4 d-flex justify-content-between align-items-center gap-3">
                                        <span class="product-data d-flex align-items-center"><?=$product->getName()?></span>
                                        <hr class="flex-grow-1">
                                        <span class="product-data d-flex align-items-center">
                                            <?php $appliedSale = $product->isOnSale($currentSales);
                                            if ($appliedSale) {
                                                $finalProductPrice = $product->getDiscountedPrice($appliedSale);
                                            } else {
                                                $finalProductPrice = $product->getPrice();
                                            }

                                            $contPrice += $finalProductPrice;
                                            echo number_format($finalProductPrice, 2);
                                            ?> €</span>
                                    </div>
                                <?php } ?>
                                <div class="d-flex justify-content-between align-items-center gap-3">
                                    <span class="container-data d-flex align-items-center">Total</span>
                                    <hr class="flex-grow-1">
                                    <span class="container-data d-flex align-items-center"><?=number_format($contPrice, 2)?> €</span>
                                </div>
                            <?php $totalContPrice += $contPrice; } ?>
                            <hr class="my-3">
                            <div class="d-flex justify-content-between align-items-center gap-3">
                                <span class="container-data d-flex align-items-center">All containers</span>
                                <hr class="flex-grow-1">
                                <span class="total-container-price"><?=number_format($totalContPrice, 2)?> €</span>
                            </div>
                            <div class="w-75 align-self-end d-flex justify-content-between align-items-center gap-3">
                                <span class="added-extras d-flex align-items-center">Taxes</span>
                                <hr class="flex-grow-1">
                                <span class="added-extras d-flex align-items-center">8%</span>
                            </div>
                            <div id="delivery-fee" class="w-75 align-self-end d-flex justify-content-between align-items-center gap-3">
                                <span class="added-extras d-flex align-items-center">Delivery Fee</span>
                                <hr class="flex-grow-1">
                                <span class="added-extras d-flex align-items-center">2.99 €</span>
                            </div>
                            <div class="w-75 align-self-end d-flex justify-content-between align-items-center gap-3">
                                <span class="added-extras d-flex align-items-center">Sales</span>
                                <hr class="flex-grow-1">
                                <?php if (count($usedSales) > 0) { ?>
                                    <span class="added-extras d-flex align-items-center"><?=$usedSales[0]->getSummary()?></span>
                                <?php } else { ?>
                                    <span class="added-extras d-flex align-items-center grayed">No sales applied</span>
                                <?php } ?>
                            </div>
                            <?php if (count($usedSales) > 1) {
                                foreach ($usedSales as $i => $sale) {
                                    if ($i != 0) { ?>
                                        <div class="w-75 align-self-end d-flex justify-content-between align-items-center gap-3">
                                            <div></div>
                                            <span class="added-extras d-flex align-items-center"><?=$sale->getSummary()?></span>
                                        </div>
                                    <?php }
                                }
                            } ?>
                            <div class="w-75 align-self-end d-flex justify-content-between align-items-center gap-3">
                                <span class="added-extras d-flex align-items-center">Coupons</span>
                                <hr class="flex-grow-1">
                                <?php if (isset($_SESSION['coupons']) && count($_SESSION['coupons']) > 0) { ?>
                                    <span class="added-extras d-flex align-items-center"><?=$_SESSION['coupons'][0]->getSummary()?></span>
                                <?php } else { ?>
                                    <span class="added-extras d-flex align-items-center grayed">No coupons used</span>
                                <?php } ?>
                            </div>
                            <?php if (isset($_SESSION['coupons']) && count($_SESSION['coupons']) > 1) {
                                foreach ($_SESSION['coupons'] as $i => $coupon) {
                                    if ($i != 0) { ?>
                                        <div class="w-75 align-self-end d-flex justify-content-between align-items-center gap-3">
                                            <div></div>
                                            <span class="added-extras d-flex align-items-center"><?=$coupon->getSummary()?></span>
                                        </div>
                                    <?php }
                                }
                            } ?>
                            <hr class="my-3">
                            <div class="d-flex justify-content-between align-items-center gap-3">
                                <span class="total-price d-flex align-items-center">TOTAL</span>
                                <hr class="flex-grow-1">
                                <span id="total-price" class="total-price align-self-end"><?php
                                    // Apply taxes
                                    $totalContPrice = $totalContPrice*1.08;

                                    // Delivery fee
                                    $totalContPrice += 2.99;

                                    // Apply sales
                                    if (count($usedSales) > 0) {
                                        $ordered_sales = Discount::order($usedSales);
                                        foreach ($ordered_sales as $i => $sale) {
                                            if ($sale -> getScope() == 1) {
                                                if ($sale -> getDiscount_type() == 2) {
                                                    // Percentage-based sale
                                                    $totalContPrice = $totalContPrice*(1 - ($sale->getDiscount() / 100));
                                                } else {
                                                    // Base-based sale
                                                    $totalContPrice -= $sale->getDiscount();
                                                }
                                            }
                                        }
                                    }

                                    // Apply coupons
                                    if (isset($_SESSION['coupons']) && count($_SESSION['coupons']) > 0) {
                                        $ordered_coupons = Discount::order($_SESSION['coupons']);
                                        foreach ($ordered_coupons as $i => $coupon) {
                                            if ($coupon -> getDiscount_type() == 2) {
                                                // Percentage-based coupon
                                                $totalContPrice = $totalContPrice*(1 - ($coupon->getDiscount() / 100));
                                            } else {
                                                // Base-based coupon
                                                $totalContPrice -= $coupon->getDiscount();
                                            }
                                        }
                                    }

                                    echo number_format(round($totalContPrice * 100) / 100, 2);
                                ?> €</span>
                            </div>
                            <hr class="my-3">
                        </div>
                        <div>
                            <h5>Select payment method</h5>
                            <div class="accordion d-flex flex-column gap-3" id="payment-accordion">
                                <!-- Credit Card Option -->
                                <div class="accordion-item">
                                    <h5 class="accordion-header">
                                        <input type="radio" name="payment-method" id="payment-card-radio" value="Card" class="d-none" checked>
                                        <label for="payment-card-radio" class="accordion-button" data-bs-toggle="collapse" data-bs-target="#payment-card" aria-expanded="true" aria-controls="payment-card">
                                            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M2 12C2 8.22876 2 6.34315 3.17157 5.17157C4.34315 4 6.22876 4 10 4H14C17.7712 4 19.6569 4 20.8284 5.17157C22 6.34315 22 8.22876 22 12C22 15.7712 22 17.6569 20.8284 18.8284C19.6569 20 17.7712 20 14 20H10C6.22876 20 4.34315 20 3.17157 18.8284C2 17.6569 2 15.7712 2 12Z" stroke="#1D63ED" stroke-width="1.5"></path><path opacity="0.5" d="M10 16H6" stroke="#1D63ED" stroke-width="1.5" stroke-linecap="round"></path><path opacity="0.5" d="M14 16H12.5" stroke="#1D63ED" stroke-width="1.5" stroke-linecap="round"></path><path opacity="0.5" d="M2 10L22 10" stroke="#1D63ED" stroke-width="1.5" stroke-linecap="round"></path></svg>
                                            Credit Card
                                        </label>
                                    </h5>
                                    <div id="payment-card" class="accordion-collapse collapse show" data-bs-parent="#payment-accordion">
                                        <div class="accordion-body">
                                            <div class="inputs d-flex flex-column gap-2">
                                                <input type="number" id="cardnumber" name="cardnumber" placeholder="Card number...">
                                                <div class="input-container d-flex gap-2">
                                                    <input type="text" id="expirationdate" name="expirationdate" placeholder="Expiration Date...">
                                                    <input type="number" id="cvc" name="cvc" placeholder="CVC...">
                                                </div>
                                                <input type="text" id="cardholder" name="cardholder" placeholder="Card holder...">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- PayPal Option -->
                                <div class="accordion-item">
                                    <h5 class="accordion-header">
                                        <input type="radio" name="payment-method" id="payment-paypal-radio" value="PayPal" class="d-none">
                                        <label for="payment-paypal-radio" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#payment-paypal" aria-expanded="false" aria-controls="payment-paypal">
                                            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M13 3H7.76556C6.75692 3 5.90612 3.75107 5.78101 4.75193L4.12403 18.0077C4.05817 18.5346 4.46901 19 5 19H6.30575C7.28342 19 8.1178 18.2932 8.27853 17.3288L8.8356 13.9864C8.93047 13.4172 9.42294 13 10 13H13C19 13 19 3 13 3Z" stroke="#1D63ED" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path><path d="M7.32317 18.7378L7.14142 20.0101C7.06678 20.5326 7.47221 21 8 21H9.43845C10.3562 21 11.1561 20.3754 11.3787 19.4851L11.7575 17.9702C11.9 17.4 12.4123 17 13 17H16C21.393 17 21.9386 8.92103 17.6368 7.28638" stroke="#1D63ED" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                                            PayPal
                                        </label>
                                    </h5>
                                    <div id="payment-paypal" class="accordion-collapse collapse" data-bs-parent="#payment-accordion">
                                        <div class="accordion-body">
                                            <span>You will be redirected to PayPal's safe website to fill out your details, then brought back here.</span>
                                        </div>
                                    </div>
                                </div>
                                <!-- Cash Option -->
                                <div class="accordion-item">
                                    <h5 class="accordion-header">
                                        <input type="radio" name="payment-method" id="payment-cash-radio" value="Cash" class="d-none">
                                        <label for="payment-cash-radio" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#payment-cash" aria-expanded="false" aria-controls="payment-cash">
                                            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M2 10C2 7.17157 2 5.75736 2.87868 4.87868C3.75736 4 5.17157 4 8 4H13C15.8284 4 17.2426 4 18.1213 4.87868C19 5.75736 19 7.17157 19 10C19 12.8284 19 14.2426 18.1213 15.1213C17.2426 16 15.8284 16 13 16H8C5.17157 16 3.75736 16 2.87868 15.1213C2 14.2426 2 12.8284 2 10Z" stroke="#1D63ED" stroke-width="1.5"></path> <path opacity="0.5" d="M19.0003 7.07617C19.9754 7.17208 20.6317 7.38885 21.1216 7.87873C22.0003 8.75741 22.0003 10.1716 22.0003 13.0001C22.0003 15.8285 22.0003 17.2427 21.1216 18.1214C20.2429 19.0001 18.8287 19.0001 16.0003 19.0001H11.0003C8.17187 19.0001 6.75766 19.0001 5.87898 18.1214C5.38909 17.6315 5.17233 16.9751 5.07642 16" stroke="#1D63ED" stroke-width="1.5"></path> <path d="M13 10C13 11.3807 11.8807 12.5 10.5 12.5C9.11929 12.5 8 11.3807 8 10C8 8.61929 9.11929 7.5 10.5 7.5C11.8807 7.5 13 8.61929 13 10Z" stroke="#1D63ED" stroke-width="1.5"></path> <path opacity="0.5" d="M16 12L16 8" stroke="#1D63ED" stroke-width="1.5" stroke-linecap="round"></path> <path opacity="0.5" d="M5 12L5 8" stroke="#1D63ED" stroke-width="1.5" stroke-linecap="round"></path> </g></svg>
                                            Cash
                                        </label>
                                    </h5>
                                    <div id="payment-cash" class="accordion-collapse collapse" data-bs-parent="#payment-accordion">
                                        <div class="accordion-body">
                                            <span>Please have the money ready as soon as possible to ensure a smooth delivery.</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input type="submit" name="buy-button" id="buy-button" class="btn btn-selected w-100 mt-3" value="Finish and buy!">
                    </div>
                </div>
            </div>
        <?php } else { ?>
            <div class="no-results d-flex flex-column align-items-center w-100 my-5">
                <span>Your cart has no containers.</span>
                <a href="/build/" class="mt-3 btn btn-selected">Build one now!</a>
            </div>
        <?php } ?>
    </form>
</section>
</main>

<?php include_once('views/footer.php') ?>