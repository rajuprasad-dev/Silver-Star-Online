<div class="modal" id="alertModal" data-backdrop="false">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title">Notification</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                Product Added to Cart
            </div>
        </div>
    </div>
</div>

<div class="modal" id="alertUpdateModal" data-backdrop="false">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title">Notification</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                Product quantity updated in Cart
            </div>
        </div>
    </div>
</div>

<div class="modal" id="loginAlertModal" data-backdrop="false">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title">Notification</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                Login before adding to cart
            </div>
        </div>
    </div>
</div>

<div class="modal" id="alreadyAddedAlertModal" data-backdrop="false">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title">Notification</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                Product Already Added
            </div>
        </div>
    </div>
</div>

<script>
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

function showAlert3() {
    $('#alertUpdateModal').modal('show');
    setTimeout(function() {
        $('#alertUpdateModal').modal('hide');
    }, 3000);
}

<?php
    if (isset($_SESSION['already_added']) && !empty($_SESSION['already_added'])) {
        echo 'showAlert2();';
        // Clear the session variable to prevent the alert from showing again on page refresh
        $_SESSION['already_added'] = '';
    }

    if (isset($_SESSION['cart_alert']) && !empty($_SESSION['cart_alert'])) {
        echo 'showAlert();';
        // Clear the session variable to prevent the alert from showing again on page refresh
        $_SESSION['cart_alert'] = '';
    }

    if (isset($_SESSION['cart_update_alert']) && !empty($_SESSION['cart_update_alert'])) {
        echo 'showAlert3();';
        // Clear the session variable to prevent the alert from showing again on page refresh
        $_SESSION['cart_update_alert'] = '';
    }

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
document.getElementById("showAlert")?.addEventListener("click", showAlert);
</script>
</script>