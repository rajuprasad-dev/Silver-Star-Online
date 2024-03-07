<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
$basePath = dirname(__FILE__);
require_once($basePath . '/../vendor/autoload.php');

global $conn;

$whitelist = array(
    '127.0.0.1',
    '::1'
);

$is_localhost = in_array($_SERVER['REMOTE_ADDR'], $whitelist);

if ($is_localhost) {
    // localhost
    DEFINE("SERVER", "localhost");
    DEFINE("USERNAME", "root");
    DEFINE("PASSWORD", "");
    DEFINE("DB", "silverstaronline");
} else {
    // server 
    DEFINE("SERVER", "85.10.211.41");
    DEFINE("USERNAME", "checkaic_silverstar");
    DEFINE("PASSWORD", "Silver@2024");
    DEFINE("DB", "checkaic_silverstar");
}

$conn = new mysqli(SERVER, USERNAME, PASSWORD, DB) or die('Unable to connect to database! Please try again later.');

function check_image($src = "")
{
    if (!empty($src) && file_exists($src) && is_file($src) && is_readable($src)) {
        return $src;
    } else {
        return "images/placeholder.jpg";
    }
}


function send_email($email, $subject, $body)
{
    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);

    try {
        // $mail->SMTPDebug = SMTP::DEBUG_SERVER; 
        $mail->isSMTP();
        $mail->Host = 'mail.silverstaronline.in';
        $mail->SMTPAuth = true;
        $mail->Username = 'no-reply@silverstaronline.in';
        $mail->Password = 'Silver@2024';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        //Recipients
        $mail->setFrom('no-reply@silverstaronline.in', 'Silver Star');
        $mail->addAddress($email);
        $mail->addReplyTo('no-reply@silverstaronline.in', 'Silver Star');
        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body = $body;

        if ($mail->send()) {
            return true;
        } else {
            return false;
        }
    } catch (Exception $e) {
        return false;
    }
}

// Send SMS & EMAIL NOTIFICATIONS
function send_order_notifications($phone_num = '', $email = '', $title = '', $message = '', $username = '')
{
    $data = array();
    $output = array();

    if (!empty($email)) {
        // storing data in array
        $email_data = array();

        $email_data['update_title'] = $title;
        $email_data['username'] = $username;
        $email_data['message'] = $message;

        // getting and storing contents of the email page in variable
        $basePath = dirname(__FILE__);
        $email_layout = file_get_contents($basePath . "/../admin/class/order.html");

        // looping through the email page and replacing the key with the variable
        foreach ($email_data as $key => $data_value) {
            $email_layout = str_replace('{{' . $key . '}}', $data_value, $email_layout);
        }

        // setting mail environment and defining variables
        $to = $email;
        $subject = 'Order Notification From Silver Star Online';
        $body = $email_layout;

        // echo $body;
        // die;

        if (send_email($to, $subject, $body)) {
            return true;
        } else {
            return false;
        }
    }
}


// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$baseURL = (empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]" . ($is_localhost ? "/Silver%20Star%20Online/" : "");
$currentURL = (empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";