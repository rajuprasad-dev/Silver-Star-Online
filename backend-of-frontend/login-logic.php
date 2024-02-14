<?php
session_start();
include_once "conn.php";

if (isset($_POST["username"]) && isset($_POST["password"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Perform a query to fetch the user with the provided username
    $sql = "SELECT * FROM `customers` WHERE `name` = '$username' OR `email` = '$username'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);

        // Verify the password
        if ($password == $row["password"]) {
            // Password is correct; user is logged in
            // You can set session variables or redirect the user to a dashboard page
            // Example: $_SESSION["user_id"] = $row["id"];
            $_SESSION['username'] = $username;
            $_SESSION['password'] = $password;
            $_SESSION['userId'] = $row['id'];

            header("Location: ../account.php");

        } else {

            // echo '<script>alert("username or password incorrect");</script>';
            // header("Location: http://localhost/rustam%20chauhan/ascella/login.php");
            $_SESSION['login_error'] = "Username or password incorrect";

            // Redirect using JavaScript after setting the session message
            echo '<script>window.location.href = "../login.php";</script>';
            exit();
        }


    } else {
        $_SESSION['login_error'] = "User doesn't exist, please register";

        // Redirect using JavaScript after setting the session message
        echo '<script>window.location.href = "../login.php";</script>';
        exit();
    }
}
?>