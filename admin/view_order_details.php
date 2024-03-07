<?php
$page = "Order Details";
include("header.php");

$db = new database();
$db->connect();

$id = base64_decode($db->clean($_GET['id']));

$sql = "SELECT `orders`.*, `customers`.`name` as `c_name`, `customers`.`phone` as `c_phone` FROM `orders` JOIN `customers` ON `orders`.`customer_id` = `customers`.`id` WHERE `orders`.`id` = '$id' ORDER BY `orders`.`id` DESC";

if ($db->sql($sql)) {
    $numrows = $db->numrows();
    if ($numrows == 0) {
        echo "<script>window.location.href='manage_orders';</script>";
        exit();
    }

    $result = $db->result()[0];
    // $billing_details = json_decode($result['address'], true);
} else {
    echo "Server Error !";
    exit();
}
?>

<div class="container-fluid my-5 order_details_container_main">
    <!-- Data -->
    <div class="d-flex mt-4 justify-content-between flex-wrap flex-md-nowrap align-items-center py-4">
        <div class="d-block mb-4 mb-md-0">
            <h2 class="h4">
                <?php echo $result['c_name']; ?>
            </h2>
            <p class="mb-0">
                <?php echo $result['booking_address']; ?>
            </p>
        </div>
        <p class="btn mb-0 btn-success text-left px-4 btn-sm" onclick="window.history.go(-1);"><i
                class="fas fa-arrow-left mr-2"></i>Go Back</p>
    </div>
    <div class="card card-body border-light shadow-sm table-wrapper table-responsive py-4">
        <table class="table table-hover table-bordered table-responsive">
            <tbody>
                <tr>
                    <th>#ID</th>
                    <td>ORDR
                        <?php echo 9999 + $result['id']; ?>
                    </td>
                </tr>
                <tr>
                    <th>Booking ID</th>
                    <td>#
                        <?php echo $result['order_id']; ?>
                    </td>
                </tr>
                <tr>
                    <th>Order Date</th>
                    <td>
                        <?php echo date("d M Y h:i:s a", strtotime($result['date_time'])); ?>
                    </td>
                </tr>
                <tr>
                    <th>Name</th>
                    <td>
                        <?php echo $result['c_name']; ?>
                    </td>
                </tr>
                <tr>
                    <th>Phone No</th>
                    <td>
                        <?php echo $result['c_phone']; ?>
                    </td>
                </tr>
                <tr>
                    <th>Products</th>
                    <td>
                        <?php
                        if (!empty($result['products'])) {
                            $products_data = json_decode($result['products'], true);

                            $products_array = array();

                            if (!empty($products_data)) {
                                if (is_array($products_data)) {
                                    foreach ($products_data as $p => $product) {
                                        array_push($products_array, "'{$product}'");
                                    }
                                } else {
                                    array_push($products_array, "'{$products_data}'");
                                }

                                $products = implode(', ', $products_array);

                                $prod_sql = "SELECT * FROM `products` WHERE `id` IN ($products)";

                                $produ_res = array();
                                if ($db->sql($prod_sql)) {
                                    $produ_num = $db->numrows();

                                    if ($produ_num > 0) {
                                        $produ_res = $db->result();

                                        foreach ($produ_res as $pk => $prod) {
                                            echo '<p class="mb-0"><a target="blank" href="../product_details?data=' . base64_encode($prod['name']) . '&id=' . base64_encode($prod['id']) . '">' . $prod['name'] . '</a><span class="ml-2 text-success">(1 ' . $prod['quantity_unit'] . ')</span><span class="ml-2 text-tertiary">(x' . $products_data[$pk]['quantity'] . ')</span><span class="ml-2 text-info"> -> ₹' . ($prod['selling_price'] * $products_data[$pk]['quantity']) . '</span></p>';
                                        }
                                    }
                                }
                            }
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <th>Delivery Address</th>
                    <td>
                        <?php echo $result['booking_address']; ?>
                    </td>
                </tr>
                <tr>
                    <th>Amount</th>
                    <td>₹
                        <?php echo $result['cart_amount']; ?>
                    </td>
                </tr>
                <tr>
                    <th>Discount</th>
                    <td>
                        <?php echo "₹" . $result['cart_amount'] - $result['discount_amt']; ?>
                    </td>
                </tr>
                <tr>
                    <th>Delivery Charges</th>
                    <td>
                        <?php echo "₹" . $result['delivery_charges'] == 0 ? "Free" : $result['delivery_charges']; ?>
                    </td>
                </tr>
                <tr>
                    <th>Coupon Used</th>
                    <td>
                        <?php echo !empty($result['coupon_code']) ? $result['coupon_code'] : "No Coupon Code Used"; ?>
                    </td>
                </tr>
                <tr>
                    <th>Coupon Discount</th>
                    <td>₹
                        <?php echo !empty($result['coupon_discount']) ? $result['coupon_discount'] : 0; ?>
                    </td>
                </tr>
                <tr>
                    <th>Final Amount</th>
                    <td>₹
                        <?php echo $result['final_amount']; ?>
                    </td>
                </tr>
                <tr>
                    <th>Payment Mode</th>
                    <td>
                        <?php echo $result['payment_method'] == "COD" ? "Cash On Delivery" : "Online"; ?>
                    </td>
                </tr>
                <tr>
                    <th>Payment ID</th>
                    <td>
                        <?php echo !empty($result['payment_id']) ? $result['payment_id'] : "Not Applicable"; ?>
                    </td>
                </tr>
                <tr>
                    <th>Order Status</th>
                    <td class="font-weight-bold">
                        <?php echo $result['order_status']; ?>
                    </td>
                </tr>
                <tr>
                    <th>Action</th>
                    <td>
                        <div class="btns_action d-flex">
                            <div class="input-group mr-3 w-75 btn_group_div_main">
                                <select class="form-select order_status_dropdown">
                                    <?php
                                    $order_status = array('Pending', 'Placed', 'Packed', 'Shipped', 'Out For Delivery', 'Delivered', 'Cancelled');
                                    foreach ($order_status as $key => $status) {
                                        ?>
                                        <option value='<?php echo $status; ?>' <?php echo $status == $result['order_status'] ? 'selected' : ''; ?>>
                                            <?php echo $status; ?>
                                        </option>
                                        <?php
                                    }
                                    ?>
                                </select>
                                <button data-id="<?php echo base64_encode($result['id']); ?>"
                                    class="btn btn-primary submit_btn" type="button"
                                    id="update_order_status">Update</button>
                            </div>
                            <button class="generate_invoice print_btn btn btn-primary w-25">Print Invoice</button>
                        </div>

                        <?php
                        if ($result['order_status'] == "Out") {
                            $check_del = "SELECT * FROM deliveries WHERE order_id = '$id'";

                            if ($db->sql($check_del)) {
                                $deliv_res = $db->result();
                                $deliv_num = $db->numrows();

                                if ($deliv_num == 0) {
                                    ?>
                                    <div class="assign_delivery_boy_module_div mt-3">
                                        <label>Assign Captain</label>
                                        <div class="input-group btn_group_div_main">
                                            <span title="Enter Delivery Amount For Captain" type="number" class="form-control"
                                                id="delivery_amount_main" contenteditable="true">
                                                <?php echo $result['delivery_charges']; ?>
                                            </span>
                                            <select class="form-select delivery_captain_dropdown">
                                                <option value="" selected disabled>Select Captain</option>
                                                <?php
                                                $del_sql = "SELECT * FROM captain";
                                                if ($db->sql($del_sql)) {
                                                    $del_res = $db->result();
                                                    $del_num = $db->numrows();

                                                    if ($del_num > 0) {
                                                        foreach ($del_res as $d => $captain) {
                                                            ?>
                                                            <option value="<?php echo base64_encode($captain['id']); ?>">
                                                                <?php echo $captain['name']; ?>
                                                            </option>
                                                            <?php
                                                        }
                                                    }
                                                }
                                                ?>
                                            </select>
                                            <button data-customer="<?php echo base64_encode($result['customer_id']); ?>"
                                                data-id="<?php echo base64_encode($result['id']); ?>"
                                                class="btn btn-info submit_btn px-4" type="button"
                                                id="assign_captain_main_btn">Assign</button>
                                        </div>
                                    </div>
                                    <?php
                                } else {
                                    $cap_id = $deliv_res[0]['captain_id'];
                                    $delcap_sql = "SELECT * FROM captain WHERE `id` = '$cap_id'";
                                    if ($db->sql($delcap_sql)) {
                                        $delcap_res = $db->result();
                                        $delcap_num = $db->numrows();

                                        if ($delcap_num > 0) {
                                            echo '<p class="mb-0 mt-3 w-100 alert-success py-1 px-2 rounded">Order Assigned to <strong>' . $delcap_res[0]['name'] . '</strong></p>';
                                        }
                                    }
                                }
                            }
                        }
                        ?>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<?php
include("invoice.php");
include("footer.php");
?>