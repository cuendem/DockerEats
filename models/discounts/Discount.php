<?php

abstract class Discount {
    protected $discount;
    protected $date_start;
    protected $date_end;
    protected $discount_type;

    public function __construct() {

    }

    abstract public function getSummary();

    public static function order($discounts) {
        // Sort the discounts using usort with a custom function
        usort($discounts, function($a, $b) {
            // Get discount types for both discounts
            $typeA = $a->getDiscount_type();
            $typeB = $b->getDiscount_type();

            // Put percentage based discounts first
            if ($typeA == 2 && $typeB != 2) {
                return -1; // $a comes before $b
            } elseif ($typeA != 2 && $typeB == 2) {
                return 1; // $b comes before $a
            }
            return 0; // Otherwise, leave order unchanged
        });

        return $discounts;
    }

    /**
     * Get the value of discount
     */ 
    public function getDiscount()
    {
        return $this->discount;
    }

    /**
     * Set the value of discount
     *
     * @return  self
     */ 
    public function setDiscount($discount)
    {
        $this->discount = $discount;

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