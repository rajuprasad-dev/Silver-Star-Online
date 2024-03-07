<?php
include "auth.php";
include_once "./backend-of-frontend/conn.php";

if (!$_POST['order_id']) {
    header("location: account");
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
            <h2 class="display-5">Order Details</h2>
            <p class="lead">Shop</p>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <!-- Side Navigation without borders or background color -->
            <div class="col-md-12" style="visibility: none;">
                <!-- <h3>Categories</h3> -->
                <div class="mx-lg-5 mx-3 px-3 py-4 custom-card">
                    <span>Order Detail</span>
                </div>
            </div>

            <!-- Container on the right side -->
            <?php
            $sqlorderdetails = "SELECT `orders`.*, `customers`.`name` as `c_name`, `customers`.`phone` as `c_phone` FROM `orders` JOIN `customers` ON `orders`.`customer_id` = `customers`.`id` WHERE `orders`.`id` = '$orderId' ORDER BY `orders`.`id` DESC";

            $resultorderdetails = $conn->query($sqlorderdetails);
            ?>
            <?php if ($resultorderdetails->num_rows > 0) {
                while ($result = $resultorderdetails->fetch_assoc()) {
                    ?>
                    <div class="col-md-12">
                        <div class="mx-lg-5 mx-3 my-4 text-left custom-card" id="orderDetailsContent">
                            <div class="table table-responsive">
                                <table class="table table-hover">
                                    <tbody>
                                        <tr>
                                            <th>Booking ID</th>
                                            <td>
                                                <?php echo "#" . $result['order_id']; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Order Date</th>
                                            <td>
                                                <?php echo date("d M Y h:i:s a", strtotime($result['date_time'])); ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Name</th>
                                            <td>
                                                <?php echo $result['c_name']; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Phone No</th>
                                            <td>
                                                <?php echo $result['c_phone']; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Products</th>
                                            <td>
                                                <?php
                                                $products_data_list = array();
                                                if (!empty($result['products'])) {
                                                    $products_data = json_decode($result['products'], true);

                                                    if (!empty($products_data) && is_array($products_data)) {
                                                        $products_data_list = $products_data;

                                                        foreach ($products_data as $pk => $prod) {
                                                            echo '<p class="mb-0"><a target="blank" href="../product_details?data=' . base64_encode($prod['name']) . '&id=' . base64_encode($prod['id']) . '">' . $prod['name'] . '</a><span class="ml-2 text-success">(1 ' . $prod['quantity_unit'] . ')</span><span class="ml-2 text-tertiary">(x' . $prod['cart_quantity'] . ')</span><span class="ml-2 text-info"></span></p>';
                                                        }
                                                    } else {
                                                        echo "Not Available";
                                                    }
                                                }
                                                ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Delivery Address</th>
                                            <td>
                                                <?php echo $result['booking_address']; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Amount</th>
                                            <td>₹
                                                <?php echo $result['cart_amount']; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Discount</th>
                                            <td>
                                                <?php echo "₹" . $result['discount_amt']; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Delivery Charges</th>
                                            <td>
                                                <?php echo "₹" . $result['delivery_charges'] == 0 ? "Free" : $result['delivery_charges']; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Coupon Used</th>
                                            <td>
                                                <?php echo !empty($result['coupon_code']) ? $result['coupon_code'] : "No Coupon Code Used"; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Coupon Discount</th>
                                            <td>₹
                                                <?php echo !empty($result['coupon_discount']) ? $result['coupon_discount'] : 0; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Final Amount</th>
                                            <td>₹
                                                <?php echo $result['final_amount']; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Payment Mode</th>
                                            <td>
                                                <?php echo $result['payment_method'] == "COD" ? "Cash On Delivery" : "Online"; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Payment ID</th>
                                            <td>
                                                <?php echo !empty($result['payment_id']) ? $result['payment_id'] : "Not Applicable"; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Order Status</th>
                                            <td class="font-weight-bold">
                                                <?php echo $result['order_status']; ?>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
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