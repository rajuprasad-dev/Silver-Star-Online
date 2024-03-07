<?php
include "auth.php";
include_once "./backend-of-frontend/conn.php";
?>
<!DOCTYPE html>
<html>

<?php include "head.php" ?>

<body>
    <style>
        .custom-card {
            /* border: 1px solid #000; */
            /* Black border */
            /* border-radius: 10px; */
            background-color: #F5F7F8;
            /* Rounded corners */
        }



        /* Styling for h1 to h6 tags */
        h1 {
            font-size: 36px;
            /* font-family: Arial, sans-serif; */
            /* Other styles for h1 tags */
        }

        h2 {
            font-size: 32px;
            /* font-family: Arial, sans-serif; */
            /* Other styles for h2 tags */
        }

        h3 {
            font-size: 28px;
            /* font-family: Arial, sans-serif; */
            /* Other styles for h3 tags */
        }

        h4 {
            font-size: 24px;
            /* font-family: Arial, sans-serif; */
            /* Other styles for h4 tags */
        }

        h5 {
            font-size: 20px;
            /* font-family: Arial, sans-serif; */
            /* Other styles for h5 tags */
        }

        h6 {
            font-size: 18px;
            /* font-family: Arial, sans-serif; */
            /* Other styles for h6 tags */
        }

        /* Styling for p tags */
        p {
            font-size: 14px;
            /* font-family: Helvetica, sans-serif; */
            /* Other styles for p tags */
        }
    </style>

    <?php include "navbar.php"; ?>
    <div class="container-account">
        <div class="jumbotron text-center" style="background-color:#f6f4f2;">
            <h2 class="display-5">
                <?php echo $_SESSION['name']; ?>
            </h2>
            <p class="lead">Manage Account</p>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <!-- Side Navigation without borders or background color -->
            <div class="col-md-3 px-5 py-5 text-center text-md-left border-right">
                <!-- <h3>Categories</h3> -->
                <ul class="list-group">
                    <li class="list-group-item accounts-tab-main active"
                        style="border: 0px; cursor: pointer;font-size:14px;" onclick="showContent(this, 'orders')">
                        Orders</li>
                    <!-- <li class="list-group-item accounts-tab-main" style="border: 0px; cursor: pointer;"
                        onclick="showContent(this, 'downloads')">Downloads</li> -->
                    <li class="list-group-item accounts-tab-main" style="border: 0px; cursor: pointer;font-size:14px;"
                        onclick="showContent(this, 'address')">
                        Address</li>
                    <li class="list-group-item accounts-tab-main" style="border: 0px; cursor: pointer;font-size:14px;"
                        onclick="showContent(this, 'accountDetails')">Account Details</li>
                    <!-- <li class="list-group-item accounts-tab-main" style="border: 0px; cursor: pointer;font-size:14px;"
                        onclick="showContent(this, 'orderDetails')">Order Detail</li> -->
                    <li class="list-group-item accounts-tab-main" style="border: 0px; cursor: pointer;font-size:14px;">
                        <a href="backend-of-frontend/logout-session.php">Logout</a>
                    </li>
                </ul>
            </div>
            <?php
            $sqlorder = "SELECT * FROM `orders` WHERE `customer_id` = '$userId' ORDER BY `id` DESC";

            $resultorder = $conn->query($sqlorder);

            // echo $sqlorder;
            // print_r($resultorder);
            ?>
            <!-- Container on the right side -->

            <div class="col-md-9">
                <div class="mx-lg-5 my-5 text-center" id="ordersContent" style="display: block;">
                    <h1 class="mx-lg-5 my-5">Orders</h1>
                    <div class="table table-responsive">
                        <table class="text-center table" style="border: none;">
                            <thead>
                                <tr>
                                    <th style="border-top: none;padding-bottom:50px;font-size:14px"><span
                                            class="custom-link">Order
                                            Id</span></th>
                                    <th style="border-top: none;padding-bottom:50px;font-size:14px"><span
                                            class="custom-link">Date</span></th>
                                    <th style="border-top: none;padding-bottom:50px;font-size:14px"><span
                                            class="custom-link">Status</span></th>
                                    <th style="border-top: none;padding-bottom:50px;font-size:14px"><span
                                            class="custom-link">Total</span></th>
                                    <th style="border-top: none;padding-bottom:50px;font-size:14px"><span
                                            class="custom-link">Action</span></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($resultorder->num_rows > 0) {
                                    while ($userOrders = $resultorder->fetch_assoc()) {
                                        ?>
                                        <tr>
                                            <td style="border: none;padding-top:50px;padding-bottom:50px;font-size:14px;">#
                                                <?= $userOrders['id'] ?>
                                            </td>
                                            <td style="border: none;padding-top:50px;padding-bottom:50px;font-size:14px;">
                                                <b>
                                                    <?= $userOrders['date_time'] ?>
                                                </b>
                                            </td>
                                            <td style="border: none;padding-top:50px;padding-bottom:50px;font-size:14px;">
                                                <?= $userOrders['order_status'] ?>
                                            </td>
                                            <td style="border: none;padding-top:50px;padding-bottom:50px;font-size:14px;">
                                                <?= $userOrders['final_amount'] ?>
                                            </td>
                                            <td style="border: none;padding-top:50px;padding-bottom:50px;font-size:14px;">
                                                <form method="POST" action="account-order-detail">
                                                    <input type="hidden" name="order_id" value="<?= $userOrders['id'] ?>">
                                                    <!-- Replace '123' with the actual order ID -->
                                                    <button class="black-button" type="submit"
                                                        onclick="showContent(this, 'orderDetails')">View</button>
                                                </form>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                } else {
                                    echo '<tr>
                                            <td style="border: none;padding-top:50px;padding-bottom:50px;font-size:14px;" colspan="5">
                                            No Orders Available
                                            </td>
                                        </tr>';
                                }
                                ?>
                                <!-- <tr style="padding-top:50px;padding-bottom:50px;font-size:14px;">
                                    <td style="border: none;padding-top:50px;padding-bottom:50px;font-size:14px;">#247
                                    </td>
                                    <td style="border: none;padding-top:50px;padding-bottom:50px;font-size:14px;">
                                        <b>March 8, 2024</b>
                                    </td>
                                    <td style="border: none;padding-top:50px;padding-bottom:50px;font-size:14px;">
                                        Checked</td>
                                    <td style="border: none;padding-top:50px;padding-bottom:50px;font-size:14px;">welome
                                    </td>
                                    <td style="border: none;padding-top:40px;padding-bottom:40px;"><button
                                            class="black-button">View</button></td>

                                </tr> -->
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="mx-lg-5 mx-3 text-center" id="downloadsContent" style="display: none;">
                    <h1 class="mx-lg-5 mx-3 my-lg-5 my-4">downloads</h1>
                    <div class="row text-center">
                        <div class="col-12 col-sm-6 col-md-4 col-lg-3 ">
                            <div class="card" onmouseover="changeImage(this, 'images/earings.jpg')"
                                onmouseout="restoreImage(this, 'images/earings2.jpg')">
                                <img src="images/earings2.jpg" alt="Card 2 Image" style="height:200px;">
                                <div class="card-body text-left">
                                    <button type="button" class="btn-dinnis px-3 py-3"
                                        style="position:absolute;top:155px;"><a
                                            style="color:inherit;text-decoration:none;"
                                            class="custom-link px-2 py-2">Add To Cart</a></button>
                                    <h5 class="card-text2-dinnis mt-4"><b class="custom-link">Card 1</b></h5>
                                    <p class="card-text2-dinnis"><span class="custom-link">Clothing, Women</span></p>
                                    <p class="card-text2-dinnis mt-3"><span class="custom-link">250 rs<span></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-4 col-lg-3 ">
                            <div class="card" onmouseover="changeImage(this, 'images/earings2.jpg')"
                                onmouseout="restoreImage(this, 'images/earings.jpg')">
                                <img src="images/earings.jpg" alt="Card 2 Image" style="height:200px;">
                                <div class="card-body text-left">
                                    <button type="button" class="btn-dinnis px-3 py-3"
                                        style="position:absolute;top:155px;"><a
                                            style="color:inherit;text-decoration:none;"
                                            class="custom-link px-2 py-2">Add To Cart</a></button>
                                    <h5 class="card-text2-dinnis mt-4"><b class="custom-link">Card 1</b></h5>
                                    <p class="card-text2-dinnis"><span class="custom-link">Clothing, Women</span></p>
                                    <p class="card-text2-dinnis mt-3"><span class="custom-link">250 rs</span></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-4 col-lg-3 ">
                            <div class="card" onmouseover="changeImage(this, 'images/earings.jpg')"
                                onmouseout="restoreImage(this, 'images/earings2.jpg')">
                                <img src="images/earings2.jpg" alt="Card 2 Image" style="height:200px;">
                                <div class="card-body text-left">
                                    <button type="button" class="btn-dinnis px-3 py-3"
                                        style="position:absolute;top:155px;"><a
                                            style="color:inherit;text-decoration:none;"
                                            class="custom-link px-2 py-2">Add To Cart</a></button>
                                    <h5 class="card-text2-dinnis mt-4"><b class="custom-link">Card 1</b></h5>
                                    <p class="card-text2-dinnis"><span class="custom-link">Clothing, Women</span></p>
                                    <p class="card-text2-dinnis mt-3"><span class="custom-link">250 rs</span></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-4 col-lg-3 ">
                            <div class="card" onmouseover="changeImage(this, 'images/earings2.jpg')"
                                onmouseout="restoreImage(this, 'images/earings.jpg')">
                                <img src="images/earings.jpg" alt="Card 2 Image" style="height:200px;">
                                <div class="card-body text-left">
                                    <button type="button" class="btn-dinnis px-3 py-3"
                                        style="position:absolute;top:155px;"><a
                                            style="color:inherit;text-decoration:none;"
                                            class="custom-link px-2 py-2">Add To Cart</a></button>
                                    <h5 class="card-text2-dinnis mt-4"><b class="custom-link">Card 1</b></h5>
                                    <p class="card-text2-dinnis"><span class="custom-link">Clothing, Women</span></p>
                                    <p class="card-text2-dinnis mt-3"><span class="custom-link">250 rs</span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                $sqluserDetails = "SELECT * FROM `customers` WHERE id = $userId";
                $resultuserDetails = mysqli_query($conn, $sqluserDetails);
                if ($resultuserDetails && mysqli_num_rows($resultuserDetails) > 0) {
                    $userDetails = mysqli_fetch_assoc($resultuserDetails);
                }
                ?>
                <?php
                if (isset($userDetails)) {
                    ?>
                    <div class="mx-lg-5 mx-3 my-5 text-center">
                        <div class="row text-left" id="accountDetailsContent" style="display: none;">
                            <div class="container">
                                <h1 class="my-5">User Account Details</h1>
                                <form>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="firstName" style="font-size:14px;">Full Name</label>
                                                <input readonly type="text" class="form-control underline-input"
                                                    id="firstName" value="<?= $userDetails['name'] ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="email" style="font-size:14px;">Email</label>
                                                <input readonly type="email" class="form-control underline-input" id="email"
                                                    value="<?= $userDetails['email'] ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="username" style="font-size:14px;">Username</label>
                                                <input readonly type="text" class="form-control underline-input"
                                                    id="username" value="<?= $userDetails['name'] ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="birthdate" style="font-size:14px;">Phone</label>
                                                <input readonly type="tel" class="form-control underline-input"
                                                    id="birthdate" value="<?= $userDetails['phone'] ?>">
                                            </div>
                                        </div>
                                        <!-- <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="phoneNumber" style="font-size:14px;">Phone Number</label>
                                                <input type="tel" class="form-control underline-input" id="phoneNumber"
                                                    value="<?php // echo $userDetails['phone'];                      ?>">
                                            </div>
                                        </div> -->
                                    </div>
                                    <!-- <button type="button" class="black-button" id="editButton"
                                        style="font-size:14px;">Edit</button> -->
                                </form>
                            </div>

                        </div>
                    </div>
                    <?php
                }
                ?>
                <?php
                $sqluserAddress = "SELECT * FROM `customers` WHERE id = $userId";
                $resultuserAddress = mysqli_query($conn, $sqluserAddress);
                if ($resultuserAddress && mysqli_num_rows($resultuserAddress) > 0) {
                    $userAddress = mysqli_fetch_assoc($resultuserAddress);
                }
                ?>
                <?php
                if (isset($userAddress)) {
                    ?>
                    <div class="mx-lg-5 mx-3 my-5 text-left" id="addressContent" style="display: none;">
                        <div class="container my-5">
                            <div class="row">
                                <div class="col-md-6 mt-4">
                                    <div class="card custom-card px-4 py-4">
                                        <div class="card-body">
                                            <h5 class="card-title"><b>Address</b></h5>
                                            <p>Name:
                                                <?= $userDetails['name'] ?>
                                            </p>
                                            <p>Address:
                                                <?= $userDetails['address'] ?>
                                            </p>
                                            <p>City:
                                                <?= $userDetails['city'] ?>
                                            </p>
                                            <p>State:
                                                <?= $userDetails['state'] ?>
                                            </p>
                                            <p>Zip Code:
                                                <?= $userDetails['pincode'] ?>
                                            </p>
                                            <p>Country: India</p>
                                            <p>Email:
                                                <?= $userDetails['email'] ?>
                                            </p>
                                            <p>Phone:
                                                <?= $userDetails['phone'] ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Shipping Address Card -->
                                <!-- <div class="col-md-6 mt-4">
                                <div class="card custom-card px-4 py-4">
                                    <div class="card-body">
                                        <h5 class="card-title"><b>Shipping Address</b></h5>
                                        <p>Name:
                                            <?php // echo $userDetails['name']     ?>
                                        </p>
                                        <p>Address:
                                            <?php // echo $userDetails['address']     ?>
                                        </p>
                                        <p>City:
                                            <?php // echo $userDetails['city']     ?>
                                        </p>
                                        <p>State:
                                            <?php // echo $userDetails['state']     ?>
                                        </p>
                                        <p>Zip Code:
                                            <?php // echo $userDetails['pincode']     ?>
                                        </p>
                                        <p>Country: India</p>
                                        <p>Email:
                                            <?php // echo $userDetails['email']     ?>
                                        </p>
                                        <p>Phone:
                                            <?php // echo $userDetails['phone']     ?>
                                        </p>
                                    </div>
                                </div>
                            </div> -->
                            </div>
                        </div>
                    </div>
                    <?php
                }
                ?>
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
    <script>
        function showContent ( elem, contentId ) {
            // Hide all content sections
            const contentSections = document.querySelectorAll( '[id$="Content"]' );
            contentSections.forEach( function ( section ) {
                section.style.display = 'none';
            } );

            // add active tab class 
            const accountsTabs = document.querySelectorAll( '.accounts-tab-main' );
            accountsTabs.forEach( function ( tabs ) {
                tabs.classList.remove( "active" );
            } );

            // console.log( elem );

            elem.classList.add( "active" );

            // Show the selected content section
            const selectedContent = document.getElementById( contentId + 'Content' );
            if ( selectedContent ) {
                selectedContent.style.display = 'block';
            }
        }
    </script>
</body>

</html>