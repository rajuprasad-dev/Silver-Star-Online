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
$sql = "SELECT p.*, c.name AS category_name, sc.name AS subcategory_name, pi.image
        FROM products p
        INNER JOIN categories c ON p.category = c.id
        LEFT JOIN subcategories sc ON p.subcategory = sc.id
        LEFT JOIN product_images pi ON p.id = pi.product_id
        WHERE c.name = 'Latest Beauty'
        LIMIT 0, 4";

$result = $conn->query($sql);

// Check if there are results
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        ?>
        <div class="col-12 col-sm-6 col-md-4 col-lg-3 ">
            <a href="detailed-product.php?product_id=<?= $row['id'] ?>">
                <?php
                $product_id = $row['id'];
                $queryimage = "SELECT image FROM product_images WHERE product_id = $product_id LIMIT 2";
                $resultimage = $conn->query($queryimage);
                if ($resultimage) {
                    // Initialize an array to store the images
                    $images = array();

                    // Fetch the images and store them in the array
                    while ($rowimage = $resultimage->fetch_assoc()) {
                        $images[] = $rowimage['image'];

                    }
                    if (isset($images['1']) && $images['1'] !== "") {
                        $images["1"] = $images["0"];
                    }
                }


                ?>
                <div class="card" onmouseover="changeImage(this, '<?= $images['1'] ?>')"
                    onmouseout="restoreImage(this, '<?= $images['0'] ?>')">
                    <div class="card" style="position: relative; overflow: hidden;">
                        <img src="<?= $row['image'] ?>" alt="<?= $row['name'] ?>"
                            style="height: 350px; width: 100%; object-fit: cover;">
                    </div>
                    <div class="card-body text-left">
                        <form method="post" action="backend-of-frontend/add-to-cart-logic.php">
                            <input type="hidden" name="product_id" value="<?= $row['id'] ?>">
                            <button type="submit" class="btn-dinnis px-3 py-3" style="position:absolute;top:295px;">
                                <a style="color:inherit;text-decoration:none;" class="custom-link px-2 py-2">Add To Cart</a>
                            </button>
                        </form>
                        <h5 class="card-text2-dinnis mt-4"><b class="custom-link">
                                <?= $row['name'] ?>
                            </b></h5>
                        <p class="card-text2-dinnis">
                            <span class="custom-link">
                                <?= $row['category_name'] . ', ' . $row['subcategory_name'] ?>
                            </span>
                        </p>
                        <p class="card-text2-dinnis mt-3">
                            <span class="custom-link">Rs
                                <?= $row['selling_price'] ?>
                            </span>
                        </p>
                    </div>
                </div>
            </a>

        </div>
        <?php
    }
} else {
    echo "No products found.";
}

// Close the database connection
$conn->close();
?>