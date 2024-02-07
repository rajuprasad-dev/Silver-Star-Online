<?php
$page = "Manage Products";
include("header.php");

$db = new database();
$db->connect();

$sql = "SELECT * FROM categories";

if ($db->sql($sql)) {
    $numrows = $db->numrows();
    $result = $db->result();
} else {
    echo "Server Error !";
}
?>

<div class="container-fluid my-5">
    <div class="d-flex mt-4 justify-content-between flex-wrap flex-md-nowrap align-items-center py-4">
        <h2 class="h4">Manage Products</h2>
    </div>

    <div class="row card card-body border-light shadow-sm px-md-3 px-2">
        <div class="main_form_div p-0">
            <form id="add_products_module" enctype="multipart/form-data">
                <div class="row main_row_form">
                    <div class="col-lg-12 col-12 main_form_col">
                        <div class="form-group my-4">
                            <div id="profile_pic">
                                <div class="profile_pic_edit">
                                    <input multiple="multiple" required="required" type='file' name="product_image[]"
                                        id="profile_upload" accept=".png, .jpg, .jpeg" class="form-control">
                                    <label for="profile_upload" id="profile_pic_btn"></label>
                                </div>
                                <div class="profile_pic_preview">
                                    <div id="profile_pic_preview"
                                        style="background-image: url('./assets/images/placeholder.jpg');">
                                    </div>
                                    <span class="more_image_span"></span>
                                </div>
                            </div>
                            <p class="text-center mt-4">Select Product Image</p>
                        </div>
                    </div>
                </div>

                <div class="row form_row_main g-2">
                    <div class="col-md-12 col-12 form_col_main mb-4">
                        <div class="form-group">
                            <label for="product_select_category_name">Select Category</label>
                            <select required="required" type="text" class="form-control"
                                id="product_select_category_name" name="category_name" placeholder="Select Category">
                                <option value="" selected disabled>Select Category</option>
                                <?php
                                if ($numrows > 0) {
                                    foreach ($result as $key => $category) {
                                        echo '<option value="' . base64_encode($category['id']) . '" >' . $category['name'] . '</option>';
                                    }
                                } else {
                                    echo '<option value="" selected disabled>No Category Available</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-group mb-4">
                    <label for="product_name">Enter Product Name</label>
                    <input required="required" type="text" class="form-control" id="product_name" name="product_name"
                        placeholder="Enter Product Name">
                </div>

                <div class="form-group mb-4">
                    <label for="rich_editor">Enter Product Details</label>
                    <textarea type="text" class="form-control" id="rich_editor" name="product_details"
                        placeholder="Enter Product Details"></textarea>
                </div>

                <div class="row form_row_main g-2">
                    <div class="col-md-4 col-12 form_col_main mb-4">
                        <div class="form-group">
                            <label for="product_stock_quantity">Enter Instock Quantity</label>
                            <input required="required" type="number" class="form-control" id="product_stock_quantity"
                                name="product_stock_quantity" placeholder="Enter Instock Quantity">
                        </div>
                    </div>
                    <div class="col-md-4 col-12 form_col_main mb-4">
                        <div class="form-group">
                            <label for="product_quantity">Enter Product Quantity</label>
                            <input required="required" type="number" class="form-control" id="product_quantity"
                                name="product_quantity" placeholder="Enter Product Quantity">
                        </div>
                    </div>
                    <div class="col-md-4 col-12 form_col_main mb-4">
                        <div class="form-group">
                            <label for="product_quantity_unit" class="form-label">Select Quantity Unit</label>
                            <select name="product_quantity_unit" class="form-control" id="product_quantity_unit"
                                name="unit" required="">
                                <option value="" disabled="" selected="">Select Unit</option>
                                <option value="item">item</option>
                                <option value="ml">ml</option>
                                <option value="litre">litre</option>
                                <option value="kg">kg</option>
                                <option value="gm">gm</option>
                                <option value="set">set</option>
                                <option value="piece">piece</option>
                                <option value="half">half</option>
                                <option value="full">full</option>
                                <option value="dozen">dozen</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row form_row_main g-2">
                    <div class="col-md-6 col-12 form_col_main mb-4">
                        <div class="form-group">
                            <label for="product_original_price">Enter Original Price</label>
                            <input required="required" type="number" class="form-control" id="product_original_price"
                                name="product_original_price" placeholder="Enter Original Price">
                        </div>
                    </div>

                    <div class="col-md-6 col-12 form_col_main mb-4">
                        <div class="form-group">
                            <label for="product_discount_price">Enter Discount Price</label>
                            <input required="required" type="number" class="form-control" id="product_discount_price"
                                name="product_discount_price" placeholder="Enter Discount Price">
                        </div>
                    </div>
                </div>

                <div class="form-group mb-3 btn_group_div_main">
                    <input type="submit" name="add_subcategory" class="btn btn-primary submit_btn" value="Add Product">
                </div>
            </form>
        </div>
    </div>

    <!-- Data -->
    <div class="d-flex mt-4 justify-content-between flex-wrap flex-md-nowrap align-items-center py-4">
        <div class="d-block mb-4 mb-md-0">
            <h2 class="h4">Added Products</h2>
            <p class="mb-0">All Your Added Products Will Appear Here.</p>
        </div>
    </div>
    <div class="card card-body border-light shadow-sm table-wrapper table-responsive py-4">
        <?php
        $db = new database();
        $db->connect();

        $sql = "SELECT `products`.*, `categories`.`name` as category_name, `subcategories`.`name` as subcategory_name FROM products LEFT JOIN categories ON `products`.`category` =  `categories`.`id` LEFT JOIN subcategories ON `products`.`subcategory` =  `subcategories`.`id` ORDER BY `products`.`id` DESC";

        if ($db->sql($sql)) {
            $numrows = $db->numrows();
            $result = $db->result();
        } else {
            echo "Server Error !";
        }
        ?>
        <table class="table table-hover w-100" id="details_table">
            <thead>
                <tr>
                    <th>#ID</th>
                    <th>Product Image</th>
                    <th>Category</th>
                    <!-- <th>Sub-Category</th> -->
                    <th>Product Name</th>
                    <th>Added On</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($numrows > 0) {
                    foreach ($result as $data) {
                        $prod_img_sql = "SELECT * FROM `product_images` WHERE `product_id` = '" . $data['id'] . "'";

                        $prod_img = '';
                        if ($db->sql($prod_img_sql)) {
                            $prod_res = $db->result();
                            $prod_num = $db->numrows();

                            if ($prod_num > 0) {
                                $prod_img = $prod_res[0]['image'];
                            }
                        }
                        ?>
                <tr>
                    <td>
                        <a href="javascript:void(0);" class="font-weight-bold">
                            PROD000
                            <?php echo $data['id']; ?>
                        </a>
                    </td>
                    <td>
                        <img class="img-fluid category_img_listed"
                            src="<?php echo !empty($prod_img) ? '../src/images/products/thumbnails/' . $prod_img : "./assets/images/placeholder.png"; ?>" />
                    </td>
                    <td>
                        <?php echo !empty($data['category_name']) ? $data['category_name'] : "Not Available"; ?>
                    </td>
                    <!-- <td>
                        <span
                            class="font-weight-normal wrap_text_data"><?php //echo !empty($data['subcategory_name']) ? $data['subcategory_name'] : "Not Available"; ?></span>
                    </td> -->
                    <td>
                        <span class="font-weight-normal wrap_text_data">
                            <?php echo !empty($data['name']) ? trim($data['name']) : "Not Available"; ?>
                        </span>
                    </td>
                    <td>
                        <?php echo !empty($data['date_time']) ? date('d M Y h:i:s a', strtotime($data['date_time'])) : "Not Available"; ?>
                    </td>
                    <td>
                        <div class="btn-group">
                            <button class="btn btn-link text-dark dropdown-toggle dropdown-toggle-split m-0 p-0"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="icon icon-sm">
                                    <span class="fas fa-ellipsis-h icon-dark"></span>
                                </span>
                                <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item text-dark view_product_btn"
                                    href="view_product_details?data=<?php echo base64_encode($data['name']) . '&id=' . base64_encode($data['id']); ?>"><span
                                        class="far fa-eye mr-2"></span>View</a>

                                <a class="dropdown-item text-dark edit_product_btn"
                                    href="edit_products?data=<?php echo base64_encode($data['name']) . '&id=' . base64_encode($data['id']); ?>"><span
                                        class="fas fa-edit mr-2"></span>Edit</a>

                                <a class="dropdown-item text-danger delete_product_btn" href="javascript:void(0);"
                                    product-id="<?php echo base64_encode($data['id']); ?>"><span
                                        class="fas fa-trash-alt mr-2"></span>Delete</a>
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
                    <!-- <th>Sub-Category</th> -->
                    <th>Product Image</th>
                    <th>Product Name</th>
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