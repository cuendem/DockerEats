<header id="header" class="position-sticky top-0">
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid px-5 py-2">
            <a class="navbar-brand" href="/">
                <img class="logo" src="/svg/DockerEatsLogo.svg" alt="DockerEats Logo">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0 align-items-center gap-4">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Containers
                            <svg class="dropdown-chevron" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M6 9L12 15L18 9" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="headerContainersDropdown">
                        <li><a class="dropdown-item" href="/build/">Start building</a></li>
                        <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="/#whatis">What is a container?</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Products
                            <svg class="dropdown-chevron" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M6 9L12 15L18 9" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="headerContainersDropdown">
                            <li><a class="dropdown-item" href="/products/">All products</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="/products/mains">Mains</a></li>
                            <li><a class="dropdown-item" href="/products/branches">Branches</a></li>
                            <li><a class="dropdown-item" href="/products/drinks">Drinks</a></li>
                            <li><a class="dropdown-item" href="/products/desserts">Desserts</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/ingredients/">Ingredients</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/sales/">Sales</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/about/">About Us</a>
                    </li>
                </ul>
                <div class="navbar-nav navbar-right nav-item d-flex align-items-center gap-4">
                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M14.9536 14.9458L21 21M17 10C17 13.866 13.866 17 10 17C6.13401 17 3 13.866 3 10C3 6.13401 6.13401 3 10 3C13.866 3 17 6.13401 17 10Z" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></g></svg>

                    <?php if (isset($_SESSION['username'])) { ?>
                        <a href="/account/cart" class="position-relative me-4">
                            <svg viewBox="0 0 1024 1024" xmlns="http://www.w3.org/2000/svg" fill="#000000" stroke="#000000" stroke-width="10"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><path fill="#000000" d="M432 928a48 48 0 1 1 0-96 48 48 0 0 1 0 96zm320 0a48 48 0 1 1 0-96 48 48 0 0 1 0 96zM96 128a32 32 0 0 1 0-64h160a32 32 0 0 1 31.36 25.728L320.64 256H928a32 32 0 0 1 31.296 38.72l-96 448A32 32 0 0 1 832 768H384a32 32 0 0 1-31.36-25.728L229.76 128H96zm314.24 576h395.904l82.304-384H333.44l76.8 384z"></path></g></svg>
                            <?php if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) { ?>
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-ishmael"><?=count($_SESSION['cart'])?></span>
                            <?php } ?>
                        </a>
                    <?php } else { ?>
                        <a href="/account/" class="btn btn-normal">Sign In</a>
                    <?php } ?>
                </div>
            </div>
            <?php if (isset($_SESSION['username'])) { ?>
                <div class="dropdown profile-dropdown">
                    <img src="<?=userController::getPfp($_SESSION['id_user'])?>" alt="<?=$_SESSION['username']?>" class="profile-picture dropdown-toggle" id="dropdownPFPButton" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
                    <div class="dropdown-menu dropdown-menu-end p-0 mt-2" aria-labelledby="dropdownPFPButton">
                        <div class="picture-backdrop d-flex justify-content-center position-relative py-3">
                            <img src="<?=userController::getPfp($_SESSION['id_user'])?>" alt="<?=$_SESSION['username']?>">
                        </div>
                        <p class="username"><?=$_SESSION['username']?></p>
                        <p class="email"><?=$_SESSION['email']?></p>
                        <ul>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item d-flex justify-content-between align-items-center" href="/account/">My profile<i class="bi bi-person-fill"></i></a></li>
                            <li><a class="dropdown-item d-flex justify-content-between align-items-center" href="/account/cart">My cart<i class="bi bi-cart-fill"></i></a></li>
                            <li><a class="dropdown-item d-flex justify-content-between align-items-center" href="/orders/">My orders<i class="bi bi-box-seam-fill"></i></a></li>
                            <li><a class="dropdown-item d-flex justify-content-between align-items-center" href="/account/edit">Account settings<i class="bi bi-gear-fill"></i></a></li>
                            <?php if ($_SESSION['id_user'] == 1) { ?>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item admin d-flex justify-content-between align-items-center" href="/admin/">Administration console<i class="bi bi-database-fill-gear"></i></a></li>
                            <?php } ?>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item signout d-flex justify-content-between align-items-center" href="/account/signout">Sign Out<i class="bi bi-box-arrow-right"></i></a></li>
                        </ul>
                    </div>
                </div>
            <?php } ?>
        </div>
    </nav>
</header>