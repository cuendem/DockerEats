<?php

include_once('UsersDAO.php');

$emailerror = "";
$passworderror = "";

if(isset($_POST['email'], $_POST['password'], $_POST['repeatpassword'])) {
    $user = UsersDAO::getByEmail($_POST['email']);

    if (is_null($user)) {
        $emailerror = "error";
    } else {
        if ($_POST['password'] !== $_POST['repeatpassword']) {
            $passworderror = "error";
        } else {
            userController::changePassword($_POST['email'], $_POST['password']);
            header('location:/account/signin');
        }
    }
}
?>