<?php session_start();

?>
<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Alex+Brush&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="mystyle.css">
    <title>Silver Star | Login</title>
</head>
<style>
    .element {
        width: 40%;
        /* Set the default width to 50% */
    }

    /* Media query for screens with a maximum width of 768px (typical for mobile devices) */
    @media screen and (max-width: 768px) {
        .element {
            width: 100%;
            /* Set the width to 100% for mobile screens */
        }
    }
</style>

<body>


    <?php include "navbar.php"; ?>
    <div class="container-account">
        <div class="jumbotron text-center" style="background-color:#f6f4f2;">
            <h2 class="display-5" style="padding-top:120px">Login/Sign up</h2>
        </div>
    </div>
    <section
        style="display:flex;justify-content:center;background-image:url('images/account.jpg');backgroud-position:center;background-repeat:no-repeat;"
        class="text-center px-4 py-4">
        <div id="container-account" class="element" style="background-color:white;border:1px solid black;">
            <div class="justify-content-around row px-5 py-5" style="list-style: none;">
                <a id="toggleLogin" class="card-text-dinnis custom-link">Login</a>
                <a class="card-text-dinnis custom-link" id="toggleSignup">SignUp</a>
            </div>
            <div id="loginForm" class="px-5 pb-5">
                <form method="post" action="backend-of-frontend/login-logic">
                    <a id="toggleLogin" class="card-text-dinnis my-5 custom link">Login</a>
                    <div class="form-group mt-3">
                        <input type="text" class="form-control underline-input" placeholder="Username" name="username"
                            required>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control underline-input" placeholder="Password"
                            name="password" required>
                    </div>
                    <p>
                        <?php if (isset($_SESSION['login_error'])) {
                            echo $_SESSION['login_error'];
                        } ?>
                    </p>
                    <button type="submit" class="btn btn-dark border">Login</button>
                </form>
                <!-- <p>Don't have an account? <a href="#" id="toggleSignup">Sign Up</a></p> -->
            </div>
            <div id="signupForm" class="px-5 pb-5">
                <form action="signup-logic" method="post">
                    <a id="toggleLogin" class="card-text-dinnis my-5">SignUp</a>
                    <div class="form-group mt-3">
                        <input type="text" class="form-control underline-input" name="username" placeholder="Username"
                            required>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control underline-input" name="password"
                            placeholder="Password" required>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control underline-input" name="confirmPassword"
                            placeholder="Confirm Password" required>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control underline-input" name="name" placeholder="Full Name"
                            required>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control underline-input" name="phone" placeholder="Phone"
                            required>
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control underline-input" name="email" placeholder="Email"
                            required>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control underline-input" name="address" placeholder="Address"
                            required>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control underline-input" name="city" placeholder="City" required>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control underline-input" name="state" placeholder="State"
                            required>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control underline-input" name="pincode" placeholder="Pincode"
                            required>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control underline-input" name="landmark" placeholder="Landmark"
                            required>
                    </div>
                    <!-- Other fields go here -->

                    <?php if (isset($_SESSION['signup_error'])) {
                        echo $_SESSION['signup_error'];
                    } ?>
                    <button type="submit" class="btn btn-dark border">Sign Up</button>
                </form>
            </div>
        </div>
    </section>


    <script>
        const loginForm = document.getElementById( 'loginForm' );
        const signupForm = document.getElementById( 'signupForm' );
        const toggleSignup = document.getElementById( 'toggleSignup' );
        const toggleLogin = document.getElementById( 'toggleLogin' );

        // Initially hide the signup form
        signupForm.style.display = 'none';

        toggleSignup.addEventListener( 'click', () => {
            loginForm.style.display = 'none';
            signupForm.style.display = 'block';

        } );

        toggleLogin.addEventListener( 'click', () => {
            loginForm.style.display = 'block';
            signupForm.style.display = 'none';
        } );

        var showSignUpForm = <?php echo isset($_SESSION['showSignUpForm']) ? $_SESSION['showSignUpForm'] : 'false'; ?>;

        // Update the display property based on the session value
        if ( showSignUpForm ) {
            loginForm.style.display = 'none';
            signupForm.style.display = 'block';
        } else {
            loginForm.style.display = 'block';
            signupForm.style.display = 'none';
        }
    </script>

    <?php include "footer.php" ?>
</body>

</html>