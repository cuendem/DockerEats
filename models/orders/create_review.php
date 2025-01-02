<?php

include_once('OrdersDAO.php');

if (isset($_POST['create'])) {
    if (isset($_POST['id_review']) && $_POST['id_review'] != '') {
        OrdersDAO::updateReview($_POST['id_review'], $_POST['id_user'], $_POST['id_order'], $_POST['comment'], $_POST['stars']);
        ?>
        <script>
            bufferedToast = {"text": "Review updated!", "type": "success"};
        </script>
        <?php
        logsController::log("Updated review ".$_POST['id_review']);
    } else {
        $id = OrdersDAO::storeReview($_POST['id_user'], $_POST['id_order'], $_POST['comment'], $_POST['stars'], date('Y-m-d'));
        ?>
        <script>
            bufferedToast = {"text": "Review created!", "type": "success"};
        </script>
        <?php
        logsController::log("Created review $id");
    }
} elseif (isset($_POST['delete'])) {
    OrdersDAO::deleteReview($_POST['id_review']);
    ?>
    <script>
        bufferedToast = {"text": "Review deleted!", "type": "success"};
    </script>
    <?php
    logsController::log("Deleted review ".$_POST['id_review']);
}

?>