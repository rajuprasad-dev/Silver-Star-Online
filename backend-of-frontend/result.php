<?php
session_start();
include_once "conn.php";

$status = $_REQUEST['payment_status'];
$_SESSION['UID'];

// $temp = $_SESSION['TEMP'];

if ($status == "Credit") {
   $customer_id = $_SESSION['userId'];
   $firstName = $_SESSION['firstName'];
   $lastName = $_SESSION['lastName'];
   $country = $_SESSION['country'];
   $state = $_SESSION['state'];
   $city = $_SESSION['city'];
   $address = $_SESSION['address'];
   $email = $_SESSION['email'];
   $pincode = $_SESSION['pincode'];
   $phone = $_SESSION['phone'];
   $companyName = $_SESSION['companyName'];
   $orderNote = $_SESSION['orderNote'];
   $orderID = $_SESSION['orderID'];
   $totalAmount = $_SESSION['totalCartAmount'];

   $date_time = date("Y-m-d H:i:s"); // Current datetime

   $insert_sql = "INSERT INTO `orders`( `customer_id`, `address`, `order_id`, `cart_amount`, `discount_amt`, `delivery_charges`, `coupon_code`, `coupon_discount`, `final_amount`, `payment_method`, `payment_status`, `payment_id`, `order_status`, `date_time`, `orderd_products_id`) VALUES ($customer_id, '$address', '$orderID', 100.00, 10.00, 5.00, 'DISCOUNT10', 10.00, 95.00, 'Razorpay', 'Paid', 'PAY123', 'Delivered', '2023-11-06 14:30:00', '1')";

   $cart_to_orders = "INSERT INTO ordered_products (customer_id, product_id, quantity, date_time) SELECT customer_id, product_id, quantity, date_time FROM cart WHERE customer_id = $customer_id";

   $deleteCart = "DELETE FROM cart WHERE customer_id = $customer_id";

   if ($conn->query($insert_sql) === TRUE && $conn->query($cart_to_orders) === TRUE && $conn->query($deleteCart) === TRUE) {
      header("Location: " . $baseURL);
      exit();
   } else {
      echo "Server Error!";
   }

   $conn->close();
} else {
   echo "FAILED";
}
