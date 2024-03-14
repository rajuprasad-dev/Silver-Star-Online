<?php
include "auth.php";
include_once "./backend-of-frontend/conn.php";

// print_r($_SESSION);
// die;
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
    $totalCartAmount = 0;
    $sqlcart2 = "SELECT p.*, c.quantity AS cart_quantity, p.quantity AS product_quantity FROM cart c INNER JOIN products p ON c.product_id = p.id WHERE c.customer_id = $userId";
    $cartresult2 = $conn->query($sqlcart2);

    $subtotal_amt = $_SESSION['subtotalCartAmount'] ?? 0;
    $sgst = ($subtotal_amt / 100) * 1.5;
    $cgst = ($subtotal_amt / 100) * 1.5;
    $igst = ($subtotal_amt / 100) * 3;
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
                                <label for="firstName">First Name<span class="ml-1 text-danger">*</span></label>
                                <input type="text" class="form-control underline-input" id="firstName" name="firstName"
                                    placeholder="First Name" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="lastName">Last Name<span class="ml-1 text-danger">*</span></label>
                                <input type="text" class="form-control underline-input" id="lastName" name="lastName"
                                    placeholder="Last Name" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="country">Country<span class="ml-1 text-danger">*</span></label>
                                <input type="text" class="form-control underline-input" id="country" name="country"
                                    placeholder="Country" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="state">State<span class="ml-1 text-danger">*</span></label>
                                <select class="form-control underline-input" id="state" name="state"
                                    onchange="checkState(this);" required>
                                    <option value="" selected disabled>Select State</option>
                                    <?php
                                    foreach ($indian_states as $key => $state_name) {
                                        echo "<option value='{$state_name}'>{$state_name}</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email">Email<span class="ml-1 text-danger">*</span></label>
                            <input type="email" class="form-control underline-input" id="email" name="email"
                                placeholder="Email" required>
                        </div>
                        <div class="form-group">
                            <label for="city">City<span class="ml-1 text-danger">*</span></label>
                            <input type="text" class="form-control underline-input" id="city" name="city"
                                placeholder="City" required>
                        </div>
                        <div class="form-group">
                            <label for="address">Address<span class="ml-1 text-danger">*</span></label>
                            <input type="text" class="form-control underline-input" id="address" name="address"
                                placeholder="Address" required>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="pincode">Pincode<span class="ml-1 text-danger">*</span></label>
                                <input type="text" class="form-control underline-input" id="pincode" name="pincode"
                                    placeholder="Pincode" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="phone">Phone<span class="ml-1 text-danger">*</span></label>
                                <input type="text" class="form-control underline-input" id="phone" name="phone"
                                    placeholder="Phone" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="gstNumber">GST Number</label>
                            <input type="text" class="form-control underline-input" id="gstNumber" name="gstNumber"
                                placeholder="GST Number" onchange="checkGST(this);" onkeyup="checkGST(this);">
                            <div id="gst-error"></div>
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
                        <input type="hidden" name="cgst" value="<?php echo $cgst; ?>">
                        <input type="hidden" name="sgst" value="<?php echo $sgst; ?>">
                        <input type="hidden" name="igst" value="<?php echo $igst; ?>">
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
                        <div class="card-body px-2 py-2 row justify-content-between">
                            <div>Discount</div>
                            <div>
                                <?php
                                echo "- ₹" . $_SESSION['cart_discount'];
                                ?>
                            </div>
                        </div>

                        <?php
                        // Calculate the discounted total
                        if (isset($_SESSION['discount_amount'])) {
                            ?>
                            <hr class="hr hr-blurry" />
                            <div class="card-body px-2 py-2 row justify-content-between">
                                <div>Coupon Discount </div>
                                <div>
                                    <?php
                                    // Calculate the discounted total
                                    echo "- ₹" . $_SESSION['discount_amount'];
                                    ?>
                                </div>
                            </div>
                        <?php } ?>

                        <hr class="hr hr-blurry" />
                        <div class="card-body px-2 py-2 row justify-content-between">
                            <div>Subtotal</div>
                            <div>
                                <?php
                                $new_subtotal = round($subtotal_amt - ($sgst + $cgst), 2);
                                $_SESSION['new_subtotalCartAmount'] = $new_subtotal;
                                echo "₹" . $new_subtotal;
                                ?>
                            </div>
                        </div>

                        <hr class="hr hr-blurry" />
                        <div id="gst-calculation">
                            <div id="cgst" class="card-body px-2 py-2 row justify-content-between">
                                <div>CGST</div>
                                <div>
                                    <?php
                                    echo "₹" . round($cgst, 2);
                                    ?>
                                </div>
                            </div>
                            <div id="sgst" class="card-body px-2 py-2 row justify-content-between">
                                <div>SGST</div>
                                <div>
                                    <?php
                                    echo "₹" . round($sgst, 2);
                                    ?>
                                </div>
                            </div>
                            <div id="igst" class="d-none card-body px-2 py-2 row justify-content-between">
                                <div>IGST</div>
                                <div>
                                    <?php
                                    echo "₹" . round($igst, 2);
                                    ?>
                                </div>
                            </div>
                        </div>

                        <hr class="hr hr-blurry" />
                        <div class="card-body px-2 py-2 row justify-content-between">
                            <div>Total </div>
                            <div>
                                <?php
                                // Calculate the discounted total
                                echo "₹" . $_SESSION['totalCartAmount'];
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include "footer.php" ?>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script type="text/javascript">
        const gstNumber = "<?php echo $gst_number; ?>";

        function checkIGSTApplicability ( userGSTNumber ) {
            // Regular expression to match GSTIN format
            const gstRegex = /^[0-9]{2}[A-Z]{5}[0-9]{4}[A-Z]{1}[1-9A-Z]{1}[Z]{1}[0-9A-Z]{1}$/;
            const userState = document.getElementById( "state" ).value;

            if ( gstRegex.test( userGSTNumber ) ) {
                // Extract state code from user's GST number (first two digits)
                const userStateCode = userGSTNumber.substr( 0, 2 );
                // Extract state code from your GST number (first two digits)
                const yourStateCode = gstNumber.substr( 0, 2 );

                // Check if the user's state code matches yours
                if ( userStateCode === yourStateCode ) {
                    if ( userState !== "" ) {
                        if ( userState === "Maharashtra" ) {
                            return "IGST is not applicable.";
                        } else {
                            return "IGST is applicable because provided GST number is not registered in the state of provided delivery address state";
                        }
                    } else {
                        return "IGST is not applicable.";
                    }
                } else {
                    return "IGST is applicable.";
                }
            } else {
                return "Invalid GST Number.";
            }
        }

        function switchGST ( isIGST ) {
            const cgst = <?php echo $cgst; ?>;
            const sgst = <?php echo $sgst; ?>;
            const igst = <?php echo $igst; ?>;

            switch ( isIGST ) {
                case "Invalid GST Number.":
                    document.getElementById( "gst-error" ).innerHTML =
                        `<span class="alert alert-danger d-block mt-3">Invalid GST number, please enter a valid GST number</span>`;
                    break;

                case "IGST is applicable because provided GST number is not registered in the state of provided delivery address state":
                    document.getElementById( "gst-error" ).innerHTML =
                        `<span class="alert alert-danger d-block mt-3">Invalid GST number, please enter a valid GST number</span>`;
                    document.getElementById( "cgst" ).classList?.remove( "d-none" );
                    document.getElementById( "sgst" ).classList?.remove( "d-none" );
                    document.getElementById( "igst" ).classList?.add( "d-none" );

                    document.getElementsByName( "cgst" )[ 0 ].value = cgst;
                    document.getElementsByName( "sgst" )[ 0 ].value = sgst;
                    document.getElementsByName( "igst" )[ 0 ].value = "";
                    break;

                case "IGST is not applicable.":
                    document.getElementById( "cgst" ).classList?.remove( "d-none" );
                    document.getElementById( "sgst" ).classList?.remove( "d-none" );
                    document.getElementById( "igst" ).classList?.add( "d-none" );

                    document.getElementsByName( "cgst" )[ 0 ].value = cgst;
                    document.getElementsByName( "sgst" )[ 0 ].value = sgst;
                    document.getElementsByName( "igst" )[ 0 ].value = "";

                    document.getElementById( "gst-error" ).innerHTML = "";
                    break;

                case "IGST is applicable.":
                    document.getElementById( "cgst" ).classList?.add( "d-none" );
                    document.getElementById( "sgst" ).classList?.add( "d-none" );
                    document.getElementById( "igst" ).classList?.remove( "d-none" );

                    document.getElementsByName( "cgst" )[ 0 ].value = "";
                    document.getElementsByName( "sgst" )[ 0 ].value = "";
                    document.getElementsByName( "igst" )[ 0 ].value = igst;

                    document.getElementById( "gst-error" ).innerHTML = "";
                    break;

                default:
                    document.getElementById( "gst-error" ).innerHTML = "";

                    document.getElementsByName( "cgst" )[ 0 ].value = cgst;
                    document.getElementsByName( "sgst" )[ 0 ].value = sgst;
                    document.getElementsByName( "igst" )[ 0 ].value = "";
                    break;
            }
        }

        function checkGST ( e ) {
            const userGSTNumber = e.value.trim();
            const isIGST = checkIGSTApplicability( userGSTNumber );

            switchGST( isIGST );
        }

        function checkState ( e ) {
            const userState = e.value.trim();
            const isIGST = userState === "Maharashtra" ? "IGST is not applicable." : "IGST is applicable.";

            switchGST( isIGST );
        }
    </script>
</body>

</html>