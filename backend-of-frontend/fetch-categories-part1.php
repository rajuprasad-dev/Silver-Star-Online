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
$sqlfetchcategories1 = "SELECT * FROM categories WHERE id % 2 = 0";

$fetchcategories1 = $conn->query($sqlfetchcategories1);

// Check if there are fetchcategories2s
if ($fetchcategories1->num_rows > 0) {
  while ($row = $fetchcategories1->fetch_assoc()) {
    ?>
    <div class="col-md-12 mb-5">
      <form action="shop.php" method="post">
        <input type="hidden" name="category" value="<?= $row['name'] ?>">
        <button type="submit" style="color: black; text-decoration: none; background: none; border: none; cursor: pointer;">
          <img src="../src/images/categories/<?php echo $row['icon']; ?>" class="img-fluid"
            alt="<?php echo $row['name']; ?>">
        </button>
      </form>
    </div>
    <?php
  }
} else {
  echo "No products found.";
}

// Close the database connection
$conn->close();
?>