<?php
$page="Delivery Boys Earnings";
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
    <div class="py-4">
        <h2 class="h4">Delivery Boys Earnings</h2>
        <p>All Earnings of Delivery Boys Will Appear Here.</p>
    </div>

    <!-- Data -->
    <div class="mt-4 card card-body border-light shadow-sm table-wrapper table-responsive py-4">
        <?php
        $db = new database();
        $db->connect();

        $sql = "SELECT * FROM captain ORDER BY id DESC";

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
                    <th>Name</th>
                    <th>DOJ</th>
                    <th>Last Month Earning</th>
                    <th>Total Earnings</th>
                    <th>Orders Recieved</th>
                    <th>Orders Completed</th>
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
                            CAER<?php echo 4565 + $data['id']; ?>
                        </a>
                    </td>
                    <td>
                        <span class="font-weight-normal wrap_text_data"><?php echo $data['name']; ?></span>
                    </td>
                    <td>
                        <span class="font-weight-normal wrap_text_data"><?php echo date("d M Y", strtotime($data['doj'])); ?></span>
                    </td>
                    <td>
                        <?php
                        $todays_date = strtotime(date("d-m-Y"));
                        $last_month_first_date = strtotime(date("d-m-Y", strtotime("first day of previous month")));
                        $last_month_last_date = strtotime(date("d-m-Y", strtotime("last day of previous month")));

                        $get_deliveries = "SELECT * FROM deliveries WHERE captain_id = '".$data['id']."'";

                        $last_month_earning = array();
                        $total_earning = array();
                        $total_completed_order = array();

                        if($db->sql($get_deliveries))
                        {
                            $del_res = $db->result();
                            $del_num = $db->numrows();

                            if($del_num > 0)
                            {
                                foreach ($del_res as $d => $deliveries) {
                                    $order_date = strtotime(date("d-m-Y", strtotime($deliveries['date_time'])));

                                    if(($order_date >= $last_month_first_date) && ($order_date <= $last_month_last_date))
                                    {
                                        array_push($last_month_earning, $deliveries['charges']);
                                    }

                                    if($deliveries['status'] == "Delivered")
                                    {
                                        array_push($total_completed_order, $deliveries['order_id']);
                                    }

                                    array_push($total_earning, $deliveries['charges']);
                                }
                            }
                        }
                        ?>
                        <span class="font-weight-normal wrap_text_data">₹<?php echo array_sum($last_month_earning); ?></span>
                    </td>
                    <td>
                        <span class="font-weight-normal wrap_text_data">₹<?php echo array_sum($total_earning); ?></span>
                    </td>
                    <td>
                        <span class="font-weight-normal wrap_text_data"><?php echo $del_num; ?></span>
                    </td>
                    <td>
                        <span
                            class="font-weight-normal wrap_text_data"><?php echo count($total_completed_order); ?></span>
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
                                <a class="dropdown-item text-dark view_delivery_boy_income"
                                    href="view_delivery_boy_earning?data=<?php echo base64_encode($data['name']).'&id='.base64_encode($data['id']); ?>"><span
                                        class="far fa-eye mr-2"></span>View Details</a>
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
                    <th>Name</th>
                    <th>DOJ</th>
                    <th>Last Month Earning</th>
                    <th>Total Earnings</th>
                    <th>Orders Recieved</th>
                    <th>Orders Completed</th>
                    <th>Action</th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>

<?php
include("footer.php");
?>