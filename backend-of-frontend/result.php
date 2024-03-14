<?php
session_start();
include_once "conn.php";

$payment_id = $_REQUEST['payment_id'];
$status = $_REQUEST['payment_status'];

if (!isset($_SESSION['userId']) && !isset($_SESSION['TEMP'])) {
	header("Location:" . $_SERVER['HTTP_REFERER']);
	exit();
}

$temp = $_SESSION['TEMP']; //this should contain all the cart information including couppon code

// echo "<pre>";
// print_r($_REQUEST);
// print_r($temp);
// print_r(json_encode($_SESSION, JSON_PRETTY_PRINT));
// die;

if ($status == "Credit") {
	$customer_id = $temp['cart_information']['userId'] ?? $_SESSION['userId'];
	$firstName = $temp['cart_information']['firstName'];
	$lastName = $temp['cart_information']['lastName'];
	$country = $temp['cart_information']['country'];
	$state = $temp['cart_information']['state'];
	$city = $temp['cart_information']['city'];
	$address = $temp['cart_information']['address'];
	$differentAddress = $temp['cart_information']['differentAddress'];
	$email = $temp['cart_information']['email'];
	$pincode = $temp['cart_information']['pincode'];
	$phone = $temp['cart_information']['phone'];
	$gstNumber = $temp['cart_information']['gstNumber'];
	$companyName = $temp['cart_information']['companyName'];
	$orderNote = $temp['cart_information']['orderNote'];
	$orderID = $temp['cart_information']['orderID'];
	$cgst = $temp['cart_information']['cgst'] ?? 0;
	$sgst = $temp['cart_information']['sgst'] ?? 0;
	$igst = $temp['cart_information']['igst'] ?? 0;
	$cart_products = clean($conn, json_encode($temp['cart']['cart_products']));
	$subtotal = $temp['cart']['subtotal'];
	$new_subtotal = $temp['cart']['new_subtotal'];
	$cart_discount = $temp['cart']['cart_discount'];
	$delivery_charges = $temp['cart']['delivery_charges'] ?? 0;
	$coupon_code = $temp['coupon']['code'];
	$coupon_discount = $temp['coupon']['discount'];
	$final_amount = $temp['cart']['total'];
	$payment_response = $temp['payment_response'];

	$date_time = date("Y-m-d H:i:s"); // Current datetime

	$insert_sql = "INSERT INTO `orders`( `customer_id`, `booking_address`, `different_address`, `order_id`, `order_note`, `products`, `cart_amount`, `discount_amt`, `delivery_charges`, `coupon_code`, `coupon_discount`, `gstNumber`, `companyName`, `cgst`, `sgst`, `igst`, `final_amount`, `payment_method`, `payment_status`, `payment_id`, `order_status`) VALUES ($customer_id, '$address', '$differentAddress', '$orderID', '$orderNote', '$cart_products', $new_subtotal, $cart_discount, $delivery_charges, '$coupon_code', $coupon_discount, '$gstNumber', '$companyName', $cgst, $sgst, $igst, $final_amount, 'Online', 'Paid', '$payment_id', 'Pending')";

	// echo "<pre>";
	// die($insert_sql);

	$deleteCart = "DELETE FROM `cart` WHERE `customer_id` = $customer_id";

	if ($conn->query($insert_sql) === TRUE && $conn->query($deleteCart) === TRUE) {
		$sqluserDetails = "SELECT * FROM `customers` WHERE id = $customer_id";
		$resultuserDetails = mysqli_query($conn, $sqluserDetails);
		$userDetails = array();
		if ($resultuserDetails && mysqli_num_rows($resultuserDetails) > 0) {
			$userDetails = mysqli_fetch_assoc($resultuserDetails);
		}

		$message = "We have successfully placed order for you with order id <b>" . $orderID . "</b> and it will be delivered to your address : " . $address . ". By Regards Silver Star";

		$title = "Order Placed Successfully";
		$mail = send_order_notifications($phone, $email, $title, $message, $userDetails['name']);

		if ($mail) {
			header("Location: " . $baseURL . "account");
		} else {
			echo "Failed to send order email";
		}
	} else {
		echo "Server Error!";
	}

	$conn->close();
} else {
	echo "FAILED";
}