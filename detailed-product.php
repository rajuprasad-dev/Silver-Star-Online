<?php
session_start();
include_once "backend-of-frontend/conn.php";

$user_id = $_SESSION['userId'] ?? 0;
?>
<!DOCTYPE html>
<html>

<?php include "head.php" ?>
<style>
    .image-container {
        position: relative;
        width: 400px;
        /* Adjust the width and height as needed */
        height: 400px;
        border: 1px solid #dfdfdf !important;
        border-radius: 10px;
        overflow: hidden;
    }

    #zoom-image {
        width: 100%;
        height: 100%;
        transition: transform 0.3s;
        object-fit: contain;
        /* Smooth transition for zoom effect */
        transform-origin: top left;
        /* Set the transform origin to the top left corner */
    }
</style>

<body>
    <?php include "navbar.php"; ?>
    <div class="container-account">
        <div class="jumbotron text-center" style="background-color:#f6f4f2;">
            <h2 class="display-5" style="padding-top:120px">Detailed Product</h2>
            <p class="lead">Shop</p>
        </div>
    </div>
    <?php
    if (isset($_GET['product_id'])) {
        $produtId = $_GET['product_id'];
        // You can now use $myVariable in this page.
    }

    $sql = "SELECT * FROM `products` WHERE id = '$produtId'";
    $result = mysqli_query($conn, $sql);
    if ($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
    }

    $cart_sql = "SELECT * FROM `cart` WHERE `product_id` = '$produtId' AND `customer_id` = '$user_id' ORDER BY id DESC LIMIT 1";
    $cart_result = mysqli_query($conn, $cart_sql);
    $cart_data = [];
    if ($cart_result && mysqli_num_rows($cart_result) > 0) {
        $cart_data = mysqli_fetch_assoc($cart_result);
    }
    ?>
    <?php if (isset($user)): ?>

        <div class="container">
            <div class="row">
                <div class="col-md-2 col-3">
                    <div class="col col-12">
                        <?php
                        $sql2 = "SELECT image FROM `product_images` WHERE product_id = $produtId";
                        $result2 = mysqli_query($conn, $sql2);
                        if (mysqli_num_rows($result2) > 0) {
                            while ($row2 = mysqli_fetch_assoc($result2)) {
                                if (empty($firstImage)) {
                                    $firstImage = check_image('src/images/products/thumbnails/' . $row2['image']);
                                    ;
                                }
                                ?>
                                <img src="<?php echo check_image('src/images/products/thumbnails/' . $row2['image']); ?>"
                                    alt="Image" class="img-fluid mb-2 square-image" onclick="replaceImage(this)"
                                    style="cursor: pointer;">
                                <?php
                            }
                        }
                        ?>
                        <!-- <img src="images/second-slider-inner-image-1-2.jpg" alt="Image" class="img-fluid mb-2 square-image"
                            onclick="replaceImage(this)">
                        <img src="images/second-slider-inner-image2.jpg" alt="Image" class="img-fluid mb-2 square-image"
                            onclick="replaceImage(this)">
                        <img src="images/second-slider-inner-image22.jpg" alt="Image" class="img-fluid mb-2 square-image"
                            onclick="replaceImage(this)"> -->
                    </div>
                </div>
                <div class="col-md-4 col-9 d-flex align-items-start">
                    <div class="image-container" onmousemove="zoomImage(event)">
                        <img src="<?php echo $firstImage; ?>" alt="Image" class="img-fluid" id="zoom-image">
                    </div>
                </div>
                <div class="col-md-6 col-12 d-flex mt-md-0 mt-4 flex-column justify-content-start">
                    <div class="mb-3">
                        <h3>
                            <?= $user['name'] ?>
                        </h3>
                        <?php
                        if (!empty($user['selling_price'])) {
                            echo '<h5 class="card-text-dinnis-h2 mt-2">Price : ₹ ' . $user['selling_price'] . '</h5>';
                        }
                        ?>
                        <?php
                        if (!empty($user['size'])) {
                            echo '<h5 class="card-text-dinnis-h2 mt-2">Size : ' . $user['size'] . '</h5>';
                        }
                        ?>
                        <?php
                        if (!empty($user['description'])) {
                            echo '<h5 class="card-text-dinnis-h2 mt-2">Description : </h5>
                                <div class="card-text-dinnis">
                                        ' . $user['description'] . '
                                </div>';
                        }
                        ?>
                    </div>
                    <form id="addToCartForm" method="post" action="backend-of-frontend/add-to-cart-logic-for-detailed-page">
                        <div class="mb-4">
                            <h5>Quantity</h5>
                            <div class="mt-2">
                                <div class="input-group" style="max-width: 200px;">
                                    <span class="input-group-btn">
                                        <button type="button" class="btn btn-light border" id="decrementBtn">-</button>
                                    </span>
                                    <input type="text" class="form-control text-center" name="quantity" id="quantityInput"
                                        value="<?= !empty($cart_data) ? $cart_data['quantity'] : "1"; ?>" min="1" max="100">
                                    <span class="input-group-btn">
                                        <button type="button" class="btn btn-light border" id="incrementBtn">+</button>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <input type="hidden" name="product_id" value="<?= $user['id'] ?>">
                            <!-- <input type="hidden" name="quantity" id="quantityHiddenInput"
                                value="<?php //echo !empty($cart_data) ? $cart_data['quantity'] : "1";                                                ?>"> -->
                            <input type="submit" class="black-button text-white" style="color:inherit;text-decoration:none;"
                                value="<?= !empty($cart_data) ? "Update Cart" : "Add To Cart"; ?>" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="container mt-5">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" style="color: inherit;font-size: 20px;" id="reviews-tab" data-toggle="tab"
                        href="#reviews" role="tab" aria-controls="reviews" aria-selected="true">Description</a>
                </li>
                <?php
                if (!empty($user['size'])) {
                    ?>
                    <li class="nav-item">
                        <a class="nav-link" style="color: inherit;font-size: 20px;" id="size-tab" data-toggle="tab" href="#size"
                            role="tab" aria-controls="size" aria-selected="false">Size</a>
                    </li>
                    <?php
                }
                if (!empty($user['shipping_and_return'])) {
                    ?>
                    <li class="nav-item">
                        <a class="nav-link" style="color: inherit;font-size: 20px;" id="shipping-returns-tab" data-toggle="tab"
                            href="#shipping-returns" role="tab" aria-controls="shipping-returns" aria-selected="false">Shipping
                            and Returns</a>
                    </li>
                    <?php
                }
                if (!empty($user['additional_information'])) {
                    ?>
                    <li class="nav-item">
                        <a class="nav-link" style="color: inherit;font-size: 20px;" id="more-products-tab" data-toggle="tab"
                            href="#more-products" role="tab" aria-controls="more-products" aria-selected="false">Additional
                            Information</a>
                    </li>
                    <?php
                }
                ?>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active border-bottom border-left border-right px-5 py-5" id="reviews"
                    role="tabpanel" aria-labelledby="reviews-tab">
                    <!-- Reviews content goes here -->
                    <h3>What the product has to say</h3>
                    <p class="card-text-dinnis">
                        <?= $user['description']; ?>
                    </p>
                </div>
                <?php
                if (!empty($user['size'])) {
                    ?>
                    <div class="tab-pane fade border-bottom border-left border-right px-5 py-5" id="size" role="tabpanel"
                        aria-labelledby="size-tab">
                        <!-- Size information goes here -->
                        <p class="card-text-dinnis">
                            <?= $user['size']; ?>
                        </p>
                    </div>
                    <?php
                }
                if (!empty($user['shipping_and_return'])) {
                    ?>
                    <div class="tab-pane fade border-bottom border-left border-right px-5 py-5" id="shipping-returns"
                        role="tabpanel" aria-labelledby="shipping-returns-tab">
                        <!-- Shipping and Returns information goes here -->
                        <h3>Our Policies</h3>
                        <p class="card-text-dinnis">
                            <?= $user['shipping_and_return']; ?>
                        </p>
                    </div>
                    <?php
                }
                if (!empty($user['additional_information'])) {
                    ?>
                    <div class="tab-pane fade border-bottom border-left border-right px-5 py-5" id="more-products"
                        role="tabpanel" aria-labelledby="more-products-tab">
                        <!-- More Products content goes here -->

                        <p class="card-text-dinnis">
                            <?= $user['additional_information']; ?>
                        </p>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>

    <?php endif; ?>

    <div class="mx-lg-5 my-lg-5 mx-4 my-4 text-center">
        <h1 class="mx-5 my-5">Latest Beauty</h1>
        <div class="row text-center">
            <?php include "backend-of-frontend/fetch-latest-beauty.php" ?>
        </div>
    </div>

    <?php include "footer.php" ?>
    <script>
        function zoomImage ( event ) {
            const container = document.querySelector( '.image-container' );
            const image = document.querySelector( '#zoom-image' );
            const containerRect = container.getBoundingClientRect();

            // Calculate the mouse position relative to the container
            const x = ( event.clientX - containerRect.left ) / containerRect.width;
            const y = ( event.clientY - containerRect.top ) / containerRect.height;

            // Apply zoom effect with the mouse position as the transform origin
            image.style.transformOrigin = `${ x * 100 }% ${ y * 100 }%`;
            image.style.transform = 'scale(1.5)'; // Adjust the scale factor as needed
        }

        // Reset the zoom when the mouse leaves the container
        document.querySelector( '.image-container' ).onmouseleave = function () {
            const image = document.querySelector( '#zoom-image' );
            image.style.transform = 'scale(1)';
        };

        function replaceImage ( clickedImage ) {
            // Get the source of the clicked image
            var newImageSrc = clickedImage.src;

            // Get the image in the col-md-4 section
            var zoomImage = document.getElementById( "zoom-image" );

            // Replace the src of the col-md-4 image with the clicked image's src
            zoomImage.src = newImageSrc;
        }
    </script>
    <script>
        document.addEventListener( 'DOMContentLoaded', function () {
            var quantityInput = document.getElementById( 'quantityInput' );
            // var quantityHiddenInput = document.getElementById( 'quantityHiddenInput' );
            var decrementButton = document.getElementById( 'decrementBtn' );
            var incrementButton = document.getElementById( 'incrementBtn' );

            decrementButton.addEventListener( 'click', function () {
                var currentValue = parseInt( quantityInput.value, 10 );
                if ( currentValue > 1 ) {
                    quantityInput.value = currentValue - 1;
                    // quantityHiddenInput.value = currentValue - 1;
                }
            } );

            incrementButton.addEventListener( 'click', function () {
                var currentValue = parseInt( quantityInput.value, 10 );
                quantityInput.value = currentValue + 1;
                // quantityHiddenInput.value = currentValue + 1;
            } );
        } );
    </script>


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <?php include_once "show-alert.php"; ?>
</body>

</html>