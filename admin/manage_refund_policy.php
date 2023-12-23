<?php
$page="Refund Policy";
include("header.php");

// including connection class file
// include("./config/conn.php");
$db = new database;
$db->connect();

$sql = "SELECT * FROM `site_settings` WHERE `setting_name`='Refund Policy'";
$db->sql($sql);
$data = $db->result();
// print_r($data);
// die();

// add if not present
$numrows = $db->numrows();
if($numrows == 0)
{
    $insert_new_data = "INSERT INTO `site_settings` (setting_name, date_time) VALUES('Refund Policy', '".date('d-m-Y h:i:s a')."')";
    
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
            <h2 class="h4">Update Refund Policy</h2>
            <p class="mb-0">The Content That You Update Here Will Appear On Refund Policy Page.</p>
        </div>
    </div>
    <div class="card card-body border-light shadow-sm table-wrapper table-responsive pt-0">
        <form id="update_site_setting" data-id="Refund Policy">
            <div class="form-group my-4">
                <textarea type="text" class="form-control" id="rich_editor" name="site_setting_data" placeholder="Enter Refund Policy Page"><?php if(!empty($data)){ echo $data[0]['setting_data']; } ?></textarea>
            </div>

            <div class="form-group mb-3 btn_group_div_main">
                <input type="submit" name="update_refund_policy" class="btn btn-primary submit_btn" value="Update Refund Policy">
            </div>
        </form>
    </div>
</div>

<?php
include("footer.php");
?>