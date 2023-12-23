<?php

// Assuming you have a database connection established
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "silverstaronline";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get values from $_POST
$productId = $_POST['product_id'];
$customerId = $_POST['customer_id'];
$increment = $_POST['increment'];
$decrement = $_POST['decrement'];

// Increment quantity by 1
if (isset($increment)) {
    $sqlIncrement = "UPDATE cart SET quantity = quantity + 1 WHERE product_id = $productId AND customer_id = $customerId";

    // Execute the query
    if ($conn->query($sqlIncrement) === TRUE) {
        header("Location: http://localhost/rustam%20chauhan/ascella/cart.php");
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

// Decrement quantity by 1 or delete if quantity is 1
if (isset($decrement)) {
    // Check if the current quantity is 1
    $currentQuantity = getCurrentQuantity($conn, $productId, $customerId);

    if ($currentQuantity > 1) {
        // Decrement quantity by 1
        $sqlDecrement = "UPDATE cart SET quantity = quantity - 1 WHERE product_id = $productId AND customer_id = $customerId";
        if ($conn->query($sqlDecrement) === TRUE) {
            header("Location: https://silver.checkai.in/cart.php");
        } else {
            echo "Error updating record: " . $conn->error;
        }
    } else {
        // Delete the product from the cart if quantity is 1
        $sqlDelete = "DELETE FROM cart WHERE product_id = $productId AND customer_id = $customerId";
        if ($conn->query($sqlDelete) === TRUE) {
            header("Location: https://silver.checkai.in/cart.php");
        } else {
            echo "Error deleting record: " . $conn->error;
        }
    }
}

// Function to get the current quantity from the database
function getCurrentQuantity($conn, $productId, $customerId)
{
    $sql = "SELECT quantity FROM cart WHERE product_id = $productId AND customer_id = $customerId";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['quantity'];
    } else {
        return 0;
    }
}

// Close the connection
$conn->close();

?>