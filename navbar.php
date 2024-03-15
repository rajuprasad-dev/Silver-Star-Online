<nav class="navbar navbar-expand-lg navbar-light bg-light justify-content-between px-lg-5 px-3">
    <div class="main-nav-block">
        <div class="search-bar-block hide-small">
            <form class="form-inline flex-nowrap" action="" method="post">
                <button class="btn  my-2 my-sm-0" type="submit"><img src="images/search-symbol.png" alt="Cart"
                        height="20"></button>
                <input class="form-control mr-sm-2" type="text" placeholder="Search" name="product_name"
                    aria-label="Search" style="border: none;">
            </form>
        </div>

        <div class="d-flex justify-content-center align-items-md-center align-items-start flex-column">
            <a class="navbar-brand align-items-center d-flex mr-0" href="./">
                <img src="assets/img/logo.png" alt="Logo" height="35"><span class="ml-2">SILVER STAR</span>
            </a>

            <div class="navigation-bar-main">
                <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item active">
                            <a class="nav-link custom-link text-nowrap<?php echo basename($_SERVER['PHP_SELF']) == "index.php" ? " active" : ""; ?>"
                                href="./">Home</a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link custom-link text-nowrap<?php echo basename($_SERVER['PHP_SELF']) == "shop.php" ? " active" : ""; ?>"
                                href="shop">Shop</a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link custom-link text-nowrap<?php echo basename($_SERVER['PHP_SELF']) == "about-us.php" ? " active" : ""; ?>"
                                href="about-us">About Us</a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link custom-link text-nowrap<?php echo basename($_SERVER['PHP_SELF']) == "contact-us.php" ? " active" : ""; ?>"
                                href="contact-us">Contact Us</a>
                        </li>
                    </ul>
                </div>
                <div class="backdrop">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
                        <i class="fa fa-times"></i>
                    </button>
                </div>
            </div>
        </div>

        <div class="nav-action-buttons hide-smal">
            <div>
                <a class="navbar-brand" href="account">
                    <img src="images/user.png" alt="Cart" height="30">
                </a>
            </div>
            <div>
                <a class="navbar-brand cart-icon" href="cart">
                    <img src="images/shopping-cart.png" alt="Cart" height="30">
                    <?php
                    include_once "backend-of-frontend/conn.php";

                    $userId = 0;
                    if (isset($_SESSION['userId'])) {
                        $userId = $_SESSION['userId'];
                    }

                    $cart_sql = "SELECT * FROM `cart` WHERE `customer_id` = '$userId'";
                    $cart_query = $conn->query($cart_sql);
                    $cart_count = $cart_query->num_rows ?? "0";

                    echo "<span class='cart-count badge badge-dark'>{$cart_count}</span>";
                    ?>
                </a>
            </div>
            <div>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
                    <i class="fa fa-bars"></i>
                </button>
            </div>
        </div>
    </div>
</nav>
<div class="sticky-buttons-icons icon-width">
    <div class="text-center bg-transparent">
        <a href="https://wa.me/+917021379952" class="whatsapp" style="color:inherit;"><i class="fa fa-whatsapp"
                style="color:white;"></i></a>
        <a href="https://www.instagram.com/skinks.tattoo/" class="instagram" style="color:inherit;"><i
                class="fa fa-instagram" style="color:white;"></i></a>
        <a href="https://www.facebook.com/getinkstattoostudio/" class="facebook" style="color:inherit;"><i
                class="fa fa-facebook" style="color:white;"></i></a>
    </div>
</div>
<div class="sticky-buttons-right">
    <a href="./shop">Silver 925</a>
</div>