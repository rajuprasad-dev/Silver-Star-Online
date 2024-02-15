<?php
$page = "Manage Orders";
include("header.php");

$db = new database();
$db->connect();

$sql = "SELECT * FROM orders ORDER BY id DESC";

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
                        $billing_details = json_decode($data['address'], true);
                        ?>
                        <tr
                            class="<?php if ($data['order_status'] == "Shipped") {
                                echo 'bg-warning';
                            } elseif ($data['order_status'] == "Delivered") {
                                echo 'bg-tertiary text-white';
                            } elseif ($data['order_status'] == "Cancelled") {
                                echo 'bg-danger text-white';
                            } elseif ($data['order_status'] == "Shipped") {
                                echo 'bg-info text-white';
                            } ?>">
                            <td>
                                <a href="javascript:void(0);" class="font-weight-bold">ORDR
                                    <?php echo 9999 + $data['id']; ?>
                                </a>
                            </td>
                            <td>
                                <span class="wrap_text_data">
                                    <?php echo date("d M Y h:i:s a", strtotime($data['date_time'])); ?>
                                </span>
                            </td>
                            <td>
                                <span class="wrap_text_data">
                                    <?php echo !empty($billing_details['name']) ? $billing_details['name'] : 'null'; ?>
                                </span>
                            </td>
                            <td>
                                <span class="wrap_text_data">
                                    <?php echo !empty($billing_details['phone']) ? $billing_details['phone'] : 'null'; ?>
                                </span>
                            </td>
                            <td>
                                <span class="wrap_text_data">
                                    <?php echo $data['order_status']; ?>
                                </span>
                            </td>
                            <td>
                                <div class="btn-group">
                                    <button class="btn btn-link text-dark dropdown-toggle dropdown-toggle-split m-0 p-0"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <span class="icon icon-sm">
                                            <span
                                                class="fas fa-ellipsis-h <?php if (($data['order_status'] == "Delivered") || ($data['order_status'] == "Cancelled") || ($data['order_status'] == "Shipped")) {
                                                    echo 'text-white';
                                                } ?>"></span>
                                        </span>
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item text-dark view_order"
                                            order-id="<?php echo base64_encode($data['id']); ?>"
                                            href="view_order_details?data=<?php echo base64_encode($billing_details['name']); ?>&id=<?php echo base64_encode($data['id']); ?>"><span
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