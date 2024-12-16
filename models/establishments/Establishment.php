<?php

class Establishment {
    protected $id_establishment;
    protected $iso_code;
    protected $name;
    protected $address;

    public function __construct() {

    }

    public function getOverview() {
        return $this->name.' ('.$this->address.')';
    }

    /**
     * Get the value of id_establishment
     */ 
    public function getId_establishment()
    {
        return $this->id_establishment;
    }

    /**
     * Set the value of id_establishment
     *
     * @return  self
     */ 
    public function setId_establishment($id_establishment)
    {
        $this->id_establishment = $id_establishment;

        return $this;
    }

    /**
     * Get the value of iso_code
     */ 
    public function getIso_code()
    {
        return $this->iso_code;
    }

    /**
     * Set the value of iso_code
     *
     * @return  self
     */ 
    public function setIso_code($iso_code)
    {
        $this->iso_code = $iso_code;

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

    /**
     * Get the value of address
     */ 
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set the value of address
     *
     * @return  self
     */ 
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }
}

?>