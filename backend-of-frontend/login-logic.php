<?php
session_start(); // Start the session
// Collect user input
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "silverstaronline";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST["username"]) && isset($_POST["password"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Perform a query to fetch the user with the provided username
    $sql = "SELECT * FROM customers WHERE name = '$username'";
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

            header("Location: https://silver.checkai.in/account.php");

        } else {

            // echo '<script>alert("username or password incorrect");</script>';
            // header("Location: http://localhost/rustam%20chauhan/ascella/login.php");
            $_SESSION['login_error'] = "Username or password incorrect";

            // Redirect using JavaScript after setting the session message
            echo '<script>window.location.href = "https://silver.checkai.in/login.php";</script>';
            exit();
        }


    }
}
?>