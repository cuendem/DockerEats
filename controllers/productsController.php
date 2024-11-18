<?php

include_once("models/ProductsDAO.php");
include_once("models/CategoriesDAO.php");

class productsController {

    public function index($title = 'Menu', $type = '%')
    {
        $categories = CategoriesDAO::getAll();
        $pageid = "productlist";
        $view = "views/products/list.php";
        $buttons = ['normal', 'normal', 'normal', 'normal']; # All normal by default

        if ($type != '%') { # If calling from a different function
            $buttons[$type-1] = 'selected'; # Set the function's corresponding type to selected
        }

        include_once("views/main.php");
    }

    public function mains()
    {
        $this->index('Mains', 1);
    }

    public function branches()
    {
        $this->index('Branches', 2);
    }

    public function drinks()
    {
        $this->index('Drinks', 3);
    }

    public function desserts()
    {
        $this->index('Desserts', 4);
    }

    public function show() {
        include_once("views/products/show.php");
    }

    public function create() {
        include_once("views/products/create.php");
    }

    public function edit() {
        include_once("views/products/edit.php");
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
}

?>