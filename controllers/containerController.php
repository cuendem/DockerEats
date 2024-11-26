<?php

include_once("models/containers/ContainersDAO.php");

class containerController {

    public function index() {
        $categories = CategoriesDAO::getAll();
        $pageid = "build";
        $title = "Build";
        $view = "views/containers/build.php";

        include_once("views/main.php");
    }
}

?>