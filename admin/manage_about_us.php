<?php
$page="About Us";
include("header.php");

// including connection class file
// include("./config/conn.php");
$db = new database;
$db->connect();

$sql = "SELECT * FROM `site_settings` WHERE `setting_name`='About Us'";
$db->sql($sql);
$data = $db->result();
// print_r($data);
// die();

// add if not present
$numrows = $db->numrows();
if($numrows == 0)
{
    $insert_new_data = "INSERT INTO `site_settings` (setting_name, date_time) VALUES('About Us', '".date('d-m-Y h:i:s a')."')";
    
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
            <h2 class="h4">Update About Us</h2>
            <p class="mb-0">The Content That You Update Here Will Appear On About Us Page.</p>
        </div>
    </div>
    <div class="card card-body border-light shadow-sm table-wrapper table-responsive pt-0">
        <form id="update_site_setting" data-id="About Us">
            <div class="form-group my-4">
                <textarea type="text" class="form-control" id="rich_editor" name="site_setting_data" placeholder="Enter About Us Page Content"><?php if(!empty($data)){ echo $data[0]['setting_data']; } ?></textarea>
            </div>

            <div class="form-group mb-3 btn_group_div_main">
                <input type="submit" name="update_about_us" class="btn btn-primary submit_btn" value="Update About Us">
            </div>
        </form>
    </div>
</div>

<?php
include("footer.php");
?>