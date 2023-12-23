<?php
$page="Dashboard";
include("header.php");

$db = new database();
$db->connect();
?>

<div class="container-fluid my-5">
    <div class="alert bg-white alert-dismissible fade show custom_welcome_message" role="alert">
        <h4 class="m-0 text-capitalize">
            <strong>Welcome <?php echo $login_username; ?> ! </strong> &nbsp; Manage Your Site Here.
        </h4>
        <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close"><i class="fas fa-times"></i></button>
    </div>
    <div class="row mt-4 text-center">
        <div class="col-lg-3 col-md-4 col-sm-6 col-12 my-2">
            <?php
            $sql = "SELECT * FROM `products` ORDER BY id DESC";

            if($db->sql($sql))
            {
                $products_numrows = $db->numrows();
            }
            else
            {
                echo "Server Error !";
            }
            ?>
            <div class="main_header_div_card">
                <i class="fas fa-shopping-basket"></i>
                <h4>Total Products<br><span class="card_count"><?php echo $products_numrows; ?></span></h4>
                <a href="products" class="stretched_link"></a>
            </div>
        </div>
        
        <div class="col-lg-3 col-md-4 col-sm-6 col-12 my-2">
            <?php
            $sql = "SELECT * FROM `orders` WHERE DATE(date_time) = CURDATE() ORDER BY id DESC";

            if($db->sql($sql))
            {
                $todays_orders_numrows = $db->numrows();
            }
            else
            {
                echo "Server Error !";
            }
            ?>
            <div class="main_header_div_card">
                <i class="fas fa-cash-register"></i>
                <h4>Today's Orders<br><span class="card_count"><?php echo $todays_orders_numrows; ?></span></h4>
                <a href="orders" class="stretched_link"></a>
            </div>
        </div>
        
        <div class="col-lg-3 col-md-4 col-sm-6 col-12 my-2">
            <?php
            $sql = "SELECT * FROM `orders` ORDER BY id DESC";

            if($db->sql($sql))
            {
                $orders_numrows = $db->numrows();
            }
            else
            {
                echo "Server Error !";
            }
            ?>
            <div class="main_header_div_card">
                <i class="fas fa-receipt"></i>
                <h4>Total Orders<br><span class="card_count"><?php echo $orders_numrows; ?></span></h4>
                <a href="orders" class="stretched_link"></a>
            </div>
        </div>
        
        <div class="col-lg-3 col-md-4 col-sm-6 col-12 my-2">
            <?php
            $sql = "SELECT * FROM customers ORDER BY id DESC";

            if($db->sql($sql))
            {
                $user_numrows = $db->numrows();
            }
            else
            {
                echo "Server Error !";
            }
            ?>
            <div class="main_header_div_card">
                <i class="fas fa-users"></i>
                <h4>Total Customers<br><span class="card_count"><?php echo $user_numrows; ?></span></h4>
                <a href="manage_customers" class="stretched_link"></a>
            </div>
        </div>

    </div>

    <!-- Enquiry -->
    <div class="d-flex mt-4 justify-content-between flex-wrap flex-md-nowrap align-items-center py-4">
        <div class="d-block mb-4 mb-md-0">
            <h2 class="h4">Latest Orders</h2>
            <p class="mb-0">Latest Orders From Will be Shown Here.</p>
        </div>
    </div>
    <div class="card card-body border-light shadow-sm table-wrapper table-responsive py-4">
        <?php
        $db = new database();
        $db->connect();

        $sql = "SELECT * FROM orders WHERE `order_status` = 'Placed' ORDER BY id DESC";

        if($db->sql($sql))
        {
            $numrows = $db->numrows();
            $result = $db->result();
        }
        else
        {
            echo "Server Error !";
        }
        ?>
        <table class="table table-hover table-responsive" id="details_table">
            <thead>
                <tr>
                    <th>#ID</th>
                    <th>Date</th>
                    <th>Name</th>
                    <th>Phone No</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if($numrows > 0)
                {
                    foreach($result as $data)
                    {
                        $billing_details = json_decode($data['booking_address'], true);
                ?>
                <tr class="<?php if($data['order_status'] == "Shipped"){ echo 'bg-warning'; }elseif($data['order_status'] == "Delivered"){ echo 'bg-tertiary text-white'; }elseif($data['order_status'] == "Cancelled"){ echo 'bg-danger text-white'; }elseif($data['order_status'] == "Shipped"){ echo 'bg-info text-white'; } ?>">
                    <td>
                        <a href="javascript:void(0);" class="font-weight-bold">ORDR<?php echo 9999 + $data['id']; ?></a>
                    </td>
                    <td>
                        <span class="wrap_text_data"><?php echo date("d M Y h:i:s a", strtotime($data['date_time'])); ?></span>
                    </td>
                    <td>
                        <span class="wrap_text_data"><?php echo $billing_details['name']; ?></span>
                    </td>
                    <td>
                        <span class="wrap_text_data"><?php echo $billing_details['phone']; ?></span>
                    </td>
                    <td>
                        <span class="wrap_text_data"><?php echo $data['order_status']; ?></span>
                    </td>
                    <td>
                        <div class="btn-group">
                            <button class="btn btn-link text-dark dropdown-toggle dropdown-toggle-split m-0 p-0" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="icon icon-sm">
                            <span class="fas fa-ellipsis-h <?php if(($data['order_status'] == "Delivered") || ($data['order_status'] == "Cancelled") || ($data['order_status'] == "Shipped")){ echo 'text-white'; } ?>"></span>
                            </span>
                            <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item text-dark view_order" order-id="<?php echo base64_encode($data['id']); ?>" href="view_order_details?data=<?php echo base64_encode($billing_details['name']); ?>&id=<?php echo base64_encode($data['id']); ?>"><span class="far fa-eye mr-2"></span>View</a>
                            </div>
                        </div>
                    </td>
                </tr>
                <?php
                    }
                }
                ?>
            </tbody>
            <tfoot>
                <tr>
                    <th>#ID</th>
                    <th>Date</th>
                    <th>Name</th>
                    <th>Phone No</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>

<?php
include("footer.php");
?>