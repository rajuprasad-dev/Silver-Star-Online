<?php
$page = "Manage Transactions";
include("header.php");

$db = new database();
$db->connect();

$sql = "SELECT * FROM orders WHERE `order_status` != 'Pending' OR  `order_status` != 'Cancelled'";

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
            <h2 class="h4">Transactions</h2>
            <p class="mb-0">All Transactions Will Appear Here.</p>
        </div>
    </div>
    <div class="card card-body border-light shadow-sm table-wrapper table-responsive py-4">
        <table class="table table-hover w-100" id="details_table">
            <thead>
                <tr>
                    <th>#ID</th>
                    <th>Order ID</th>
                    <th>Transaction ID</th>
                    <th>User Name</th>
                    <th>Total Amount</th>
                    <th>Payment Method</th>
                    <th>Transaction Date</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($numrows > 0) {
                    foreach ($result as $data) {
                        ?>
                        <tr>
                            <td>
                                <a href="javascript:void(0);" class="font-weight-bold">
                                    TRANS4565
                                    <?php echo $data['id']; ?>
                                </a>
                            </td>
                            <td>
                                <span class="font-weight-normal wrap_text_data">
                                    <?php echo $data['order_id']; ?>
                                </span>
                            </td>
                            <td>
                                <span class="font-weight-normal wrap_text_data">
                                    <?php echo !empty($data['payment_id']) ? $data['payment_id'] : "Not Available"; ?>
                                </span>
                            </td>
                            <td>
                                <span class="font-weight-normal wrap_text_data">
                                    <?php echo !empty($data['address']) ? json_decode($data['address'], true)['name'] : "Not Available"; ?>
                                </span>
                            </td>
                            <td>
                                <span class="font-weight-normal wrap_text_data">₹
                                    <?php echo $data['final_amount']; ?>
                                </span>
                            </td>
                            <td>
                                <span class="font-weight-normal wrap_text_data">
                                    <?php echo $data['payment_method']; ?>
                                </span>
                            </td>
                            <td>
                                <span class="font-weight-normal wrap_text_data">
                                    <?php echo date("d M Y h:i:s a", strtotime($data['date_time'])); ?>
                                </span>
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
                    <th>Order ID</th>
                    <th>Transaction ID</th>
                    <th>User Name</th>
                    <th>Total Amount</th>
                    <th>Payment Method</th>
                    <th>Transaction Date</th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>

<div class="modal fade" id="update_stocks_data" tabindex="-1" aria-labelledby="update_stocks_dataLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <form id="update_stocks_module">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="update_stocks_dataLabel">Update Stocks</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group mb-4">
                        <label for="updated_stock" class="form-label">Enter Quantity</label>
                        <input type="number" name="updated_stock" id="updated_stock">
                        <input type="hidden" name="stock_id">
                    </div>

                    <div class="form-group mb-4">
                        <label for="stock_quantity_unit" class="form-label">Select Quantity Unit</label>
                        <select name="stock_quantity_unit" class="form-control" id="stock_quantity_unit" name="unit"
                            required="">
                            <option value="" disabled="" selected="">Select Unit</option>
                            <option value="item">item</option>
                            <option value="ml">ml</option>
                            <option value="litre">litre</option>
                            <option value="kg">kg</option>
                            <option value="gm">gm</option>
                            <option value="set">set</option>
                            <option value="piece">piece</option>
                        </select>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update Stock</button>
                </div>
            </div>
        </form>
    </div>
</div>

<?php
include("footer.php");
?>