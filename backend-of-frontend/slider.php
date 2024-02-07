<?php
include "conn.php";

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
                <img src="src/images/slider/<?= $row['image'] ?>" class="d-block w-100" alt="Chicago">
                <div class="carousel-caption text-center">
                    <a href="shop.php" class="d-block"><button class="black-button">Shop Now</button></a>
                </div>
            </div>
            <?php
            $firstTime = false; // Set the flag to prevent further execution
        } else {
            ?>
            <div class="carousel-item">
                <img src="src/images/slider/<?= $row['image'] ?>" class="d-block w-100" alt="Chicago">
                <div class="carousel-caption text-center">
                    <a href="shop.php"><button class="black-button">Shop Now</button></a>
                </div>
            </div>
            <?php
        }
    }
}
?>