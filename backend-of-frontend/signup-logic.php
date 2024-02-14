<?php
// Collect user input
include("conn.php");
if (isset($_POST["username"]) && isset($_POST["password"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];
    echo $username;
}


// Check if the username is already taken
// $check_sql = "SELECT id, name FROM customers WHERE name = '$username'";

// $result = $conn->query($check_sql);

// if ($result->num_rows > 0) {
//     echo "Username is already taken. Please choose a different one.";
// } else {
//     // Username is unique, proceed with inserting into the database
//     $insert_sql = "INSERT INTO customers (name, password) VALUES ('$username', '$password')";
//     if ($conn->query($insert_sql) === TRUE) {
//         echo "Signup successful!";

//         // Set the session variables
//         session_start(); // Start the session
//         $_SESSION['username'] = $username;
//         $_SESSION['password'] = $password;
//         $_SESSION['userId'] = 1; // Assuming 'id' is an auto-increment primary key

//         // Redirect to index after successful signup
//         header("Location: account");
//         exit();
//     } else {
//         echo "Error: " . $insert_sql . "<br>" . $conn->error;
//     }
// }

// $conn->close();

?>