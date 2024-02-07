<?php
session_start();
include_once "backend-of-frontend/conn.php";
?>
<!DOCTYPE html>
<html>

<?php include "head.php" ?>

<body>
    <?php include "navbar.php"; ?>
    <div class="container-account">
        <div class="jumbotron text-center" style="background-color:#f6f4f2;">
            <h2 class="display-5" style="padding-top:120px">Products</h2>
            <p class="lead">Shop</p>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <!-- Side Navigation without borders or background color -->
            <div class="col-md-3 px-5 py-5 text-center text-md-left">
                <h2>Categories</h2>
                <form action="shop.php" method="post" class="my-5">
                    <ul class="list-group">
                        <?php
                        // Select categories and subcategories
                        $query = "SELECT `id` as `category_id`, `name` as `category_name`, `icon` as `category_icon` FROM `categories`";

                        $result = $conn->query($query);

                        if ($result->num_rows > 0) {
                            $categories = [];

                            // Organize the data into an associative array with categories as keys
                            while ($row = $result->fetch_assoc()) {
                                $categoryId = $row["category_id"];
                                if (!isset($categories[$categoryId])) {
                                    $categories[$categoryId] = [
                                        "name" => $row["category_name"],
                                        "icon" => $row["category_icon"],
                                    ];
                                }
                            }

                            // Display the categories and subcategories in a dropdown
                            foreach ($categories as $categoryId => $category) {
                                $category_name = str_replace([' ', "\n", "\r", "\t"], '_', $category["name"]);
                                $post_category = str_replace([' ', "\n", "\r", "\t"], '_', ($_POST['category'] ?? ""));
                                $activeClass = $post_category == $category_name ? " border-primary border-top-1 rounded" : " border-0";
                                // echo $activeClass;
                        
                                echo '<li class="list-group-item custom-list mb-2' . $activeClass . '">';
                                echo '<button type="submit" name="category" value="' . $category["name"] . '" style="background: none; border: none; cursor: pointer;">';
                                echo "<img src='" . check_image("src/images/categories/thumbnails/" . $category["icon"]) . "' height='40' width='40' style='object-fit: cover; border-radius: 10px; margin-right: 10px;' />";
                                echo $category["name"];
                                echo '</button>';

                                // // Display subcategories as options in a nested list
                                // if (!empty($category["subcategories"])) {
                                //     echo '<ul style="list-style-type:none;">';
                                //     foreach ($category["subcategories"] as $subcategory) {
                                //         echo '<li>';
                                //         echo '<button type="submit" name="subcategory" value="' . $subcategory["name"] . '" style="background: none; border: none; cursor: pointer;">';
                                //         echo $subcategory["name"];
                                //         echo '</button>';
                                //         echo '</li>';
                                //     }
                                //     echo '</ul>';
                                // }
                        
                                echo '</li>';
                            }
                        }
                        ?>

                    </ul>
                </form>
                <!-- <h3>Gender</h3>
                <ul class="list-group">
                    <div class="radio-group">
                        <li class="list-group-item" style="border: 0px;">
                            <label>
                                <input type="radio" name="gender" value="Men"> Men
                            </label>
                        </li>
                        <li class="list-group-item" style="border: 0px;">
                            <label>
                                <input type="radio" name="gender" value="Women"> Women
                            </label>
                        </li>
                </ul>
                <h3>Price range</h3>
                <ul class="list-group">
                    <li class="list-group-item underline-input">
                        <input type="number" id="minPrice" name="minPrice" placeholder="Enter minimum price">
                    </li>
                    <li class="list-group-item underline-input">
                        <input type="number" id="maxPrice" name="maxPrice" placeholder="Enter maximum price">
                    </li>
                </ul> -->
            </div>

            <!-- Container on the right side -->
            <div class="col-md-9">
                <div class="mx-5 my-5">
                    <h2 class="my-5">
                        <?php if (isset($_POST['category'])) {
                            echo $_POST['category'];
                        } ?>
                    </h2>
                    <div class="row text-center">
                        <?php
                        if (isset($_POST['category'])) {
                            $category = $_POST['category'];
                            // SQL query to fetch the latest beauty products
                            $sql = "SELECT p.*, c.name AS `category_name`, pi.image FROM products p INNER JOIN categories c ON p.category = c.id LEFT JOIN product_images pi ON p.id = pi.product_id WHERE c.name = '$category'";

                            $result = $conn->query($sql);
                        } else {
                            $sql = "SELECT p.*, c.name AS `category_name`, pi.image FROM products p INNER JOIN categories c ON p.category = c.id LEFT JOIN product_images pi ON p.id = pi.product_id WHERE c.name = 'Latest Beauty'";

                            $result = $conn->query($sql);
                        }

                        // Check if there are results
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                ?>
                                <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
                                    <a href="detailed-product.php?product_id=<?= $row['id'] ?>">
                                        <div class="card"
                                            onmouseover="changeImage(this, '<?= check_image('src/images/products/thumbnails/' . $row['image']); ?>')"
                                            onmouseout="restoreImage(this, '<?= check_image('src/images/products/thumbnails/' . $row['image']); ?>')">
                                            <div class="card" style="position: relative; overflow: hidden;">
                                                <img src="<?= check_image("src/images/products/thumbnails/" . $row['image']); ?>"
                                                    alt="<?= $row['name'] ?>"
                                                    style="height: 350px; width: 100%; object-fit: cover;">
                                            </div>
                                            <div class="card-body text-left">
                                                <form method="post" action="backend-of-frontend/add-to-cart-logic.php">
                                                    <input type="hidden" name="product_id" value="<?= $row['id'] ?>">
                                                    <button type="submit" class="btn-dinnis px-3 py-3"
                                                        style="position:absolute;top:295px;">
                                                        <a style="color:inherit;text-decoration:none;"
                                                            class="custom-link px-2 py-2">Add To Cart</a>
                                                    </button>
                                                </form>
                                                <h5 class="card-text2-dinnis mt-4"><b class="custom-link">
                                                        <?= $row['name'] ?>
                                                    </b></h5>
                                                <p class="card-text2-dinnis">
                                                    <span class="custom-link">
                                                        <?= $row['category_name']; ?>
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
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include "footer.php" ?>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        function changeImage ( card, newImageSrc ) {
            const image = card.querySelector( 'img' );
            image.src = newImageSrc;
        }

        function restoreImage ( card, originalImageSrc ) {
            const image = card.querySelector( 'img' );
            image.src = originalImageSrc;
        }
    </script>

    <?php include_once "show-alert.php"; ?>
</body>

</html>