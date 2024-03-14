<?php
session_start(); // Start the session

// Check if session variables are set
if (!isset($_SESSION['username']) || !isset($_SESSION['userId'])) {
    // Redirect to the login page
    header("Location: login");
    exit;
}


if (isset($_SESSION['userId'])) {
    $userId = $_SESSION['userId'];
    // You can now use $myVariable in this page.
}
?>