<?php include_once('views/header.php') ?>
<main>
<section id="banner" class="container-fluid text-center py-5">
    <h2>Menu</h2>
    <h1>Our <?=$title?></h1>
    <p class="lead">Check out our contantly-expanding menu!</p>
</section>
<section id="list" class="wave-separator">
    <?php foreach ($categories as $category) {
        $products = $category->getAllProducts($type);
        if (count($products) > 0) { ?>
            <h5 class="categoryName"><?=$category->getName()?></h5>
            <div class="productsCategory d-flex pt-3 pb-5 flex-wrap gap-3">
            <?php foreach ($products as $product) { ?>
                <div class="card product">
                    <img src="/img/products/product<?=$product->getId_product()?>.webp" class="card-img-top" alt="<?=$product->getName()?>">
                    <div class="card-body d-flex flex-column justify-content-between">
                        <h5 class="card-title"><?=$product->getName()?></h5>
                        <p class="card-subtitle"><?=$product->getPrice()?> €</p>
                    </div>
                </div>
            <?php } ?>
            </div>
        <?php }
    } ?>
</section>
</main>
<?php include_once('views/footer.php') ?>