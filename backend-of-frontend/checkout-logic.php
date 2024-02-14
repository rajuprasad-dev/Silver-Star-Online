<?php
// Start the session
session_start();
include_once "conn.php";

if (isset($_POST['firstName'])) {
    $firstName = $_POST["firstName"];
    $lastName = $_POST["lastName"];
    $country = $_POST["country"];
    $state = $_POST["state"];
    $city = $_POST["city"];
    $address = $_POST["address"];
    $differentAddress = isset($_POST["differentAddress"]) ? $_POST["differentAddress"] : "";

    if (!empty($differentAddress)) {
        $address = $differentAddress;
    } else {
        // Concatenate values into a single string
        $address = "Country: $country, State: $state, City: $city, Address: $address";
    }
    $email = $_POST["email"];
    $pincode = $_POST["pincode"];
    $phone = $_POST["phone"];
    $companyName = $_POST["companyName"];
    $orderNote = $_POST["orderNote"];
    $orderID = "ORD" . date("YmdHis") . mt_rand(1000, 9999);

    // Store variables in the session
    $_SESSION['firstName'] = $firstName;
    $_SESSION['lastName'] = $lastName;
    $_SESSION['country'] = $country;
    $_SESSION['state'] = $state;
    $_SESSION['city'] = $city;
    $_SESSION['address'] = $address;
    $_SESSION['email'] = $email;
    $_SESSION['pincode'] = $pincode;
    $_SESSION['phone'] = $phone;
    $_SESSION['companyName'] = $companyName;
    $_SESSION['orderNote'] = $orderNote;
    $_SESSION['orderID'] = $orderID;


}

$purpose = 'product-payment';
$temp = $_GET['uid'];
$temp = $_GET['temp'];
$_SESSION['TEMP'] = $temp;
$_SESSION['UID'] = $uid;

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
    'redirect_url' => '/backend-of-frontend/result',
    'send_email' => true,
    'send_sms' => true,
    'email' => $email,
    'allow_repeated_payments' => false
);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($payload));
$response = curl_exec($ch);
curl_close($ch);

$response = json_decode($response);
echo '<pre>';
// print_r($response);
$_SESSION['TID'] = $response->payment_request->id;
header('location:' . $response->payment_request->longurl);
