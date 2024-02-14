<?php
session_start();
include_once "./backend-of-frontend/conn.php";

// Collect user input
if (
    isset($_POST["username"]) && isset($_POST["password"]) && isset($_POST["confirmPassword"]) &&
    isset($_POST["name"]) && isset($_POST["phone"]) && isset($_POST["email"]) && isset($_POST["address"]) &&
    isset($_POST["city"]) && isset($_POST["state"]) && isset($_POST["pincode"]) && isset($_POST["landmark"])
) {

    $username = $_POST["username"];
    $password = $_POST["password"];
    $confirmPassword = $_POST["confirmPassword"];
    $name = $_POST["name"];
    $phone = $_POST["phone"];
    $email = $_POST["email"];
    $address = $_POST["address"];
    $city = $_POST["city"];
    $state = $_POST["state"];
    $pincode = $_POST["pincode"];
    $landmark = $_POST["landmark"];

    // Check if passwords match
    if ($password != $confirmPassword) {
        $_SESSION['signup_error'] = "Two passwords don't match";
        $_SESSION['showSignUpForm'] = true;
        header("Location: http://localhost/rustam%20chauhan/ascella/login.php");
        exit();
    }

    // Check if the username is already taken
    $check_sql = "SELECT id, name FROM customers WHERE name = '$username'";
    $result = $conn->query($check_sql);

    if ($result->num_rows > 0) {
        $_SESSION['signup_error'] = "Username already in use";
        $_SESSION['showSignUpForm'] = true;
        header("Location: http://localhost/rustam%20chauhan/ascella/login.php");
        exit();
    } else {
        $insert_sql = "INSERT INTO customers (name, phone, email, address, city, state, pincode, landmark, status, otp, otp_time, date_time, password)
           VALUES ('$name', '$phone', '$email', '$address', '$city', '$state', '$pincode', '$landmark', 0, '00000', NOW(), NOW(), '$password')";

        if ($conn->query($insert_sql) === TRUE) {
            // Set the session variables
            $_SESSION['username'] = $username;
            $_SESSION['password'] = $password;
            $_SESSION['userId'] = $conn->insert_id;

            // Redirect to account.php after successful signup
            header("Location: account.php");
            exit();
        } else {
            // Handle the case where the INSERT query fails
            echo "Error: " . $insert_sql . "<br>" . $conn->error;
        }
    }
}

$conn->close();
?>