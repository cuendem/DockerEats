<?php

include_once("models/containers/ContainersDAO.php");
include_once("models/products/ProductsDAO.php");
include_once("models/products/Product.php");

class containerController {
    public function index() {
        include_once('models/protection.php');

        $pageid = "build";
        $title = "Build";
        $view = "views/containers/build.php";

        $categories = CategoriesDAO::getAll();
        $alcoholicProducts = ProductsDAO::getByCat(10);
        $currentSales = SalesDAO::getAllAvailable(date('Y-m-d'));

        include_once("views/main.php");
    }

    public function add() {
        include_once('models/protection.php');

        if (isset($_GET['param1'], $_GET['param2'])) {
            $product = ProductsDAO::get($_GET['param2']);
            if (!is_null($product)) {
                $_SESSION['container'][$_GET['param1']] = $product;
                $id = $product->getId_product();
                logsController::log("Added product $id to container");
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

        if (isset($_GET['param1'])) {
            $type = $_GET['param1'];

            if ($type == 'all') {
                unset($_SESSION['container']);
                logsController::log("Removed all products from container");
            } else {
                unset($_SESSION['container'][$type]);
                logsController::log("Removed $type from container");
            }

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

        logsController::log("Generated a lucky container");

        header('Location:/build/');
    }

    public function addtocart() {
        include_once('models/protection.php');

        if (isset($_SESSION['container']['main'], $_SESSION['container']['branch'], $_SESSION['container']['drink'], $_SESSION['container']['dessert'])) {
            $_SESSION['cart'][] = $_SESSION['container'];
            unset($_SESSION['container']);

            logsController::log("Added container to cart");
        }

        header('Location:/build/');
    }

    public function removefromcart() {
        include_once('models/protection.php');

        if (isset($_GET['param1'])) {
            unset($_SESSION['cart'][intval($_GET['param1'])]);

            logsController::log("Removed container from cart");
        }

        header('Location:/account/cart');
    }

    public static function addContainer($order) {
        return ContainersDAO::store($order);
    }
}

?>