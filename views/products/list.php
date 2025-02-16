<?php include_once('views/header.php') ?>
<main>
<section id="banner" class="container-fluid text-center py-5">
    <h2>Menu</h2>
    <h1>Our <?=$title?></h1>
    <p class="lead">Check out our contantly-expanding menu!</p>
</section>
<section id="list" class="wave-separator pb-0">
    <div class="listButtons d-flex flex-wrap justify-content-center gap-4 py-4">
        <a href="/products/<?=$buttons[0] == 'selected' ? '' : 'mains'?>" class="z-2 btn btn-pilled btn-<?=$buttons[0]?> d-flex align-items-center gap-2"><svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M5 10C5 7.23858 7.23858 5 10 5H14C16.7614 5 19 7.23858 19 10V10.8382C17.9457 9.59948 16.026 9.60669 14.9818 10.8598C14.7311 11.1607 14.2689 11.1607 14.0182 10.8598C12.9679 9.59944 11.0321 9.59944 9.98178 10.8598C9.73105 11.1607 9.26895 11.1607 9.01822 10.8598C7.97395 9.60669 6.05435 9.59948 5 10.8382V10ZM21 10V10.5C21.2559 10.5 21.5118 10.5976 21.7071 10.7929C22.0976 11.1834 22.0976 11.8166 21.7071 12.2071L21.5246 12.3896C21.1544 12.7599 20.7056 12.999 20.234 13.1095C21.2565 13.4231 22 14.3747 22 15.5C22 16.3607 21.565 17.1199 20.9029 17.5696C20.9651 17.6999 21 17.8459 21 18V18.5C21 20.433 19.433 22 17.5 22H6.5C4.567 22 3 20.433 3 18.5V18C3 17.8459 3.03486 17.6999 3.09712 17.5696C2.43498 17.1199 2 16.3607 2 15.5C2 14.3747 2.74348 13.4231 3.76602 13.1095C3.29437 12.999 2.84564 12.7599 2.47537 12.3896L2.29289 12.2071C1.90237 11.8166 1.90237 11.1834 2.29289 10.7929C2.48816 10.5976 2.74408 10.5 3 10.5V10C3 6.13401 6.13401 3 10 3H14C17.866 3 21 6.13401 21 10ZM5.35966 13H8.83259C8.32453 12.8675 7.84903 12.5809 7.48178 12.1402C7.23105 11.8393 6.76895 11.8393 6.51822 12.1402L6.46105 12.2088C6.15489 12.5762 5.77366 12.8406 5.35966 13ZM10.1674 13H13.8326C13.3245 12.8675 12.849 12.5809 12.4818 12.1402C12.2311 11.8393 11.7689 11.8393 11.5182 12.1402C11.151 12.5809 10.6755 12.8675 10.1674 13ZM15.1674 13H18.6403C18.2263 12.8406 17.8451 12.5762 17.5389 12.2088L17.4818 12.1402C17.2311 11.8393 16.7689 11.8393 16.5182 12.1402C16.151 12.5809 15.6755 12.8675 15.1674 13ZM5 18V18.5C5 19.3284 5.67157 20 6.5 20H17.5C18.3284 20 19 19.3284 19 18.5V18H5ZM4 15.5C4 15.2239 4.22386 15 4.5 15H19.5C19.7761 15 20 15.2239 20 15.5C20 15.7761 19.7761 16 19.5 16H4.5C4.22386 16 4 15.7761 4 15.5Z"/></svg> Mains</a>
        <a href="/products/<?=$buttons[1] == 'selected' ? '' : 'branches'?>" class="z-2 btn btn-pilled btn-<?=$buttons[1]?> d-flex align-items-center gap-2"><svg viewBox="0 0 1024 1024" xmlns="http://www.w3.org/2000/svg"><path d="M608 224v-64a32 32 0 0 0-64 0v336h26.88A64 64 0 0 0 608 484.096V224zm101.12 160A64 64 0 0 0 672 395.904V384h64V224a32 32 0 1 0-64 0v160h37.12zm74.88 0a92.928 92.928 0 0 1 91.328 110.08l-60.672 323.584A96 96 0 0 1 720.32 896H303.68a96 96 0 0 1-94.336-78.336L148.672 494.08A92.928 92.928 0 0 1 240 384h-16V224a96 96 0 0 1 188.608-25.28A95.744 95.744 0 0 1 480 197.44V160a96 96 0 0 1 188.608-25.28A96 96 0 0 1 800 224v160h-16zM670.784 512a128 128 0 0 1-99.904 48H453.12a128 128 0 0 1-99.84-48H352v-1.536a128.128 128.128 0 0 1-9.984-14.976L314.88 448H240a28.928 28.928 0 0 0-28.48 34.304L241.088 640h541.824l29.568-157.696A28.928 28.928 0 0 0 784 448h-74.88l-27.136 47.488A132.405 132.405 0 0 1 672 510.464V512h-1.216zM480 288a32 32 0 0 0-64 0v196.096A64 64 0 0 0 453.12 496H480V288zm-128 96V224a32 32 0 0 0-64 0v160h64-37.12A64 64 0 0 1 352 395.904zm-98.88 320 19.072 101.888A32 32 0 0 0 303.68 832h416.64a32 32 0 0 0 31.488-26.112L770.88 704H253.12z"/></svg> Branches</a>
        <a href="/products/<?=$buttons[2] == 'selected' ? '' : 'drinks'?>" class="z-2 btn btn-pilled btn-<?=$buttons[2]?> d-flex align-items-center gap-2"><svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path fill-rule="evenodd" clip-rule="evenodd" d="M16.7071 1.70711C17.0976 1.31658 17.0976 0.683417 16.7071 0.292893C16.3166 -0.0976311 15.6834 -0.0976311 15.2929 0.292893L13.2929 2.29289C13.1054 2.48043 13 2.73478 13 3V4H5.5H4C3.44772 4 3 4.44772 3 5C3 5.55228 3.44772 6 4 6H4.61075L6.50685 22.1168C6.5661 22.6205 6.99291 23 7.5 23H16.5C17.0071 23 17.4339 22.6205 17.4932 22.1168L19.3892 6H20C20.5523 6 21 5.55228 21 5C21 4.44772 20.5523 4 20 4H18.5H15V3.41421L16.7071 1.70711ZM14 6H6.62454L7.31722 11.8878C10.0331 9.75216 13.5867 8.597 17.1281 8.10244L17.3755 6H14ZM8.28305 20.0973L7.60083 14.2985C9.88074 12.0481 13.256 10.7393 16.886 10.1607L16.602 12.5743C13.0248 13.6331 9.94299 16.1542 8.28305 20.0973ZM10.0738 21H15.6108L16.3435 14.7712C13.6416 15.8014 11.3534 17.8673 10.0738 21Z"></path> </g></svg> Drinks</a>
        <a href="/products/<?=$buttons[3] == 'selected' ? '' : 'desserts'?>" class="z-2 btn btn-pilled btn-<?=$buttons[3]?> d-flex align-items-center gap-2"><svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path fill-rule="evenodd" clip-rule="evenodd" d="M13.9999 3.125C13.9999 4.16053 13.1044 5 11.9999 5C10.8953 5 9.99988 4.16053 9.99988 3.125C9.99988 2.08947 11.9999 0 11.9999 0C11.9999 0 13.9999 2.08947 13.9999 3.125ZM0.460826 13.6423L2.31939 14.8317L4.02549 22.2249C4.1302 22.6786 4.53422 23 4.99988 23H18.9999C19.4655 23 19.8696 22.6786 19.9743 22.2249L21.6804 14.8317L23.5389 13.6423C24.0041 13.3446 24.1399 12.7261 23.8421 12.2609C23.5444 11.7958 22.926 11.66 22.4608 11.9577L21.9256 12.3003C21.5906 9.92302 19.5498 8 16.9717 8H12.9999V7C12.9999 6.44772 12.5522 6 11.9999 6C11.4476 6 10.9999 6.44772 10.9999 7V8H7.02808C4.44994 8 2.40918 9.92302 2.0742 12.3003L1.53893 11.9577C1.07376 11.66 0.455319 11.7958 0.157608 12.2609C-0.140103 12.7261 -0.0043478 13.3446 0.460826 13.6423ZM5.79539 21L4.65309 16.05C6.02133 16.4189 7.50983 16.1952 8.72873 15.3826L10.3358 14.3113C11.3435 13.6395 12.6563 13.6395 13.664 14.3113L15.271 15.3826C16.4899 16.1952 17.9784 16.4189 19.3467 16.05L18.2044 21H5.79539ZM16.9717 10C18.8713 10 20.2847 11.74 19.9135 13.588L19.6617 13.7492C18.6588 14.391 17.3712 14.379 16.3804 13.7185L14.7734 12.6472C13.0939 11.5275 10.9059 11.5275 9.22638 12.6472L7.61933 13.7185C6.62859 14.379 5.34099 14.391 4.33807 13.7492L4.08623 13.588C3.71509 11.74 5.12847 10 7.02808 10H11.9999H16.9717ZM8.99993 18C8.99993 17.4477 8.55221 17 7.99993 17C7.44764 17 6.99993 17.4477 6.99993 18V19C6.99993 19.5523 7.44764 20 7.99993 20C8.55221 20 8.99993 19.5523 8.99993 19V18ZM12.9999 18C12.9999 17.4477 12.5522 17 11.9999 17C11.4476 17 10.9999 17.4477 10.9999 18V19C10.9999 19.5523 11.4476 20 11.9999 20C12.5522 20 12.9999 19.5523 12.9999 19V18ZM16.9999 18C16.9999 17.4477 16.5522 17 15.9999 17C15.4476 17 14.9999 17.4477 14.9999 18V19C14.9999 19.5523 15.4476 20 15.9999 20C16.5522 20 16.9999 19.5523 16.9999 19V18Z"></path> </g></svg> Desserts</a>
        <form class="z-2 d-flex align-items-center gap-2" action="">
            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M14.9536 14.9458L21 21M17 10C17 13.866 13.866 17 10 17C6.13401 17 3 13.866 3 10C3 6.13401 6.13401 3 10 3C13.866 3 17 6.13401 17 10Z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></g></svg>
            <input type="text" name="dishnamelist" placeholder="Search...">
        </form>
        </div>
    <?php $i = 0; foreach ($categories as $category) {
        $products = $category->getAllProducts($type);
        if (count($products) > 0) { $i++; ?>
            <div class="categoryRow pb-4 <?php if ($i > 1) { echo 'wave-separator pt-4 '; } if ($i % 2 == 0) { echo 'grayed'; } ?>">
                <h2 class="categoryName"><?=$category->getName()?></h2>
                <div class="productsCategory d-flex pt-3 pb-5 flex-wrap gap-3">
                <?php foreach ($products as $product) {
                    $allergens = $product->getAllergens() ?>
                    <div class="card product">
                        <div class="overflow-hidden position-relative">
                            <img src="/img/products/product<?=$product->getId_product()?>.webp" class="card-img-top undraggable" alt="<?=$product->getName()?>">
                            <div class="allergens-overlay d-flex justify-content-center align-content-center gap-2 flex-wrap position-absolute z-3 top-0 w-100 h-100">
                                <div class="allergens-overlay-bg w-100 h-100 position-absolute"></div>
                                <?php if (count($allergens) > 0) {
                                        foreach ($allergens as $allergen) { ?>
                                            <img class="allergen-icon z-2" src="/svg/allergens/allergen<?=$allergen->getId_allergen()?>.svg" alt="<?=$allergen->getName()?>" data-bs-toggle="tooltip" data-bs-custom-class="custom-tooltip-2" data-bs-title="<?=$allergen->getName()?>">
                                        <?php }
                                    } else { ?>
                                        <span class="no-allergens d-flex align-items-center z-2">No allergens</span>
                                    <?php } ?>
                            </div>
                        </div>
                        <div class="card-body d-flex flex-column justify-content-between">
                            <?=productsController::getTypeIcon($product->getId_type())?>
                            <?=$product->alcoholIcon($alcoholicProducts)?>
                            <h5 class="card-title"><?=$product->getName()?></h5>
                            <?php $appliedSales = $product->isOnSale($currentSales);
                            if (count($appliedSales) > 0) { ?>
                                <div class="d-flex align-items-end gap-2">
                                    <p class="card-subtitle crossed-out"><?=$product->getPrice()?> €</p>
                                    <p class="card-subtitle discounted"><?=$product->getDiscountedPrice($appliedSales)?> €</p>
                                </div>
                            <?php } else { ?>
                                <p class="card-subtitle"><?=$product->getPrice()?> €</p>
                            <?php } ?>
                        </div>
                    </div>
                <?php } ?>
                </div>
            </div>
        <?php }
    } ?>
</section>
</main>
<?php include_once('views/footer.php') ?>