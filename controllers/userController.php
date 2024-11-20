<?php

include_once("models/UsersDAO.php");

class userController {
    public function index() {
        if (isset($_SESSION['username'])) {
            # Logged in
            $pageid = "account";
            $view = "views/users/show.php";
            $title = $_SESSION['username'];
            include_once("models/sign_out.php");
        } else {
            # Not logged in
            $pageid = "signin";
            $view = "views/users/signin.php";
            $title = "Sign In";
            include_once("models/user_authentication.php");
        }

        include_once("views/main.php");
    }

    public function signout() {
        session_destroy();
        header('location:/');
    }

    public static function getPfp($id) {
        if (file_exists('img/users/user'.$id.'.webp')) {
            return '/img/users/user'.$id.'.webp';
        } else {
            return '/img/users/user0.webp';
        }
    }
}

?>