<?php

include_once('UsersDAO.php');

$emailerror = "";
$passworderror = "";

if(isset($_POST['email'], $_POST['password'])) {
    $user = UsersDAO::getByEmail($_POST['email']);

    if (is_null($user)) {
        $emailerror = "error";
    } else {
        if (password_verify($_POST['password'], $user->getPassword())) { 
            $_SESSION['id_user'] = $user->getId_user();
            $_SESSION['username'] = $user->getUsername();
            $_SESSION['email'] = $user->getEmail();

            header('location:/account/');
        } else {
            $passworderror = "error";
        }
    }
}
?>