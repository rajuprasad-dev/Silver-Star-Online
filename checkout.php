<?php
include "auth.php";
include_once "./backend-of-frontend/conn.php";
?>
<!DOCTYPE html>
<html>

<?php include "head.php" ?>

<body>
    <style>
    .underline-input {
        border-top: none;
        border-left: none;
        border-right: none;
        border-bottom: 1.5px solid black;
        border-radius: 0px;
        ;
    }
    </style>
    <?php
	$toalCartAmount = 0;
	$sqlcart2 = "SELECT p.*, c.quantity AS cart_quantity, p.quantity AS product_quantity
  FROM cart c
  INNER JOIN products p ON c.product_id = p.id
  WHERE c.customer_id = $userId";
	$cartresult2 = $conn->query($sqlcart2);
	?>
    <?php include "navbar.php"; ?>
    <div class="container-account">
        <div class="jumbotron text-center" style="background-color:#f6f4f2;">
            <h2 class="display-5" style="padding-top:120px">Shopping Cart</h2>
            <p class="lead">Shop</p>
        </div>
    </div>


    <div class="container">
        <hr class="hr hr-blurry" />
    </div>

    <div class="container mt-5">
        <div class="row">
            <div class="col-sm-7 mb-5">
                <form method="post" action="backend-of-frontend/checkout-logic">
                    <div class="container">
                        <h1 class="mb-5">Billing Details</h1>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="firstName">First Name</label>
                                <input type="text" class="form-control underline-input" id="firstName" name="firstName"
                                    placeholder="First Name">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="lastName">Last Name</label>
                                <input type="text" class="form-control underline-input" id="lastName" name="lastName"
                                    placeholder="Last Name">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="country">Country</label>
                                <input type="text" class="form-control underline-input" id="country" name="country"
                                    placeholder="Country">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="state">State</label>
                                <input type="text" class="form-control underline-input" id="state" name="state"
                                    placeholder="State">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control underline-input" id="email" name="email"
                                placeholder="Email">
                        </div>
                        <div class="form-group">
                            <label for="city">City</label>
                            <input type="text" class="form-control underline-input" id="city" name="city"
                                placeholder="City">
                        </div>
                        <div class="form-group">
                            <label for="address">Address</label>
                            <input type="text" class="form-control underline-input" id="address" name="address"
                                placeholder="Address">
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="pincode">Pincode</label>
                                <input type="text" class="form-control underline-input" id="pincode" name="pincode"
                                    placeholder="Pincode">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="phone">Phone</label>
                                <input type="text" class="form-control underline-input" id="phone" name="phone"
                                    placeholder="Phone">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="companyName">Company Name</label>
                            <input type="text" class="form-control underline-input" id="companyName" name="companyName"
                                placeholder="Company Name">
                        </div>
                        <div class="form-group">
                            <label for="orderNote">Order Note</label>
                            <textarea class="form-control underline-input" id="orderNote" name="orderNote" rows="4"
                                placeholder="Enter your order note here"></textarea>
                        </div>
                        <div class="form-group mt-5">
                            <label for="differentAddress">Send It To Different Address</label>
                            <textarea class="form-control" id="differentAddress" name="differentAddress" rows="4"
                                style="border: 1.5px solid black" placeholder="Enter your order note here"></textarea>
                        </div>
                        <button type="submit" class="black-button mt-2">Checkout</button>
                    </div>
                </form>

            </div>
            <div class="col-sm-5">
                <!-- <h1 class="my-5">Total In Cart</h1> -->

                <div class="card px-2 py-2"
                    style="border:1px solid black;border-style:dashed;background-color:#F5F7F8;">

                    <div class="card-body px-2 py-2 text-center">
                        <h4>Shipping </h4>
                        <hr class="hr hr-blurry" />
                        <?php
						if ($cartresult2->num_rows > 0) {
							while ($rowcart2 = $cartresult2->fetch_assoc()) {
								$toalCartAmount = $toalCartAmount + $rowcart2["selling_price"] * $rowcart2["cart_quantity"];
								?>
                        <div class="card-body row justify-content-between px-2 py-2">
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

                        <hr class="hr hr-blurry" />
                        <div class="card-body row justify-content-between px-2 py-2">
                            <div>Total </div>
                            <div>
                                <?php echo $toalCartAmount; ?>
                            </div>
                        </div>
                        <!-- <div class="text-center">
			  <a class="color:inherit;" href="checkout">
				<button class="black-button">Checkout</button>
			  </a>
			</div> -->
                    </div>
                </div>


            </div>
        </div>
    </div>





    <?php include "footer.php" ?>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>