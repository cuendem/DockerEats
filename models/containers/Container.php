<?php

class Container {
    protected $id_container;
    protected $id_order;

    public function __construct() {

    }

    public function getPart($id_part_type, $get_product = false) {
        $parts = PartsDAO::getFromContainer($this->id_container);

        foreach ($parts as $i => $part) {
            $product = $part->getProduct();
            if ($product->getId_type() == $id_part_type) {
                if ($get_product) {
                    return $product;
                } else {
                    return $part;
                }
            }
        }
    }

    public function getPrice($sales) {
        $parts = PartsDAO::getFromContainer($this->id_container);
        $total = 0;

        foreach ($parts as $i => $part) {
            $total += $part->getPrice($sales);
        }

        return $total;
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