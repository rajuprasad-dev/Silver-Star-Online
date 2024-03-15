<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<?php include "head.php" ?>
<style>
/* Custom CSS for controlling the image size */
.carousel-control-prev img,
.carousel-control-next img {
    width: 8vw;
    /* Set the desired width */
    height: auto;
    /* Automatically adjust the height to maintain the aspect ratio */
}

button:focus {
    outline: none;
}

@media only screen and (max-width: 767px) {

    /* Styles for mobile screens (using only row class) */
    #categories {
        display: flex;
        flex-direction: column;
    }
}

.image-grid {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    margin: -50px;
}
</style>

<body>

    <?php include "navbar.php" ?>

    <!-- Contact Us Section -->
    <section class="container mt-5">
        <div class="row">
            <div class="col-lg-12" style="margin-top:100px;">
                <h2>Contact Us</h2>
                <p>
                    If you have any questions or inquiries, feel free to reach out to us. We are here to assist you.
                </p>
                <p>
                    <strong>Email:</strong> info@silverstaronline.in<br>
                    <strong>Phone:</strong> +91 81694 40710
                </p>
                <form action="process_form" method="post" id="contactForm">
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" class="form-control underline-input" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control underline-input" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone:</label>
                        <input type="tel" class="form-control underline-input" id="phone" name="phone" required>
                    </div>
                    <div class="form-group">
                        <label for="message">Message:</label>
                        <textarea class="form-control underline-input" id="message" name="message" rows="4"
                            required></textarea>
                    </div>
                    <button type="submit" class="btn black-button">Submit</button>
                </form>
            </div>
        </div>
    </section>

    <?php include "footer.php" ?>

    <!-- Bootstrap JS and jQuery scripts (include at the end of the body for better performance) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
<script>
// Function to show the alert


function showAlert() {
    $('#alertModal').modal('show');
    setTimeout(function() {
        $('#alertModal').modal('hide');
    }, 3000);
}

function showAlert1() {
    $('#loginAlertModal').modal('show');
    setTimeout(function() {
        $('#loginAlertModal').modal('hide');
    }, 3000);
}

function showAlert2() {
    $('#alreadyAddedAlertModal').modal('show');
    setTimeout(function() {
        $('#alreadyAddedAlertModal').modal('hide');
    }, 3000);
}
<?php

    if (isset($_SESSION['already_added']) && !empty($_SESSION['already_added'])) {
        echo 'showAlert2();';
        // Clear the session variable to prevent the alert from showing again on page refresh
        $_SESSION['already_added'] = '';
    }
    ?>
// Check if the session variable is set
<?php

    if (isset($_SESSION['cart_alert']) && !empty($_SESSION['cart_alert'])) {
        echo 'showAlert();';
        // Clear the session variable to prevent the alert from showing again on page refresh
        $_SESSION['cart_alert'] = '';
    }
    ?>

<?php
    if (isset($_SESSION['login_cart_alert']) && !empty($_SESSION['login_cart_alert'])) {
        echo 'showAlert1();';
        // Clear the session variable to prevent the alert from showing again on page refresh
        $_SESSION['login_cart_alert'] = '';
    }
    ?>

// Event listener for keypress
document.addEventListener("keydown", function(event) {
    if (event.key === "a") {
        showAlert();
    }
});

// Event listener for button click
document.getElementById("showAlert").addEventListener("click", showAlert);
</script>