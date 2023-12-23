<?php
$page="Manage Trending Products";
include("header.php");

$db = new database();
$db->connect();

// $sql = "SELECT `featured_hotdeals`.*, `products`.*, `product_images`.`image` as `product_image` FROM featured_hotdeals LEFT JOIN products ON `featured_hotdeals`.`product_id` = `products`.`id` LEFT JOIN `product_images` ON `product_images`.`product_id` = `products`.`id` WHERE `featured_hotdeals`.`type` = 1 ORDER BY `products`.`id` DESC";

$check = "SELECT product_id FROM featured_hotdeals WHERE `type` = '1'";
if($db->sql($check))
{
    $nr = $db->numrows();
    $res = $db->result();

    $tr_prod = '0';

    if($nr > 0)
    {
        $vals = array();

        foreach ($res as $key => $value) {
            array_push($vals, $value['product_id']);
        }
        // print_r($vals);

        $tr_prod = "'".implode("', '", $vals)."'";
    }

}

$sql = "SELECT * FROM products WHERE id NOT IN ($tr_prod) ORDER BY id DESC";

if($db->sql($sql))
{
    $product_numrows = $db->numrows();
    $product_result = $db->result();
}
else
{
    echo "Server Error !";
}
?>

<div class="container-fluid my-5">
    <div class="d-flex mt-4 justify-content-between flex-wrap flex-md-nowrap align-items-center py-4">
        <h2 class="h4">Manage Trending Products</h2>
    </div>

    <div class="row card card-body border-light shadow-sm px-md-3 px-2">
        <div class="main_form_div p-0">
            <form id="add_featured_products_module" enctype="multipart/form-data" data-id="1">
                <div class="form-group mb-4">
                    <label for="products_list">Select Products</label>
                    <select required="required" type="text" class="form-control multiple_image_select" id="products_list" name="products_list[]" data-holder="Select Products" multiple >
                        <?php
                        if($product_numrows > 0)
                        {
                            foreach ($product_result as $key => $product_data) {
                                echo '<option value="'.$product_data['id'].'" >'.$product_data['name'].'</option>';
                            }
                        }
                        else
                        {
                            echo '<option value="" disabled>No Products Available</option>';
                        }
                        ?>
                    </select>
                </div>
                
                <div class="form-group mb-3 btn_group_div_main">
                    <input type="submit" name="add_featured" class="btn btn-primary submit_btn" value="Add Trending Products">
                </div>
            </form>
        </div>
    </div>

    <!-- Data -->
    <div class="d-flex mt-4 justify-content-between flex-wrap flex-md-nowrap align-items-center py-4">
        <div class="d-block mb-4 mb-md-0">
            <h2 class="h4">Added Trending Products</h2>
            <p class="mb-0">All Your Added Trending Products Will Appear Here.</p>
        </div>
    </div>
    <div class="card card-body border-light shadow-sm table-wrapper table-responsive py-4">
        <?php
        $db = new database();
        $db->connect();

        $sql = "SELECT `featured_hotdeals`.*, `products`.`name` as product_name FROM featured_hotdeals LEFT JOIN products ON `featured_hotdeals`.`product_id` = `products`.`id` WHERE `featured_hotdeals`.`type` = 1 ORDER BY `products`.`id` DESC";

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
                    <th>Product Image</th>
                    <th>Product Name</th>
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
                        $prod_img_sql = "SELECT * FROM `product_images` WHERE `product_id` = '".$data['id']."'";
                        
                        $prod_img = '';
                        if($db->sql($prod_img_sql))
                        {
                            $prod_res = $db->result();
                            $prod_num = $db->numrows();

                            if($prod_num > 0)
                            {
                                $prod_img = $prod_res[0]['image'];
                            }
                        }
                ?>
                <tr>
                    <td>
                        <a href="javascript:void(0);" class="font-weight-bold">
                        TSER4565<?php echo $data['id']; ?>
                        </a>
                    </td>
                    <td>
                        <img class="img-fluid category_img_listed" src="<?php echo !empty($prod_img) ? '../src/images/products/'.$prod_img : "./assets/images/placeholder.png"; ?>" />
                    </td>
                    <td>
                        <span class="font-weight-normal wrap_text_data"><?php echo !empty($data['product_name']) ? $data['product_name'] : "No Details Available"; ?></span>
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
                                <a class="dropdown-item text-dark view_product_btn" href="view_product_details?data=<?php echo base64_encode($data['product_name']).'&id='.base64_encode($data['id']); ?>"><span class="far fa-eye mr-2"></span>View</a>

                                <a class="dropdown-item text-danger remove_featured_product_btn" href="javascript:void(0);" product-id="<?php echo base64_encode($data['id']); ?>"><span class="fas fa-trash-alt mr-2"></span>Remove</a>
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