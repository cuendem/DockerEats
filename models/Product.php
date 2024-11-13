<?php

class Product {
    protected $id_product;
    protected $id_type;
    protected $id_category;
    protected $name;
    protected $description;
    protected $price;

    public function __construct() {

    }

    public function getId_product()
    {
        return $this->id_product;
    }

    public function setId_product($id_product)
    {
        $this->id_product = $id_product;

        return $this;
    }

    public function getId_type()
    {
        return $this->id_type;
    }

    public function setId_type($id_type)
    {
        $this->id_type = $id_type;

        return $this;
    }

    public function getId_category()
    {
        return $this->id_category;
    }

    public function setId_category($id_category)
    {
        $this->id_category = $id_category;

        return $this;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }
}

?>