<?php

include_once('UsersDAO.php');

if(isset($_POST['username'])) {
    userController::editUser($_SESSION['id_user'], username:$_POST['username']);

    // If the username is different
    if ($_SESSION['username'] != $_POST['username']) {
        logsController::log("Changed username from ".$_SESSION['username']." to ".$_POST['username']);
    }

    $_SESSION['username'] = $_POST['username'];
}

// Check if the image is uploaded
if (isset($_FILES['pfp']) && $_FILES['pfp']['name'] != '') {
    $originalExtension = strtolower(pathinfo($_FILES['pfp']['name'], PATHINFO_EXTENSION));
    $imgName = 'user'.$_SESSION['id_user'].'.webp';
    $path = 'img/users/'.$imgName;

    // Load the image based on its original type
    switch ($originalExtension) {
        case 'jpeg':
        case 'jpg':
            $image = imagecreatefromjpeg($_FILES['pfp']['tmp_name']);
            break;
        case 'png':
            $image = imagecreatefrompng($_FILES['pfp']['tmp_name']);
            break;
        case 'gif':
            $image = imagecreatefromgif($_FILES['pfp']['tmp_name']);
            break;
        case 'webp':
            $image = imagecreatefromwebp($_FILES['pfp']['tmp_name']);
            break;
        default:
            die("Unsupported image format!");  // Handle unsupported formats
    }

    if ($image) {
        // Get original dimensions
        $originalW = imagesx($image);
        $originalH = imagesy($image);

        // Determine square crop dimensions
        $size = min($originalW, $originalH);
        $x = ($originalW > $originalH) ? ($originalW - $originalH) / 2 : 0;
        $y = ($originalH > $originalW) ? ($originalH - $originalW) / 2 : 0;

        // Create a square crop
        $croppedImage = imagecrop($image, ['x' => $x, 'y' => $y, 'width' => $size, 'height' => $size]);
        if ($croppedImage === false) {
            die("Failed to crop image.");
        }

        // Resize the cropped image to 250x250
        $resizedImage = imagescale($croppedImage, 250, 250);

        // Save the image as WebP
        imagewebp($resizedImage, $path, 80);  // 80 is the quality level

        logsController::log("Changed profile picture");

        // Free up memory
        imagedestroy($image);
        imagedestroy($croppedImage);
        imagedestroy($resizedImage);
    }
}
?>