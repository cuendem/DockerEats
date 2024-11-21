<?php include_once('views/header.php') ?>
<main>
<section id="banner" class="container-fluid text-center py-5">
    <div class="row">
        <div class="col d-flex flex-column align-items-center gap-3">
            <h1>Account Settings</h1>
        </div>
    </div>
</section>
<section id="edit-cont" class="container-fluid wave-separator mt-5 pt-5">
    <div class="row">
        <div class="col d-flex flex-column align-items-center gap-3">
            <form action="" method="POST">
                <div class="position-relative">
                    <img id="preview-image" class="pfpbig" src="<?=userController::getPfp($_SESSION['id_user'])?>" alt="<?=$_SESSION['username']?>">
                    <label id="preview-image-label" class="position-absolute" for="pfp"></label>
                    <input type="file" name="pfp" id="pfp" accept="image/*" onchange="previewPfp()">
                </div>
            </form>
        </div>
    </div>
</section>
</main>
<?php include_once('views/footer.php') ?>