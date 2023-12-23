<!DOCTYPE html>
<html lang="en">
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- Primary Meta Tags -->
<title>Register</title>
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=no">
<meta name="title" content="Saabmall">
<meta name="description" content="">
<meta name="author" content="Raju Prasad">
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
        <h4 class="text-center">Register</h4>
        <form id="admin_registration_module">
            <div class="form-group my-4">
                <div id="product_pic" class="add_testimonials_pic">
                    <div class="product_pic_edit">
                        <input required="required" type='file' name="admin_profile_pic" id="product_upload" accept=".png, .jpg, .jpeg" class="form-control">
                        <label for="product_upload" id="edit_product_pic_btn"></label>
                    </div>
                    <div class="product_pic_preview add_testimonials_preview">
                        <div class="add_testimonials_images" id="pic_preview" style="background-image: url('./assets/images/placeholder.png');">
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group my-3">
                <input required="required" type="text" name="name" class="form-control" placeholder="Enter Full Name">
            </div>

            <div class="form-group my-3">
                <input required="required" type="email" name="email" class="form-control" placeholder="Enter Email ID">
            </div>

            <div class="form-group my-3">
                <input required="required" type="tel" name="phone" class="form-control" placeholder="Enter Phone Number">
            </div>

            <div class="form-group my-3">
                <input required="required" type="password" name="password" class="form-control" placeholder="Create password">
            </div>

            <div class="form-group mb-3 btn_group_div_main">
                <input type="hidden" name="add_admin_user_profile" value="1">
                <input type="submit" name="add_admin_user" class="btn btn-primary submit_btn" value="Register">
            </div>
        </form>
    </div>
</div>

<footer class="footer bg-white fixed-bottom py-2 w-100">
    <div class="text-center w-100">
        <p class="mb-0 w-100">Copyright © 2021-<span class="current-year"><?php echo date("Y"); ?></span> | Powered By <a class="text-primary font-weight-normal" href="" target="_blank">Raju Prasad</a></p>
    </div>
</footer>

<!-- jquery -->
<script src="./vendor/jquery/jquery-3.5.1.min.js"></script>
<!-- Core -->
<script src="./vendor/popper.js/dist/umd/popper.min.js"></script>
<script src="./vendor/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- data -->
<script src="./assets/js/data.js"></script>
<script type="text/javascript">

// show image
function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#pic_preview').css('background-image', 'url('+e.target.result +')');
            $('#pic_preview').hide();
            $('#pic_preview').fadeIn(650);
        }
        reader.readAsDataURL(input.files[0]);
    }
}
$("#product_upload").change(function() {
    readURL(this);
});
</script>
</body>
</html>