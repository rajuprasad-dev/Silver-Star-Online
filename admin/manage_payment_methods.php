<?php
$page="Payment Methods";
include("header.php");

// including connection class file
// include("./config/conn.php");
$db = new database;
$db->connect();

$sql = "SELECT * FROM `site_settings` WHERE `setting_name`='Payment Methods'";
$db->sql($sql);
$data = $db->result();

$data_array = explode(',', $data[0]['setting_data']);

// print_r($data);
// die();

// add if not present
$numrows = $db->numrows();
if($numrows == 0)
{
    $insert_new_data = "INSERT INTO `site_settings` (setting_name, date_time) VALUES('Payment Methods', '".date('d-m-Y h:i:s a')."')";
    
    $db->sql($insert_new_data);
    $db->result();
    
    echo "<script type='text/javascript'>location.reload();<script>";
    return false;
}
?>

<div class="container-fluid my-5">
    <!-- Enquiry -->
    <div class="d-flex mt-4 justify-content-between flex-wrap flex-md-nowrap align-items-center py-4">
        <div class="d-block mb-4 mb-md-0">
            <h2 class="h4">Update Payment Methods</h2>
            <p class="mb-0">The Content That You Update Here Will Appear On Payment Methods Page.</p>
        </div>
    </div>
    <div class="card card-body border-light shadow-sm table-wrapper table-responsive pt-0">
        <form id="update_payment_method">
            <div class="form-group my-4">
                <div class="form-check form-switch">
                    <input <?php echo in_array("COD", $data_array) ? 'checked="checked"' : ''; ?> class="form-check-input" type="checkbox" id="cod" value="COD" name="site_setting_data[]">
                    <label class="form-check-label" for="cod">Cash On Delivery (COD)</label>
                </div>
            </div>

            <div class="form-group my-4">
                <div class="form-check form-switch">
                    <input <?php echo in_array("Razorpay", $data_array) ? 'checked="checked"' : ''; ?> class="form-check-input" type="checkbox" id="Razorpay" value="Razorpay" name="site_setting_data[]">
                    <label class="form-check-label" for="Razorpay">Razorpay</label>
                </div>
            </div>

            <div class="form-group mb-3 btn_group_div_main">
                <input type="submit" name="update_payment_method" class="btn btn-primary submit_btn" value="Update Payment Methods">
            </div>
        </form>
    </div>
</div>

<?php
include("footer.php");
?>