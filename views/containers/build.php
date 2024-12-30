<?php include_once('views/header.php') ?>

<main>
<section id="banner" class="container-fluid text-center mt-5">
    <div class="row">
        <div class="col">
            <h1>Build your container!</h1>
            <p class="lead mt-4 col-lg-6 mx-auto">Choose a main, a branch, a drink and a dessert, customize them however you'd like, then add it to your cart!</p>
            <p class="my-3">
                <a href="addtocart" class="mt-3 mx-2 btn btn-selected">Add container to cart</a>
                <a href="lucky" class="mt-3 mx-2 btn btn-normal">I'm feeling lucky</a>
            </p>
        </div>
    </div>
</section>

<section id="container" class="container-fluid text-center mt-3">
    <div class="row px-3">
        <div id="container-graph" class="col-md-8 col-lg-6 mx-auto container-fluid position-relative">
            <img class="position-absolute top-50 start-50 translate-middle w-75 z-0 undraggable" src="/svg/IconDockerEatsWhite.svg" alt="DockerEats">
            <div id="container-top" class="row position-relative z-1">
                <div id="container-dessert" class="col-8 d-flex justify-content-center align-items-center">
                    <?php if (isset($_SESSION['container']['dessert'])) { ?>
                        <div class="position-relative">
                            <img id="build-dessert" class="selected-product" src="/img/products/product<?=$_SESSION['container']['dessert']->getId_product()?>.webp" alt="<?=$_SESSION['container']['dessert']->getName()?>">
                            <a href="/build/remove/dessert" class="selected-product-remove bi bi-x-circle-fill position-absolute top-0 start-100"></a>
                        </div>
                    <?php } ?>
                        <button id="build-dessert" class="typeicon <?=isset($_SESSION['container']['dessert']) ? 'hidden' : ''?>"><?=productsController::getTypeIcon(4)?></button>
                </div>
                <div id="container-drink" class="col-4 d-flex justify-content-center align-items-center">
                    <?php if (isset($_SESSION['container']['drink'])) { ?>
                        <div class="position-relative">
                            <img id="build-drink" class="selected-product" src="/img/products/product<?=$_SESSION['container']['drink']->getId_product()?>.webp" alt="<?=$_SESSION['container']['drink']->getName()?>">
                            <a href="/build/remove/drink" class="selected-product-remove bi bi-x-circle-fill position-absolute top-0 start-100"></a>
                        </div>
                    <?php } ?>
                        <button id="build-drink" class="typeicon <?=isset($_SESSION['container']['drink']) ? 'hidden' : ''?>"><?=productsController::getTypeIcon(3)?></button>
                </div>
            </div>
            <div id="container-bottom" class="row position-relative z-1">
                <div id="container-main" class="col-8 d-flex justify-content-center align-items-center">
                    <?php if (isset($_SESSION['container']['main'])) { ?>
                        <div class="position-relative">
                            <img id="build-main" class="selected-product" src="/img/products/product<?=$_SESSION['container']['main']->getId_product()?>.webp" alt="<?=$_SESSION['container']['main']->getName()?>">
                            <a href="/build/remove/main" class="selected-product-remove bi bi-x-circle-fill position-absolute top-0 start-100"></a>
                        </div>
                    <?php } ?>
                        <button id="build-main" class="typeicon <?=isset($_SESSION['container']['main']) ? 'hidden' : ''?>"><?=productsController::getTypeIcon(1)?></button>
                </div>
                <div id="container-branch" class="col-4 d-flex justify-content-center align-items-center">
                    <?php if (isset($_SESSION['container']['branch'])) { ?>
                        <div class="position-relative">
                            <img id="build-branch" class="selected-product" src="/img/products/product<?=$_SESSION['container']['branch']->getId_product()?>.webp" alt="<?=$_SESSION['container']['branch']->getName()?>">
                            <a href="/build/remove/branch" class="selected-product-remove bi bi-x-circle-fill position-absolute top-0 start-100"></a>
                        </div>
                    <?php } ?>
                        <button id="build-branch" class="typeicon <?=isset($_SESSION['container']['branch']) ? 'hidden' : ''?>"><?=productsController::getTypeIcon(2)?></button>
                </div>
            </div>
        </div>
    </div>
    <div class="row px-3">
        <div class="col-md-8 col-lg-6 mx-auto">
            <a href="/build/remove/all" class="mt-3 mx-2 btn btn-warning">Clear container</a>
        </div>
    </div>
