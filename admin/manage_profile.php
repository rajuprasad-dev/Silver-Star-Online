<?php
$page="Manage Profile";
include("header.php");

$db = new database();
$db->connect();
?>

<div class="container px-lg-3 px-0 my-5">
    <div class="card card-body shadow py-4">
        <form autocomplete="off" id="admin_update_profile_module">
            <div class="form-group my-4">
                <div id="product_pic" class="add_testimonials_pic">
                    <div class="product_pic_edit">
                        <input type='file' name="admin_profile_pic" id="product_upload" accept=".png, .jpg, .jpeg" class="form-control">
                        <label for="product_upload" id="edit_product_pic_btn"></label>
                    </div>
                    <div class="product_pic_preview add_testimonials_preview">
                        <div class="add_testimonials_images" id="pic_preview" style="background-image: url('<?php echo $login_userpic; ?>');">
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group my-3">
                <input required="required" type="text" name="name" class="form-control" placeholder="Enter Full Name" value="<?php echo $login_username; ?>">
            </div>

            <div class="form-group my-3">
                <input required="required" type="email" name="email" class="form-control" placeholder="Enter Email ID" value="<?php echo $login_useremail; ?>">
            </div>

            <div class="form-group my-3">
                <input required="required" type="tel" name="phone" class="form-control" placeholder="Enter Phone Number" value="<?php echo $login_userphone; ?>">
            </div>

            <div class="form-group my-3">
                <input type="password" name="password" class="form-control" placeholder="Change Password (Optional)">
            </div>

            <div class="form-group mb-3 btn_group_div_main">
                <input type="hidden" name="update_admin_user_profile" value="1">
                <input type="submit" name="update_admin_user" class="btn btn-primary submit_btn" value="Update Profile">
            </div>
        </form>
    </div>
</div>

<?php
include("footer.php");
?>