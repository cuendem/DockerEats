<?php

class Product {
    protected $id_product;
    protected $id_type;
    protected $name;
    protected $price;

    public function __construct() {

    }

    public function isAlcoholic($alcoholicProducts) {
        return in_array($this, $alcoholicProducts) ? true : false;
    }

    public function alcoholIcon($alcoholicProducts) {
        if ($this->isAlcoholic($alcoholicProducts)) {
            return '<svg class="over18" title="This product cannot be bought by people under 18." viewBox="-6.4 -6.4 76.80 76.80" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img" class="iconify iconify--emojione-monotone" preserveAspectRatio="xMidYMid meet" fill="#000000" stroke="#000000" stroke-width="0.00064"><g id="SVGRepo_bgCarrier" stroke-width="0" transform="translate(0,0), scale(1)"><rect x="-6.4" y="-6.4" width="76.80" height="76.80" rx="38.4" fill="#a03b4e" strokewidth="0"></rect></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" stroke="#ffffffCCCCCC" stroke-width="0.64"></g><g id="SVGRepo_iconCarrier"><path d="M32 2C15.432 2 2 15.432 2 32s13.432 30 30 30s30-13.432 30-30S48.568 2 32 2m24 30a23.89 23.89 0 0 1-5.045 14.713l-4.607-4.607c1.011-1.324 1.525-2.846 1.525-4.576c0-1.463-.325-2.787-.975-3.973c-.65-1.188-1.62-2.141-2.908-2.859c1.259-.72 2.076-1.567 2.454-2.544c.377-.977.566-1.891.566-2.741c0-1.894-.715-3.508-2.145-4.845c-1.429-1.336-3.446-2.004-6.053-2.004s-4.625.668-6.054 2.004c-1.43 1.337-2.144 2.951-2.144 4.845c0 .343.039.698.101 1.062l-3.211-3.211v-4.295h-4.278a.077.077 0 0 1-.002.015l-5.938-5.938A23.892 23.892 0 0 1 32 8c13.255 0 24 10.745 24 24m-20.477-6.013c0-1.03.291-1.836.875-2.418c.583-.581 1.39-.872 2.424-.872c1.046 0 1.853.291 2.424.872c.57.582.856 1.388.856 2.418c0 .947-.286 1.72-.856 2.318c-.571.6-1.378.899-2.424.899c-1.034 0-1.841-.3-2.424-.899c-.584-.598-.875-1.37-.875-2.318m3.308 7.138c1.15 0 2.064.344 2.741 1.033c.678.689 1.016 1.699 1.016 3.029c0 .381-.039.729-.098 1.061l-4.937-4.937a4.5 4.5 0 0 1 1.278-.186M8 32a23.892 23.892 0 0 1 5.045-14.713l6.035 6.035c-.672.105-1.646.189-2.953.247v3.487h6.131v17.977h5.248V31.749l2.785 2.785a8.26 8.26 0 0 0-.538 2.995c0 2.193.749 4.059 2.25 5.6c1.498 1.539 3.706 2.309 6.622 2.309c.845 0 1.63-.072 2.366-.202l5.721 5.721A23.9 23.9 0 0 1 32 56C18.745 56 8 45.256 8 32" fill="#ffffff"></path></g></svg>';
        }
    }

    public function getCategories() {
        return CategoriesDAO::getIDsByProduct($this->id_product);
    }

    public function getAllergens() {
        return AllergensDAO::getByProduct($this->id_product);
    }

    public function isOnSale($currentSales) {
        if (!is_null($currentSales)) {
            foreach ($currentSales as $i => $sale) {
                if ($sale->getScope() == 2) {
                    # Product specific, not entire container
                    if (($sale->getProduct_type() == 0 || $sale->getProduct_type() == $this->id_type) && ($sale->getCategory_affected() == 0 || in_array($sale->getCategory_affected(), $this->getCategories()))) {
                        return $sale;
                    }
                }
            }
        }
        return false;
    }

    public function getDiscountedPrice($sale)
    {
        if ($sale->getDiscount_type() == 1) {
            # Base
            return number_format($this->price - $sale->getDiscount(), 2);
        } else {
            # Percentage
            return number_format(round($this->price*(1 - ($sale->getDiscount() / 100)), 2), 2);
        }
    }

