<?php include_once('admin/views/header.html') ?>
<div class="mt-5 d-flex justify-content-center"><svg class="admin-icon" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M7.50626 15.2647C7.61657 15.6639 8.02965 15.8982 8.4289 15.7879C8.82816 15.6776 9.06241 15.2645 8.9521 14.8652L7.50626 15.2647ZM6.07692 7.27442L6.79984 7.0747V7.0747L6.07692 7.27442ZM4.7037 5.91995L4.50319 6.64265L4.7037 5.91995ZM3.20051 4.72457C2.80138 4.61383 2.38804 4.84762 2.2773 5.24675C2.16656 5.64589 2.40035 6.05923 2.79949 6.16997L3.20051 4.72457ZM20.1886 15.7254C20.5895 15.6213 20.8301 15.2118 20.7259 14.8109C20.6217 14.41 20.2123 14.1695 19.8114 14.2737L20.1886 15.7254ZM10.1978 17.5588C10.5074 18.6795 9.82778 19.8618 8.62389 20.1747L9.00118 21.6265C10.9782 21.1127 12.1863 19.1239 11.6436 17.1594L10.1978 17.5588ZM8.62389 20.1747C7.41216 20.4896 6.19622 19.7863 5.88401 18.6562L4.43817 19.0556C4.97829 21.0107 7.03196 22.1383 9.00118 21.6265L8.62389 20.1747ZM5.88401 18.6562C5.57441 17.5355 6.254 16.3532 7.4579 16.0403L7.08061 14.5885C5.10356 15.1023 3.89544 17.0911 4.43817 19.0556L5.88401 18.6562ZM7.4579 16.0403C8.66962 15.7254 9.88556 16.4287 10.1978 17.5588L11.6436 17.1594C11.1035 15.2043 9.04982 14.0768 7.08061 14.5885L7.4579 16.0403ZM8.9521 14.8652L6.79984 7.0747L5.354 7.47414L7.50626 15.2647L8.9521 14.8652ZM4.90421 5.19725L3.20051 4.72457L2.79949 6.16997L4.50319 6.64265L4.90421 5.19725ZM6.79984 7.0747C6.54671 6.15847 5.8211 5.45164 4.90421 5.19725L4.50319 6.64265C4.92878 6.76073 5.24573 7.08223 5.354 7.47414L6.79984 7.0747ZM11.1093 18.085L20.1886 15.7254L19.8114 14.2737L10.732 16.6332L11.1093 18.085Z" fill="#1D63ED"></path> <path opacity="0.5" d="M9.56541 8.73049C9.0804 6.97492 8.8379 6.09714 9.24954 5.40562C9.66119 4.71409 10.5662 4.47889 12.3763 4.00849L14.2962 3.50955C16.1062 3.03915 17.0113 2.80394 17.7242 3.20319C18.4372 3.60244 18.6797 4.48023 19.1647 6.2358L19.6792 8.09786C20.1642 9.85343 20.4067 10.7312 19.995 11.4227C19.5834 12.1143 18.6784 12.3495 16.8683 12.8199L14.9484 13.3188C13.1384 13.7892 12.2333 14.0244 11.5203 13.6252C10.8073 13.2259 10.5648 12.3481 10.0798 10.5926L9.56541 8.73049Z" stroke="#1D63ED" stroke-width="1.5"></path> </g></svg></div>
<h1 class="mt-2 mb-0">Manage orders</h1>
<section id="buttons" class="d-flex justify-content-center align-items-center my-5">
    <button id="listorders" class="mx-2 btn btn-normal">Get ALL</button>
    <div class="filter-selector d-flex align-items-center mx-2">
        <button id="filter-user" type="submit" class="btn selector-start">Get by user</button>
        <select name="user" id="user-filter" class="selector-end"></select>
    </div>
    <div class="filter-selector d-flex align-items-center mx-2">
        <select class="bordered text-center" name="type" id="order-filter">
            <option value="none">Order...</option>
            <option value="date_order-ASC">Date 🠇</option>
            <option value="date_order-DESC">Date 🠅</option>
            <option value="price-ASC">Price 🠇</option>
            <option value="price-DESC">Price 🠅</option>
        </select>
    </div>
    <div class="filter-selector d-flex align-items-center mx-2">
        <select class="bordered" name="type" id="currency-filter">
            <option value="eur">€ - Euro</option>
            <option value="usd">$ - US Dollar</option>
            <option value="gbp">£ - British Pound</option>
            <option value="jpy">¥ - Japanese Yen</option>
            <option value="cny">¥ - Chinese Yuan</option>
            <option value="krw">₩ - South Korean Won</option>
            <option value="rub">₽ - Russian Ruble</option>
            <option value="chf">CHF - Swiss Franc</option>
            <option value="czk">Kč - Czech Koruna</option>
            <option value="inr">₹ - Indian Rupee</option>
            <option value="btc">₿ - Bitcoin</option>
        </select>
    </div>
</section>
<section id="target" class="container-fluid" data-tax="<?=tax?>" data-delivery-tax="<?=delivery_tax?>">
    
</section>
<?php include_once('admin/views/footer.html') ?>
<script type="module" src="scripts/orders.js"></script>