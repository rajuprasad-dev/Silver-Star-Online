<?php
$edit_name = base64_decode($_GET['data']);
$page="Edit ".$edit_name;
include("header.php");

$db = new database();
$db->connect();

$id = $db->clean(base64_decode($_GET['id']));

$sql = "SELECT `subcategories`.*, `categories`.`name` as category_name FROM subcategories LEFT JOIN categories ON `subcategories`.`category` = `categories`.`id` WHERE `subcategories`.`id` = '$id'";

if($db->sql($sql))
{
    $numrows = $db->numrows();
    $result = $db->result();

    $data = $result[0];
}
else
{
    echo "Server Error !";
}
?>

<div class="container-fluid my-5">
    <div class="d-flex mt-4 justify-content-between flex-wrap flex-md-nowrap align-items-center py-4">
        <h2 class="h4">Edit Sub-Categories</h2>
    </div>

    <div class="row card card-body border-light shadow-sm px-md-3 px-2">
        <div class="main_form_div p-0">
            <form id="edit_subcategory_module" enctype="multipart/form-data" data-id="<?php echo base64_encode($data['id']); ?>">
                <div class="row main_row_form">
                    <div class="col-lg-12 col-12 main_form_col">
                        <div class="form-group my-4">
                            <div id="profile_pic">
                                <div class="profile_pic_edit">
                                    <input type='file' name="subcategory_icon" id="profile_upload" accept=".png, .jpg, .jpeg" class="form-control">
                                    <label for="profile_upload" id="profile_pic_btn"></label>
                                </div>
                                <div class="profile_pic_preview">
                                    <div class="add_testimonials_images" id="profile_pic_preview" style="background-image: url('../src/images/subcategories/<?php echo $data['icon'] ?>');">
                                    </div>
                                </div>
                            </div>
                            <p class="text-center mt-4">Change Sub-Category Icon (Optional)</p>
                        </div>
                    </div>
                </div>

                <div class="form-group mb-4">
                    <label for="category_name">Select Category</label>
                    <select required="required" type="text" class="form-control" id="category_name" name="category_name" placeholder="Select Category">
                        <option value="" selected disabled>Select Category</option>
                        <?php
                        $category_sql = "SELECT * FROM categories";
                        $db->sql($category_sql);

                        $category_data = $db->result();
                        $category_numrows = $db->numrows();

                        if($category_numrows > 0)
                        {
                            foreach ($category_data as $key => $category) {
                            ?>
                                <option <?php echo $category['name'] == $data['category_name'] ? "selected" : ""; ?> value="<?php echo $category['id']; ?>" ><?php echo $category['name']; ?></option>
                            <?php
                            }
                        }
                        else
                        {
                            echo '<option value="" selected disabled>No Category Available</option>';
                        }
                        ?>
                    </select>
                </div>

                <div class="form-group mb-4">
                    <label for="subcategory_name">Enter Sub-Category Name</label>
                    <input required="required" type="text" class="form-control" id="subcategory_name" name="subcategory_name" placeholder="Enter Sub-Category Name" value="<?php echo $data['name']; ?>">
                </div>

                <div class="form-group mb-3 btn_group_div_main">
                    <input type="submit" name="update_subcategory" class="btn btn-primary submit_btn" value="Update Sub-Category">
                </div>
            </form>
        </div>
    </div>
</div>

<?php
include("footer.php");
?>