<?php

include_once('UsersDAO.php');

$emailerror = "";
$passworderror = "";

if(isset($_POST['username'], $_POST['email'], $_POST['password'], $_POST['repeatpassword'])) {
    $users = UsersDAO::getByEmail($_POST['email']);

    if (!empty($users)) {
        $emailerror = "error";
    } else {
        if ($_POST['password'] !== $_POST['repeatpassword']) {
            $passworderror = "error";
        } else {
            userController::addUser($_POST['username'], $_POST['password'], $_POST['email']);
            header('location:/account/signin');
        }
    }
}
?>