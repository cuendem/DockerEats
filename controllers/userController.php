<?php

include_once("models/UsersDAO.php");

class userController {
    public function index() {
        if (isset($_SESSION['username'])) {
            $pageid = "myaccount";
            $view = "views/users/show.php";
            $title = $_SESSION['username'];
        } else {
            $pageid = "signin";
            $view = "views/users/signin.php";
            $title = "Sign In";
        }

        include_once("views/main.php");
    }
}

?>