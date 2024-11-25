<?php include_once('header.php') ?>
<main>
<section id="banner" class="container-fluid text-center mt-5">
    <div class="row">
        <div class="col">
            <h1>Build whatever.<br>Eat wherever.</h1>
            <p class="lead">Build your very own food container. Unlimited combinations.</p>
            <p class="my-2">
                <a href="/build/" class="mt-3 mx-2 btn btn-selected">Start building</a>
                <a href="/#whatis" class="mt-3 mx-2 btn btn-normal">Learn more about DockerEats</a>
            </p>
        </div>
    </div>
    <div class="bannerContainer mt-5 position-relative overflow-hidden">
        <img src="/img/TupperContainer.webp" class="undraggable position-absolute top-0 start-50 translate-middle-x"  alt="DockerEats Container">
    </div>
</section>

<section id="whatis" class="container-fluid wave-separator">
    <div class="whatisHead row">
        <div class="col-lg-8 text-center mx-auto">
            <h2>What is DockerEats?</h2>
            <h3>A completely customizable experience for every customer</h3>
            <p>DockerEats is the latest branch in the Docker family, a fun and engaging way to adapt our love for containerized applications into the second most important helper for a developer — Food!</p>
            <div class="row">
                <div class="d-flex justify-content-center mt-4 gap-3 flex-wrap">
                    <button type="button" class="btn btn-pilled btn-selected d-flex align-items-center gap-2"><svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M15.5777 3.38197L17.5777 4.43152C19.7294 5.56066 20.8052 6.12523 21.4026 7.13974C22 8.15425 22 9.41667 22 11.9415V12.0585C22 14.5833 22 15.8458 21.4026 16.8603C20.8052 17.8748 19.7294 18.4393 17.5777 19.5685L15.5777 20.618C13.8221 21.5393 12.9443 22 12 22C11.0557 22 10.1779 21.5393 8.42229 20.618L6.42229 19.5685C4.27063 18.4393 3.19479 17.8748 2.5974 16.8603C2 15.8458 2 14.5833 2 12.0585V11.9415C2 9.41667 2 8.15425 2.5974 7.13974C3.19479 6.12523 4.27063 5.56066 6.42229 4.43152L8.42229 3.38197C10.1779 2.46066 11.0557 2 12 2C12.9443 2 13.8221 2.46066 15.5777 3.38197Z" stroke-linecap="round"/><path opacity="0.5" d="M21 7.5L12 12M12 12L3 7.5M12 12V21.5" stroke-linecap="round"/></svg> Containers</button>
                    <button type="button" class="btn btn-pilled btn-normal d-flex align-items-center gap-2"><svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path opacity="0.5" d="M13.2535 19.4243C12.9606 19.1314 12.4857 19.1314 12.1928 19.4243C11.8999 19.7172 11.8999 20.1921 12.1928 20.485L13.2535 19.4243ZM18.5083 19.9546L19.0387 20.485L18.5083 19.9546ZM4.04537 5.49167L4.5757 6.022H4.5757L4.04537 5.49167ZM3.51504 11.8072C3.80794 12.1001 4.28281 12.1001 4.5757 11.8072C4.8686 11.5143 4.8686 11.0394 4.5757 10.7465L3.51504 11.8072ZM11.2769 4.04537L11.8072 4.5757C11.9478 4.43505 12.0269 4.24428 12.0269 4.04537C12.0269 3.84646 11.9478 3.65569 11.8072 3.51504L11.2769 4.04537ZM5.49167 4.04537L4.96134 3.51504L4.96134 3.51504L5.49167 4.04537ZM19.9546 12.7231L20.485 12.1928C20.3443 12.0522 20.1535 11.9731 19.9546 11.9731C19.7557 11.9731 19.565 12.0522 19.4243 12.1928L19.9546 12.7231ZM19.9546 18.5083L19.4243 17.978L19.9546 18.5083ZM8.33603 5.92553C8.04314 6.21843 8.04314 6.6933 8.33603 6.98619C8.62892 7.27909 9.1038 7.27909 9.39669 6.98619L8.33603 5.92553ZM17.0138 14.6033C16.7209 14.8962 16.7209 15.3711 17.0138 15.664C17.3067 15.9569 17.7816 15.9569 18.0745 15.664L17.0138 14.6033ZM4.96134 3.51504L3.51504 4.96134L4.5757 6.022L6.022 4.5757L4.96134 3.51504ZM19.0387 20.485L20.485 19.0387L19.4243 17.978L17.978 19.4243L19.0387 20.485ZM12.1928 20.485C12.8596 21.1518 13.4119 21.7063 13.9081 22.0849C14.4217 22.4767 14.9622 22.75 15.6157 22.75V21.25C15.422 21.25 15.1981 21.1824 14.818 20.8924C14.4206 20.5892 13.9503 20.1211 13.2535 19.4243L12.1928 20.485ZM17.978 19.4243C17.2812 20.1211 16.8109 20.5892 16.4135 20.8924C16.0334 21.1824 15.8094 21.25 15.6157 21.25V22.75C16.2693 22.75 16.8098 22.4767 17.3233 22.0849C17.8195 21.7063 18.3719 21.1518 19.0387 20.485L17.978 19.4243ZM3.51504 4.96134C2.84824 5.62814 2.29367 6.18046 1.91508 6.67666C1.52328 7.19018 1.25 7.73073 1.25 8.38426H2.75C2.75 8.19057 2.81761 7.96662 3.10761 7.58654C3.41081 7.18914 3.87892 6.71878 4.5757 6.022L3.51504 4.96134ZM4.5757 10.7465C3.87892 10.0497 3.41081 9.57937 3.10761 9.18198C2.81761 8.8019 2.75 8.57795 2.75 8.38426H1.25C1.25 9.03779 1.52328 9.57835 1.91508 10.0919C2.29367 10.5881 2.84824 11.1404 3.51504 11.8072L4.5757 10.7465ZM11.8072 3.51504C11.1404 2.84824 10.5881 2.29367 10.0919 1.91508C9.57835 1.52328 9.03779 1.25 8.38426 1.25V2.75C8.57795 2.75 8.8019 2.81761 9.18199 3.10761C9.57938 3.41081 10.0497 3.87892 10.7465 4.5757L11.8072 3.51504ZM6.022 4.5757C6.71878 3.87892 7.18914 3.41081 7.58654 3.10761C7.96662 2.81762 8.19057 2.75 8.38426 2.75V1.25C7.73073 1.25 7.19018 1.52328 6.67666 1.91508C6.18046 2.29367 5.62814 2.84824 4.96134 3.51504L6.022 4.5757ZM19.4243 13.2535C20.1211 13.9503 20.5892 14.4206 20.8924 14.818C21.1824 15.1981 21.25 15.422 21.25 15.6157H22.75C22.75 14.9622 22.4767 14.4217 22.0849 13.9081C21.7063 13.4119 21.1518 12.8596 20.485 12.1928L19.4243 13.2535ZM20.485 19.0387C21.1518 18.3719 21.7063 17.8195 22.0849 17.3233C22.4767 16.8098 22.75 16.2693 22.75 15.6157H21.25C21.25 15.8094 21.1824 16.0334 20.8924 16.4135C20.5892 16.8109 20.1211 17.2812 19.4243 17.978L20.485 19.0387ZM10.7465 3.51504L8.33603 5.92553L9.39669 6.98619L11.8072 4.5757L10.7465 3.51504ZM19.4243 12.1928L17.0138 14.6033L18.0745 15.664L20.485 13.2535L19.4243 12.1928Z"/><path d="M4.19792 21.6782L5 21.4108L7.47918 20.5844C8.25352 20.3263 8.6407 20.1973 9.00498 20.0237C9.43469 19.8189 9.84082 19.5679 10.2162 19.2751C10.5344 19.0269 10.8229 18.7383 11.4001 18.1612L19.9213 9.63993L20.8482 8.71306C22.3839 7.17735 22.3839 4.68748 20.8482 3.15178C19.3125 1.61607 16.8226 1.61607 15.2869 3.15178L14.3601 4.07866L5.83882 12.5999C5.26166 13.1771 4.97308 13.4656 4.7249 13.7838C4.43213 14.1592 4.18114 14.5653 3.97634 14.995C3.80273 15.3593 3.67368 15.7465 3.41556 16.5208L2.58917 19L2.32181 19.8021M4.19792 21.6782L3.39584 21.9456C3.01478 22.0726 2.59466 21.9734 2.31063 21.6894C2.0266 21.4053 1.92743 20.9852 2.05445 20.6042L2.32181 19.8021M4.19792 21.6782L2.32181 19.8021" /><path opacity="0.5" d="M14.3601 4.07861C14.3601 4.07861 14.476 6.04823 16.2139 7.78613C17.9518 9.52403 19.9214 9.63989 19.9214 9.63989" /></svg> Customize</button>
                    <button type="button" class="btn btn-pilled btn-normal d-flex align-items-center gap-2"><svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M2 3L2.26491 3.0883C3.58495 3.52832 4.24497 3.74832 4.62248 4.2721C5 4.79587 5 5.49159 5 6.88304V9.5C5 12.3284 5 13.7426 5.87868 14.6213C6.75736 15.5 8.17157 15.5 11 15.5H19"  stroke-linecap="round"/><path opacity="0.5" d="M7.5 18C8.32843 18 9 18.6716 9 19.5C9 20.3284 8.32843 21 7.5 21C6.67157 21 6 20.3284 6 19.5C6 18.6716 6.67157 18 7.5 18Z" /><path opacity="0.5" d="M16.5 18.0001C17.3284 18.0001 18 18.6716 18 19.5001C18 20.3285 17.3284 21.0001 16.5 21.0001C15.6716 21.0001 15 20.3285 15 19.5001C15 18.6716 15.6716 18.0001 16.5 18.0001Z" /><path opacity="0.5" d="M11 9H8"  stroke-linecap="round"/><path d="M5 6H16.4504C18.5054 6 19.5328 6 19.9775 6.67426C20.4221 7.34853 20.0173 8.29294 19.2078 10.1818L18.7792 11.1818C18.4013 12.0636 18.2123 12.5045 17.8366 12.7523C17.4609 13 16.9812 13 16.0218 13H5" /></svg> Purchase</button>
                    <button type="button" class="btn btn-pilled btn-normal d-flex align-items-center gap-2"><svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M7.50626 15.2647C7.61657 15.6639 8.02965 15.8982 8.4289 15.7879C8.82816 15.6776 9.06241 15.2645 8.9521 14.8652L7.50626 15.2647ZM6.07692 7.27442L6.79984 7.0747V7.0747L6.07692 7.27442ZM4.7037 5.91995L4.50319 6.64265L4.7037 5.91995ZM3.20051 4.72457C2.80138 4.61383 2.38804 4.84762 2.2773 5.24675C2.16656 5.64589 2.40035 6.05923 2.79949 6.16997L3.20051 4.72457ZM20.1886 15.7254C20.5895 15.6213 20.8301 15.2118 20.7259 14.8109C20.6217 14.41 20.2123 14.1695 19.8114 14.2737L20.1886 15.7254ZM10.1978 17.5588C10.5074 18.6795 9.82778 19.8618 8.62389 20.1747L9.00118 21.6265C10.9782 21.1127 12.1863 19.1239 11.6436 17.1594L10.1978 17.5588ZM8.62389 20.1747C7.41216 20.4896 6.19622 19.7863 5.88401 18.6562L4.43817 19.0556C4.97829 21.0107 7.03196 22.1383 9.00118 21.6265L8.62389 20.1747ZM5.88401 18.6562C5.57441 17.5355 6.254 16.3532 7.4579 16.0403L7.08061 14.5885C5.10356 15.1023 3.89544 17.0911 4.43817 19.0556L5.88401 18.6562ZM7.4579 16.0403C8.66962 15.7254 9.88556 16.4287 10.1978 17.5588L11.6436 17.1594C11.1035 15.2043 9.04982 14.0768 7.08061 14.5885L7.4579 16.0403ZM8.9521 14.8652L6.79984 7.0747L5.354 7.47414L7.50626 15.2647L8.9521 14.8652ZM4.90421 5.19725L3.20051 4.72457L2.79949 6.16997L4.50319 6.64265L4.90421 5.19725ZM6.79984 7.0747C6.54671 6.15847 5.8211 5.45164 4.90421 5.19725L4.50319 6.64265C4.92878 6.76073 5.24573 7.08223 5.354 7.47414L6.79984 7.0747ZM11.1093 18.085L20.1886 15.7254L19.8114 14.2737L10.732 16.6332L11.1093 18.085Z"/><path opacity="0.5" d="M9.56541 8.73049C9.0804 6.97492 8.8379 6.09714 9.24954 5.40562C9.66119 4.71409 10.5662 4.47889 12.3763 4.00849L14.2962 3.50955C16.1062 3.03915 17.0113 2.80394 17.7242 3.20319C18.4372 3.60244 18.6797 4.48023 19.1647 6.2358L19.6792 8.09786C20.1642 9.85343 20.4067 10.7312 19.995 11.4227C19.5834 12.1143 18.6784 12.3495 16.8683 12.8199L14.9484 13.3188C13.1384 13.7892 12.2333 14.0244 11.5203 13.6252C10.8073 13.2259 10.5648 12.3481 10.0798 10.5926L9.56541 8.73049Z" /></svg> Deliver</button>
                </div>
            </div>
        </div>
    </div>
    <div class="whatisBody row gy-5 mt-3">
        <div class="col-xl-6">
            <h4>Containers</h4>
            <div class="mt-4">
                <h5>A container with a whole course meal inside</h5>
                <p>A DockerEats container has all the necessary ingredients, parts and preparation for an entire meal, all in one small package. Plus, you'll be able to build your own container, customizing your culinary experience to the max.</p>
            </div>
            <div class="my-5">
                <h5>Healthy, compact and light</h5>
                <p>Our DockerEats brand containers are extremely light and easily transported, keep food fresh, hot (or cold!) whatever the weather may be. You can even keep them after the food has been eaten to use them as normal containers!</p>
            </div>
            <div>
                <h5>Freshly-made, freshly-eaten</h5>
                <p class="mb-0">Our delivery is quick to make sure your food is as fresh when it gets to you as it was when it left our kitchen. Precooked is not in our dictionary — everything you eat has been freshly prepared and cooked the same day!</p>
            </div>
        </div>
        <div class="whatisImage col-xl-6 position-relative overflow-hidden">
            <img src="/img/TupperContainer.webp" class="undraggable position-absolute" alt="DockerEats Container">
        </div>
    </div>
    <div class="row d-flex">
        <div class="col d-flex mt-5 justify-content-center">
            <div class="d-flex align-items-center gap-3">
                <a href="/products/" class="btn btn-selected">View the menu</a>
                <a href="/ingredients/" class="btn btn-normal">Our ingredients</a>
            </div>
        </div>
    </div>
