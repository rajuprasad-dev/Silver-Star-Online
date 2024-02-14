<?php
include_once "conn.php";

// SQL query to fetch the latest beauty products
$sql = "SELECT p.*, c.name AS category_name, sc.name AS subcategory_name, pi.image
        FROM products p
        INNER JOIN categories c ON p.category = c.id
        LEFT JOIN subcategories sc ON p.subcategory = sc.id
        LEFT JOIN product_images pi ON p.id = pi.product_id
        WHERE c.name = 'New Collection' LIMIT 5 OFFSET 5";



$result = $conn->query($sql);

// Check if there are results
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        ?>
        <div class="col-12 col-sm-6 col-md-4 col-lg-2">
            <a href="detailed-product.php?product_id=<?= $row['id']; ?>" style="text-decoration: none; color: inherit;">
                <div class="card ">
                    <img src="<?= check_image("src/images/categories/thumbnails/" . $row['image']); ?>" alt="Card 1 Image"
                        style="height:200px;">
                    <!-- If you want to add an "Add To Cart" button, you can uncomment the following lines -->
                    <!-- <button type="button" class="btn-dinnis px-3 py-3" style="position:absolute;top:295px;">
                <a style="color:inherit;text-decoration:none;" class="custom-link px-2 py-2">Add To Cart</a>
            </button> -->
                    <div class="card-body text-center">
                        <h5 class="card-text2-dinnis mt-4"><b>
                                <?= $row['name']; ?>
                            </b></h5>
                        <p class="card-text2-dinnis">
                            <?= $row['category_name']; ?>
                        </p>
                        <p class="card-text2-dinnis mt-3">
                            Rs
                            <?= $row['selling_price']; ?>
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