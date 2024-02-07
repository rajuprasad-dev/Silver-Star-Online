<?php
$prod_name = base64_decode($_GET['data']);
$page = "Edit " . $prod_name;
include("header.php");

$db = new database();
$db->connect();

$id = $db->clean(base64_decode($_GET['id']));

$sql = "SELECT `products`.*, `product_images`.`image`, `product_images`.`id` as image_id, `categories`.`name` as category_name, `subcategories`.`name` as subcategory_name FROM products LEFT JOIN product_images ON `products`.`id` =  `product_images`.`product_id` LEFT JOIN categories ON `products`.`category` =  `categories`.`id` LEFT JOIN subcategories ON `products`.`subcategory` =  `subcategories`.`id` WHERE `products`.`id` = '$id' ORDER BY `products`.`id` DESC";

if ($db->sql($sql)) {
    $numrows = $db->numrows();
    $result = $db->result();
} else {
    echo "Server Error !";
}
?>

<div class="container-fluid my-5">
    <div class="d-flex mt-4 justify-content-between flex-wrap flex-md-nowrap align-items-center py-4">
        <h2 class="h4">Edit
            <?php echo $prod_name; ?>
        </h2>
    </div>

    <div class="row card card-body border-light shadow-sm px-md-3 px-2">
        <div class="main_form_div p-0">
            <form id="update_subcategory_module" enctype="multipart/form-data"
                data-id="<?php echo base64_encode($result[0]['id']); ?>">
                <label class="text-center mb-3 w-100">Added Product Images</label>
                <div class="row main_row_form">
                    <?php
                    foreach ($result as $key => $row) {
                        ?>
                        <div class="col-lg-2 col-md-3 col-sm-4 col-6 main_form_col">
                            <div class="form-group my-4">
                                <div class="view_product_pic">
                                    <img src="../src/images/products/<?php echo $row['image']; ?>" alt="" class="img-fluid">
                                    <button data-id="<?php echo base64_encode($row['image_id']); ?>" type="button"
                                        class="btn btn-danger mt-3 w-100 py-1 px-3 delete_product_image_btn">Delete</button>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                    <div class="col-lg-12 col-12 main_form_col">
                        <div class="form-group my-4">
                            <div id="profile_pic">
                                <div class="profile_pic_edit">
                                    <input multiple="multiple" type='file' name="product_image[]" id="profile_upload"
                                        accept=".png, .jpg, .jpeg" class="form-control">
                                    <label for="profile_upload" id="profile_pic_btn"></label>
                                </div>
                                <div class="profile_pic_preview">
                                    <div id="profile_pic_preview"
                                        style="background-image: url('./assets/images/placeholder.jpg');">
                                    </div>
                                    <span class="more_image_span"></span>
                                </div>
                            </div>
                            <p class="text-center mt-4">Select New Product Image</p>
                        </div>
                    </div>
                </div>

                <div class="form-group mb-4">
                    <label for="product_select_category_name">Select Category</label>
                    <select required="required" type="text" class="form-control" id="product_select_category_name"
                        name="category_name" placeholder="Select Category">
                        <option value="" selected disabled>Select Category</option>
                        <?php
                        $categ_sql = "SELECT * FROM categories";
                        if ($db->sql($categ_sql)) {
                            $categ_res = $db->result();
                            $categ_num = $db->numrows();
                        }
                        if ($categ_num > 0) {
                            foreach ($categ_res as $key => $category) {
                                ?>
                                <option <?php echo $category['name'] == $result[0]['category_name'] ? 'selected' : ''; ?>
                                    value="<?php echo base64_encode($category['id']); ?>">
                                    <?php echo $category['name']; ?>
                                </option>
                                <?php
                            }
                        } else {
                            echo '<option value="" selected disabled>No Category Available</option>';
                        }
                        ?>
                    </select>
                </div>

                <div class="form-group mb-4">
                    <label for="product_select_subcategory_name">Select Sub-Category</label>
                    <select required="required" type="text" class="form-control" id="product_select_subcategory_name"
                        name="subcategory_name" placeholder="Select Sub-Category">
                        <option value="" selected disabled>Select Sub-Category</option>
                        <?php
                        $sub_categ_sql = "SELECT * FROM subcategories WHERE category = '" . $result[0]['category'] . "'";

                        if ($db->sql($sub_categ_sql)) {
                            $sub_categ_res = $db->result();
                            $sub_categ_num = $db->numrows();
                        }
                        if ($sub_categ_num > 0) {
                            foreach ($sub_categ_res as $key => $subcategory) {
                                ?>
                                <option <?php echo $subcategory['name'] == $result[0]['subcategory_name'] ? 'selected' : ''; ?>
                                    value="<?php echo base64_encode($subcategory['id']); ?>">
                                    <?php echo $subcategory['name']; ?>
                                </option>
                                <?php
                            }
                        } else {
                            echo '<option value="" selected disabled>No Sub-Category Available</option>';
                        }
                        ?>
                    </select>
                </div>

                <div class="form-group mb-4">
                    <label for="product_name">Enter Product Name</label>
                    <input required="required" type="text" class="form-control" id="product_name" name="product_name"
                        placeholder="Enter Product Name" value="<?php echo $result[0]['name']; ?>">
                </div>

                <div class="form-group mb-4">
                    <label for="rich_editor">Enter Product Details</label>
                    <textarea type="text" class="form-control" id="rich_editor" name="product_details"
                        placeholder="Enter Product Details"><?php echo $result[0]['description']; ?></textarea>
                </div>

                <div class="form-group mb-4">
                    <label for="product_stock_quantity">Enter Instock Quantity</label>
                    <input required="required" type="text" class="form-control" id="product_stock_quantity"
                        name="product_stock_quantity" placeholder="Enter Instock Quantity"
                        value="<?php echo $result[0]['stock']; ?>">
                </div>

                <div class="form-group mb-4">
                    <label for="product_quantity">Enter Product Quantity</label>
                    <input required="required" type="text" class="form-control" id="product_quantity"
                        name="product_quantity" placeholder="Enter Instock Quantity"
                        value="<?php echo $result[0]['quantity']; ?>">
                </div>

                <div class="form-group mb-4">
                    <label for="product_quantity_unit" class="form-label">Select Quantity Unit</label>
                    <select name="product_quantity_unit" class="form-control" id="product_quantity_unit" name="unit"
                        required="">
                        <option <?php echo $result[0]['quantity_unit'] == '' ? 'selected' : ''; ?> value="" disabled=""
                            selected="">Select Unit</option>
                        <option <?php echo $result[0]['quantity_unit'] == 'item' ? 'selected' : ''; ?> value="item">item
                        </option>
                        <option <?php echo $result[0]['quantity_unit'] == 'ml' ? 'selected' : ''; ?> value="ml">ml
                        </option>
                        <option <?php echo $result[0]['quantity_unit'] == 'litre' ? 'selected' : ''; ?> value="litre">
                            litre</option>
                        <option <?php echo $result[0]['quantity_unit'] == 'kg' ? 'selected' : ''; ?> value="kg">kg
                        </option>
                        <option <?php echo $result[0]['quantity_unit'] == 'gm' ? 'selected' : ''; ?> value="gm">gm
                        </option>
                        <option <?php echo $result[0]['quantity_unit'] == 'set' ? 'selected' : ''; ?> value="set">set
                        </option>
                        <option <?php echo $result[0]['quantity_unit'] == 'piece' ? 'selected' : ''; ?> value="piece">
                            piece</option>
                        <option <?php echo $result[0]['quantity_unit'] == 'half' ? 'selected' : ''; ?> value="half">half
                        </option>
                        <option <?php echo $result[0]['quantity_unit'] == 'full' ? 'selected' : ''; ?> value="full">full
                        </option>
                        <option <?php echo $result[0]['quantity_unit'] == 'dozen' ? 'selected' : ''; ?> value="dozen">
                            dozen</option>
                    </select>
                </div>

                <div class="form-group mb-4">
                    <label for="product_original_price">Enter Original Price</label>
                    <input required="required" type="number" class="form-control" id="product_original_price"
                        name="product_original_price" placeholder="Enter Original Price"
                        value="<?php echo $result[0]['original_price']; ?>">
                </div>

                <div class="form-group mb-4">
                    <label for="product_discount_price">Enter Discount Price</label>
                    <input required="required" type="number" class="form-control" id="product_discount_price"
                        name="product_discount_price" placeholder="Enter Discount Price"
                        value="<?php echo $result[0]['selling_price']; ?>">
                </div>

                <div class="form-group mb-3 btn_group_div_main">
                    <input type="submit" name="add_subcategory" class="btn btn-primary submit_btn"
                        value="Update Product">
                </div>
            </form>
        </div>
    </div>
</div>

<?php
include("footer.php");
?>