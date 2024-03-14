<?php
// Start the session
session_start();
include_once "conn.php";

$sql = "SELECT * FROM `site_settings` WHERE `setting_name`='Payment Gateway'";
$payment_query = $conn->query($sql);
$payment_data = [
    "test" => [
        "key" => "",
        "token" => "",
    ],
    "live" => [
        "key" => "",
        "token" => "",
    ],
    "isTest" => false,
];

if ($payment_query->num_rows > 0) {
    $row = $payment_query->fetch_assoc();
    $payment_data = json_decode($row['setting_data'], true);
}

if (empty($payment_data) || empty($payment_data['test']) || !is_array($payment_data)) {
    // echo "Bug";
    // die;
    header('location:' . $_SERVER['HTTP_REFERER']);
    exit;
}

$actual_payment_details = $payment_data['isTest'] ? $payment_data['test'] : $payment_data['live'];

if (!empty($_POST['firstName']) && !empty($_POST['lastName']) && !empty($_POST['email']) && !empty($_POST['phone']) && !empty($_POST['address']) && !empty($_POST['city']) && !empty($_POST['state']) && !empty($_POST['country']) && !empty($_POST['pincode']) && !empty($_SESSION['totalCartAmount']) && !empty($_SESSION['new_subtotalCartAmount']) && ((!empty($_POST['cgst']) && !empty($_POST['sgst'])) || !empty($_POST['igst']))) {
    $firstName = $_POST["firstName"];
    $lastName = $_POST["lastName"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $address = $_POST["address"];
    $city = $_POST["city"];
    $state = $_POST["state"];
    $country = $_POST["country"];
    $pincode = $_POST["pincode"];
    $gstNumber = $_POST["gstNumber"];
    $companyName = $_POST["companyName"];
    $orderNote = $_POST["orderNote"];
    $differentAddress = isset($_POST["differentAddress"]) ? $_POST["differentAddress"] : "";
    $cgst = isset($_POST["cgst"]) ? $_POST["cgst"] : "";
    $sgst = isset($_POST["sgst"]) ? $_POST["sgst"] : "";
    $igst = isset($_POST["igst"]) ? $_POST["igst"] : "";
    $totalCartAmount = $_SESSION['totalCartAmount'];
    $new_subtotalCartAmount = $_SESSION['new_subtotalCartAmount'];

    $orderID = "ORD" . date("YmdHis") . mt_rand(1000, 9999);

    // print_r($_POST);
    // die;

    // Concatenate values into a single string
    $full_address = "{$address}, {$city}, {$state}, {$country}, {$pincode}";

    // Store variables in the session
    $_SESSION['TEMP']['cart_information'] = [
        'userId' => $_SESSION['userId'],
        'firstName' => $firstName,
        'lastName' => $lastName,
        'country' => $country,
        'state' => $state,
        'city' => $city,
        'address' => $full_address,
        'differentAddress' => $differentAddress,
        'email' => $email,
        'pincode' => $pincode,
        'phone' => $phone,
        'companyName' => $companyName,
        'gstNumber' => $gstNumber,
        'cgst' => $cgst,
        'sgst' => $sgst,
        'igst' => $igst,
        'orderNote' => $orderNote,
        'orderID' => $orderID,
    ];

    $purpose = 'product-payment';

    $ch = curl_init();

    $api_url = $payment_data['isTest'] ? 'https://test.instamojo.com/api/1.1/payment-requests/' : "https://www.instamojo.com/api/1.1/payment-requests/";

    curl_setopt($ch, CURLOPT_URL, $api_url);
    curl_setopt($ch, CURLOPT_HEADER, FALSE);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
    curl_setopt(
        $ch,
        CURLOPT_HTTPHEADER,
        array(
            "X-Api-Key:{$actual_payment_details['key']}",
            "X-Auth-Token:{$actual_payment_details['token']}"
        )
    );
    $payload = array(
        'purpose' => $purpose,
        'amount' => $totalCartAmount,
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
            "new_subtotal" => $_SESSION['new_subtotalCartAmount'],
            "cart_discount" => $_SESSION['cart_discount'],
            "total" => $totalCartAmount,
        ];

        unset($_SESSION['password']);
        unset($_SESSION['cart_products']);
        unset($_SESSION['subtotalCartAmount']);
        unset($_SESSION['new_subtotalCartAmount']);
        unset($_SESSION['cart_discount']);
        unset($_SESSION['totalCartAmount']);
        unset($_SESSION['coupon_code']);
        unset($_SESSION['discount_amount']);
        unset($_SESSION['coupon_set']);

        header('location:' . $response->payment_request->longurl);
    } else {
        header('location:' . $_SERVER['HTTP_REFERER']);
    }
} else {
    // echo "<script>alert('Please enter all the required values');</script>";
    header('location:' . $_SERVER['HTTP_REFERER']);
}