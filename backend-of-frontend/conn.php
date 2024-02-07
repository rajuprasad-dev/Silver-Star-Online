<?php
global $conn;
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "silverstaronline";

$conn = new mysqli($servername, $username, $password, $dbname);

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