</section>

<section id="whyorder" class="container-fluid wave-separator">
    <div class="row">
        <div class="col-lg-8 text-center mx-auto">
            <h2>Why order DockerEats?</h2>
            <h3>Already trusted by developers.<br>Now trusted by consumers.</h3>
            <p>DockerEats allows you to eat whatever you want, whenever and wherever you want. And most importantly, eat it the way you want. Much like our containers, we completely adapt to our customer's wants and needs.</p>
            <a href="#" class="arrow">Read our reviews ➜</a>
        </div>
    </div>
    <div class="row mt-1 mx-3 d-flex gy-5 gx-0">
        <div class="card review mx-auto col-lg-12 col-xxl-4">
            <div class="row g-0">
                <div class="col-3 p-3 rounded">
                    <img src="/img/products/product1.webp" class="img-fluid" alt="Jeremy Elbertson">
                </div>
                <div class="col-9 d-flex align-items-center">
                    <div class="card-body">
                        <h5 class="card-title">Jeremy Elbertson</h5>
                        <h6 class="card-subtitle mb-2 text-body-secondary"><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-half"></i><i class="bi bi-star"></i></h6>
                        <p class="card-text">Ever since I tried DockerEats, I never eat anywhere else. Not even my home.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="card review mx-auto col-lg-12 col-xxl-4">
            <div class="row g-0">
                <div class="col-3 p-3 rounded">
                    <img src="/img/products/product2.webp" class="img-fluid" alt="Jeremiah Albert Jr.">
                </div>
                <div class="col-9 d-flex align-items-center">
                    <div class="card-body">
                        <h5 class="card-title">Jeremiah Albert Jr.</h5>
                        <h6 class="card-subtitle mb-2 text-body-secondary"><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-half"></i></h6>
                        <p class="card-text">Just perfect. The degree of customization is amazing. You are in control of everything.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="card review mx-auto col-lg-12 col-xxl-4">
            <div class="row g-0">
                <div class="col-3 p-3 rounded">
                    <img src="/img/products/product3.webp" class="img-fluid" alt="José Alberto Olivares">
                </div>
                <div class="col-9 d-flex align-items-center">
                    <div class="card-body">
                        <h5 class="card-title">José Alberto Olivares</h5>
                        <h6 class="card-subtitle mb-2 text-body-secondary"><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star"></i></h6>
                        <p class="card-text">Containers are useful even after having finished your food. They can store things.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="siteNumbers row text-center mt-1 g-4">
        <div class="col-md-4">
            <h3>5K+</h3>
            <p>customers</p>
        </div>
        <div class="col-md-4">
            <h3>10K+</h3>
            <p>monthly orders</p>
        </div>
        <div class="col-md-4">
            <h3>1M+</h3>
            <p>containers built so far</p>
        </div>
    </div>
