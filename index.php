<?php

include_once("config/parameters.php");
include_once("controllers/productController.php");

    if (!isset($_GET['controller'])) {
        header("Location:".url."?controller=product");
    } else {
        $controller_name = $_GET['controller']."Controller";
        if (class_exists($controller_name)) {
            $controller = new $controller_name();

            if (isset($_GET['action']) && method_exists($controller, $_GET['action'])) {
                $action = $_GET['action'];
            } else {
                $action = default_action;
            }

            $controller -> $action();
        } else {
            echo "Controller ".$controller_name." does not exist.";
        }
    }
?>