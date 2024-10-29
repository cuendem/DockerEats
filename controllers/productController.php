<?php

include_once("models/ProductDAO.php");

class productController {

    public function index()
    {
        $products = ProductDAO::getAll();
        $title = "DockerEats: Product List";
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
        include_once("views/productos/edit.php");
    }
}

?>