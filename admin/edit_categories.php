<?php
$page="Edit ".ucwords(base64_decode($_GET['data']));
include("header.php");

$db = new database();
$db->connect();

$id = $db->clean(base64_decode($_GET['id']));
$sql = "SELECT * FROM categories WHERE id = '$id'";

if($db->sql($sql))
{
    $numrows = $db->numrows();
    $result = $db->result();
}
else
{
    echo "Server Error !";
}
?>

<div class="container-fluid my-5">
    <div class="d-flex mt-4 justify-content-between flex-wrap flex-md-nowrap align-items-center py-4">
        <h2 class="h4">Edit <?php echo ucwords(base64_decode($_GET['data'])); ?></h2>
        <p class="btn mb-0 btn-success text-left px-4 btn-sm" onclick="window.history.go(-1);"><i class="fas fa-arrow-left mr-2"></i>Go Back</p>
    </div>

    <div class="row card card-body border-light shadow-sm px-md-3 px-2">
        <div class="main_form_div p-0">
            <form id="edit_category_module" enctype="multipart/form-data" data-id="<?php echo $_GET['id']; ?>">
                <div class="row main_row_form">
                    <div class="col-lg-12 col-12 main_form_col">
                        <div class="form-group my-4">
                            <div id="profile_pic">
                                <div class="profile_pic_edit">
                                    <input <?php echo empty($result[0]['icon']) ? 'required="required"' : ''; ?> type='file' name="category_icon" id="profile_upload" accept=".png, .jpg, .jpeg" class="form-control">
                                    <label for="profile_upload" id="profile_pic_btn"></label>
                                </div>
                                <div class="profile_pic_preview">
                                    <div class="add_testimonials_images" id="profile_pic_preview" style="background-image: url(<?php echo !empty($result[0]['icon']) ? '../src/images/categories/'.$result[0]['icon'] : './assets/images/placeholder.jpg'; ?>);">
                                    </div>
                                </div>
                            </div>
                            <p class="text-center mt-4">Select New Category Icon (Optional)</p>
                        </div>
                    </div>
                </div>

                <div class="form-group mb-4">
                    <label for="category_name">Enter Category Name</label>
                    <input required="required" type="text" class="form-control" id="category_name" name="category_name" placeholder="Enter Category Name" value="<?php echo !empty($result[0]['name']) ? $result[0]['name'] : ''; ?>">
                </div>

                <div class="form-group mb-4">
                    <p for="category_bg_color"><strong>Select Category Color</strong></p>
                    <input required="required" type="text" class="form-control" id="category_bg_color" data-coloris name="category_bg_color" value="<?php echo $result[0]['color']; ?>" placeholder="Select Color">
                </div>

                <div class="form-group mb-3 btn_group_div_main">
                    <input type="submit" name="update_category" class="btn btn-primary submit_btn" value="Update Category">
                </div>
            </form>
        </div>
    </div>
</div>

<?php
include("footer.php");
?>