</section>

<section id="getstarted" class="container-fluid wave-separator">
    <div class="row">
        <h2>How to get started</h2>
        <h3>Hungry? Order now and eat in a completely customizable way.</h3>
    </div>
    <div class="row mt-3 g-5">
        <div class="col-xl-4">
            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M15.5777 3.38197L17.5777 4.43152C19.7294 5.56066 20.8052 6.12523 21.4026 7.13974C22 8.15425 22 9.41667 22 11.9415V12.0585C22 14.5833 22 15.8458 21.4026 16.8603C20.8052 17.8748 19.7294 18.4393 17.5777 19.5685L15.5777 20.618C13.8221 21.5393 12.9443 22 12 22C11.0557 22 10.1779 21.5393 8.42229 20.618L6.42229 19.5685C4.27063 18.4393 3.19479 17.8748 2.5974 16.8603C2 15.8458 2 14.5833 2 12.0585V11.9415C2 9.41667 2 8.15425 2.5974 7.13974C3.19479 6.12523 4.27063 5.56066 6.42229 4.43152L8.42229 3.38197C10.1779 2.46066 11.0557 2 12 2C12.9443 2 13.8221 2.46066 15.5777 3.38197Z" stroke-linecap="round"/><path opacity="0.5" d="M21 7.5L12 12M12 12L3 7.5M12 12V21.5" stroke-linecap="round"/></svg>
            <h5>Learn the parts of a container</h5>
            <p>Main, branch, drink and dessert: All four parts that make up a container. Learn how to mix and match them the way you like!</p>
            <a href="/build/" class="arrow">Create a container ➜</a>
        </div>
        <div class="col-xl-4">
            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M3.86376 16.4552C3.00581 13.0234 2.57684 11.3075 3.47767 10.1538C4.3785 9 6.14721 9 9.68462 9H14.3153C17.8527 9 19.6214 9 20.5222 10.1538C21.4231 11.3075 20.9941 13.0234 20.1362 16.4552C19.5905 18.6379 19.3176 19.7292 18.5039 20.3646C17.6901 21 16.5652 21 14.3153 21H9.68462C7.43476 21 6.30983 21 5.49605 20.3646C4.68227 19.7292 4.40943 18.6379 3.86376 16.4552Z" /><path opacity="0.5" d="M19.5 9.5L18.7896 6.89465C18.5157 5.89005 18.3787 5.38775 18.0978 5.00946C17.818 4.63273 17.4378 4.34234 17.0008 4.17152C16.5619 4 16.0413 4 15 4M4.5 9.5L5.2104 6.89465C5.48432 5.89005 5.62128 5.38775 5.90221 5.00946C6.18199 4.63273 6.56216 4.34234 6.99922 4.17152C7.43808 4 7.95872 4 9 4" /><path d="M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4C15 4.55228 14.5523 5 14 5H10C9.44772 5 9 4.55228 9 4Z" /><path opacity="0.5" d="M4.5 18L12 9M19.5 18L12.5 9.5M4.5 10L12 21L19.5 10" stroke-linecap="round" stroke-linejoin="round"/></svg>
            <h5>Check our menu</h5>
            <p>Much like our global support accross the globe, our food does not belong to a single culture or type. We gladly cook and serve all kinds of dishes!</p>
            <a href="/products/" class="arrow">Our Menu ➜</a>
        </div>
        <div class="col-xl-4">
            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path opacity="0.5" d="M4.72848 16.1369C3.18295 14.5914 2.41018 13.8186 2.12264 12.816C1.83509 11.8134 2.08083 10.7485 2.57231 8.61875L2.85574 7.39057C3.26922 5.59881 3.47597 4.70292 4.08944 4.08944C4.70292 3.47597 5.5988 3.26922 7.39057 2.85574L8.61875 2.57231C10.7485 2.08083 11.8134 1.83509 12.816 2.12264C13.8186 2.41018 14.5914 3.18295 16.1369 4.72848L17.9665 6.55812C20.6555 9.24711 22 10.5916 22 12.2623C22 13.933 20.6555 15.2775 17.9665 17.9665C15.2775 20.6555 13.933 22 12.2623 22C10.5916 22 9.24711 20.6555 6.55812 17.9665L4.72848 16.1369Z" /><path d="M15.3893 15.3891C15.9751 14.8033 16.0542 13.9327 15.5661 13.4445C15.0779 12.9564 14.2073 13.0355 13.6215 13.6213C13.0358 14.2071 12.1652 14.2863 11.677 13.7981C11.1888 13.3099 11.268 12.4393 11.8538 11.8536M15.3893 15.3891L15.7429 15.7426M15.3893 15.3891C14.9883 15.7901 14.4539 15.9537 14 15.8604M11.5002 11.5L11.8538 11.8536M11.8538 11.8536C12.185 11.5223 12.6073 11.3531 13 11.3568"  stroke-linecap="round"/><circle cx="8.60699" cy="8.87891" r="2" transform="rotate(-45 8.60699 8.87891)" /></svg>
            <h5>See our promotions</h5>
            <p>We commonly run special promotions, discounts and sales with our products! Check and see if there's one that applies to you!</p>
            <a href="/sales/" class="arrow">Our promotions ➜</a>
        </div>
    </div>
    <div class="row d-flex filled align-items-center justify-content-center mt-5 g-0 gy-4">
        <div class="col-lg-10 mt-0">
            <h4>Create your container now</h4>
            <h5>Build it step by step and have it paid for and delivered however works best for you.</h5>
        </div>
        <div class="col-lg-2 d-inline-flex justify-content-center">
            <button type="button" class="btn btn-selected">Start building</button>
        </div>
    </div>
</section>
</main>
<?php include_once('footer.php') ?>