</section>

<section id="building" class="container-fluid wave-separator">
    <div class="row">
        <h2>Building a container</h2>
        <h3>Click, pick, tweak.<br>It's never been easier.</h3>
    </div>
    <div class="row mt-3 g-5">
        <div class="col-xl-4">
            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M15.5777 3.38197L17.5777 4.43152C19.7294 5.56066 20.8052 6.12523 21.4026 7.13974C22 8.15425 22 9.41667 22 11.9415V12.0585C22 14.5833 22 15.8458 21.4026 16.8603C20.8052 17.8748 19.7294 18.4393 17.5777 19.5685L15.5777 20.618C13.8221 21.5393 12.9443 22 12 22C11.0557 22 10.1779 21.5393 8.42229 20.618L6.42229 19.5685C4.27063 18.4393 3.19479 17.8748 2.5974 16.8603C2 15.8458 2 14.5833 2 12.0585V11.9415C2 9.41667 2 8.15425 2.5974 7.13974C3.19479 6.12523 4.27063 5.56066 6.42229 4.43152L8.42229 3.38197C10.1779 2.46066 11.0557 2 12 2C12.9443 2 13.8221 2.46066 15.5777 3.38197Z" stroke-linecap="round"/><path opacity="0.5" d="M21 7.5L12 12M12 12L3 7.5M12 12V21.5" stroke-linecap="round"/></svg>
            <h5>1. Click the part you want to add</h5>
            <p>See this big container on the screen? That's YOUR container — or rather, it'll be your container. Click on a part to open up the selection menu.</p>
        </div>
        <div class="col-xl-4">
            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path opacity="0.5" d="M13.2535 19.4243C12.9606 19.1314 12.4857 19.1314 12.1928 19.4243C11.8999 19.7172 11.8999 20.1921 12.1928 20.485L13.2535 19.4243ZM18.5083 19.9546L19.0387 20.485L18.5083 19.9546ZM4.04537 5.49167L4.5757 6.022H4.5757L4.04537 5.49167ZM3.51504 11.8072C3.80794 12.1001 4.28281 12.1001 4.5757 11.8072C4.8686 11.5143 4.8686 11.0394 4.5757 10.7465L3.51504 11.8072ZM11.2769 4.04537L11.8072 4.5757C11.9478 4.43505 12.0269 4.24428 12.0269 4.04537C12.0269 3.84646 11.9478 3.65569 11.8072 3.51504L11.2769 4.04537ZM5.49167 4.04537L4.96134 3.51504L4.96134 3.51504L5.49167 4.04537ZM19.9546 12.7231L20.485 12.1928C20.3443 12.0522 20.1535 11.9731 19.9546 11.9731C19.7557 11.9731 19.565 12.0522 19.4243 12.1928L19.9546 12.7231ZM19.9546 18.5083L19.4243 17.978L19.9546 18.5083ZM8.33603 5.92553C8.04314 6.21843 8.04314 6.6933 8.33603 6.98619C8.62892 7.27909 9.1038 7.27909 9.39669 6.98619L8.33603 5.92553ZM17.0138 14.6033C16.7209 14.8962 16.7209 15.3711 17.0138 15.664C17.3067 15.9569 17.7816 15.9569 18.0745 15.664L17.0138 14.6033ZM4.96134 3.51504L3.51504 4.96134L4.5757 6.022L6.022 4.5757L4.96134 3.51504ZM19.0387 20.485L20.485 19.0387L19.4243 17.978L17.978 19.4243L19.0387 20.485ZM12.1928 20.485C12.8596 21.1518 13.4119 21.7063 13.9081 22.0849C14.4217 22.4767 14.9622 22.75 15.6157 22.75V21.25C15.422 21.25 15.1981 21.1824 14.818 20.8924C14.4206 20.5892 13.9503 20.1211 13.2535 19.4243L12.1928 20.485ZM17.978 19.4243C17.2812 20.1211 16.8109 20.5892 16.4135 20.8924C16.0334 21.1824 15.8094 21.25 15.6157 21.25V22.75C16.2693 22.75 16.8098 22.4767 17.3233 22.0849C17.8195 21.7063 18.3719 21.1518 19.0387 20.485L17.978 19.4243ZM3.51504 4.96134C2.84824 5.62814 2.29367 6.18046 1.91508 6.67666C1.52328 7.19018 1.25 7.73073 1.25 8.38426H2.75C2.75 8.19057 2.81761 7.96662 3.10761 7.58654C3.41081 7.18914 3.87892 6.71878 4.5757 6.022L3.51504 4.96134ZM4.5757 10.7465C3.87892 10.0497 3.41081 9.57937 3.10761 9.18198C2.81761 8.8019 2.75 8.57795 2.75 8.38426H1.25C1.25 9.03779 1.52328 9.57835 1.91508 10.0919C2.29367 10.5881 2.84824 11.1404 3.51504 11.8072L4.5757 10.7465ZM11.8072 3.51504C11.1404 2.84824 10.5881 2.29367 10.0919 1.91508C9.57835 1.52328 9.03779 1.25 8.38426 1.25V2.75C8.57795 2.75 8.8019 2.81761 9.18199 3.10761C9.57938 3.41081 10.0497 3.87892 10.7465 4.5757L11.8072 3.51504ZM6.022 4.5757C6.71878 3.87892 7.18914 3.41081 7.58654 3.10761C7.96662 2.81762 8.19057 2.75 8.38426 2.75V1.25C7.73073 1.25 7.19018 1.52328 6.67666 1.91508C6.18046 2.29367 5.62814 2.84824 4.96134 3.51504L6.022 4.5757ZM19.4243 13.2535C20.1211 13.9503 20.5892 14.4206 20.8924 14.818C21.1824 15.1981 21.25 15.422 21.25 15.6157H22.75C22.75 14.9622 22.4767 14.4217 22.0849 13.9081C21.7063 13.4119 21.1518 12.8596 20.485 12.1928L19.4243 13.2535ZM20.485 19.0387C21.1518 18.3719 21.7063 17.8195 22.0849 17.3233C22.4767 16.8098 22.75 16.2693 22.75 15.6157H21.25C21.25 15.8094 21.1824 16.0334 20.8924 16.4135C20.5892 16.8109 20.1211 17.2812 19.4243 17.978L20.485 19.0387ZM10.7465 3.51504L8.33603 5.92553L9.39669 6.98619L11.8072 4.5757L10.7465 3.51504ZM19.4243 12.1928L17.0138 14.6033L18.0745 15.664L20.485 13.2535L19.4243 12.1928Z"/><path d="M4.19792 21.6782L5 21.4108L7.47918 20.5844C8.25352 20.3263 8.6407 20.1973 9.00498 20.0237C9.43469 19.8189 9.84082 19.5679 10.2162 19.2751C10.5344 19.0269 10.8229 18.7383 11.4001 18.1612L19.9213 9.63993L20.8482 8.71306C22.3839 7.17735 22.3839 4.68748 20.8482 3.15178C19.3125 1.61607 16.8226 1.61607 15.2869 3.15178L14.3601 4.07866L5.83882 12.5999C5.26166 13.1771 4.97308 13.4656 4.7249 13.7838C4.43213 14.1592 4.18114 14.5653 3.97634 14.995C3.80273 15.3593 3.67368 15.7465 3.41556 16.5208L2.58917 19L2.32181 19.8021M4.19792 21.6782L3.39584 21.9456C3.01478 22.0726 2.59466 21.9734 2.31063 21.6894C2.0266 21.4053 1.92743 20.9852 2.05445 20.6042L2.32181 19.8021M4.19792 21.6782L2.32181 19.8021" /><path opacity="0.5" d="M14.3601 4.07861C14.3601 4.07861 14.476 6.04823 16.2139 7.78613C17.9518 9.52403 19.9214 9.63989 19.9214 9.63989" /></svg>
            <h5>2. Pick from our selection of dishes</h5>
            <p>You can pick from our big selection of dishes exclusive to each part. Sushi, pizza or steak for a main? You got it! Maybe a branch of fries or pepper? Cola or beer? Just choose!</p>
        </div>
        <div class="col-xl-4">
            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path fill-rule="evenodd" clip-rule="evenodd" d="M15.8787 3.70705C17.0503 2.53547 18.9498 2.53548 20.1213 3.70705L20.2929 3.87862C21.4645 5.05019 21.4645 6.94969 20.2929 8.12126L18.5556 9.85857L8.70713 19.7071C8.57897 19.8352 8.41839 19.9261 8.24256 19.9701L4.24256 20.9701C3.90178 21.0553 3.54129 20.9554 3.29291 20.7071C3.04453 20.4587 2.94468 20.0982 3.02988 19.7574L4.02988 15.7574C4.07384 15.5816 4.16476 15.421 4.29291 15.2928L14.1989 5.38685L15.8787 3.70705ZM18.7071 5.12126C18.3166 4.73074 17.6834 4.73074 17.2929 5.12126L16.3068 6.10738L17.8622 7.72357L18.8787 6.70705C19.2692 6.31653 19.2692 5.68336 18.8787 5.29283L18.7071 5.12126ZM16.4477 9.13804L14.8923 7.52185L5.90299 16.5112L5.37439 18.6256L7.48877 18.097L16.4477 9.13804Z"></path> </g></svg>
            <h5>3. Make it yours</h5>
            <p>Once you've made your selection, you can customize your part. Do you want to add extra ingredients or remove them? Or perhaps check the allergens of each dish? Make it yours.</p>
        </div>
    </div>
