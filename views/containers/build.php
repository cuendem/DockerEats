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
            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M15.5777 3.38197L17.5777 4.43152C19.7294 5.56066 20.8052 6.12523 21.4026 7.13974C22 8.15425 22 9.41667 22 11.9415V12.0585C22 14.5833 22 15.8458 21.4026 16.8603C20.8052 17.8748 19.7294 18.4393 17.5777 19.5685L15.5777 20.618C13.8221 21.5393 12.9443 22 12 22C11.0557 22 10.1779 21.5393 8.42229 20.618L6.42229 19.5685C4.27063 18.4393 3.19479 17.8748 2.5974 16.8603C2 15.8458 2 14.5833 2 12.0585V11.9415C2 9.41667 2 8.15425 2.5974 7.13974C3.19479 6.12523 4.27063 5.56066 6.42229 4.43152L8.42229 3.38197C10.1779 2.46066 11.0557 2 12 2C12.9443 2 13.8221 2.46066 15.5777 3.38197Z" stroke="#1D63ED" stroke-width="2" stroke-linecap="round"></path> <path opacity="0.5" d="M21 7.5L12 12M12 12L3 7.5M12 12V21.5" stroke="#1D63ED" stroke-width="2" stroke-linecap="round"></path> </g></svg>
            <h5>1. Click the part you want to add</h5>
            <p>See this big container on the screen? That's YOUR container — or rather, it'll be your container. Click on a part to open up the selection menu.</p>
        </div>
        <div class="col-xl-4">
            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M19 18H19.75H19ZM5 14.584H5.75C5.75 14.2859 5.57345 14.016 5.30028 13.8967L5 14.584ZM19 14.584L18.6997 13.8967C18.4265 14.016 18.25 14.2859 18.25 14.584H19ZM15.75 7C15.75 7.41421 16.0858 7.75 16.5 7.75C16.9142 7.75 17.25 7.41421 17.25 7H15.75ZM6.75 7C6.75 7.41421 7.08579 7.75 7.5 7.75C7.91421 7.75 8.25 7.41421 8.25 7H6.75ZM7 4.25C3.82436 4.25 1.25 6.82436 1.25 10H2.75C2.75 7.65279 4.65279 5.75 7 5.75V4.25ZM17 5.75C19.3472 5.75 21.25 7.65279 21.25 10H22.75C22.75 6.82436 20.1756 4.25 17 4.25V5.75ZM15 21.25H9V22.75H15V21.25ZM9 21.25C8.03599 21.25 7.38843 21.2484 6.90539 21.1835C6.44393 21.1214 6.24643 21.0142 6.11612 20.8839L5.05546 21.9445C5.51093 22.4 6.07773 22.5857 6.70552 22.6701C7.31174 22.7516 8.07839 22.75 9 22.75V21.25ZM4.25 18C4.25 18.9216 4.24841 19.6883 4.32991 20.2945C4.41432 20.9223 4.59999 21.4891 5.05546 21.9445L6.11612 20.8839C5.9858 20.7536 5.87858 20.5561 5.81654 20.0946C5.75159 19.6116 5.75 18.964 5.75 18H4.25ZM18.25 18C18.25 18.964 18.2484 19.6116 18.1835 20.0946C18.1214 20.5561 18.0142 20.7536 17.8839 20.8839L18.9445 21.9445C19.4 21.4891 19.5857 20.9223 19.6701 20.2945C19.7516 19.6883 19.75 18.9216 19.75 18H18.25ZM15 22.75C15.9216 22.75 16.6883 22.7516 17.2945 22.6701C17.9223 22.5857 18.4891 22.4 18.9445 21.9445L17.8839 20.8839C17.7536 21.0142 17.5561 21.1214 17.0946 21.1835C16.6116 21.2484 15.964 21.25 15 21.25V22.75ZM7 5.75C7.2137 5.75 7.42326 5.76571 7.6277 5.79593L7.84703 4.31205C7.57021 4.27114 7.28734 4.25 7 4.25V5.75ZM12 1.25C9.68949 1.25 7.72942 2.7421 7.02709 4.81312L8.44763 5.29486C8.94981 3.81402 10.3516 2.75 12 2.75V1.25ZM7.02709 4.81312C6.84722 5.34352 6.75 5.91118 6.75 6.5H8.25C8.25 6.07715 8.3197 5.67212 8.44763 5.29486L7.02709 4.81312ZM17 4.25C16.7127 4.25 16.4298 4.27114 16.153 4.31205L16.3723 5.79593C16.5767 5.76571 16.7863 5.75 17 5.75V4.25ZM12 2.75C13.6484 2.75 15.0502 3.81402 15.5524 5.29486L16.9729 4.81312C16.2706 2.7421 14.3105 1.25 12 1.25V2.75ZM15.5524 5.29486C15.6803 5.67212 15.75 6.07715 15.75 6.5H17.25C17.25 5.91118 17.1528 5.34352 16.9729 4.81312L15.5524 5.29486ZM5.75 18V14.584H4.25V18H5.75ZM5.30028 13.8967C3.79769 13.2402 2.75 11.7416 2.75 10H1.25C1.25 12.359 2.6705 14.3846 4.69972 15.2712L5.30028 13.8967ZM18.25 14.584L18.25 18H19.75L19.75 14.584H18.25ZM21.25 10C21.25 11.7416 20.2023 13.2402 18.6997 13.8967L19.3003 15.2712C21.3295 14.3846 22.75 12.359 22.75 10H21.25ZM15.75 6.5V7H17.25V6.5H15.75ZM6.75 6.5V7H8.25V6.5H6.75Z" fill="#1D63ED"></path> <path opacity="0.5" d="M9 18H15" stroke="#1D63ED" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
            <h5>2. Pick from our selection of dishes</h5>
            <p>You can pick from our big selection of dishes exclusive to each part. Sushi, pizza or steak for a main? You got it! Maybe a branch of fries or pepper? Cola or beer? Just choose!</p>
        </div>
        <div class="col-xl-4">
            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path opacity="0.5" d="M13.2535 19.4243C12.9606 19.1314 12.4857 19.1314 12.1928 19.4243C11.8999 19.7172 11.8999 20.1921 12.1928 20.485L13.2535 19.4243ZM18.5083 19.9546L19.0387 20.485L18.5083 19.9546ZM4.04537 5.49167L4.5757 6.022H4.5757L4.04537 5.49167ZM3.51504 11.8072C3.80794 12.1001 4.28281 12.1001 4.5757 11.8072C4.8686 11.5143 4.8686 11.0394 4.5757 10.7465L3.51504 11.8072ZM11.2769 4.04537L11.8072 4.5757C11.9478 4.43505 12.0269 4.24428 12.0269 4.04537C12.0269 3.84646 11.9478 3.65569 11.8072 3.51504L11.2769 4.04537ZM5.49167 4.04537L4.96134 3.51504L4.96134 3.51504L5.49167 4.04537ZM19.9546 12.7231L20.485 12.1928C20.3443 12.0522 20.1535 11.9731 19.9546 11.9731C19.7557 11.9731 19.565 12.0522 19.4243 12.1928L19.9546 12.7231ZM19.9546 18.5083L19.4243 17.978L19.9546 18.5083ZM8.33603 5.92553C8.04314 6.21843 8.04314 6.6933 8.33603 6.98619C8.62892 7.27909 9.1038 7.27909 9.39669 6.98619L8.33603 5.92553ZM17.0138 14.6033C16.7209 14.8962 16.7209 15.3711 17.0138 15.664C17.3067 15.9569 17.7816 15.9569 18.0745 15.664L17.0138 14.6033ZM4.96134 3.51504L3.51504 4.96134L4.5757 6.022L6.022 4.5757L4.96134 3.51504ZM19.0387 20.485L20.485 19.0387L19.4243 17.978L17.978 19.4243L19.0387 20.485ZM12.1928 20.485C12.8596 21.1518 13.4119 21.7063 13.9081 22.0849C14.4217 22.4767 14.9622 22.75 15.6157 22.75V21.25C15.422 21.25 15.1981 21.1824 14.818 20.8924C14.4206 20.5892 13.9503 20.1211 13.2535 19.4243L12.1928 20.485ZM17.978 19.4243C17.2812 20.1211 16.8109 20.5892 16.4135 20.8924C16.0334 21.1824 15.8094 21.25 15.6157 21.25V22.75C16.2693 22.75 16.8098 22.4767 17.3233 22.0849C17.8195 21.7063 18.3719 21.1518 19.0387 20.485L17.978 19.4243ZM3.51504 4.96134C2.84824 5.62814 2.29367 6.18046 1.91508 6.67666C1.52328 7.19018 1.25 7.73073 1.25 8.38426H2.75C2.75 8.19057 2.81761 7.96662 3.10761 7.58654C3.41081 7.18914 3.87892 6.71878 4.5757 6.022L3.51504 4.96134ZM4.5757 10.7465C3.87892 10.0497 3.41081 9.57937 3.10761 9.18198C2.81761 8.8019 2.75 8.57795 2.75 8.38426H1.25C1.25 9.03779 1.52328 9.57835 1.91508 10.0919C2.29367 10.5881 2.84824 11.1404 3.51504 11.8072L4.5757 10.7465ZM11.8072 3.51504C11.1404 2.84824 10.5881 2.29367 10.0919 1.91508C9.57835 1.52328 9.03779 1.25 8.38426 1.25V2.75C8.57795 2.75 8.8019 2.81761 9.18199 3.10761C9.57938 3.41081 10.0497 3.87892 10.7465 4.5757L11.8072 3.51504ZM6.022 4.5757C6.71878 3.87892 7.18914 3.41081 7.58654 3.10761C7.96662 2.81762 8.19057 2.75 8.38426 2.75V1.25C7.73073 1.25 7.19018 1.52328 6.67666 1.91508C6.18046 2.29367 5.62814 2.84824 4.96134 3.51504L6.022 4.5757ZM19.4243 13.2535C20.1211 13.9503 20.5892 14.4206 20.8924 14.818C21.1824 15.1981 21.25 15.422 21.25 15.6157H22.75C22.75 14.9622 22.4767 14.4217 22.0849 13.9081C21.7063 13.4119 21.1518 12.8596 20.485 12.1928L19.4243 13.2535ZM20.485 19.0387C21.1518 18.3719 21.7063 17.8195 22.0849 17.3233C22.4767 16.8098 22.75 16.2693 22.75 15.6157H21.25C21.25 15.8094 21.1824 16.0334 20.8924 16.4135C20.5892 16.8109 20.1211 17.2812 19.4243 17.978L20.485 19.0387ZM10.7465 3.51504L8.33603 5.92553L9.39669 6.98619L11.8072 4.5757L10.7465 3.51504ZM19.4243 12.1928L17.0138 14.6033L18.0745 15.664L20.485 13.2535L19.4243 12.1928Z" fill="#1D63ED"></path> <path d="M4.19792 21.6782L5 21.4108L7.47918 20.5844C8.25352 20.3263 8.6407 20.1973 9.00498 20.0237C9.43469 19.8189 9.84082 19.5679 10.2162 19.2751C10.5344 19.0269 10.8229 18.7383 11.4001 18.1612L19.9213 9.63993L20.8482 8.71306C22.3839 7.17735 22.3839 4.68748 20.8482 3.15178C19.3125 1.61607 16.8226 1.61607 15.2869 3.15178L14.3601 4.07866L5.83882 12.5999C5.26166 13.1771 4.97308 13.4656 4.7249 13.7838C4.43213 14.1592 4.18114 14.5653 3.97634 14.995C3.80273 15.3593 3.67368 15.7465 3.41556 16.5208L2.58917 19L2.32181 19.8021M4.19792 21.6782L3.39584 21.9456C3.01478 22.0726 2.59466 21.9734 2.31063 21.6894C2.0266 21.4053 1.92743 20.9852 2.05445 20.6042L2.32181 19.8021M4.19792 21.6782L2.32181 19.8021" stroke="#1D63ED" stroke-width="2"></path> <path opacity="0.5" d="M14.3601 4.07861C14.3601 4.07861 14.476 6.04823 16.2139 7.78613C17.9518 9.52403 19.9214 9.63989 19.9214 9.63989" stroke="#1D63ED" stroke-width="2"></path> </g></svg>
            <h5>3. Make it yours</h5>
            <p>Our containers are meant to be exclusive to each and every customer. That is why you'll be able to see the allergens of each product, to make your container as good as it can be to you.</p>
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