<?php
global $conn;

$whitelist = array(
    '127.0.0.1',
    '::1'
);

$is_localhost = in_array($_SERVER['REMOTE_ADDR'], $whitelist);

if ($is_localhost) {
    // localhost
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "silverstaronline";
} else {
    // server 
    $servername = "85.10.211.41";
    $username = "checkaic_silverstar";
    $password = "Silver@2024";
    $dbname = "checkaic_silverstar";
}

$conn = new mysqli($servername, $username, $password, $dbname) or die('Unable to connect to database! Please try again later.');

function check_image($src = "")
{
    if (!empty($src) && file_exists($src) && is_file($src) && is_readable($src)) {
        return $src;
    } else {
        return "images/placeholder.jpg";
    }
}

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$baseURL = (empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]" . ($is_localhost ? "/Silver%20Star%20Online/" : "");
$currentURL = (empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";