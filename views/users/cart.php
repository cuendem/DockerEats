<?php include_once('views/header.php') ?>

<main>
<section id="banner" class="container-fluid text-center mt-5">
    <div class="row">
        <div class="col">
            <h1>Review your order</h1>
        </div>
    </div>
</section>

<section id="order" class="container-fluid px-5">
    <div class="row">
        <div class="col-md-12 col-lg-7">
            <div class="containers">
                <div class="section-title d-flex align-items-center gap-2">
                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M15.5777 3.38197L17.5777 4.43152C19.7294 5.56066 20.8052 6.12523 21.4026 7.13974C22 8.15425 22 9.41667 22 11.9415V12.0585C22 14.5833 22 15.8458 21.4026 16.8603C20.8052 17.8748 19.7294 18.4393 17.5777 19.5685L15.5777 20.618C13.8221 21.5393 12.9443 22 12 22C11.0557 22 10.1779 21.5393 8.42229 20.618L6.42229 19.5685C4.27063 18.4393 3.19479 17.8748 2.5974 16.8603C2 15.8458 2 14.5833 2 12.0585V11.9415C2 9.41667 2 8.15425 2.5974 7.13974C3.19479 6.12523 4.27063 5.56066 6.42229 4.43152L8.42229 3.38197C10.1779 2.46066 11.0557 2 12 2C12.9443 2 13.8221 2.46066 15.5777 3.38197Z" stroke="#1D63ED" stroke-width="1.5" stroke-linecap="round"></path> <path opacity="0.5" d="M21 7.5L12 12M12 12L3 7.5M12 12V21.5" stroke="#1D63ED" stroke-width="1.5" stroke-linecap="round"></path> </g></svg>
                    <h2>Containers</h2>
                </div>
                <div class="containers-list d-flex justify-content-between flex-wrap row-gap-4">
                    <?php if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
                        foreach ($_SESSION['cart'] as $i => $cart_container) { ?>
                            <div class="container-order d-flex flex-column align-items-end position-relative">
                                <div class="container-order-products w-100">
                                    <div class="main d-flex p-3 gap-2 w-100">
                                        <img src="/img/products/product<?=$cart_container['main']->getId_product()?>.webp" alt="<?=$cart_container['main']->getName()?>">
                                        <div class="content position-relative flex-grow-1">
                                            <?=productsController::getTypeIcon(1)?>
                                            <span class="product-name"><?=$cart_container['main']->getName()?></span>
                                            <div class="customs">

                                            </div>
                                            <span class="price position-absolute bottom-0 end-0"><?=$cart_container['main']->getPrice()?> €</span>
                                        </div>
                                    </div>
                                    <div class="branch d-flex p-3 gap-2 w-100">
                                        <img src="/img/products/product<?=$cart_container['branch']->getId_product()?>.webp" alt="<?=$cart_container['branch']->getName()?>">
                                        <div class="content position-relative flex-grow-1">
                                            <?=productsController::getTypeIcon(2)?>
                                            <span class="product-name"><?=$cart_container['branch']->getName()?></span>
                                            <div class="customs">

                                            </div>
                                            <span class="price position-absolute bottom-0 end-0"><?=$cart_container['branch']->getPrice()?> €</span>
                                        </div>
                                    </div>
                                    <div class="drink d-flex p-3 gap-2 w-100">
                                        <img src="/img/products/product<?=$cart_container['drink']->getId_product()?>.webp" alt="<?=$cart_container['drink']->getName()?>">
                                        <div class="content position-relative flex-grow-1">
                                            <?=productsController::getTypeIcon(3)?>
                                            <span class="product-name"><?=$cart_container['drink']->getName()?></span>
                                            <div class="customs">

                                            </div>
                                            <span class="price position-absolute bottom-0 end-0"><?=$cart_container['drink']->getPrice()?> €</span>
                                        </div>
                                    </div>
                                    <div class="dessert d-flex p-3 gap-2 w-100">
                                        <img src="/img/products/product<?=$cart_container['dessert']->getId_product()?>.webp" alt="<?=$cart_container['dessert']->getName()?>">
                                        <div class="content position-relative flex-grow-1">
                                            <?=productsController::getTypeIcon(4)?>
                                            <span class="product-name"><?=$cart_container['dessert']->getName()?></span>
                                            <div class="customs">

                                            </div>
                                            <span class="price position-absolute bottom-0 end-0"><?=$cart_container['dessert']->getPrice()?> €</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="bottom-tag d-flex align-items-center">
                                    <span class="total px-4 py-2"><?=$cart_container['main']->getPrice()+$cart_container['branch']->getPrice()+$cart_container['drink']->getPrice()+$cart_container['dessert']->getPrice()?> €</span>
                                    <a href="/build/removefromcart/<?=$i?>" class="container-remove px-3 py-2 bi bi-trash-fill"></a>
                                </div>
                            </div>
                        <?php }
                    } else { ?>
                        <div class="no-conts d-flex flex-column align-items-center w-100 my-5">
                            <span>Your cart has no containers.</span>
                            <a href="/build/" class="mt-3 mx-2 btn btn-selected">Build one now!</a>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <div class="delivery">
                <div class="section-title d-flex align-items-center gap-2">
                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M7.50626 15.2647C7.61657 15.6639 8.02965 15.8982 8.4289 15.7879C8.82816 15.6776 9.06241 15.2645 8.9521 14.8652L7.50626 15.2647ZM6.07692 7.27442L6.79984 7.0747V7.0747L6.07692 7.27442ZM4.7037 5.91995L4.50319 6.64265L4.7037 5.91995ZM3.20051 4.72457C2.80138 4.61383 2.38804 4.84762 2.2773 5.24675C2.16656 5.64589 2.40035 6.05923 2.79949 6.16997L3.20051 4.72457ZM20.1886 15.7254C20.5895 15.6213 20.8301 15.2118 20.7259 14.8109C20.6217 14.41 20.2123 14.1695 19.8114 14.2737L20.1886 15.7254ZM10.1978 17.5588C10.5074 18.6795 9.82778 19.8618 8.62389 20.1747L9.00118 21.6265C10.9782 21.1127 12.1863 19.1239 11.6436 17.1594L10.1978 17.5588ZM8.62389 20.1747C7.41216 20.4896 6.19622 19.7863 5.88401 18.6562L4.43817 19.0556C4.97829 21.0107 7.03196 22.1383 9.00118 21.6265L8.62389 20.1747ZM5.88401 18.6562C5.57441 17.5355 6.254 16.3532 7.4579 16.0403L7.08061 14.5885C5.10356 15.1023 3.89544 17.0911 4.43817 19.0556L5.88401 18.6562ZM7.4579 16.0403C8.66962 15.7254 9.88556 16.4287 10.1978 17.5588L11.6436 17.1594C11.1035 15.2043 9.04982 14.0768 7.08061 14.5885L7.4579 16.0403ZM8.9521 14.8652L6.79984 7.0747L5.354 7.47414L7.50626 15.2647L8.9521 14.8652ZM4.90421 5.19725L3.20051 4.72457L2.79949 6.16997L4.50319 6.64265L4.90421 5.19725ZM6.79984 7.0747C6.54671 6.15847 5.8211 5.45164 4.90421 5.19725L4.50319 6.64265C4.92878 6.76073 5.24573 7.08223 5.354 7.47414L6.79984 7.0747ZM11.1093 18.085L20.1886 15.7254L19.8114 14.2737L10.732 16.6332L11.1093 18.085Z" fill="#1D63ED"></path> <path opacity="0.5" d="M9.56541 8.73049C9.0804 6.97492 8.8379 6.09714 9.24954 5.40562C9.66119 4.71409 10.5662 4.47889 12.3763 4.00849L14.2962 3.50955C16.1062 3.03915 17.0113 2.80394 17.7242 3.20319C18.4372 3.60244 18.6797 4.48023 19.1647 6.2358L19.6792 8.09786C20.1642 9.85343 20.4067 10.7312 19.995 11.4227C19.5834 12.1143 18.6784 12.3495 16.8683 12.8199L14.9484 13.3188C13.1384 13.7892 12.2333 14.0244 11.5203 13.6252C10.8073 13.2259 10.5648 12.3481 10.0798 10.5926L9.56541 8.73049Z" stroke="#1D63ED" stroke-width="1.5"></path> </g></svg>
                    <h2>Delivery</h2>
                </div>
            </div>
        </div>
        <div class="col-md-12 col-lg-5 right">
            <div class="payment">
                <div class="section-title d-flex align-items-center gap-2">
                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M2 10C2 7.17157 2 5.75736 2.87868 4.87868C3.75736 4 5.17157 4 8 4H13C15.8284 4 17.2426 4 18.1213 4.87868C19 5.75736 19 7.17157 19 10C19 12.8284 19 14.2426 18.1213 15.1213C17.2426 16 15.8284 16 13 16H8C5.17157 16 3.75736 16 2.87868 15.1213C2 14.2426 2 12.8284 2 10Z" stroke="#1D63ED" stroke-width="1.5"></path> <path opacity="0.5" d="M19.0003 7.07617C19.9754 7.17208 20.6317 7.38885 21.1216 7.87873C22.0003 8.75741 22.0003 10.1716 22.0003 13.0001C22.0003 15.8285 22.0003 17.2427 21.1216 18.1214C20.2429 19.0001 18.8287 19.0001 16.0003 19.0001H11.0003C8.17187 19.0001 6.75766 19.0001 5.87898 18.1214C5.38909 17.6315 5.17233 16.9751 5.07642 16" stroke="#1D63ED" stroke-width="1.5"></path> <path d="M13 10C13 11.3807 11.8807 12.5 10.5 12.5C9.11929 12.5 8 11.3807 8 10C8 8.61929 9.11929 7.5 10.5 7.5C11.8807 7.5 13 8.61929 13 10Z" stroke="#1D63ED" stroke-width="1.5"></path> <path opacity="0.5" d="M16 12L16 8" stroke="#1D63ED" stroke-width="1.5" stroke-linecap="round"></path> <path opacity="0.5" d="M5 12L5 8" stroke="#1D63ED" stroke-width="1.5" stroke-linecap="round"></path> </g></svg>
                    <h2>Payment</h2>
                </div>
            </div>
        </div>
    </div>
</section>
</main>

<?php include_once('views/footer.php') ?>