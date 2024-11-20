<?php

include_once('UsersDAO.php');

$emailerror = "";
$passworderror = "";

if(isset($_POST['email'], $_POST['password'])) {
    $users = UsersDAO::getByEmail($_POST['email']);

    if (empty($users)) {
        $emailerror = "error";
    } else {
        $user = $users[0];

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