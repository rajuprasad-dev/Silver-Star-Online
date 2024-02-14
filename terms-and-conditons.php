<?php
session_start();
include_once "./backend-of-frontend/conn.php";
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
<?php
// Fetch existing "Privacy Policy" content from the database
$sqlSelect = "SELECT * FROM site_settings WHERE setting_name = 'Terms & Conditions'";
$result = $conn->query($sqlSelect);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
?>
    <section class="container mt-5">
        <div class="row">
            <div class="col-lg-12" style="margin-top:100px;">
                <h2><?php echo $row["setting_name"]; ?></h2></h2>
                <?php echo $row["setting_data"];?>
                

                <!-- Add any other sections as needed -->

            </div>
        </div>
    </section>..
<?php    
} 

include "footer.php" ?>

    <!-- Bootstrap JS and jQuery scripts (include at the end of the body for better performance) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        function changeImage(card, newImageSrc) {
            const image = card.querySelector('img');
            image.src = newImageSrc;
        }

        function restoreImage(card, originalImageSrc) {
            const image = card.querySelector('img');
            image.src = originalImageSrc;
        }
    </script>

</body>

</html>

<script>
    // Function to show the alert


    function showAlert() {
        $('#alertModal').modal('show');
        setTimeout(function () {
            $('#alertModal').modal('hide');
        }, 3000);
    }

    function showAlert1() {
        $('#loginAlertModal').modal('show');
        setTimeout(function () {
            $('#loginAlertModal').modal('hide');
        }, 3000);
    }
    function showAlert2() {
        $('#alreadyAddedAlertModal').modal('show');
        setTimeout(function () {
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
    document.addEventListener("keydown", function (event) {
        if (event.key === "a") {
            showAlert();
        }
    });

    // Event listener for button click
    document.getElementById("showAlert").addEventListener("click", showAlert);
</script>