<?php

class Order {
    protected $id_order;
    protected $id_user;
    protected $id_establishment;
    protected $date_order;
    protected $delivery_address;
    protected $payment_type;
    protected $card_number;
    protected $expiration_date;
    protected $cvc;
    protected $card_holder;

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
     * Get the value of payment_type
     */ 
    public function getPayment_type()
    {
        return $this->payment_type;
    }

    /**
     * Set the value of payment_type
     *
     * @return  self
     */ 
    public function setPayment_type($payment_type)
    {
        $this->payment_type = $payment_type;

        return $this;
    }

    /**
     * Get the value of card_number
     */ 
    public function getCard_number()
    {
        return $this->card_number;
    }

    /**
     * Set the value of card_number
     *
     * @return  self
     */ 
    public function setCard_number($card_number)
    {
        $this->card_number = $card_number;

        return $this;
    }

    /**
     * Get the value of expiration_date
     */ 
    public function getExpiration_date()
    {
        return $this->expiration_date;
    }

    /**
     * Set the value of expiration_date
     *
     * @return  self
     */ 
    public function setExpiration_date($expiration_date)
    {
        $this->expiration_date = $expiration_date;

        return $this;
    }

    /**
     * Get the value of cvc
     */ 
    public function getCvc()
    {
        return $this->cvc;
    }

    /**
     * Set the value of cvc
     *
     * @return  self
     */ 
    public function setCvc($cvc)
    {
        $this->cvc = $cvc;

        return $this;
    }

    /**
     * Get the value of card_holder
     */ 
    public function getCard_holder()
    {
        return $this->card_holder;
    }

    /**
     * Set the value of card_holder
     *
     * @return  self
     */ 
    public function setCard_holder($card_holder)
    {
        $this->card_holder = $card_holder;

        return $this;
    }
}

?>