<?php

include_once("models/session_init.php");
include_once("config/parameters.php");
include_once("controllers/productsController.php");
include_once("controllers/userController.php");
include_once("controllers/containerController.php");

if (!isset($_GET['controller'])) {
    $title = "Home";
    $view = "views/homepage.php";
    $pageid = "home";
    include_once("views/main.php");
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
        $title = "Page not found";
        $view = "views/404.php";
        $pageid = "notfound";
        include_once("views/main.php");
    }
}
?>