<?php include_once('views/header.php') ?>
<main>
<section id="banner" class="container-fluid text-center py-5">
    <div class="row">
        <div class="col d-flex flex-column align-items-center gap-3">
            <h1>Write a review</h1>
        </div>
    </div>
</section>
<section id="review-cont" class="container-fluid wave-separator pt-5">
    <div class="row">
        <form action="" method="POST" class="d-flex flex-column align-items-center gap-3 mx-auto col-8 col-md-6 col-lg-4">
            <div class="inputDiv position-relative d-flex gap-2">
                <select name="stars" id="stars">
                <?php
                $stars = [0, 0.5, 1, 1.5, 2, 2.5, 3, 3.5, 4, 4.5, 5];
                foreach ($stars as $value) {
                    $starsDisplay = str_repeat('★', floor($value)) . 
                                    ($value - floor($value) == 0.5 ? '✯' : '') . 
                                    str_repeat('☆', 5 - ceil($value));
                    $selected = floatval($order->getStars()) == $value ? 'selected' : '';
                    echo "<option value=\"$value\" $selected>$starsDisplay</option>";
                }
                ?>
                </select>
                <input type="number" value="<?=$order->getId_user()?>" name="id_user" id="id_user" hidden>
                <input type="number" value="<?=$order->getId_order()?>" name="id_order" id="id_order" hidden>
                <input type="number" value="<?=$order->getId_review()?>" name="id_review" id="id_review" hidden>
                <input type="submit" value="<?=$order->getId_review() ? 'Update' : 'Create'?> review" name="create" id="create">
                <input type="submit" class="delete" value="Delete review" name="delete" id="delete">
            </div>

            <div class="inputDiv no-label position-relative">
                <textarea name="comment" id="comment" required placeholder=" " autocomplete="off"><?=$order->getComment()?></textarea>
                <label for="comment">Comment</label>
            </div>
        </form>
    </div>
</section>
</main>
<?php include_once('views/footer.php') ?>