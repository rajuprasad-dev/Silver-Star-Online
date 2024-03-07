<?php
$page = "Manage Coupons";
include("header.php");

$db = new database();
$db->connect();

$sql = "SELECT * FROM coupons ORDER BY id DESC";

if ($db->sql($sql)) {
    $numrows = $db->numrows();
    $result = $db->result();
} else {
    echo "Server Error !";
}
?>

<div class="container-fluid my-5">
    <div class="d-flex mt-4 justify-content-between flex-wrap flex-md-nowrap align-items-center py-4">
        <h2 class="h4">Manage Coupons</h2>
    </div>

    <div class="row card card-body border-light shadow-sm px-md-3 px-2">
        <div class="main_form_div p-0">
            <form id="add_coupon_module" enctype="multipart/form-data">
                <div class="form-group mb-4">
                    <label for="coupon_code">Enter Coupon Code</label>
                    <input required="required" type="text" class="form-control" id="coupon_code" name="coupon_code"
                        placeholder="Enter Coupon Code">
                </div>

                <div class="form-group mb-4">
                    <label for="discount_amount">Enter Discount Amount</label>
                    <input required="required" type="number" class="form-control" id="discount_amount"
                        name="discount_amount" placeholder="Enter Discount Amount">
                </div>

                <div class="form-group mb-4">
                    <label for="min_cart_value">Enter Minimum Cart Value</label>
                    <input required="required" type="number" class="form-control" id="min_cart_value"
                        name="min_cart_value" placeholder="Enter Minimum Cart Value">
                </div>

                <div class="form-group mb-3 btn_group_div_main">
                    <input type="submit" name="add_coupon" class="btn btn-primary submit_btn" value="Add Coupon">
                </div>
            </form>
        </div>
    </div>

    <!-- Data -->
    <div class="d-flex mt-4 justify-content-between flex-wrap flex-md-nowrap align-items-center py-4">
        <div class="d-block mb-4 mb-md-0">
            <h2 class="h4">Added Coupons</h2>
            <p class="mb-0">All Your Added Coupons Will Appear Here.</p>
        </div>
    </div>
    <div class="card card-body border-light shadow-sm table-wrapper table-responsive py-4">
        <table class="table table-hover w-100" id="details_table">
            <thead>
                <tr>
                    <th>#ID</th>
                    <th>Coupon Code</th>
                    <th>Discount Amount</th>
                    <th>Minimum Cart Value</th>
                    <th>Added On</th>
                    <th>Action</th>
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
                                    COUP4565
                                    <?php echo $data['id']; ?>
                                </a>
                            </td>
                            <td>
                                <span class="font-weight-normal wrap_text_data">
                                    <?php echo !empty($data['coupon']) ? $data['coupon'] : "No Details Available"; ?>
                                </span>
                            </td>
                            <td>
                                <span class="font-weight-normal wrap_text_data">
                                    <?php echo !empty($data['discount']) ? $data['discount'] : "No Details Available"; ?>
                                </span>
                            </td>
                            <td>
                                <span class="font-weight-normal wrap_text_data">
                                    <?php echo !empty($data['min_value']) ? $data['min_value'] : "No Details Available"; ?>
                                </span>
                            </td>
                            <td>
                                <span class="font-weight-normal wrap_text_data">
                                    <?php echo $data['date_time']; ?>
                                </span>
                            </td>
                            <td>
                                <div class="btn-group">
                                    <button class="btn btn-link text-dark dropdown-toggle dropdown-toggle-split m-0 p-0"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <span class="icon icon-sm">
                                            <span class="fas fa-ellipsis-h icon-dark"></span>
                                        </span>
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item text-danger delete_coupon_btn" href="javascript:void(0);"
                                            coupon-id="<?php echo base64_encode($data['id']); ?>"><span
                                                class="fas fa-trash-alt mr-2"></span>Delete</a>
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
                    <th>Coupon Code</th>
                    <th>Discount Amount</th>
                    <th>Minimum Cart Value</th>
                    <th>Added On</th>
                    <th>Action</th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>

<?php
include("footer.php");
?>