<?php

include_once("models/ProductsDAO.php");

class productsController {

    public function index()
    {
        $products = ProductsDAO::getAll();
        $type = "Products";
        $title = "DockerEats: Our ".$type;
        $view = "views/products/list.php";
        include_once("views/main.php");
    }

    public function mains()
    {
        $products = ProductsDAO::getAll(1);
        $type = "Mains";
        $title = "DockerEats: Our ".$type;
        $view = "views/products/list.php";
        include_once("views/main.php");
    }

    public function branches()
    {
        $products = ProductsDAO::getAll(2);
        $type = "Branches";
        $title = "DockerEats: Our ".$type;
        $view = "views/products/list.php";
        include_once("views/main.php");
    }

    public function drinks()
    {
        $products = ProductsDAO::getAll(3);
        $type = "Drinks";
        $title = "DockerEats: Our ".$type;
        $view = "views/products/list.php";
        include_once("views/main.php");
    }

    public function desserts()
    {
        $products = ProductsDAO::getAll(4);
        $type = "Desserts";
        $title = "DockerEats: Our ".$type;
        $view = "views/products/list.php";
        include_once("views/main.php");
    }

    public function show() {
        include_once("views/products/show.php");
    }

    public function create() {
        include_once("views/products/create.php");
    }

    public function store() {
        $nombre = $_POST['nombre'];
        $talla = $_POST['talla'];
        $precio = $_POST['precio'];

        $producto = new Camiseta();
        $producto->setNombre($nombre);
        $producto->setTalla($talla);
        $producto->setPrecio($precio);

        CamisetaDAO::store($producto);
    }

    public function edit() {
        include_once("views/products/edit.php");
    }
}

?>