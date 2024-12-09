<?php

class Offer {
    protected $id_offer;
    protected $name;
    protected $description;
    protected $discount;
    protected $date_start;
    protected $date_end;
    protected $discount_type;
    protected $product_type;
    protected $category_affected;
    protected $scope;

    public function __construct() {

    }

    public function getSummary() {
        $summary = $this->name;

        if ($this->scope == 1) {
            $summary .= ' (-'.$this->discount.($this->discount_type == 1 ? '€' : '%').')';
        }

        return $summary;
    }

    /**
     * Get the value of id_offer
     */ 
    public function getId_offer()
    {
        return $this->id_offer;
    }

    /**
     * Set the value of id_offer
     *
     * @return  self
     */ 
    public function setId_offer($id_offer)
    {
        $this->id_offer = $id_offer;

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
     * Get the value of description
     */ 
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set the value of description
     *
     * @return  self
     */ 
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
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

    /**
     * Get the value of product_type
     */ 
    public function getProduct_type()
    {
        return $this->product_type;
    }

    /**
     * Set the value of product_type
     *
     * @return  self
     */ 
    public function setProduct_type($product_type)
    {
        $this->product_type = $product_type;

        return $this;
    }

    /**
     * Get the value of category_affected
     */ 
    public function getCategory_affected()
    {
        return $this->category_affected;
    }

    /**
     * Set the value of category_affected
     *
     * @return  self
     */ 
    public function setCategory_affected($category_affected)
    {
        $this->category_affected = $category_affected;

        return $this;
    }

    /**
     * Get the value of scope
     */ 
    public function getScope()
    {
        return $this->scope;
    }

    /**
     * Set the value of scope
     *
     * @return  self
     */ 
    public function setScope($scope)
    {
        $this->scope = $scope;

        return $this;
    }
}

?>