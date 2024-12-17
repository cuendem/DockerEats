<?php

include_once("models/users/UsersDAO.php");

class userController {
    public function index() {
        include_once('models/protection.php');

        $pageid = "account";
        $view = "views/users/show.php";
        $title = $_SESSION['username'];
        include_once("views/main.php");
    }

    public function cart() {
        include_once('models/protection.php');

        $pageid = "cart";
        $view = "views/users/cart.php";
        $title = "Your Cart";

        $categories = CategoriesDAO::getAll();
        $currentSales = SalesDAO::getAllAvailable(date('Y-m-d'));

        include_once("models/coupons/coupon_authentication.php");
        include_once("models/orders/create_order.php");
        include_once("views/main.php");
    }

    public function signin() {
        $pageid = "signin";
        $view = "views/users/signin.php";
        $title = "Sign In";
        include_once("models/users/user_authentication.php");
        include_once("views/main.php");
    }

    public function signup() {
        $pageid = "signup";
        $view = "views/users/signup.php";
        $title = "Sign Up";
        include_once("models/users/user_signup.php");
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
        include_once("models/users/edit_user.php");
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

    public static function editUser($id, $username = null, $password = null) {
        $user = UsersDAO::getById($id);

        if (!is_null($username)) {
            $user->setUsername($username);
        }

        if (!is_null($password)) {
            $user->setPassword($password);
        }

        UsersDAO::update($user);
    }
}

?>