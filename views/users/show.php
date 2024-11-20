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
<section id="options" class="container-fluid">
    <div class="row mt-3">
        <div class="col-xl-4">
            <div class="option">
                <span>See orders</span>
            </div>
        </div>
        <div class="col-xl-4">
            <div class="option">
                <span>Edit account</span>
            </div>
        </div>
        <div class="col-xl-4">
            <div class="option">
                <span>Kill yourself</span>
            </div>
        </div>
    </div>
</section>
</main>
<?php include_once('views/footer.php') ?>