</section>

<!-- Product overlays -->
<?php foreach (['main', 'branch', 'drink', 'dessert'] as $i => $type) { ?>
    <div id="build-<?=$type?>-overlay" class="overlay hidden">
        <section id="build-<?=$type?>-overlay-container" class="overlay-modal position-relative overflow-hidden display-block abnormal">
            <div class="header p-4 d-flex align-items-center justify-content-between">
                <div class="title d-flex align-items-center gap-3 w-50">
                    <?=productsController::getTypeIcon($i+1)?>
                    <h4>Add a <?=$type?></h4>
                </div>
                <form class="d-flex align-items-center gap-2" action="">
                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M14.9536 14.9458L21 21M17 10C17 13.866 13.866 17 10 17C6.13401 17 3 13.866 3 10C3 6.13401 6.13401 3 10 3C13.866 3 17 6.13401 17 10Z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></g></svg>
                    <input type="text" name="dishname" placeholder="Search for a specific dish...">
                </form>
            </div>

            <div class="container-fluid overlay-content">
                <div class="row">
                    <div class="col-3 sidebar p-4">

                    </div>
                    <div class="col-9 list h-100 overflow-y-auto overflow-x-hidden">
                        <?php foreach ($categories as $category) {
                            $products = $category->getAllProducts($i+1);
                            if (count($products) > 0) { ?>
                                <h5 class="category-name"><?=$category->getName()?></h5>
                                <hr>
                                <div class="category-products d-flex gap-3 p-1 flex-wrap">
                                    <?php foreach ($products as $product) {
                                        $allergens = $product->getAllergens() ?>
                                        <a href="/build/add/<?=$type?>/<?=$product->getId_product()?>" class="card product">
                                            <img src="/img/products/product<?=$product->getId_product()?>.webp" class="card-img-top undraggable" alt="<?=$product->getName()?>">
                                            <div class="allergens-overlay d-flex justify-content-center align-content-center gap-2 flex-wrap position-absolute z-3 top-0 card-img-top">
                                                <div class="allergens-overlay-bg w-100 h-100 position-absolute"></div>
                                                <?php if (count($allergens) > 0) {
                                                        foreach ($allergens as $allergen) { ?>
                                                            <img class="allergen-icon z-2" src="/svg/allergens/allergen<?=$allergen->getId_allergen()?>.svg" alt="<?=$allergen->getName()?>" data-bs-toggle="tooltip" data-bs-custom-class="custom-tooltip-2" data-bs-title="<?=$allergen->getName()?>">
                                                        <?php }
                                                    } else { ?>
                                                        <span class="no-allergens d-flex align-items-center z-2">No allergens</span>
                                                    <?php } ?>
                                            </div>
                                            <div class="card-body d-flex flex-column justify-content-between">
                                                <?=$product->alcoholIcon($alcoholicProducts)?>
                                                <h5 class="card-title"><?=$product->getName()?></h5>
                                                <?php $appliedSale = $product->isOnSale($currentSales);
                                                if ($appliedSale) { ?>
                                                    <div class="d-flex align-items-end gap-2">
                                                        <p class="card-subtitle crossed-out"><?=$product->getPrice()?> €</p>
                                                        <p class="card-subtitle discounted"><?=$product->getDiscountedPrice($appliedSale)?> €</p>
                                                    </div>
                                                <?php } else { ?>
                                                    <p class="card-subtitle"><?=$product->getPrice()?> €</p>
                                                <?php } ?>
                                            </div>
                                        </a>
                                    <?php } ?>
                                </div>
                            <?php }
                        } ?>
                    </div>
                </div>
            </div>
        </section>
    </div>
<?php } ?>

</main>

<?php include_once('views/footer.php') ?>