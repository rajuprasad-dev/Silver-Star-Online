<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <!-- Primary Meta Tags -->
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=no">
    <meta name="title" content="Saabmall">
    <meta name="description" content="">
    <meta name="author" content="Incinc Media">
    <meta name="robots" content="noindex, nofollow">
    <meta name="googlebot" content="noindex">
    <meta name="googlebot-news" content="nosnippet">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://saabmall.com">
    <meta property="og:title" content="Saabmall">
    <meta property="og:description" content="">
    <meta property="og:image" content="../src/images/favicon.ico">

    <!-- Twitter -->
    <meta property="twitter:card" content="">
    <meta property="twitter:url" content="https://saabmall.com">
    <meta property="twitter:title" content="Saabmall">
    <meta property="twitter:description" content="">
    <meta property="twitter:image" content="../src/images/favicon.ico">

    <!-- Favicon -->
    <link rel="shortcut icon" href="../src/images/favicon.ico">
    <link rel="apple-touch-icon" href="../src/images/apple-touch-icon.png">
    <link rel="image_src" href="../src/images/favicon-192x192.png">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="theme-color" content="#ffffff">

    <!-- Fontawesome -->
    <link type="text/css" href="./vendor/fontawesome/css/all.min.css" rel="stylesheet">

    <!-- App CSS -->
    <link type="text/css" href="./assets/css/app.css" rel="stylesheet">

</head>

<body class="main_registration_login_page">

    <div class="container my-5">
        <div class="card card-body shadow py-4">
            <h4 class="text-center">Welcome Back ! Admin</h4>
            <form id="admin_login_module">
                <div class="form-group my-3">
                    <input required="required" type="email" name="email" class="form-control login_email_id"
                        placeholder="Enter Email ID">
                </div>

                <div class="form-group my-3">
                    <input required="required" type="password" name="password" class="form-control"
                        placeholder="Enter Your password">
                </div>

                <div class="form-group mb-3 btn_group_div_main">
                    <input type="hidden" name="login_admin" value="1">
                    <input type="submit" name="login_admin_user" class="btn btn-primary submit_btn" value="Login">
                </div>
            </form>
        </div>
    </div>

    <footer class="bg-white py-2 fixed-bottom w-100">
        <div class="text-center w-100">
            <p class="mb-0 w-100">Copyright © 2021-<span class="current-year">
                    <?php echo date("Y"); ?>
                </span> | Powered By <a class="text-primary font-weight-normal" href="https://www.incincmedia.com"
                    target="_blank">Incinc Media</a></p>
        </div>
    </footer>

    <!-- jquery -->
    <script src="./vendor/jquery/jquery-3.5.1.min.js"></script>
    <!-- Core -->
    <script src="./vendor/popper.js/dist/umd/popper.min.js"></script>
    <script src="./vendor/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- data -->
    <script src="./assets/js/data.js"></script>
</body>

</html>