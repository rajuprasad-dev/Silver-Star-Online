<?php include "auth.php" ?>
<?php
session_start();

// Assuming you have a database connection established
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "silverstaronline";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}


// Check if the coupon form is submitted
if (isset($_POST['coupon_code'])) {
  $couponCode = $_POST['coupon_code'];
  if (isset($_SESSION['coupon_set'])) {
    echo '<script>alert("code already used.");</script>';
  } else {

    // Query to check if the coupon code exists
    $sqlCoupon = "SELECT * FROM coupons WHERE coupon = '$couponCode'";
    $resultCoupon = $conn->query($sqlCoupon);

    if ($resultCoupon->num_rows > 0) {
      // Coupon code exists, retrieve coupon details
      $couponDetails = $resultCoupon->fetch_assoc();

      // Check if the total cart amount is greater than or equal to the minimum value required for the coupon
      if ($_SESSION['totalCartAmount'] >= $couponDetails['min_value']) {
        // Apply the discount to the total cart amount
        $_SESSION['discount_amount'] = $couponDetails['discount'];
        $_SESSION['coupon_set'] = "set";
        echo '<script>alert("Coupon Code Added");</script>';
      } else {
        // Display an error message if the minimum value requirement is not met
        $_SESSION['discount_amount'] = 0;
        echo '<script>alert("Minimum value requirement not met for the coupon.");</script>';
      }
    } else {
      // Display an error message if the coupon code is not valid
      $_SESSION['discount_amount'] = 0;
      echo '<script>alert("Invalid coupon code.");</script>';
    }
  }

}

// Close the connection
$conn->close();
?>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "neocart";

if (isset($_SESSION['userId'])) {
  $userId = $_SESSION['userId'];
}
$conn = new mysqli($servername, $username, $password, $dbname);

$sqlcart = "SELECT p.* FROM cart c INNER JOIN products p ON c.product_id = p.id WHERE c.customer_id = $userId";
$resultcart = mysqli_query($conn, $sqlcart);
if ($resultcart && mysqli_num_rows($resultcart) > 0) {
  $cartProduct = mysqli_fetch_assoc($resultcart);
}
?>
<!DOCTYPE html>
<html>

<?php include "head.php" ?>

