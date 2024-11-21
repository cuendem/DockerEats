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
            include_once("views/main.php");
        } else {
            # Not logged in
            header("location:/account/signin");
        }
    }

    public function signin() {
        $pageid = "signin";
        $view = "views/users/signin.php";
        $title = "Sign In";
        include_once("models/user_authentication.php");
        include_once("views/main.php");
    }

    public function signup() {
        $pageid = "signup";
        $view = "views/users/signup.php";
        $title = "Sign Up";
        include_once("models/user_signup.php");
        include_once("views/main.php");
    }

    public function signout() {
        session_destroy();
        header('location:/');
    }

    public function edit() {
        $pageid = "edituser";
        $view = "views/users/edit.php";
        $title = "Account Settings";
        include_once("views/main.php");
    }

    public static function getPfp($id) {
        if (file_exists('img/users/user'.$id.'.webp')) {
            return '/img/users/user'.$id.'.webp';
        } else {
            return '/img/users/user0.webp';
        }
    }

    public static function addUser($username, $password, $email) {
        $newUser = new User();
        $newUser->setUsername($username);
        $newUser->setPassword(password_hash($password, PASSWORD_DEFAULT));
        $newUser->setEmail($email);

        UsersDAO::store($newUser);
    }
}

?>