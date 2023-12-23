<?php
$page="App Version";
include("header.php");

// including connection class file
// include("./config/conn.php");
$db = new database;
$db->connect();

$sql = "SELECT * FROM `site_settings` WHERE `setting_name`='App Version'";
$db->sql($sql);
$data = $db->result();
// print_r($data);
// die();

// add if not present
$numrows = $db->numrows();
if($numrows == 0)
{
    $insert_new_data = "INSERT INTO `site_settings` (setting_name, date_time) VALUES('App Version', '".date('d-m-Y h:i:s a')."')";
    
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
            <h2 class="h4">Update App Version</h2>
            <p class="mb-0">The Content That You Update Here Will Appear On App Version Page.</p>
        </div>
    </div>
    <div class="card card-body border-light shadow-sm table-wrapper table-responsive pt-0">
        <form id="update_app_version">
            <div class="form-group my-4">
                <label>Current Version v<?php echo !empty($data) ? $data[0]['setting_data'] : '0'; ?></label>
                <input type="number" step="0.01" class="form-control" name="app_version" placeholder="Enter New App Version" value="<?php if(!empty($data)){ echo $data[0]['setting_data']; } ?>">
            </div>

            <div class="form-group mb-3 btn_group_div_main">
                <input type="submit" name="update_app_version" class="btn btn-primary submit_btn" value="Update App Version">
            </div>
        </form>
    </div>
</div>

<?php
include("footer.php");
?>