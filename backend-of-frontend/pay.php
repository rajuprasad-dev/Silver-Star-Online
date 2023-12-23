<?php
session_start();


$name = $_GET['name'];
$phone = $_GET['phone'];
$email = $_GET['email'];
$amount = $_GET['amount'];
$purpose = $_GET['purpose'];
$temp=$_GET['uid'];
$temp=$_GET['temp'];
$_SESSION['TEMP']=$temp;
$_SESSION['UID']=$uid;




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
    'amount' => $amount,
    'phone' => $phone,
    'buyer_name' => $name,
    'redirect_url' => 'http://localhost/rustam%20chauhan/instamojo%20(1)/result.php',
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
$_SESSION['TID']=$response->payment_request->id;
header('location:'.$response->payment_request->longurl);

?>