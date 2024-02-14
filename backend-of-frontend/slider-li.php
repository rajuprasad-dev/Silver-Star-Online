<?php
include_once "conn.php";

// Query to fetch data from the site_slider table
$sql = "SELECT * FROM site_slider";
$result = $conn->query($sql);
?>

<ol class="carousel-indicators">
    <?php
    $sequence = 0;
    // Loop through each row in the result set
    while ($row = $result->fetch_assoc()) {
        ?>
        <li data-target="#myCarousel" data-slide-to="<?= $sequence ?>" <?= $sequence === 0 ? ' class="active"' : '' ?>></li>
        <?php
        $sequence++;
    }
    ?>
</ol>