<?php
$page = "Payment Gateway";
include("header.php");

// including connection class file
// include("./config/conn.php");
$db = new database;
$db->connect();

$sql = "SELECT * FROM `site_settings` WHERE `setting_name`='Payment Gateway'";
$db->sql($sql);
$data = $db->result();
// print_r($data);
// die();

// add if not present
$numrows = $db->numrows();
if ($numrows == 0) {
    $insert_new_data = "INSERT INTO `site_settings` (setting_name, date_time) VALUES('Payment Gateway', '" . date('d-m-Y h:i:s a') . "')";

    $db->sql($insert_new_data);
    $db->result();

    echo "<script type='text/javascript'>location.reload();<script>";
    return false;
}

$decoded_data = [
    "test" => [
        "key" => "",
        "token" => "",
    ],
    "live" => [
        "key" => "",
        "token" => "",
    ],
    "isTest" => false,
];

if (!empty($data) && !empty($data[0]['setting_data']) && is_array(json_decode($data[0]['setting_data'], true))) {
    $decoded_data = json_decode($data[0]['setting_data'], true);
}
?>

<div class="container-fluid my-5">
    <!-- Enquiry -->
    <div class="d-flex mt-4 justify-content-between flex-wrap flex-md-nowrap align-items-center py-4">
        <div class="d-block mb-4 mb-md-0">
            <h2 class="h4">Update Payment Gateway</h2>
            <p class="mb-0">The Content That You Update Here Will Be Used On Payment Gateway Page.</p>
        </div>
    </div>
    <div class="card card-body border-light shadow-sm table-wrapper table-responsive pt-0">
        <form id="update_site_setting" data-id="Payment Gateway">
            <div class="row">
                <div class="col-md-6 col-12 my-4">
                    <div class="form-group">
                        <label for="test_api_key">Test API Key</label>
                        <input type="text" class="form-control" id="test_api_key" name="test_api_key"
                            placeholder="Enter Payment Gateway Page"
                            value="<?php echo $decoded_data['test']['key']; ?>">
                    </div>
                </div>
                <div class="col-md-6 col-12 my-4">
                    <div class="form-group">
                        <label for="test_api_token">Test API Auth Token</label>
                        <input type="text" class="form-control" id="test_api_token" name="test_api_token"
                            placeholder="Enter Payment Gateway Page"
                            value="<?php echo $decoded_data['test']['token']; ?>">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 col-12 my-4">
                    <div class="form-group">
                        <label for="live_api_key">Live API Key</label>
                        <input type="text" class="form-control" id="live_api_key" name="live_api_key"
                            placeholder="Enter Payment Gateway Page"
                            value="<?php echo $decoded_data['live']['key']; ?>">
                    </div>
                </div>
                <div class="col-md-6 col-12 my-4">
                    <div class="form-group">
                        <label for="live_api_token">Live API Auth Token</label>
                        <input type="text" class="form-control" id="live_api_token" name="live_api_token"
                            placeholder="Enter Payment Gateway Page"
                            value="<?php echo $decoded_data['live']['token']; ?>">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12 my-4">
                    <div class="form-check form-switch d-flex align-items-center">
                        <input class="form-check-input mr-2" type="checkbox" id="is_test_mode"
                            <?php echo $decoded_data['isTest'] == true ? 'checked="checked"' : ""; ?>>
                        <label class="form-check-label mb-0" for="is_test_mode">
                            <span>Test Mode</span><br>
                            <small>(Check if want to enable Test mode in payment gateway)</small>
                        </label>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12 mb-3">
                    <div class="form-group btn_group_div_main">
                        <input type="submit" name="update_refund_policy" class="btn btn-primary submit_btn"
                            value="Update Payment Gateway">
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<?php
include("footer.php");
?>