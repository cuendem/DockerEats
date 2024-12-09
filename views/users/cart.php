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
    <div class="row">
        <?php if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) { ?>
            <div class="col-md-12 col-lg-7 d-flex flex-column gap-4">
                <div class="containers">
                    <div class="section-title d-flex align-items-center gap-2">
                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M15.5777 3.38197L17.5777 4.43152C19.7294 5.56066 20.8052 6.12523 21.4026 7.13974C22 8.15425 22 9.41667 22 11.9415V12.0585C22 14.5833 22 15.8458 21.4026 16.8603C20.8052 17.8748 19.7294 18.4393 17.5777 19.5685L15.5777 20.618C13.8221 21.5393 12.9443 22 12 22C11.0557 22 10.1779 21.5393 8.42229 20.618L6.42229 19.5685C4.27063 18.4393 3.19479 17.8748 2.5974 16.8603C2 15.8458 2 14.5833 2 12.0585V11.9415C2 9.41667 2 8.15425 2.5974 7.13974C3.19479 6.12523 4.27063 5.56066 6.42229 4.43152L8.42229 3.38197C10.1779 2.46066 11.0557 2 12 2C12.9443 2 13.8221 2.46066 15.5777 3.38197Z" stroke="#1D63ED" stroke-width="1.5" stroke-linecap="round"></path> <path opacity="0.5" d="M21 7.5L12 12M12 12L3 7.5M12 12V21.5" stroke="#1D63ED" stroke-width="1.5" stroke-linecap="round"></path> </g></svg>
                        <h2>Containers</h2>
                    </div>
                    <div class="containers-list d-flex justify-content-center flex-wrap gap-4">
                        <?php foreach ($_SESSION['cart'] as $i => $cart_container) { ?>
                            <div class="container-order d-flex flex-column align-items-end position-relative">
                                <?php $contPrice = 0;
                                foreach (['main', 'branch', 'drink', 'dessert'] as $i => $type) {
                                    $product = $cart_container[$type]; ?>
                                    <div class="<?=$type?> d-flex p-3 gap-3 w-100">
                                        <img src="/img/products/product<?=$product->getId_product()?>.webp" alt="<?=$product->getName()?>">
                                        <div class="content position-relative flex-grow-1">
                                            <?=productsController::getTypeIcon($i+1)?>
                                            <span class="product-name"><?=$product->getName()?></span>
                                            <div class="customs">
                                                
                                            </div>
                                            
                                                <?php $appliedSale = $product->isOnSale($currentSales);
                                                if ($appliedSale) {
                                                    $finalProductPrice = $product->getDiscountedPrice($appliedSale); ?>
                                                    <div class="d-flex align-items-end gap-2 position-absolute bottom-0 end-0">
                                                        <span class="price crossed-out"><?=$product->getPrice()?> €</span>
                                                        <span class="price discounted"><?=$finalProductPrice?> €</span>
                                                    </div>
                                                <?php } else {
                                                    $finalProductPrice = $product->getPrice(); ?>
                                                    <span class="price position-absolute bottom-0 end-0"><?=$finalProductPrice?> €</span>
                                                <?php } $contPrice += $finalProductPrice; ?>
                                        </div>
                                    </div>
                                <?php } ?>
                                <div class="bottom-tag d-flex align-items-center">
                                    <span class="total px-4 py-2"><?=$contPrice?> €</span>
                                    <a href="/build/removefromcart/<?=$i?>" class="container-remove px-3 py-2 bi bi-trash-fill"></a>
                                </div>
                            </div>
                        <?php } ?>
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
                                    <input type="text" id="floor" name="floor" placeholder="Floor..." autocomplete="address-level3">
                                    <input type="text" id="town" name="town" placeholder="Town..." autocomplete="address-level2">
                                </div>
                                <div class="input-container d-flex gap-2">
                                    <input type="text" id="city" name="city" placeholder="City..." autocomplete="address-level1">
                                    <input type="text" id="postalcode" name="postalcode" placeholder="Postal code..." autocomplete="postal-code">
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
                                        <option value="<?=$establishment->getId_establishment()?>"><?=$establishment->getName()?> (<?=$establishment->getAddress()?>)</option>
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
                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path opacity="0.5" d="M9.78133 3.89027C10.3452 3.40974 10.6271 3.16948 10.9219 3.02859C11.6037 2.70271 12.3963 2.70271 13.0781 3.02859C13.3729 3.16948 13.6548 3.40974 14.2187 3.89027C14.4431 4.08152 14.5553 4.17715 14.6752 4.25747C14.9499 4.4416 15.2584 4.56939 15.5828 4.63344C15.7244 4.66139 15.8713 4.67312 16.1653 4.69657C16.9038 4.7555 17.273 4.78497 17.5811 4.89378C18.2936 5.14546 18.8541 5.70591 19.1058 6.41844C19.2146 6.72651 19.244 7.09576 19.303 7.83426C19.3264 8.12819 19.3381 8.27515 19.3661 8.41669C19.4301 8.74114 19.5579 9.04965 19.7421 9.32437C19.8224 9.44421 19.918 9.55642 20.1093 9.78084C20.5898 10.3447 20.8301 10.6267 20.971 10.9214C21.2968 11.6032 21.2968 12.3958 20.971 13.0776C20.8301 13.3724 20.5898 13.6543 20.1093 14.2182C19.918 14.4426 19.8224 14.5548 19.7421 14.6747C19.5579 14.9494 19.4301 15.2579 19.3661 15.5824C19.3381 15.7239 19.3264 15.8709 19.303 16.1648C19.244 16.9033 19.2146 17.2725 19.1058 17.5806C18.8541 18.2931 18.2936 18.8536 17.5811 19.1053C17.273 19.2141 16.9038 19.2435 16.1653 19.3025C15.8713 19.3259 15.7244 19.3377 15.5828 19.3656C15.2584 19.4297 14.9499 19.5574 14.6752 19.7416C14.5553 19.8219 14.4431 19.9175 14.2187 20.1088C13.6548 20.5893 13.3729 20.8296 13.0781 20.9705C12.3963 21.2963 11.6037 21.2963 10.9219 20.9705C10.6271 20.8296 10.3452 20.5893 9.78133 20.1088C9.55691 19.9175 9.44469 19.8219 9.32485 19.7416C9.05014 19.5574 8.74163 19.4297 8.41718 19.3656C8.27564 19.3377 8.12868 19.3259 7.83475 19.3025C7.09625 19.2435 6.72699 19.2141 6.41893 19.1053C5.7064 18.8536 5.14594 18.2931 4.89427 17.5806C4.78546 17.2725 4.75599 16.9033 4.69706 16.1648C4.6736 15.8709 4.66188 15.7239 4.63393 15.5824C4.56988 15.2579 4.44209 14.9494 4.25796 14.6747C4.17764 14.5548 4.08201 14.4426 3.89076 14.2182C3.41023 13.6543 3.16997 13.3724 3.02907 13.0776C2.7032 12.3958 2.7032 11.6032 3.02907 10.9214C3.16997 10.6266 3.41023 10.3447 3.89076 9.78084C4.08201 9.55642 4.17764 9.44421 4.25796 9.32437C4.44209 9.04965 4.56988 8.74114 4.63393 8.41669C4.66188 8.27515 4.6736 8.12819 4.69706 7.83426C4.75599 7.09576 4.78546 6.72651 4.89427 6.41844C5.14594 5.70591 5.7064 5.14546 6.41893 4.89378C6.72699 4.78497 7.09625 4.7555 7.83475 4.69657C8.12868 4.67312 8.27564 4.66139 8.41718 4.63344C8.74163 4.56939 9.05014 4.4416 9.32485 4.25747C9.4447 4.17715 9.55691 4.08152 9.78133 3.89027Z" stroke="#1D63ED" stroke-width="1.5"></path> <path d="M9 15L15 9" stroke="#1D63ED" stroke-width="1.5" stroke-linecap="round"></path> <path d="M15.5 14.5C15.5 15.0523 15.0523 15.5 14.5 15.5C13.9477 15.5 13.5 15.0523 13.5 14.5C13.5 13.9477 13.9477 13.5 14.5 13.5C15.0523 13.5 15.5 13.9477 15.5 14.5Z" fill="#1D63ED"></path> <path d="M10.5 9.5C10.5 10.0523 10.0523 10.5 9.5 10.5C8.94772 10.5 8.5 10.0523 8.5 9.5C8.5 8.94772 8.94772 8.5 9.5 8.5C10.0523 8.5 10.5 8.94772 10.5 9.5Z" fill="#1D63ED"></path> </g></svg>
                        <h2>Coupons</h2>
                    </div>
                    <div class="coupon-container d-flex flex-column align-items-center gap-4 p-3">
                        <div class="d-flex flex-column align-items-center">
                            <span class="lead">Enter a coupon</span>
                            <span class="description">Found one of our coupons? Enter it here to get a neat discount with your order!</span>
                        </div>
                        <form action="" method="post">
                            <input type="text" id="coupon-code" name="coupon-code" placeholder="Coupon...">
                            <input type="submit" value="Redeem">
                        </form>
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
                                            echo $finalProductPrice;
                                            ?> €</span>
                                    </div>
                                <?php } ?>
                                <div class="d-flex justify-content-between align-items-center gap-3">
                                    <span class="container-data d-flex align-items-center">Total</span>
                                    <hr class="flex-grow-1">
                                    <span class="container-data d-flex align-items-center"><?=$contPrice?> €</span>
                                </div>
                            <?php $totalContPrice += $contPrice; } ?>
                            <hr class="my-3">
                            <div class="d-flex justify-content-between align-items-center gap-3">
                                <span class="container-data d-flex align-items-center">All containers</span>
                                <hr class="flex-grow-1">
                                <span class="total-container-price"><?=$totalContPrice?> €</span>
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
                                <?php if (count($currentSales) > 0) { ?>
                                    <span class="added-extras d-flex align-items-center"><?=$currentSales[0]->getSummary()?></span>
                                <?php } else { ?>
                                    <span class="added-extras d-flex align-items-center grayed">No sales applied</span>
                                <?php } ?>
                            </div>
                            <?php if (count($currentSales) > 1) {
                                foreach ($currentSales as $i => $sale) {
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
                                    $totalContPrice = round($totalContPrice*1.08, 2);

                                    // Delivery fee
                                    $totalContPrice += 2.99;

                                    // Apply sales
                                    if (count($currentSales) > 0) {
                                        foreach ($currentSales as $i => $sale) {
                                            if ($sale -> getScope() == 1) {
                                                if ($sale -> getDiscount_type() == 2) {
                                                    // Percentage-based sale
                                                    $totalContPrice = round($totalContPrice*(1 - ($sale->getDiscount() / 100)), 2);
                                                } else {
                                                    // Base-based sale
                                                    $totalContPrice -= $sale->getDiscount();
                                                }
                                            }
                                        }
                                    }

                                    // Apply coupons
                                    if (isset($_SESSION['coupons']) && count($_SESSION['coupons']) > 0) {
                                        foreach ($_SESSION['coupons'] as $i => $coupon) {
                                            if ($coupon -> getDiscount_type() == 2) {
                                                // Percentage-based coupon
                                                $totalContPrice = round($totalContPrice*(1 - ($coupon->getDiscount() / 100)), 2);
                                            } else {
                                                // Base-based coupon
                                                $totalContPrice -= $coupon->getDiscount();
                                            }
                                        }
                                    }

                                    echo $totalContPrice;
                                ?> €</span>
                            </div>
                            <hr class="my-3">
                        </div>
                        <div class="payment-method">
                            <h5>Select payment method</h5>
                            <div class="accordion d-flex flex-column gap-3" id="payment-accordion">
                                <div class="accordion-item">
                                    <h5 class="accordion-header">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#payment-card" aria-expanded="true" aria-controls="payment-card">
                                            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M2 12C2 8.22876 2 6.34315 3.17157 5.17157C4.34315 4 6.22876 4 10 4H14C17.7712 4 19.6569 4 20.8284 5.17157C22 6.34315 22 8.22876 22 12C22 15.7712 22 17.6569 20.8284 18.8284C19.6569 20 17.7712 20 14 20H10C6.22876 20 4.34315 20 3.17157 18.8284C2 17.6569 2 15.7712 2 12Z" stroke="#1D63ED" stroke-width="1.5"></path> <path opacity="0.5" d="M10 16H6" stroke="#1D63ED" stroke-width="1.5" stroke-linecap="round"></path> <path opacity="0.5" d="M14 16H12.5" stroke="#1D63ED" stroke-width="1.5" stroke-linecap="round"></path> <path opacity="0.5" d="M2 10L22 10" stroke="#1D63ED" stroke-width="1.5" stroke-linecap="round"></path> </g></svg>
                                            Credit Card
                                        </button>
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
                                <div class="accordion-item">
                                    <h5 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#payment-paypal" aria-expanded="false" aria-controls="payment-paypal">
                                            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M13 3H7.76556C6.75692 3 5.90612 3.75107 5.78101 4.75193L4.12403 18.0077C4.05817 18.5346 4.46901 19 5 19H6.30575C7.28342 19 8.1178 18.2932 8.27853 17.3288L8.8356 13.9864C8.93047 13.4172 9.42294 13 10 13H13C19 13 19 3 13 3Z" stroke="#1D63ED" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M7.32317 18.7378L7.14142 20.0101C7.06678 20.5326 7.47221 21 8 21V21H9.43845C10.3562 21 11.1561 20.3754 11.3787 19.4851L11.7575 17.9702C11.9 17.4 12.4123 17 13 17V17H16C21.393 17 21.9386 8.92103 17.6368 7.28638" stroke="#1D63ED" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
                                            PayPal
                                        </button>
                                    </h5>
                                    <div id="payment-paypal" class="accordion-collapse collapse" data-bs-parent="#payment-accordion">
                                        <div class="accordion-body">
                                            <span>You will be redirected to PayPal's safe website to fill out your details, then brought back here.</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h5 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#payment-cash" aria-expanded="false" aria-controls="payment-cash">
                                            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M2 10C2 7.17157 2 5.75736 2.87868 4.87868C3.75736 4 5.17157 4 8 4H13C15.8284 4 17.2426 4 18.1213 4.87868C19 5.75736 19 7.17157 19 10C19 12.8284 19 14.2426 18.1213 15.1213C17.2426 16 15.8284 16 13 16H8C5.17157 16 3.75736 16 2.87868 15.1213C2 14.2426 2 12.8284 2 10Z" stroke="#1D63ED" stroke-width="1.5"></path> <path opacity="0.5" d="M19.0003 7.07617C19.9754 7.17208 20.6317 7.38885 21.1216 7.87873C22.0003 8.75741 22.0003 10.1716 22.0003 13.0001C22.0003 15.8285 22.0003 17.2427 21.1216 18.1214C20.2429 19.0001 18.8287 19.0001 16.0003 19.0001H11.0003C8.17187 19.0001 6.75766 19.0001 5.87898 18.1214C5.38909 17.6315 5.17233 16.9751 5.07642 16" stroke="#1D63ED" stroke-width="1.5"></path> <path d="M13 10C13 11.3807 11.8807 12.5 10.5 12.5C9.11929 12.5 8 11.3807 8 10C8 8.61929 9.11929 7.5 10.5 7.5C11.8807 7.5 13 8.61929 13 10Z" stroke="#1D63ED" stroke-width="1.5"></path> <path opacity="0.5" d="M16 12L16 8" stroke="#1D63ED" stroke-width="1.5" stroke-linecap="round"></path> <path opacity="0.5" d="M5 12L5 8" stroke="#1D63ED" stroke-width="1.5" stroke-linecap="round"></path> </g></svg>
                                            Cash
                                        </button>
                                    </h5>
                                    <div id="payment-cash" class="accordion-collapse collapse" data-bs-parent="#payment-accordion">
                                        <div class="accordion-body">
                                            <span>Please have the money ready as soon as possible to ensure a smooth delivery.</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <a href="" id="buy-button" class="btn btn-selected w-100 mt-3">Finish and buy!</a>
                    </div>
                </div>
            </div>
        <?php } else { ?>
            <div class="no-conts d-flex flex-column align-items-center w-100 my-5">
                <span>Your cart has no containers.</span>
                <a href="/build/" class="mt-3 btn btn-selected">Build one now!</a>
            </div>
        <?php } ?>
    </div>
</section>
</main>

<?php include_once('views/footer.php') ?>