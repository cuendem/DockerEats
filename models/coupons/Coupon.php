<?php

include_once('models/discounts/Discount.php');

class Coupon extends Discount {
    protected $id_coupon;
    protected $code;

    public function __construct() {

    }

    public function getSummary() {
        return $this->code.' (-'.$this->discount.($this->discount_type == 1 ? '€' : '%').')';
    }

    /**
     * Get the value of id_coupon
     */ 
    public function getId_coupon()
    {
        return $this->id_coupon;
    }

    /**
     * Set the value of id_coupon
     *
     * @return  self
     */ 
    public function setId_coupon($id_coupon)
    {
        $this->id_coupon = $id_coupon;

        return $this;
    }

    /**
     * Get the value of code
     */ 
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set the value of code
     *
     * @return  self
     */ 
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }
}

?>