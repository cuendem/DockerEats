<?php

include_once('UsersDAO.php');

$emailerror = "";
$passworderror = "";

if(isset($_POST['username'], $_POST['email'], $_POST['password'], $_POST['repeatpassword'])) {
    $user = UsersDAO::getByEmail($_POST['email']);

    if (!is_null($user)) {
        $emailerror = "error";
    } else {
        if ($_POST['password'] !== $_POST['repeatpassword']) {
            $passworderror = "error";
        } else {
            $id = userController::addUser($_POST['username'], $_POST['password'], $_POST['email']);
            header('location:/account/signin');
        }
    }
}
?>