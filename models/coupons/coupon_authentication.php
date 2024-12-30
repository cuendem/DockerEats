<?php

include_once('CouponsDAO.php');

?>
<script>
    let bufferedToast = null;
</script>
<?php

if(isset($_POST['coupon-code'], $_POST['coupon-button']) && $_POST['coupon-code'] != '') {
    $coupon = CouponsDAO::getAvailable($_POST['coupon-code']);

    if (is_null($coupon)) {
        ?>
        <script>
            bufferedToast = {"text": "This coupon is invalid or has expired.", "type": "error"};
        </script>
        <?php
    } else {
        // Initialize the coupons session array if it doesn't exist
        if (!isset($_SESSION['coupons'])) {
            $_SESSION['coupons'] = [];
        }

        // Add the coupon only if it's not already in the array
        if (!in_array($coupon, $_SESSION['coupons'])) {
            $_SESSION['coupons'][] = $coupon;

            $code = $coupon->getCode();

            ?>
            <script>
                bufferedToast = {"text": "Coupon <?=$coupon->getSummary()?> applied!", "type": "success"};
            </script>
            <?php

            logsController::log("Used coupon $code");
        } else {
            ?>
            <script>
                bufferedToast = {"text": "You have already used this coupon.", "type": "error"};
            </script>
            <?php
        }
    }
} elseif (isset($_POST['clear-coupons-button'])) {
    // Reset coupons session array
    unset($_SESSION['coupons']);
    ?>
    <script>
        bufferedToast = {"text": "All coupons cleared.", "type": "success"};
    </script>
    <?php
}
?>