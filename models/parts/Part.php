<?php

class Part {
    protected $id_part;
    protected $id_container;
    protected $id_product;

    public function __construct() {

    }

    /**
     * Get the value of id_part
     */ 
    public function getId_part()
    {
        return $this->id_part;
    }

    /**
     * Set the value of id_part
     *
     * @return  self
     */ 
    public function setId_part($id_part)
    {
        $this->id_part = $id_part;

        return $this;
    }

    /**
     * Get the value of id_container
     */ 
    public function getId_container()
    {
        return $this->id_container;
    }

    /**
     * Set the value of id_container
     *
     * @return  self
     */ 
    public function setId_container($id_container)
    {
        $this->id_container = $id_container;

        return $this;
    }

    /**
     * Get the value of id_product
     */ 
    public function getId_product()
    {
        return $this->id_product;
    }

    /**
     * Set the value of id_product
     *
     * @return  self
     */ 
    public function setId_product($id_product)
    {
        $this->id_product = $id_product;

        return $this;
    }
}

?>