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

        if ($_POST['password'] == $user->getPassword()) { 
            session_start();

            $_SESSION['id_user'] = $user->getId_user();
            $_SESSION['username'] = $user->getUsername();

            header('location:/');
        } else {
            $passworderror = "error";
        }
    }
}
?>