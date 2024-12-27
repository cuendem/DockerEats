<?php include_once('views/header.php') ?>
<main>
<section id="banner" class="container-fluid text-center py-5">
    <h1>Sales</h1>
</section>
<section id="list" class="wave-separator container-fluid pt-5">
    <?php if (count($sales) <= 0) { ?>
        <div class="no-results d-flex flex-column align-items-center w-100 my-5">
            <span>There are no sales for now.</span>
        </div>
    <?php } else { foreach ($sales as $i => $sale) { ?>
        <div class="row mb-5">
            <div class="sale p-3 col-md-12 col-lg-10 col-xl-8 mx-auto position-relative d-flex justify-content-between">
                <div class="d-flex flex-column justify-content-between">
                    <div class="d-flex flex-column align-items-start">
                        <span class="sale-name"><?=$sale->getName()?></span>
                        <span class="sale-length"><?=$sale->getDate_start()?> - <?=is_null($sale->getDate_end()) ? 'TBA' : $sale->getDate_end()?></span>
                    </div>
                    <span class="sale-description"><?=$sale->getDescription()?></span>
                </div>
                <div class="d-flex flex-column justify-content-between align-items-end">
                    <div class="salepill d-flex align-items-center gap-1 px-3 py-2">
                        <?=$sale->getScopeIcon()?>
                        <span class="flex-grow-1"><?=$sale->getScopeName()?></span>
                    </div>
                    <span class="discount position-absolute bottom-0 end-0 py-2 px-3">-<?=$sale->getDiscount()?><?=$sale->getDiscount_type() == 1 ? '€' : '%'?></span>
                </div>
            </div>
        </div>
    <?php }} ?>
</section>
</main>
<?php include_once('views/footer.php') ?>