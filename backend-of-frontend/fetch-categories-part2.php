<?php
include_once "conn.php";

// SQL query to fetch the latest beauty products
$sqlfetchcategories2 = "SELECT * FROM categories WHERE id % 2 = 1";

$fetchcategories2 = $conn->query($sqlfetchcategories2);

// Check if there are fetchcategories2s
if ($fetchcategories2->num_rows > 0) {
  while ($row = $fetchcategories2->fetch_assoc()) {
    ?>
    <div class="col-md-12 mb-5">
      <form action="shop.php" method="post">
        <input type="hidden" name="category" value="<?= $row['name'] ?>">
        <button type="submit" style="color: black; text-decoration: none; background: none; border: none; cursor: pointer;">
          <img src="<?php echo check_image("src/images/categories/{$row['icon']}"); ?>" class="img-fluid"
            alt="<?php echo $row['name']; ?>">
        </button>
      </form>
    </div>
    <?php
  }
} else {
  echo "No products found.";
}
?>