<?php
session_start();
if (isset($_POST["product_id"])) {

    if (!isset($_SESSION['username']) || !isset($_SESSION['password']) || !isset($_SESSION['userId'])) {
        $_SESSION['login_cart_alert'] = "set";
        header("Location: https://silver.checkai.in/");
        exit();
    }

    // Collect product_id and quantity from the form
    $product_id = $_POST["product_id"];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "silverstaronline";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Check if the product is already in the cart
    $check_existing_sql = "SELECT * FROM cart WHERE customer_id = '$customer_id' AND product_id = '$product_id'";
    $result = $conn->query($check_existing_sql);

    if ($result->num_rows > 0) {
        // Product already in the cart
        $_SESSION['already_added'] = "set";
        header("Location: https://silver.checkai.in/");
        exit();
    } else {
        // Insert the new record into the cart table
        $date_time = date("Y-m-d H:i:s"); // Current datetime
        $insert_sql = "INSERT INTO cart (customer_id, product_id, quantity, date_time) VALUES ('$customer_id', '$product_id', '1', '$date_time')";

        if ($conn->query($insert_sql) === TRUE) {
            // Redirect to cart.php after successful insertion
            $_SESSION['cart_alert'] = "set";
            header("Location: https://silver.checkai.in/");
            exit();
        } else {
            echo "Error: " . $insert_sql . "<br>" . $conn->error;
        }
    }



    $conn->close();
}
?>