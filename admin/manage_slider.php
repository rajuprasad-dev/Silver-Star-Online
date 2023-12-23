<?php
$page="Manage Slider";
include("header.php");

$db = new database();
$db->connect();

$sql = "SELECT * FROM site_slider ORDER BY `sequence` ASC";

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
    <div class="card card-body border-light shadow-sm table-wrapper table-responsive pt-0">
        <form id="add_slider_images_module" enctype="multipart/form-data">
            <div class="form-group my-4">
                <div id="product_pic">
                    <div class="product_pic_edit">
                        <input required="required" type='file' name="slider_images" id="product_upload" accept=".png, .jpg, .jpeg" class="form-control">
                        <label for="product_upload" id="edit_product_pic_btn"></label>
                    </div>
                    <div class="product_pic_preview add_testimonials_preview">
                        <div class="slider_images" id="product_pic_preview" style="background-image: url('./assets/images/placeholder.jpg');">
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group mb-4">
                <label for="sequence">Select Image Position</label>
                <select class="form-select" id="sequence" name="sequence">
                    <option value="" disabled>Select Image Position</option>

                    <?php
                    if($numrows == 0)
                    {
                        echo '<option value="1">Default</option>';
                    }
                    elseif($numrows > 0)
                    {
                        $max_seq = end($result);
                        foreach($result as $key => $row)
                        {
                        ?>
                        <option value="<?php echo $row['sequence']; ?>"><?php echo $row['sequence']; ?></option>
                        <?php
                        }
                        ?>
                        <option selected value="<?php echo $max_seq['sequence']+1; ?>">Default</option>
                    <?php
                    }
                    ?>
                </select>
            </div>

            <div class="form-group mb-3 btn_group_div_main">
                <input type="hidden" name="add_slider_image" value="1">
                <input type="submit" name="add_slider_images" class="btn btn-primary submit_btn" value="Add Slider Images">
            </div>
        </form>
    </div>

    <!-- data -->
    <div class="d-flex mt-4 justify-content-between flex-wrap flex-md-nowrap align-items-center py-4">
        <div class="d-block mb-4 mb-md-0">
            <h2 class="h4">Added Slider Images</h2>
            <p class="mb-0">All Your Added Slider Images Will Show Here.</p>
        </div>
    </div>
    <div class="card card-body border-light shadow-sm table-wrapper table-responsive py-4">
        <?php
        $db = new database();
        $db->connect();

        $sql = "SELECT * FROM site_slider ORDER BY `sequence` ASC";

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
        <table class="table table-hover w-100 testimonials_table" id="details_table">
            <thead>
                <tr>
                    <th>#Slider Image ID</th>
                    <th>Added Date</th>
                    <th>Slider Image</th>
                    <th>Slider Position</th>
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
                        <a href="javascript:void(0);" class="font-weight-bold">SLID465<?php echo $data['id']; ?></a>
                    </td>
                    <td>
                        <img src="../src/images/slider/<?php echo $data['image']; ?>" class="img-fluid" width="200">
                    </td>
                    <td>
                        <span class="font-weight-normal wrap_text_data"><?php echo $data['sequence']; ?></span>
                    </td>
                    <td>
                        <span class="font-weight-normal wrap_text_data"><?php echo $data['date_time']; ?></span>
                    </td>
                    <td>
                        <div class="btn-group">
                            <button class="btn btn-link text-dark dropdown-toggle dropdown-toggle-split m-0 p-0" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="icon icon-sm">
                            <span class="fas fa-ellipsis-h icon-dark"></span>
                            </span>
                            <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item text-danger delete_slider_btn" slider-id="<?php echo base64_encode($data['id']); ?>" href="javascript:void(0);"><span class="fas fa-trash-alt mr-2"></span>Delete</a>
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
                    <th>#Slider Image ID</th>
                    <th>Added Date</th>
                    <th>Slider Image</th>
                    <th>Slider Position</th>
                    <th>Action</th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>

<?php
include("footer.php");
?>