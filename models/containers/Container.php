<?php

class Container {
    protected $id_container;
    protected $id_order;

    public function __construct() {

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
     * Get the value of id_order
     */ 
    public function getId_order()
    {
        return $this->id_order;
    }

    /**
     * Set the value of id_order
     *
     * @return  self
     */ 
    public function setId_order($id_order)
    {
        $this->id_order = $id_order;

        return $this;
    }
}

?>