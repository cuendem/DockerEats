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

    public function getUser_data()
    {
        return UsersDAO::getById($this->id_user);
    }

    public function getDate()
    {
        $date = new DateTime($this->date_order);
        return $date->format('d/m/Y');
    }

    public function getDeliveryData() {
        if (is_null($this->delivery_address)) {
            return ['Pick Up', '<svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M22 22H2" stroke="#1D63ED" stroke-width="1.5" stroke-linecap="round"></path> <path opacity="0.5" d="M20 22V11" stroke="#1D63ED" stroke-width="1.5" stroke-linecap="round"></path> <path opacity="0.5" d="M4 22V11" stroke="#1D63ED" stroke-width="1.5" stroke-linecap="round"></path> <path d="M16.5278 2H7.47214C6.26932 2 5.66791 2 5.18461 2.2987C4.7013 2.5974 4.43234 3.13531 3.89443 4.21114L2.49081 7.75929C2.16652 8.57905 1.88279 9.54525 2.42867 10.2375C2.79489 10.7019 3.36257 11 3.99991 11C5.10448 11 5.99991 10.1046 5.99991 9C5.99991 10.1046 6.89534 11 7.99991 11C9.10448 11 9.99991 10.1046 9.99991 9C9.99991 10.1046 10.8953 11 11.9999 11C13.1045 11 13.9999 10.1046 13.9999 9C13.9999 10.1046 14.8953 11 15.9999 11C17.1045 11 17.9999 10.1046 17.9999 9C17.9999 10.1046 18.8953 11 19.9999 11C20.6373 11 21.205 10.7019 21.5712 10.2375C22.1171 9.54525 21.8334 8.57905 21.5091 7.75929L20.1055 4.21114C19.5676 3.13531 19.2986 2.5974 18.8153 2.2987C18.332 2 17.7306 2 16.5278 2Z" stroke="#1D63ED" stroke-width="1.5" stroke-linejoin="round"></path> <path opacity="0.5" d="M9.5 21.5V18.5C9.5 17.5654 9.5 17.0981 9.70096 16.75C9.83261 16.522 10.022 16.3326 10.25 16.201C10.5981 16 11.0654 16 12 16C12.9346 16 13.4019 16 13.75 16.201C13.978 16.3326 14.1674 16.522 14.299 16.75C14.5 17.0981 14.5 17.5654 14.5 18.5V21.5" stroke="#1D63ED" stroke-width="1.5" stroke-linecap="round"></path> </g></svg>', establishmentsController::getEstablishment($this->id_establishment)->getName()];
        } else {
            return ['Delivery', '<svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M7.50626 15.2647C7.61657 15.6639 8.02965 15.8982 8.4289 15.7879C8.82816 15.6776 9.06241 15.2645 8.9521 14.8652L7.50626 15.2647ZM6.07692 7.27442L6.79984 7.0747V7.0747L6.07692 7.27442ZM4.7037 5.91995L4.50319 6.64265L4.7037 5.91995ZM3.20051 4.72457C2.80138 4.61383 2.38804 4.84762 2.2773 5.24675C2.16656 5.64589 2.40035 6.05923 2.79949 6.16997L3.20051 4.72457ZM20.1886 15.7254C20.5895 15.6213 20.8301 15.2118 20.7259 14.8109C20.6217 14.41 20.2123 14.1695 19.8114 14.2737L20.1886 15.7254ZM10.1978 17.5588C10.5074 18.6795 9.82778 19.8618 8.62389 20.1747L9.00118 21.6265C10.9782 21.1127 12.1863 19.1239 11.6436 17.1594L10.1978 17.5588ZM8.62389 20.1747C7.41216 20.4896 6.19622 19.7863 5.88401 18.6562L4.43817 19.0556C4.97829 21.0107 7.03196 22.1383 9.00118 21.6265L8.62389 20.1747ZM5.88401 18.6562C5.57441 17.5355 6.254 16.3532 7.4579 16.0403L7.08061 14.5885C5.10356 15.1023 3.89544 17.0911 4.43817 19.0556L5.88401 18.6562ZM7.4579 16.0403C8.66962 15.7254 9.88556 16.4287 10.1978 17.5588L11.6436 17.1594C11.1035 15.2043 9.04982 14.0768 7.08061 14.5885L7.4579 16.0403ZM8.9521 14.8652L6.79984 7.0747L5.354 7.47414L7.50626 15.2647L8.9521 14.8652ZM4.90421 5.19725L3.20051 4.72457L2.79949 6.16997L4.50319 6.64265L4.90421 5.19725ZM6.79984 7.0747C6.54671 6.15847 5.8211 5.45164 4.90421 5.19725L4.50319 6.64265C4.92878 6.76073 5.24573 7.08223 5.354 7.47414L6.79984 7.0747ZM11.1093 18.085L20.1886 15.7254L19.8114 14.2737L10.732 16.6332L11.1093 18.085Z" fill="#1D63ED"></path> <path opacity="0.5" d="M9.56541 8.73049C9.0804 6.97492 8.8379 6.09714 9.24954 5.40562C9.66119 4.71409 10.5662 4.47889 12.3763 4.00849L14.2962 3.50955C16.1062 3.03915 17.0113 2.80394 17.7242 3.20319C18.4372 3.60244 18.6797 4.48023 19.1647 6.2358L19.6792 8.09786C20.1642 9.85343 20.4067 10.7312 19.995 11.4227C19.5834 12.1143 18.6784 12.3495 16.8683 12.8199L14.9484 13.3188C13.1384 13.7892 12.2333 14.0244 11.5203 13.6252C10.8073 13.2259 10.5648 12.3481 10.0798 10.5926L9.56541 8.73049Z" stroke="#1D63ED" stroke-width="1.5"></path> </g></svg>', $this->delivery_address];
        }
    }

    public function getPaymentData() {
        switch ($this->payment_type) {
            case 'Card':
                return [$this->payment_type, '<svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M2 12C2 8.22876 2 6.34315 3.17157 5.17157C4.34315 4 6.22876 4 10 4H14C17.7712 4 19.6569 4 20.8284 5.17157C22 6.34315 22 8.22876 22 12C22 15.7712 22 17.6569 20.8284 18.8284C19.6569 20 17.7712 20 14 20H10C6.22876 20 4.34315 20 3.17157 18.8284C2 17.6569 2 15.7712 2 12Z" stroke="#1D63ED" stroke-width="1.5"></path><path opacity="0.5" d="M10 16H6" stroke="#1D63ED" stroke-width="1.5" stroke-linecap="round"></path><path opacity="0.5" d="M14 16H12.5" stroke="#1D63ED" stroke-width="1.5" stroke-linecap="round"></path><path opacity="0.5" d="M2 10L22 10" stroke="#1D63ED" stroke-width="1.5" stroke-linecap="round"></path></svg>'];

            case 'PayPal':
                return [$this->payment_type, '<svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M13 3H7.76556C6.75692 3 5.90612 3.75107 5.78101 4.75193L4.12403 18.0077C4.05817 18.5346 4.46901 19 5 19H6.30575C7.28342 19 8.1178 18.2932 8.27853 17.3288L8.8356 13.9864C8.93047 13.4172 9.42294 13 10 13H13C19 13 19 3 13 3Z" stroke="#1D63ED" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path><path d="M7.32317 18.7378L7.14142 20.0101C7.06678 20.5326 7.47221 21 8 21H9.43845C10.3562 21 11.1561 20.3754 11.3787 19.4851L11.7575 17.9702C11.9 17.4 12.4123 17 13 17H16C21.393 17 21.9386 8.92103 17.6368 7.28638" stroke="#1D63ED" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></svg>'];

            case 'Cash':
                return [$this->payment_type, '<svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M2 10C2 7.17157 2 5.75736 2.87868 4.87868C3.75736 4 5.17157 4 8 4H13C15.8284 4 17.2426 4 18.1213 4.87868C19 5.75736 19 7.17157 19 10C19 12.8284 19 14.2426 18.1213 15.1213C17.2426 16 15.8284 16 13 16H8C5.17157 16 3.75736 16 2.87868 15.1213C2 14.2426 2 12.8284 2 10Z" stroke="#1D63ED" stroke-width="1.5"></path> <path opacity="0.5" d="M19.0003 7.07617C19.9754 7.17208 20.6317 7.38885 21.1216 7.87873C22.0003 8.75741 22.0003 10.1716 22.0003 13.0001C22.0003 15.8285 22.0003 17.2427 21.1216 18.1214C20.2429 19.0001 18.8287 19.0001 16.0003 19.0001H11.0003C8.17187 19.0001 6.75766 19.0001 5.87898 18.1214C5.38909 17.6315 5.17233 16.9751 5.07642 16" stroke="#1D63ED" stroke-width="1.5"></path> <path d="M13 10C13 11.3807 11.8807 12.5 10.5 12.5C9.11929 12.5 8 11.3807 8 10C8 8.61929 9.11929 7.5 10.5 7.5C11.8807 7.5 13 8.61929 13 10Z" stroke="#1D63ED" stroke-width="1.5"></path> <path opacity="0.5" d="M16 12L16 8" stroke="#1D63ED" stroke-width="1.5" stroke-linecap="round"></path> <path opacity="0.5" d="M5 12L5 8" stroke="#1D63ED" stroke-width="1.5" stroke-linecap="round"></path> </g></svg>'];
        }
    }

    public function getCoupons() {
        return CouponsDAO::getOrderCoupons($this->id_order);
    }

    public function getContainers() {
        return ContainersDAO::getOrderContainers($this->id_order);
    }

    public function getSales() {
        return SalesDAO::getByOrder($this->id_order);
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