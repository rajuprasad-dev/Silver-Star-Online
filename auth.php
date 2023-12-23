<?php
session_start(); // Start the session


// Check if session variables are set
if (!isset($_SESSION['username']) || !isset($_SESSION['password']) || !isset($_SESSION['userId'])) {
    // Redirect to the login page
    header("Location: login.php");
    exit;
}
?>