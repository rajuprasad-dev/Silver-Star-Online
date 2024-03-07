<?php
session_start();
include_once "conn.php";

// Get values from $_POST
$productId = $_POST['product_id'];
$customerId = $_POST['customer_id'];

// Increment quantity by 1
if (isset($_POST['increment'])) {
    $increment = $_POST['increment'];

    $sqlIncrement = "UPDATE cart SET quantity = quantity + 1 WHERE product_id = $productId AND customer_id = $customerId";

    // Execute the query
    if ($conn->query($sqlIncrement) === TRUE) {
        header("location:" . $_SERVER['HTTP_REFERER']);
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

// Decrement quantity by 1 or delete if quantity is 1
if (isset($_POST['decrement'])) {
    $decrement = $_POST['decrement'];

    // Check if the current quantity is 1
    $currentQuantity = getCurrentQuantity($conn, $productId, $customerId);

    if ($currentQuantity > 1) {
        // Decrement quantity by 1
        $sqlDecrement = "UPDATE cart SET quantity = quantity - 1 WHERE product_id = $productId AND customer_id = $customerId";
        if ($conn->query($sqlDecrement) === TRUE) {
            header("location:" . $_SERVER['HTTP_REFERER']);
        } else {
            echo "Error updating record: " . $conn->error;
        }
    } else {
        // Delete the product from the cart if quantity is 1
        $sqlDelete = "DELETE FROM cart WHERE product_id = $productId AND customer_id = $customerId";
        if ($conn->query($sqlDelete) === TRUE) {
            header("location:" . $_SERVER['HTTP_REFERER']);
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