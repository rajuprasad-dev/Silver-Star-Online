<?php
$page="Manage Stocks";
include("header.php");

$db = new database();
$db->connect();

$sql = "SELECT `products`.*, `categories`.`name` as category_name, `subcategories`.`name` as subcategory_name FROM products LEFT JOIN categories ON `products`.`category` =  `categories`.`id` LEFT JOIN subcategories ON `products`.`subcategory` =  `subcategories`.`id` ORDER BY `products`.`id` DESC";

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
    <!-- Data -->
    <div class="d-flex mt-4 justify-content-between flex-wrap flex-md-nowrap align-items-center py-4">
        <div class="d-block mb-4 mb-md-0">
            <h2 class="h4">Added Stocks</h2>
            <p class="mb-0">All Your Added Stocks Will Appear Here.</p>
        </div>
    </div>
    <div class="card card-body border-light shadow-sm table-wrapper table-responsive py-4">
        <table class="table table-hover w-100 manage_stocks_table" id="details_table">
            <thead>
                <tr>
                    <th>#ID</th>
                    <th>Category</th>
                    <th>Sub-Category</th>
                    <th>Product Image</th>
                    <th>Product Name</th>
                    <th>Stocks Available</th>
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
                            STOK000<?php echo $data['id']; ?>
                        </a>
                    </td>
                    <td>
                        <span class="font-weight-normal wrap_text_data"><?php echo !empty($data['category_name']) ? $data['category_name'] : "Not Available"; ?></span>
                    </td>
                    <td>
                        <span class="font-weight-normal wrap_text_data"><?php echo !empty($data['subcategory_name']) ? $data['subcategory_name'] : "Not Available"; ?></span>
                    </td>
                    <td>
                        <img class="img-fluid category_img_listed"
                            src="<?php echo !empty($prod_img) ? '../src/images/products/thumbnails/'.$prod_img : "./assets/images/placeholder.png"; ?>" />
                    </td>
                    <td>
                        <span class="font-weight-normal wrap_text_data"><?php echo $data['name']; ?></span>
                    </td>
                    <td>
                        <span class="font-weight-normal wrap_text_data <?php echo $data['stock'] < 20 ? 'text-danger' : (($data['stock'] < 40) && ($data['stock'] >= 20) ? 'text-warning' : 'text-success'); ?>"><?php echo $data['stock']; ?></span>
                    </td>
                    <td>
                        <span class="font-weight-normal wrap_text_data"><?php echo date("d M Y h:i:s a", strtotime($data['date_time'])); ?></span>
                    </td>
                    <td>
                        <a class="btn btn-tertiary update_stock_main_btn" href="javascript:void(0);" data-toggle="modal" data-target="#update_stocks_data" onclick="update_stock_module_toggle('<?php echo base64_encode($data['id']); ?>', '<?php echo base64_encode($data['stock']); ?>', '<?php echo base64_encode($data['name']); ?>');"><span class="fas fa-edit mr-2"></span>Update Stocks</a>
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
                    <th>Sub-Category</th>
                    <th>Product Image</th>
                    <th>Product Name</th>
                    <th>Stocks Available</th>
                    <th>Added On</th>
                    <th>Action</th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>

<div class="modal fade" id="update_stocks_data" tabindex="-1" aria-labelledby="update_stocks_dataLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="update_stocks_module">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="update_stocks_dataLabel"></h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group mb-4">
                        <label for="updated_stock" class="form-label">Enter Quantity</label>
                        <input type="number" class="form-control" name="updated_stock" id="updated_stock" placeholde="Enter Quantity">
                    </div>
                </div>

                <div class="modal-footer btn_group_div_main">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary submit_btn">Update Stock</button>
                </div>
            </div>
        </form>
    </div>
</div>

<?php
include("footer.php");
?>