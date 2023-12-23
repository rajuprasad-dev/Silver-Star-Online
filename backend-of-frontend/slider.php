<?php
// Establish a database connection (you should have a database connection script)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "silverstaronline";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to fetch the latest beauty products
$sqlslider = "SELECT * FROM `site_slider`";

$fetchSlider = $conn->query($sqlslider);
$firstTime = true;
// Check if there are fetchSliders
if ($fetchSlider->num_rows > 0) {
    while ($row = $fetchSlider->fetch_assoc()) {
        if ($firstTime) {
            // Code to execute only once
            ?>
            <div class="carousel-item active">
                <img src="images/<?= $row['image'] ?>" class="d-block w-100" alt="Chicago">
                <div class="carousel-caption text-center">
                    <h1 style="font-size:7.5rem;" class="header-font">Heart Stone</h1>
                    <a href="shop.php"><button class="black-button">Shop Now</button></a>
                </div>
            </div>
            <?php
            $firstTime = false; // Set the flag to prevent further execution
        } else {
            ?>
            <div class="carousel-item">
                <img src="images/<?= $row['image'] ?>" class="d-block w-100" alt="Chicago">
                <div class="carousel-caption text-center">
                    <h1 style="font-size:7.5rem;" class="header-font">Heart Stone</h1>
                    <a href="shop.php"><button class="black-button">Shop Now</button></a>
                </div>
            </div>
            <?php
        }
    }
} else {
    echo '<script>
    function myFunction() {
        alert("This is JavaScript code echoed from PHP!");
    }
</script>';
}

// Close the database connection
$conn->close();
?>