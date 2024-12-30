<?php

class Allergen {
    protected $id_allergen;
    protected $name;

    public function __construct() {

    }

    /**
     * Get the value of id_allergen
     */ 
    public function getId_allergen()
    {
        return $this->id_allergen;
    }

    /**
     * Set the value of id_allergen
     *
     * @return  self
     */ 
    public function setId_allergen($id_allergen)
    {
        $this->id_allergen = $id_allergen;

        return $this;
    }

    /**
     * Get the value of name
     */ 
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */ 
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }
}