<?php

class Order {
    protected $id_order;
    protected $id_user;
    protected $id_establishment;
    protected $date_order;
    protected $delivery_address;
    protected $cart;

    public function __construct() {

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

    /**
     * Get the value of id_user
     */ 
    public function getId_user()
    {
        return $this->id_user;
    }

    /**
     * Set the value of id_user
     *
     * @return  self
     */ 
    public function setId_user($id_user)
    {
        $this->id_user = $id_user;

        return $this;
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
     * Get the value of date_order
     */ 
    public function getDate_order()
    {
        return $this->date_order;
    }

    /**
     * Set the value of date_order
     *
     * @return  self
     */ 
    public function setDate_order($date_order)
    {
        $this->date_order = $date_order;

        return $this;
    }

    /**
     * Get the value of delivery_address
     */ 
    public function getDelivery_address()
    {
        return $this->delivery_address;
    }

    /**
     * Set the value of delivery_address
     *
     * @return  self
     */ 
    public function setDelivery_address($delivery_address)
    {
        $this->delivery_address = $delivery_address;

        return $this;
    }

    /**
     * Get the value of cart
     */ 
    public function getCart()
    {
        return $this->cart;
    }

    /**
     * Set the value of cart
     *
     * @return  self
     */ 
    public function setCart($cart)
    {
        $this->cart = $cart;

        return $this;
    }
}

?>