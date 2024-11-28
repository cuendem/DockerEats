<?php

class Product {
    protected $id_product;
    protected $id_type;
    protected $name;
    protected $price;

    public function __construct() {

    }

    public function isAlcoholic() {
        $alcoholicProducts = ProductsDAO::getByCat(10); // 10 - Alcoholic

        return in_array($this, $alcoholicProducts) ? true : false;
    }

    public function alcoholIcon() {
        if ($this->isAlcoholic()) {
            return '<svg class="over18" title="This product cannot be bought by people under 18." viewBox="-6.4 -6.4 76.80 76.80" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img" class="iconify iconify--emojione-monotone" preserveAspectRatio="xMidYMid meet" fill="#000000" stroke="#000000" stroke-width="0.00064"><g id="SVGRepo_bgCarrier" stroke-width="0" transform="translate(0,0), scale(1)"><rect x="-6.4" y="-6.4" width="76.80" height="76.80" rx="38.4" fill="#a03b4e" strokewidth="0"></rect></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" stroke="#ffffffCCCCCC" stroke-width="0.64"></g><g id="SVGRepo_iconCarrier"><path d="M32 2C15.432 2 2 15.432 2 32s13.432 30 30 30s30-13.432 30-30S48.568 2 32 2m24 30a23.89 23.89 0 0 1-5.045 14.713l-4.607-4.607c1.011-1.324 1.525-2.846 1.525-4.576c0-1.463-.325-2.787-.975-3.973c-.65-1.188-1.62-2.141-2.908-2.859c1.259-.72 2.076-1.567 2.454-2.544c.377-.977.566-1.891.566-2.741c0-1.894-.715-3.508-2.145-4.845c-1.429-1.336-3.446-2.004-6.053-2.004s-4.625.668-6.054 2.004c-1.43 1.337-2.144 2.951-2.144 4.845c0 .343.039.698.101 1.062l-3.211-3.211v-4.295h-4.278a.077.077 0 0 1-.002.015l-5.938-5.938A23.892 23.892 0 0 1 32 8c13.255 0 24 10.745 24 24m-20.477-6.013c0-1.03.291-1.836.875-2.418c.583-.581 1.39-.872 2.424-.872c1.046 0 1.853.291 2.424.872c.57.582.856 1.388.856 2.418c0 .947-.286 1.72-.856 2.318c-.571.6-1.378.899-2.424.899c-1.034 0-1.841-.3-2.424-.899c-.584-.598-.875-1.37-.875-2.318m3.308 7.138c1.15 0 2.064.344 2.741 1.033c.678.689 1.016 1.699 1.016 3.029c0 .381-.039.729-.098 1.061l-4.937-4.937a4.5 4.5 0 0 1 1.278-.186M8 32a23.892 23.892 0 0 1 5.045-14.713l6.035 6.035c-.672.105-1.646.189-2.953.247v3.487h6.131v17.977h5.248V31.749l2.785 2.785a8.26 8.26 0 0 0-.538 2.995c0 2.193.749 4.059 2.25 5.6c1.498 1.539 3.706 2.309 6.622 2.309c.845 0 1.63-.072 2.366-.202l5.721 5.721A23.9 23.9 0 0 1 32 56C18.745 56 8 45.256 8 32" fill="#ffffff"></path></g></svg>';
        }
    }

    public function getId_product()
    {
        return $this->id_product;
    }

    public function setId_product($id_product)
    {
        $this->id_product = $id_product;

        return $this;
    }

    public function getId_type()
    {
        return $this->id_type;
    }

    public function setId_type($id_type)
    {
        $this->id_type = $id_type;

        return $this;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }
}

?>