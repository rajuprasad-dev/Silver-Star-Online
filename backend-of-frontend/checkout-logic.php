<?php
// Start the session
session_start();
include_once "conn.php";

if (isset($_POST['firstName'])) {
    $firstName = $_POST["firstName"];
    $lastName = $_POST["lastName"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $address = $_POST["address"];
    $city = $_POST["city"];
    $state = $_POST["state"];
    $country = $_POST["country"];
    $pincode = $_POST["pincode"];
    $companyName = $_POST["companyName"];
    $orderNote = $_POST["orderNote"];
    $differentAddress = isset($_POST["differentAddress"]) ? $_POST["differentAddress"] : "";

    $orderID = "ORD" . date("YmdHis") . mt_rand(1000, 9999);

    if (!empty($differentAddress)) {
        $full_address = $differentAddress;
    } else {
        // Concatenate values into a single string
        $full_address = "{$address}, {$city}, {$state}, {$country}, {$pincode}";
    }

    // Store variables in the session
    $_SESSION['TEMP']['cart_information'] = [
        'userId' => $_SESSION['userId'],
        'firstName' => $firstName,
        'lastName' => $lastName,
        'country' => $country,
        'state' => $state,
        'city' => $city,
        'address' => $full_address,
        'email' => $email,
        'pincode' => $pincode,
        'phone' => $phone,
        'companyName' => $companyName,
        'orderNote' => $orderNote,
        'orderID' => $orderID,
    ];
}

$purpose = 'product-payment';

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, 'https://test.instamojo.com/api/1.1/payment-requests/');
curl_setopt($ch, CURLOPT_HEADER, FALSE);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
curl_setopt(
    $ch,
    CURLOPT_HTTPHEADER,
    array(
        "X-Api-Key:test_de4c72b30e16006591dfd1d0e75",
        "X-Auth-Token:test_126856e442c357e6ecb83c2e9f3"
    )
);
$payload = array(
    'purpose' => $purpose,
    'amount' => $_SESSION['totalCartAmount'],
    'phone' => $phone,
    'buyer_name' => $firstName,
    'redirect_url' => $baseURL . 'backend-of-frontend/result',
    'send_email' => true,
    'send_sms' => true,
    'email' => $email,
    'allow_repeated_payments' => false
);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($payload));
$response = curl_exec($ch);
curl_close($ch);

// echo "<pre>";
// print_r($response);
// die;

if ($response) {
    $response = json_decode($response);
    // echo '<pre>';
    // print_r($response);
    $_SESSION['TEMP']['coupon'] = [
        "discount" => $_SESSION['discount_amount'] ?? "0",
        "code" => $_SESSION['coupon_code'] ?? "",
    ];
    $_SESSION['TEMP']['payment_response'] = $response;
    $_SESSION['TEMP']['cart'] = [
        "cart_products" => $_SESSION['cart_products'],
        "subtotal" => $_SESSION['subtotalCartAmount'],
        "cart_discount" => $_SESSION['cart_discount'],
        "total" => $_SESSION['totalCartAmount'],
    ];

    unset($_SESSION['password']);
    unset($_SESSION['cart_products']);
    unset($_SESSION['subtotalCartAmount']);
    unset($_SESSION['cart_discount']);
    unset($_SESSION['totalCartAmount']);
    unset($_SESSION['coupon_code']);
    unset($_SESSION['discount_amount']);
    unset($_SESSION['coupon_set']);

    header('location:' . $response->payment_request->longurl);
} else {
    header('location:' . $_SERVER['HTTP_REFERER']);
}