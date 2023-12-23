<?php
$prod_name = base64_decode($_GET['data']);
$page = $prod_name." Details";
include("header.php");

$db = new database();
$db->connect();

$id = $db->clean(base64_decode($_GET['id']));

$sql = "SELECT `products`.*, `product_images`.`image`, `categories`.`name` as category_name, `subcategories`.`name` as subcategory_name FROM products LEFT JOIN product_images ON `products`.`id` =  `product_images`.`product_id` LEFT JOIN categories ON `products`.`category` =  `categories`.`id` LEFT JOIN subcategories ON `products`.`subcategory` =  `subcategories`.`id` WHERE `products`.`id` = '$id' ORDER BY `products`.`id` DESC";

if($db->sql($sql))
{
    $numrows = $db->numrows();
    $result = $db->result();
}
else
{
    echo "Server Error !";
}

// echo "<pre>";
// print_r($result);
// echo "</pre>";
?>

<div class="container-fluid my-5">
    <div class="d-flex mt-4 justify-content-between flex-wrap flex-md-nowrap align-items-cpy-4">
        <h2 class="h4"><?php echo ucwords(strtolower($result[0]['name'])); ?> Details</h2>
    </div>

    <div class="row card card-body border-light shadow-sm px-md-3 px-2">
        <div class="main_form_div p-0">
            <div class="row main_row_form">
                <?php
                foreach($result as $key => $row)
                {
                ?>
                <div class="col-lg-2 col-md-2 col-sm-3 col-6 main_form_col">
                    <div class="form-group my-4">
                        <div class="view_product_pic">
                            <img src="../src/images/products/<?php echo $row['image']; ?>" alt="" class="img-fluid">
                        </div>
                    </div>
                </div>
                <?php
                }
                ?>
            </div>

            <div class="form-group mb-4">
                <label for="category_name">Category</label>
                <div class="form-control"><?php echo ucwords(strtolower($result[0]['category_name'])); ?></div>
            </div>

            <div class="form-group mb-4">
                <label for="subcategory_name">Sub-Category</label>
                <div class="form-control"><?php echo ucwords(strtolower($result[0]['subcategory_name'])); ?></div>
            </div>

            <div class="form-group mb-4">
                <label for="product_name">Product Name</label>
                <div class="form-control"><?php echo ucwords(strtolower($result[0]['name'])); ?></div>
            </div>

            <div class="form-group mb-4">
                <label for="product_details">Product Details</label>
                <div class="form-control"><?php echo ucwords(strtolower($result[0]['details'])); ?></div>
            </div>

            <div class="form-group mb-4">
                <label for="product_stock_quantity">Instock Quantity</label>
                <div class="form-control"><?php echo ucwords(strtolower($result[0]['stock'])); ?></div>
            </div>

            <div class="form-group mb-4">
                <label for="product_stock_quantity">Product Quantity</label>
                <div class="form-control"><?php echo ucwords(strtolower($result[0]['quantity'])); ?></div>
            </div>

            <div class="form-group mb-4">
                <label for="product_quantity_unit" class="form-label">Quantity Unit</label>
                <div class="form-control"><?php echo ucwords(strtolower($result[0]['quantity_unit'])); ?></div>
            </div>

            <div class="form-group mb-4">
                <label for="product_orginal_price">Original Price</label>
                <div class="form-control"><?php echo ucwords(strtolower($result[0]['original_price'])); ?></div>
            </div>

            <div class="form-group mb-4">
                <label for="product_discount_price">Discount Price</label>
                <div class="form-control"><?php echo ucwords(strtolower($result[0]['selling_price'])); ?></div>
            </div>
        </div>
    </div>
</div>

<?php
include("footer.php");
?>