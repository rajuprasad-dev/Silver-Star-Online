<?php
$page="Sales Report";
include("header.php");

$db = new database();
$db->connect();

$sql = "SELECT * FROM `orders` WHERE `order_status` != 'Cancelled' ORDER BY id DESC";

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
            <h2 class="h4">Sales Report</h2>
            <p class="mb-0">All Your Sales Report Data Will Appear Here.</p>
        </div>
    </div>
    <div class="card card-body border-light shadow-sm table-wrapper table-responsive py-4">
        <div class="row g-2">
            <div class="col-sm-6">
                <div class="form-floating mb-2">
                    <input class="form-control" type="text" name="min_date" id="min" placeholder="Select From" id="from_date">
                    <label for="from_date" class="form-control-label">From Date</label>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-floating mb-2">
                    <input class="form-control" type="text" name="max_date" id="max" placeholder="Select To" id="to_date">
                    <label for="to_date" class="form-control-label">To Date</label>
                </div>
            </div>
        </div>
        <table class="table table-hover w-100" id="sales_report">
            <thead>
                <tr>
                    <th>#ID</th>
                    <th>Date</th>
                    <th>Order ID</th>
                    <th>Total Amount</th>
                    <th>Payment Method</th>
                    <th>Address</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $total_earning = 0;
                if($numrows > 0)
                {
                    foreach($result as $data)
                    {
                        $total_earning += $data['final_amount'];
                ?>
                <tr>
                    <td>
                        <a href="javascript:void(0);" class="font-weight-bold">REPO000<?php echo $data['id']; ?></a>
                    </td>
                    <td>
                        <span class="wrap_text_data"><?php echo !empty($data['post_date']) ? date("d F Y g:i:s a", strtotime($data['post_date'])) : "Not Available"; ?></span>
                    </td>
                    <td>
                        <span class="wrap_text_data"><?php echo !empty($data['order_id']) ? $data['order_id'] : "Not Available"; ?></span>
                    </td>
                    <td>
                        <span class="wrap_text_data">₹<?php echo !empty($data['final_amount']) ? $data['final_amount'] : "0"; ?></span>
                    </td>
                    <td>
                        <span class="wrap_text_data"><?php echo !empty($data['payment_method']) ? $data['payment_method'] : "Not Available"; ?></span>
                    </td>
                    <td>
                        <span class="wrap_text_data"><?php echo !empty($data['booking_address']) ? json_decode($data['booking_address'], true)['address'] : "Not Available"; ?></span>
                    </td>
                    <td>
                        <span class="wrap_text_data"><?php echo !empty($data['date_time']) ? $data['date_time'] : "Not Available"; ?></span>
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
                    <th>Date</th>
                    <th>Order ID</th>
                    <th>Total Amount</th>
                    <th>Payment Method</th>
                    <th>Address</th>
                    <th>Date</th>
                </tr>
            </tfoot>
        </table>
        <p class="total_sales mt-4 mb-0 font-weight-bold">Total Sales : <?php echo $numrows; ?></p>
        <p class="total_sales font-weight-bold">Total Earning : ₹<?php echo $total_earning; ?></p>
    </div>
</div>

<?php
include("footer.php");
?>