<body>
  <?php include "navbar.php"; ?>
  <div class="container-account">
    <div class="jumbotron text-center" style="background-color:#f6f4f2;">
      <h2 class="display-5" style="padding-top:120px">Shopping Cart</h2>
      <p class="lead">Shop</p>
    </div>
  </div>
  <?php
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "neocart";

  if (isset($_SESSION['userId'])) {
    $userId = $_SESSION['userId'];
  }
  $conn = new mysqli($servername, $username, $password, $dbname);
  $toalCartAmount = 0;
  $sqlcart = "SELECT p.*, c.quantity AS cart_quantity, p.quantity AS product_quantity, c.product_id AS cart_product_id, c.customer_id AS cart_customer_id
  FROM cart c
  INNER JOIN products p ON c.product_id = p.id
  WHERE c.customer_id = $userId";

  $cartresult = $conn->query($sqlcart);
  $sqlcart2 = "SELECT p.*, c.quantity AS cart_quantity, p.quantity AS product_quantity
  FROM cart c
  INNER JOIN products p ON c.product_id = p.id
  WHERE c.customer_id = $userId";
  $cartresult2 = $conn->query($sqlcart2);
  ?>
  <div class="container-fluid mt-5">
    <div class="row">
      <div class="col-sm-8 mb-5">
        <div class="table-responsive">
          <table class="table" style="border: none;">
            <thead>

              <!-- <form method="post" action="backend-of-frontend/add-to-cart-logic.php">
                <input type="hidden" name="product_id" value="<?= $row['id'] ?>">
                <button type="submit" class="btn-dinnis px-3 py-3" style="position:absolute;top:295px;">
                  <a style="color:inherit;text-decoration:none;" class="custom-link px-2 py-2">Add To Cart</a>
                </button>
              </form> -->
              <tr>
                <th style="border-top: none;padding-bottom:50px;"><span class="custom-link">Delete</span></th>
                <th style="border-top: none;padding-bottom:50px;"><span class="custom-link">Image</span></th>
                <th style="border-top: none;padding-bottom:50px;"><span class="custom-link">Name</span></th>
                <th style="border-top: none;padding-bottom:50px;"><span class="custom-link">Price</span></th>
                <th style="border-top: none;padding-bottom:50px;"><span class="custom-link">Quantity</span></th>
                <th style="border-top: none;padding-bottom:50px;"><span class="custom-link">Total</span></th>
              </tr>
            </thead>
            <tbody>
              <?php
              if ($cartresult->num_rows > 0) {
                while ($rowcart = $cartresult->fetch_assoc()) {

                  $toalCartAmount = $toalCartAmount + $rowcart["selling_price"] * $rowcart["cart_quantity"];
                  ?>
                  <tr>
                    <td style="border: none;padding-top:50px;padding-bottom:50px;">
                      <form method="post" action="backend-of-frontend/delete-to-cart-logic.php">
                        <input type="hidden" name="product_id" value="<?php echo $rowcart['cart_product_id']; ?>">
                        <button class="black-button" type="submit">
                          Delete
                        </button>
                      </form>
                    </td>
                    <td style="border: none;padding-top:50px;padding-bottom:50px;"><img src="images/hero.jpg"
                        style="width:75px;" alt="Product Image"></td>
                    <td style="border: none;padding-top:50px;padding-bottom:50px;"><b>
                        <?= $rowcart['name'] ?>
                      </b></td>
                    <td style="border: none;padding-top:50px;padding-bottom:50px;">
                      <?= $rowcart['selling_price'] ?>
                    </td>
                    <td style="border: none;padding-top:50px;padding-bottom:50px;">
                      <div class="input-group" style="width: 50%;">
                        <span class="input-group-btn">
                          <form id="incrementDecrementForm" action="backend-of-frontend/increment-decrement-logic.php"
                            method="post">
                            <input type="hidden" name="action" value="decrement">
                            <input type="hidden" name="product_id" value="<?= $rowcart['cart_product_id'] ?>">
                            <input type="hidden" name="customer_id" value="<?= $rowcart['cart_customer_id'] ?>">
                            <input type="hidden" name="decrement" value="decrement">
                            <button type="submit" class="btn btn-light border">-</button>
                          </form>
                        </span>
                        <input type="text" class="form-control text-center" id="currentValueInput" name="current_value"
                          value="<?php echo $rowcart['cart_quantity']; ?>" min="1" max="1">
                        <span class="input-group-btn">
                          <form id="incrementDecrementForm" action="backend-of-frontend/increment-decrement-logic.php"
                            method="post">
                            <input type="hidden" name="action" value="decrement">
                            <input type="hidden" name="product_id" value="<?= $rowcart['cart_product_id'] ?>">
                            <input type="hidden" name="customer_id" value="<?= $rowcart['cart_customer_id'] ?>">
                            <input type="hidden" name="increment" value="increment">
                            <button type="submit" class="btn btn-light border">+</button>
                          </form>
                        </span>
                      </div>
                    </td>
                    <td style="border: none;padding-top:50px;padding-bottom:50px;">399 Rs</td>
                  </tr>
                  <?php
                }
              }

              // Close the database connection
              $conn->close();
              ?>
              <!-- <tr style="padding-top:50px;padding-bottom:50px;">
                <td style="border: none;padding-top:50px;padding-bottom:50px;"><img src="images/hero.jpg"
                    style="width:75px;" alt="Product Image"></td>
                <td style="border: none;padding-top:50px;padding-bottom:50px;"><b>Product 1</b></td>
                <td style="border: none;padding-top:50px;padding-bottom:50px;">399 Rs</td>
                <td style="border: none;padding-top:50px;padding-bottom:50px;">
                  <div class="input-group" style="width: 50%;">
                    <span class="input-group-btn">
                      <button type="button" class="btn btn-light border" data-action="decrement">-</button>
                    </span>
                    <input type="text" class="form-control text-center" value="1" min="1" max="100">
                    <span class="input-group-btn">
                      <button type="button" class="btn btn-light border" data-action="increment">+</button>
                    </span>
                  </div>
                </td>
                <td style="border: none;padding-top:40px;padding-bottom:40px;">399 Rs</td>
              </tr> -->
            </tbody>
          </table>

        </div>
      </div>


      <div class="col-sm-4">
        <!-- <h1 class="my-5">Total In Cart</h1> -->

        <div class="card px-2 py-2" style="border:1px solid black;border-style:dashed;background-color:#F5F7F8;">

          <div class="card-body px-2 py-2 text-center">
            <h4>Shipping </h4>
            <hr class="hr hr-blurry" />
            <?php
            if ($cartresult2->num_rows > 0) {
              while ($rowcart2 = $cartresult2->fetch_assoc()) {
                ?>
                <div class="card-body row justify-content-around px-2 py-2">
                  <div>
                    <?php echo $rowcart2['name']; ?>
                  </div>
                  <div>
                    <?php echo $rowcart2['selling_price']; ?> X
                    <?php echo $rowcart2['cart_quantity']; ?>
                  </div>
                </div>
              <?php } ?>
            <?php } ?>

            <!-- <div class="card-body row justify-content-around">
              <div>Product 2</div>
              <div>399 Rs </div>
            </div> -->
            <hr class="hr hr-blurry" />
            <div class="card-body row justify-content-around">
              <div>Total </div>
              <div>
                <?php
                // Calculate the discounted total
                if (isset($_SESSION['discount_amount'])) {
                  $discountedTotal = $toalCartAmount - $_SESSION['discount_amount'];
                  $_SESSION['totalCartAmount'] = $discountedTotal;
                  echo $discountedTotal;
                } else {
                  $_SESSION['totalCartAmount'] = $toalCartAmount;
                  echo $toalCartAmount;
                }
                ?>
              </div>
            </div>
            <div class="text-center">
              <a class="color:inherit;" href="checkout.php">
                <button class="black-button">Checkout</button>
              </a>
            </div>
          </div>
        </div>


      </div>
    </div>
    <div class="row">
      <div class="col-sm-8 mb-5 row">

        <form method="post" action="cart.php">

          <div class="form-group mr-2">
            <input type="text" class="form-control border-dark rounded-0" style="padding: 21px 25px;"
              placeholder="enter your coupon code" name="coupon_code">
          </div>

          <div class="form-group">
            <button type="submit" class="black-button">coupon code</button>
          </div>

        </form>
        <div>
        </div>
      </div>
    </div>
  </div>





  <?php include "footer.php" ?>
  <script>
    document.getElementById( "incrementDecrementForm" ).addEventListener( "submit", function ( event ) {
      // Get the current value from the hidden input field
      var currentValue = parseInt( document.getElementById( "currentValueInput" ).value );

      // Check if the current value is 0
      if ( currentValue === 0 ) {
        // Prevent the form submission
        event.preventDefault();
        alert( "Value is already 0. Decrement not allowed." );
      }
    } );
  </script>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>