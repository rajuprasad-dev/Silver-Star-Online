<?php
include "auth.php";
include_once "./backend-of-frontend/conn.php";

if (!$_POST['order_id']) {
    header("location: account.php");
    exit();
}
$orderId = $_POST['order_id'];
?>
<!DOCTYPE html>
<html>

<?php include "head.php" ?>

<body>
    <style>
        .custom-card {
            /* border: 1px solid #000; */
            /* Black border */
            /* border-radius: 10px; */
            background-color: #F5F7F8;
            /* Rounded corners */
        }



        /* Styling for h1 to h6 tags */
        h1 {
            font-size: 36px;
            /* font-family: Arial, sans-serif; */
            /* Other styles for h1 tags */
        }

        h2 {
            font-size: 32px;
            /* font-family: Arial, sans-serif; */
            /* Other styles for h2 tags */
        }

        h3 {
            font-size: 28px;
            /* font-family: Arial, sans-serif; */
            /* Other styles for h3 tags */
        }

        h4 {
            font-size: 24px;
            /* font-family: Arial, sans-serif; */
            /* Other styles for h4 tags */
        }

        h5 {
            font-size: 20px;
            /* font-family: Arial, sans-serif; */
            /* Other styles for h5 tags */
        }

        h6 {
            font-size: 18px;
            /* font-family: Arial, sans-serif; */
            /* Other styles for h6 tags */
        }

        /* Styling for p tags */
        p {
            font-size: 14px;
            /* font-family: Helvetica, sans-serif; */
            /* Other styles for p tags */
        }
    </style>

    <?php include "navbar.php"; ?>
    <div class="container-account">
        <div class="jumbotron text-center" style="background-color:#f6f4f2;">
            <h2 class="display-5" style="padding-top:120px">Account</h2>
            <p class="lead">Shop</p>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <!-- Side Navigation without borders or background color -->
            <div class="col-md-3 px-5 py-5" style="visibility: none;">
                <!-- <h3>Categories</h3> -->
                <ul class="list-group">
                    <li class="list-group-item" style="border: 0px; cursor: pointer;font-size:14px;"
                        onclick="showContent('orderDetails')">Order Detail</li>
                </ul>
            </div>

            <!-- Container on the right side -->
            <?php
            $sqlorderdetails = "SELECT * FROM `orders` WHERE id = $orderId";

            $resultorderdetails = $conn->query($sqlorderdetails);
            ?>
            <?php if ($resultorderdetails->num_rows > 0) {
                while ($userOrdersDetails = $resultorderdetails->fetch_assoc()) {
                    ?>
                    <div class="col-md-9">
                        <div class=" mx-5 my-5 text-left" id="orderDetailsContent">
                            <div class="container my-5">
                                <div class="row justify-content-center">
                                    <!-- Billing Address Card -->
                                    <div class="col-md-12">
                                        <div class="card custom-card px-4 py-4">
                                            <div class="card-body">
                                                <h5 class="card-title"><b>Order Details</b></h5>
                                                <p>Order Number:
                                                    <?= $userOrdersDetails['order_id'] ?>
                                                </p>
                                                <p>Date:
                                                    <?= $userOrdersDetails['date_time'] ?>
                                                </p>
                                                <p>Shipping Address:
                                                    <?= $userOrdersDetails['address'] ?>
                                                </p>
                                                <p>Cart Amount:
                                                    <?= $userOrdersDetails['cart_amount'] ?>
                                                </p>
                                                <p>Discount Amount:
                                                    <?= $userOrdersDetails['discount_amt'] ?>
                                                </p>
                                                <p>Payment Method:
                                                    <?= $userOrdersDetails['payment_method'] ?>
                                                </p>
                                                <p>Delivery Charges:
                                                    <?= $userOrdersDetails['delivery_charges'] ?>
                                                </p>
                                                <p>Total Amount:
                                                    <?= $userOrdersDetails['final_amount'] ?>
                                                </p>
                                                <!-- You can add more order details here as needed -->
                                            </div>
                                        </div>
                                    </div>


                                    <!-- <div class="col-md-6 mt-4">
                                        <div class="card custom-card px-4 py-4">
                                            <div class="card-body">
                                                <h5 class="card-title"><b>Billing Address</b></h5>
                                                <p>Name: John Doe</p>
                                                <p>Address: 123 Main Street</p>
                                                <p>City: Anytown</p>
                                                <p>State: CA</p>
                                                <p>Zip Code: 12345</p>
                                                <p>Country: United States</p>
                                                <p>Email: john.doe@email.com</p>
                                                <p>Phone: (555) 123-4567</p>
                                            </div>
                                        </div>
                                    </div> -->

                                    <!-- Shipping Address Card -->
                                    <!-- <div class="col-md-6 mt-4">
                                        <div class="card custom-card px-4 py-4">
                                            <div class="card-body">
                                                <h5 class="card-title"><b>Shipping Address</b></h5>
                                                <p>Name: Jane Smith</p>
                                                <p>Address: 456 Elm Avenue</p>
                                                <p>City: Anothercity</p>
                                                <p>State: NY</p>
                                                <p>Zip Code: 54321</p>
                                                <p>Country: United States</p>
                                                <p>Email: jane.smith@email.com</p>
                                                <p>Phone: (555) 987-6543</p>
                                            </div>
                                        </div>
                                    </div> -->
                                </div>
                            </div>
                        </div>

                    </div>
                    <?php
                }
            }
            ?>
        </div>
    </div>

    <?php include "footer.php" ?>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        function changeImage ( card, newImageSrc ) {
            const image = card.querySelector( 'img' );
            image.src = newImageSrc;
        }

        function restoreImage ( card, originalImageSrc ) {
            const image = card.querySelector( 'img' );
            image.src = originalImageSrc;
        }
    </script>

</body>

</html>