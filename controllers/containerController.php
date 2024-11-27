<?php

include_once("models/containers/ContainersDAO.php");

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
            $_SESSION['container'][$_GET['type']] = $_GET['id'];
            header('Location:/build/');
        } else {
            header('Location:/');
        }
    }
}

?>