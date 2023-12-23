<?php
$page="Manage Sub-Categories";
include("header.php");

$db = new database();
$db->connect();

$sql = "SELECT * FROM categories";

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
        <h2 class="h4">Manage Sub-Categories</h2>
    </div>

    <div class="row card card-body border-light shadow-sm px-md-3 px-2">
        <div class="main_form_div p-0">
            <form id="add_subcategory_module" enctype="multipart/form-data">
                <div class="row main_row_form">
                    <div class="col-lg-12 col-12 main_form_col">
                        <div class="form-group my-4">
                            <div id="profile_pic">
                                <div class="profile_pic_edit">
                                    <input required="required" type='file' name="subcategory_icon" id="profile_upload" accept=".png, .jpg, .jpeg" class="form-control">
                                    <label for="profile_upload" id="profile_pic_btn"></label>
                                </div>
                                <div class="profile_pic_preview">
                                    <div class="add_testimonials_images" id="profile_pic_preview" style="background-image: url('./assets/images/placeholder.jpg');">
                                    </div>
                                </div>
                            </div>
                            <p class="text-center mt-4">Select Sub-Category Icon</p>
                        </div>
                    </div>
                </div>

                <div class="form-group mb-4">
                    <label for="category_name">Select Category</label>
                    <select required="required" type="text" class="form-control" id="category_name" name="category_name" placeholder="Select Category">
                        <option value="" selected disabled>Select Category</option>
                        <?php
                        if($numrows > 0)
                        {
                            foreach ($result as $key => $category) {
                                echo '<option value="'.$category['id'].'" >'.$category['name'].'</option>';
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
                    <input required="required" type="text" class="form-control" id="subcategory_name" name="subcategory_name" placeholder="Enter Sub-Category Name">
                </div>

                <div class="form-group mb-3 btn_group_div_main">
                    <input type="submit" name="add_subcategory" class="btn btn-primary submit_btn" value="Add Sub-Category">
                </div>
            </form>
        </div>
    </div>

    <!-- Data -->
    <div class="d-flex mt-4 justify-content-between flex-wrap flex-md-nowrap align-items-center py-4">
        <div class="d-block mb-4 mb-md-0">
            <h2 class="h4">Added Sub-Categories</h2>
            <p class="mb-0">All Your Added Sub-Categories Will Appear Here.</p>
        </div>
    </div>
    <div class="card card-body border-light shadow-sm table-wrapper table-responsive py-4">
        <?php
        $db = new database();
        $db->connect();

        $sql = "SELECT `subcategories`.*, `categories`.`name` as category_name FROM subcategories LEFT JOIN categories ON `subcategories`.`category` = `categories`.`id` ORDER BY `subcategories`.`id` DESC";

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
        <table class="table table-hover w-100" id="details_table">
            <thead>
                <tr>
                    <th>#ID</th>
                    <th>Category</th>
                    <th>Sub-Category Icon</th>
                    <th>Sub-Category Name</th>
                    <th>Added On</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if($numrows > 0)
                {
                    foreach($result as $data)
                    {
                ?>
                <tr>
                    <td>
                        <a href="javascript:void(0);" class="font-weight-bold">
                        SUBM4565<?php echo $data['id']; ?>
                        </a>
                    </td>
                    <td>
                        <span class="font-weight-normal wrap_text_data"><?php echo $data['category_name']; ?></span>
                    </td>
                    <td>
                        <img class="img-fluid category_img_listed" src="<?php echo !empty($data['icon']) ? '../src/images/subcategories/thumbnails/'.$data['icon'] : "./assets/images/placeholder.png"; ?>" />
                    </td>
                    <td>
                        <span class="font-weight-normal wrap_text_data"><?php echo !empty($data['name']) ? $data['name'] : "No Name Available"; ?></span>
                    </td>
                    <td>
                        <span class="font-weight-normal wrap_text_data"><?php echo $data['date_time']; ?></span></td>
                    <td>
                        <div class="btn-group">
                            <button class="btn btn-link text-dark dropdown-toggle dropdown-toggle-split m-0 p-0" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="icon icon-sm">
                            <span class="fas fa-ellipsis-h icon-dark"></span>
                            </span>
                            <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item text-dark edit_category_btn" href="edit_subcategories?data=<?php echo base64_encode($data['name']).'&id='.base64_encode($data['id']); ?>"><span class="fas fa-edit mr-2"></span>Edit</a>
                                <a class="dropdown-item text-danger delete_subcategory_btn" href="javascript:void(0);" subcategories-id="<?php echo base64_encode($data['id']); ?>"><span class="fas fa-trash-alt mr-2"></span>Delete</a>
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
                    <th>Category</th>
                    <th>Sub-Category Icon</th>
                    <th>Sub-Category Name</th>
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