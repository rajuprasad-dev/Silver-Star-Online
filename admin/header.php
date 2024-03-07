<?php
session_start();
if (!isset($_SESSION['admin_login'])) {
    header('location:login');
}
include("./config/conn.php");

$login = new database();
$login->connect();

// $_SESSION['admin_email'] = "rk24052000@gmail.com";

$login_sql = "SELECT * FROM admin WHERE email = '" . $_SESSION['admin_email'] . "' LIMIT 1";

$login->sql($login_sql);

$login_user_data = $login->result();

if ($login->numrows() > 0) {
    $login_userpic = "./assets/images/profile_pic/" . $login_user_data[0]['photo'];
    $login_userunique_id = $login_user_data[0]['unique_id'];
    $login_username = $login_user_data[0]['name'];
    $login_useremail = $login_user_data[0]['email'];
    $login_userphone = $login_user_data[0]['phone'];
    $login_userlast_login = $login_user_data[0]['last_login'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <!-- Primary Meta Tags -->
    <title>
        <?php echo $page; ?>
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=no">
    <meta name="title" content="">
    <meta name="description" content="">
    <meta name="author" content="Mynex Technology">
    <meta name="robots" content="noindex, nofollow">
    <meta name="googlebot" content="noindex">
    <meta name="googlebot-news" content="snippet">

    <!-- favicon -->
    <link rel="shortcut icon" href="../assets/img/favicon.png">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="">
    <meta property="og:title" content="">
    <meta property="og:description" content="">

    <!-- Twitter -->
    <meta property="twitter:card" content="">
    <meta property="twitter:url" content="https://silverstar.in">
    <meta property="twitter:title" content="">
    <meta property="twitter:description" content="">

    <!-- Favicon -->
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="theme-color" content="#ffffff">

    <!-- Fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />

    <!-- Datatable -->
    <!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.24/r-2.2.7/sp-1.2.2/datatables.min.css"/> -->
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.24/b-1.7.0/b-colvis-1.7.0/b-html5-1.7.0/b-print-1.7.0/r-2.2.7/datatables.min.css" />

    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/datetime/1.1.1/css/dataTables.dateTime.min.css">

    <!-- select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <link type="text/css" href="./vendor/coloris/coloris.min.css" rel="stylesheet">

    <!-- App CSS -->
    <link type="text/css" href="./assets/css/app.css" rel="stylesheet">

</head>

<body>

    <div class="container-fluid bg-soft">
        <div class="row">
            <div class="col-12">
                <nav id="sidebarMenu" class="sidebar d-md-block bg-primary text-white collapse" data-simplebar>
                    <div class="sidebar-inner px-4 pt-3">
                        <div
                            class="user-card d-flex d-md-none align-items-center justify-content-between justify-content-md-center pb-4">
                            <div class="d-flex align-items-center">
                                <div class="user-avatar profile_pic_image_dashboard lg-avatar mr-4">
                                    <img src="<?php echo !empty($login_userpic) ? $login_userpic : '../assets/images/favicon.png'; ?>"
                                        class="card-img-top rounded-circle border-white" alt="Bonnie Green">
                                </div>
                                <div class="d-block">
                                    <h2 class="h6">Hi,
                                        <?php echo $login_username; ?>
                                    </h2>
                                    <a href="javascript:void(0);"
                                        class="btn btn-secondary text-dark btn-xs logout_user_btn"
                                        logout-id="<?php echo base64_encode($login_useremail); ?>"><span
                                            class="mr-2"><span class="fas fa-sign-out-alt"></span></span>Sign Out</a>
                                </div>
                            </div>
                            <div class="collapse-close d-md-none">
                                <a href="#sidebarMenu" class="fas fa-times" data-toggle="collapse"
                                    data-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="true"
                                    aria-label="Toggle navigation"></a>
                            </div>
                        </div>
                        <ul class="nav flex-column">
                            <div class="user-card d-none d-md-flex align-items-center justify-content-start pb-4">
                                <div class="d-flex align-items-center">
                                    <div class="user-avatar profile_pic_image_dashboard lg-avatar mr-4">
                                        <img src="<?php echo !empty($login_userpic) ? $login_userpic : '../assets/images/favicon.png'; ?>"
                                            class="card-img-top rounded-circle border-white">
                                    </div>
                                    <div class="d-block">
                                        <h2 class="h6">Hi,
                                            <?php echo $login_username; ?>
                                        </h2>
                                    </div>
                                </div>
                            </div>
                            <li class="nav-item">
                                <a href="index" class="nav-link">
                                    <span class="sidebar-icon"><span class="fas fa-chart-pie"></span></span>
                                    <span>Dashboard</span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <span class="nav-link collapsed d-flex justify-content-between align-items-center"
                                    data-toggle="collapse" data-target="#products-list">
                                    <span>
                                        <span class="sidebar-icon"><i class="fas fa-box-open"></i></span>
                                        Products
                                    </span>
                                    <span class="link-arrow"><i class="fas fa-chevron-right"></i></span>
                                </span>
                                <div class="multi-level collapse " role="list" id="products-list" aria-expanded="false">
                                    <ul class="flex-column nav">
                                        <li class="nav-item"><a class="nav-link" href="./manage_categories"><span>Manage
                                                    Categories</span></a></li>

                                        <li class="nav-item"><a class="nav-link" href="manage_products"><span>Manage
                                                    Produts</span></a></li>
                                    </ul>
                                </div>
                            </li>

                            <!--<li class="nav-item">-->
                            <!--    <span class="nav-link collapsed d-flex justify-content-between align-items-center" data-toggle="collapse" data-target="#featured_products">-->
                            <!--    <span>-->
                            <!--    <span class="sidebar-icon"><i class="fas fa-bullhorn"></i></span> -->
                            <!--    Featured Products-->
                            <!--    </span>-->
                            <!--    <span class="link-arrow"><i class="fas fa-chevron-right"></i></span> -->
                            <!--    </span>-->
                            <!--    <div class="multi-level collapse " role="list" id="featured_products" aria-expanded="false">-->
                            <!--        <ul class="flex-column nav">-->
                            <!--            <li class="nav-item"><a class="nav-link" href="manage_trending_products"><span>Trending Products</span></a></li>-->

                            <!--            <li class="nav-item"><a class="nav-link" href="manage_hot_deal_products"><span>Hot Deal Producs</span></a></li>-->
                            <!--        </ul>-->
                            <!--    </div>-->
                            <!--</li>-->

                            <li class="nav-item">
                                <span class="nav-link collapsed d-flex justify-content-between align-items-center"
                                    data-toggle="collapse" data-target="#orders_nav">
                                    <span>
                                        <span class="sidebar-icon"><i class="fas fa-receipt"></i></span>
                                        Orders
                                    </span>
                                    <span class="link-arrow"><i class="fas fa-chevron-right"></i></span>
                                </span>
                                <div class="multi-level collapse " role="list" id="orders_nav" aria-expanded="false">
                                    <ul class="flex-column nav">
                                        <li class="nav-item"><a class="nav-link" href="./manage_orders"><span>Manage
                                                    Orders</span></a></li>
                                    </ul>
                                </div>
                            </li>

                            <li class="nav-item">
                                <span class="nav-link collapsed d-flex justify-content-between align-items-center"
                                    data-toggle="collapse" data-target="#coupons_nav">
                                    <span>
                                        <span class="sidebar-icon"><i class="fas fa-tag"></i></span>
                                        Coupons
                                    </span>
                                    <span class="link-arrow"><i class="fas fa-chevron-right"></i></span>
                                </span>
                                <div class="multi-level collapse " role="list" id="coupons_nav" aria-expanded="false">
                                    <ul class="flex-column nav">
                                        <li class="nav-item"><a class="nav-link" href="./manage_coupons"><span>Manage
                                                    Coupons</span></a></li>
                                    </ul>
                                </div>
                            </li>

                            <li class="nav-item">
                                <span class="nav-link collapsed d-flex justify-content-between align-items-center"
                                    data-toggle="collapse" data-target="#customers_nav">
                                    <span>
                                        <span class="sidebar-icon"><i class="fas fa-users"></i></span>
                                        Customers
                                    </span>
                                    <span class="link-arrow"><i class="fas fa-chevron-right"></i></span>
                                </span>
                                <div class="multi-level collapse " role="list" id="customers_nav" aria-expanded="false">
                                    <ul class="flex-column nav">
                                        <li class="nav-item"><a class="nav-link" href="./manage_customers"><span>Manage
                                                    Customers</span></a></li>
                                    </ul>
                                </div>
                            </li>

                            <li class="nav-item">
                                <span class="nav-link collapsed d-flex justify-content-between align-items-center"
                                    data-toggle="collapse" data-target="#transactions_nav">
                                    <span>
                                        <span class="sidebar-icon"><i class="fas fa-coins"></i></span>
                                        Transactions
                                    </span>
                                    <span class="link-arrow"><i class="fas fa-chevron-right"></i></span>
                                </span>
                                <div class="multi-level collapse " role="list" id="transactions_nav"
                                    aria-expanded="false">
                                    <ul class="flex-column nav">
                                        <li class="nav-item"><a class="nav-link"
                                                href="./manage_transactions"><span>Manage Transactions</span></a></li>
                                    </ul>
                                </div>
                            </li>

                            <li class="nav-item">
                                <span class="nav-link collapsed d-flex justify-content-between align-items-center"
                                    data-toggle="collapse" data-target="#sales_report_nav">
                                    <span>
                                        <span class="sidebar-icon"><i class="fas fa-chart-line"></i></span>
                                        Report
                                    </span>
                                    <span class="link-arrow"><i class="fas fa-chevron-right"></i></span>
                                </span>
                                <div class="multi-level collapse " role="list" id="sales_report_nav"
                                    aria-expanded="false">
                                    <ul class="flex-column nav">
                                        <li class="nav-item"><a class="nav-link" href="./sales_report"><span>Sales
                                                    Report</span></a></li>
                                        <li class="nav-item"><a class="nav-link" href="./manage_stocks"><span>Manage
                                                    Stocks</span></a></li>
                                    </ul>
                                </div>
                            </li>

                            <li class="nav-item">
                                <span class="nav-link collapsed d-flex justify-content-between align-items-center"
                                    data-toggle="collapse" data-target="#settings">
                                    <span>
                                        <span class="sidebar-icon"><i class="fas fa-cog"></i></span>
                                        Settings
                                    </span>
                                    <span class="link-arrow"><i class="fas fa-chevron-right"></i></span>
                                </span>
                                <div class="multi-level collapse " role="list" id="settings" aria-expanded="false">
                                    <ul class="flex-column nav mb-5">
                                        <li class="nav-item"><a class="nav-link" href="./manage_slider"><span>Manage
                                                    Slider</span></a></li>

                                        <li class="nav-item"><a class="nav-link" href="manage_about_us"><span>About
                                                    Us</span></a></li>

                                        <li class="nav-item"><a class="nav-link"
                                                href="manage_refund_policy"><span>Refund Policy</span></a></li>

                                        <li class="nav-item"><a class="nav-link"
                                                href="manage_privacy_policy"><span>Privacy Policy</span></a></li>

                                        <li class="nav-item"><a class="nav-link"
                                                href="manage_terms_and_conditions"><span>Terms & Conditions</span></a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>

                <main class="content">
                    <nav class="navbar navbar-top navbar-expand navbar-dashboard navbar-light pl-0 pr-2 pb-0">
                        <div class="container-fluid px-0">
                            <div class="d-flex justify-content-between w-100" id="navbarSupportedContent">
                                <div class="d-flex">
                                    <button class="navbar-toggler d-flex d-md-none collapsed" type="button"
                                        data-toggle="collapse" data-target="#sidebarMenu" aria-controls="sidebarMenu"
                                        aria-expanded="false">
                                        <span class="navbar-toggler-icon"></span>
                                    </button>
                                </div>
                                <!-- Navbar links -->
                                <ul class="navbar-nav align-items-center">
                                    <li class="nav-item dropdown">
                                        <a class="nav-link pt-1 px-0" href="#" role="button" data-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false">
                                            <div class="media d-flex align-items-center">
                                                <img class="user-avatar profile_pic_image_dropdown md-avatar rounded-circle"
                                                    alt="Image placeholder"
                                                    src="<?php echo !empty($login_userpic) ? $login_userpic : '../assets/images/favicon.png'; ?>">
                                                <div
                                                    class="media-body ml-2 text-dark align-items-center d-none d-lg-block">
                                                    <span class="mb-0 font-small font-weight-bold">
                                                        <?php echo $login_username; ?>
                                                    </span>
                                                </div>
                                            </div>
                                        </a>
                                        <div class="dropdown-menu dashboard-dropdown dropdown-menu-right mt-2">
                                            <a class="dropdown-item font-weight-bold" href="manage_profile"><span
                                                    class="far fa-user-circle"></span>My Profile</a>
                                            <div role="separator" class="dropdown-divider"></div>
                                            <a class="dropdown-item font-weight-bold logout_user_btn"
                                                href="javascript:void(0);"
                                                logout-id="<?php echo base64_encode($login_useremail); ?>"><span
                                                    class="fas fa-sign-out-alt text-danger"></span>Logout</a>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </nav>