<?php
// Establish a database connection (you should have a database connection script)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "neocart";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}




$images = array(
    "https://ascella.qodeinteractive.com/wp-content/uploads/2022/12/slider-list-img-new-7.jpg",
    "https://ascella.qodeinteractive.com/wp-content/uploads/2022/12/slider-list-img-new-6.jpg",
    "https://ascella.qodeinteractive.com/wp-content/uploads/2022/12/slider-list-img-new-2.jpg",
    "https://ascella.qodeinteractive.com/wp-content/uploads/2022/12/slider-list-img-new-5.jpg",
    "https://ascella.qodeinteractive.com/wp-content/uploads/2023/01/slider-list-img-new-10.jpg"
);
$loopStart = 100;
$loopEnd = 124;

for ($i = $loopStart; $i <= $loopEnd; $i++) {
    $imageIndex = ($i - 1) % 8; // Calculate the image index, wrapping around to 0 when it reaches 8
    $imageName = $images[$imageIndex];
    // SQL query to fetch the latest beauty products
    $sql = "UPDATE `product_images` SET `image`='$imageName' WHERE product_id = $i";

    $conn->query($sql);
    
}
?>