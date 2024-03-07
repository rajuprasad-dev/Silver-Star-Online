<?php
$page = "Manage Orders";
include("header.php");

$db = new database();
$db->connect();

$sql = "SELECT `orders`.*, `customers`.`name` as `c_name`, `customers`.`phone` as `c_phone` FROM `orders` JOIN `customers` ON `orders`.`customer_id` = `customers`.`id` ORDER BY `orders`.`id` DESC";

if ($db->sql($sql)) {
    $numrows = $db->numrows();
    $result = $db->result();
} else {
    echo "Server Error !";
}
?>

<div class="container-fluid my-5">
    <!-- Data -->
    <div class="d-flex mt-4 justify-content-between flex-wrap flex-md-nowrap align-items-center py-4">
        <div class="d-block mb-4 mb-md-0">
            <h2 class="h4">Latest Orders</h2>
            <p class="mb-0">All Your Latest Orders Will Appear Here.</p>
        </div>
    </div>
    <div class="card card-body border-light shadow-sm table-wrapper table-responsive py-4">
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
                if ($numrows > 0) {
                    foreach ($result as $data) {
                        // $billing_details = json_decode($data['booking_address'], true);
                        ?>
                        <tr class="<?php if ($data['order_status'] == "Shipped") {
                        // echo 'bg-warning';
                    } elseif ($data['order_status'] == "Delivered") {
                        // echo 'bg-tertiary text-white';
                    } elseif ($data['order_status'] == "Cancelled") {
                        // echo 'bg-danger text-white';
                    } elseif ($data['order_status'] == "Shipped") {
                        // echo 'bg-info text-white';
                    } ?>">
                            <td>
                                <a href="javascript:void(0);" class="font-weight-bold">
                                    <?php echo "ORDR" . (9999 + $data['id']); ?>
                                </a>
                            </td>
                            <td>
                                <span>
                                    <?php echo date("d M Y h:i:s a", strtotime($data['date_time'])); ?>
                                </span>
                            </td>
                            <td>
                                <span>
                                    <?php echo !empty($data['c_name']) ? $data['c_name'] : 'null'; ?>
                                </span>
                            </td>
                            <td>
                                <span>
                                    <?php echo !empty($data['c_phone']) ? $data['c_phone'] : 'null'; ?>
                                </span>
                            </td>
                            <td>
                                <span>
                                    <select name="update_status" id="update_order_status_select"
                                        data-id="<?php echo base64_encode($data['id']); ?>">
                                        <?php
                                        $order_status = array('Pending', 'Placed', 'Packed', 'Shipped', 'Out For Delivery', 'Delivered', 'Cancelled');
                                        foreach ($order_status as $key => $status) {
                                            ?>
                                            <option value='<?php echo $status; ?>' <?php echo $status == $data['order_status'] ? 'selected' : ''; ?>>
                                                <?php echo $status; ?>
                                            </option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </span>
                            </td>
                            <td>
                                <div class="btn-group">
                                    <button class="btn btn-link text-dark dropdown-toggle dropdown-toggle-split m-0 p-0"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <span class="icon icon-sm">
                                            <span class="fas fa-ellipsis-h <?php if (($data['order_status'] == "Delivered") || ($data['order_status'] == "Cancelled") || ($data['order_status'] == "Shipped")) {
                                            // echo 'text-white';
                                        } ?>"></span>
                                        </span>
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item text-dark view_order"
                                            order-id="<?php echo base64_encode($data['id']); ?>"
                                            href="view_order_details?data=<?php echo base64_encode($data['c_name']); ?>&id=<?php echo base64_encode($data['id']); ?>"><span
                                                class="far fa-eye mr-2"></span>View</a>
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