    public function saleIcon() {
        return '<svg class="saleicon" title="This product is on sale!" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M9.59236 3.20031C9.34886 3.40782 9.2271 3.51158 9.09706 3.59874C8.79896 3.79854 8.46417 3.93721 8.1121 4.00672C7.95851 4.03705 7.79903 4.04977 7.48008 4.07522L7.48007 4.07523C6.67869 4.13918 6.278 4.17115 5.94371 4.28923C5.17051 4.56233 4.56233 5.17051 4.28923 5.94371C4.17115 6.278 4.13918 6.67869 4.07523 7.48007L4.07522 7.48008C4.04977 7.79903 4.03705 7.95851 4.00672 8.1121C3.93721 8.46417 3.79854 8.79896 3.59874 9.09706C3.51158 9.2271 3.40781 9.34887 3.20028 9.59239L3.20027 9.5924C2.67883 10.2043 2.4181 10.5102 2.26522 10.8301C1.91159 11.57 1.91159 12.43 2.26522 13.1699C2.41811 13.4898 2.67883 13.7957 3.20027 14.4076L3.20031 14.4076C3.4078 14.6511 3.51159 14.7729 3.59874 14.9029C3.79854 15.201 3.93721 15.5358 4.00672 15.8879C4.03705 16.0415 4.04977 16.201 4.07522 16.5199L4.07523 16.5199C4.13918 17.3213 4.17115 17.722 4.28923 18.0563C4.56233 18.8295 5.17051 19.4377 5.94371 19.7108C6.27799 19.8288 6.67867 19.8608 7.48 19.9248L7.48008 19.9248C7.79903 19.9502 7.95851 19.963 8.1121 19.9933C8.46417 20.0628 8.79896 20.2015 9.09706 20.4013C9.22711 20.4884 9.34887 20.5922 9.5924 20.7997C10.2043 21.3212 10.5102 21.5819 10.8301 21.7348C11.57 22.0884 12.43 22.0884 13.1699 21.7348C13.4898 21.5819 13.7957 21.3212 14.4076 20.7997C14.6511 20.5922 14.7729 20.4884 14.9029 20.4013C15.201 20.2015 15.5358 20.0628 15.8879 19.9933C16.0415 19.963 16.201 19.9502 16.5199 19.9248L16.52 19.9248C17.3213 19.8608 17.722 19.8288 18.0563 19.7108C18.8295 19.4377 19.4377 18.8295 19.7108 18.0563C19.8288 17.722 19.8608 17.3213 19.9248 16.52L19.9248 16.5199C19.9502 16.201 19.963 16.0415 19.9933 15.8879C20.0628 15.5358 20.2015 15.201 20.4013 14.9029C20.4884 14.7729 20.5922 14.6511 20.7997 14.4076C21.3212 13.7957 21.5819 13.4898 21.7348 13.1699C22.0884 12.43 22.0884 11.57 21.7348 10.8301C21.5819 10.5102 21.3212 10.2043 20.7997 9.5924C20.5922 9.34887 20.4884 9.22711 20.4013 9.09706C20.2015 8.79896 20.0628 8.46417 19.9933 8.1121C19.963 7.95851 19.9502 7.79903 19.9248 7.48008L19.9248 7.48C19.8608 6.67867 19.8288 6.27799 19.7108 5.94371C19.4377 5.17051 18.8295 4.56233 18.0563 4.28923C17.722 4.17115 17.3213 4.13918 16.5199 4.07523L16.5199 4.07522C16.201 4.04977 16.0415 4.03705 15.8879 4.00672C15.5358 3.93721 15.201 3.79854 14.9029 3.59874C14.7729 3.51158 14.6511 3.40781 14.4076 3.20027C13.7957 2.67883 13.4898 2.41811 13.1699 2.26522C12.43 1.91159 11.57 1.91159 10.8301 2.26522C10.5102 2.4181 10.2043 2.67883 9.5924 3.20027L9.59236 3.20031Z" fill="#1D63ED"></path> <path d="M15.8309 8.17001C16.1487 8.48785 16.1487 9.00315 15.8309 9.32099L9.32001 15.8319C9.00218 16.1497 8.48687 16.1497 8.16904 15.8319C7.85121 15.514 7.85121 14.9987 8.16904 14.6809L14.6799 8.17001C14.9978 7.85218 15.5131 7.85218 15.8309 8.17001Z" fill="#FFFFFF"></path> <path d="M15.798 14.7138C15.798 15.3131 15.3121 15.799 14.7128 15.799C14.1135 15.799 13.6277 15.3131 13.6277 14.7138C13.6277 14.1145 14.1135 13.6287 14.7128 13.6287C15.3121 13.6287 15.798 14.1145 15.798 14.7138Z" fill="#FFFFFF"></path> <path d="M9.2871 10.3732C9.88641 10.3732 10.3722 9.88738 10.3722 9.28807C10.3722 8.68876 9.88641 8.20293 9.2871 8.20293C8.68779 8.20293 8.20195 8.68876 8.20195 9.28807C8.20195 9.88738 8.68779 10.3732 9.2871 10.3732Z" fill="#FFFFFF"></path> </g></svg>';
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