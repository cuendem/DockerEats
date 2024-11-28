<?php

include_once("models/containers/ContainersDAO.php");
include_once("models/products/ProductsDAO.php");
include_once("models/products/Product.php");

class containerController {
    public function index() {
        include_once('models/protection.php');

        $categories = CategoriesDAO::getAll();
        $pageid = "build";
        $title = "Build";
        $view = "views/containers/build.php";

        include_once("views/main.php");
    }

    public function add() {
        include_once('models/protection.php');

        if (isset($_GET['type'], $_GET['id'])) {
            $product = ProductsDAO::get($_GET['id']);
            if (!is_null($product)) {
                $_SESSION['container'][$_GET['type']] = $product;
                header('Location:/build/');
            } else {
                header('Location:/');
            }
        } else {
            header('Location:/');
        }
    }

    public function remove() {
        include_once('models/protection.php');

        if (isset($_GET['type'])) {
            $_SESSION['container'][$_GET['type']] = null;
            header('Location:/build/');
        } else {
            header('Location:/');
        }
    }

    public function lucky() {
        include_once('models/protection.php');

        $_SESSION['container']['main'] = ProductsDAO::getRandom(1);
        $_SESSION['container']['branch'] = ProductsDAO::getRandom(2);
        $_SESSION['container']['drink'] = ProductsDAO::getRandom(3);
        $_SESSION['container']['dessert'] = ProductsDAO::getRandom(4);

        header('Location:/build/');
    }
}

?>