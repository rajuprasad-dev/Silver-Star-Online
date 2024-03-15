<?php
include_once "conn.php";

// SQL query to fetch the latest beauty products
$sqlfetchcategories1 = "SELECT * FROM categories";

$fetchcategories1 = $conn->query($sqlfetchcategories1);

// Check if there are fetchcategories2s
if ($fetchcategories1->num_rows > 0) {
  while ($row = $fetchcategories1->fetch_assoc()) {
    ?>
    <div class="col-lg-3 col-md-4 col-6 mb-5">
      <form action="shop" method="post" class="categories-card">
        <input type="hidden" name="category" value="<?= $row['name']; ?>">
        <button type="submit" style="color: black; text-decoration: none; background: none; border: none; cursor: pointer;">
          <img src="<?php echo check_image("src/images/categories/{$row['icon']}"); ?>" class="img-fluid"
            alt="<?php echo $row['name']; ?>">
          <h4 class="mt-3">
            <?= $row['name'] ?>
          </h4>
        </button>
      </form>
    </div>
    <?php
  }
} else {
  echo "No products found.";
}
?>