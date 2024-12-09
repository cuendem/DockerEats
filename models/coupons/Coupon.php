<?php

class Coupon {
    protected $id_coupon;
    protected $code;
    protected $discount;
    protected $date_start;
    protected $date_end;
    protected $discount_type;

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

    /**
     * Get the value of date_start
     */ 
    public function getDate_start()
    {
        return $this->date_start;
    }

    /**
     * Set the value of date_start
     *
     * @return  self
     */ 
    public function setDate_start($date_start)
    {
        $this->date_start = $date_start;

        return $this;
    }

    /**
     * Get the value of date_end
     */ 
    public function getDate_end()
    {
        return $this->date_end;
    }

    /**
     * Set the value of date_end
     *
     * @return  self
     */ 
    public function setDate_end($date_end)
    {
        $this->date_end = $date_end;

        return $this;
    }

    /**
     * Get the value of type
     */ 
    public function getDiscount()
    {
        return $this->discount;
    }

    /**
     * Set the value of type
     *
     * @return  self
     */ 
    public function setDiscount($discount)
    {
        $this->discount = $discount;

        return $this;
    }

    /**
     * Get the value of discount_type
     */ 
    public function getDiscount_type()
    {
        return $this->discount_type;
    }

    /**
     * Set the value of discount_type
     *
     * @return  self
     */ 
    public function setDiscount_type($discount_type)
    {
        $this->discount_type = $discount_type;

        return $this;
    }
}

?>