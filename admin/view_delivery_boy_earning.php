<?php
$page = base64_decode($_GET["data"])." Earnings";
include("header.php");

$db = new database();
$db->connect();

$id = base64_decode($db->clean($_GET["id"]));
$name = base64_decode($db->clean($_GET["data"]));
$captain_id = '';
?>

<div class="container-fluid my-5">
    <!-- Data -->
    <div class="d-flex mt-4 justify-content-between flex-wrap flex-md-nowrap align-items-center py-4">
        <div class="d-block mb-4 mb-md-0">
            <h2 class="h4"><?php echo $name; ?></h2>
        </div>
    </div>
    <div class="card card-body border-light shadow-sm table-wrapper table-responsive py-4">
        <?php
        $db = new database();
        $db->connect();

        $sql = "SELECT * FROM captain WHERE id = '$id'";

        if($db->sql($sql))
        {
            $captain_numrows = $db->numrows();
            $captain_result = $db->result();

            $captain_id = $captain_result[0]['id'];

            $todays_date = strtotime(date("d-m-Y"));
            $last_month_first_date = strtotime(date("d-m-Y", strtotime("first day of previous month")));
            $last_month_last_date = strtotime(date("d-m-Y", strtotime("last day of previous month")));
            
            $this_month_first_date = strtotime(date("d-m-Y", strtotime("first day of this month")));
            $this_month_last_date = strtotime(date("d-m-Y", strtotime("last day of this month")));

            $get_deliveries = "SELECT * FROM deliveries WHERE captain_id = '$captain_id'";

            $last_month_earning = array();
            $todays_earning = array();
            $this_month_earning = array();
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

                        if((($order_date >= $last_month_first_date) && ($order_date <= $last_month_last_date)) && ($deliveries['status'] == "Delivered"))
                        {
                            array_push($last_month_earning, $deliveries['charges']);
                        }

                        if((($order_date >= $this_month_first_date) && ($order_date <= $this_month_last_date)) && ($deliveries['status'] == "Delivered"))
                        {
                            array_push($this_month_earning, $deliveries['charges']);
                        }

                        if(($order_date >= $todays_date) && ($deliveries['status'] == "Delivered"))
                        {
                            array_push($todays_earning, $deliveries['charges']);
                        }

                        if($deliveries['status'] == "Delivered")
                        {
                            array_push($total_completed_order, $deliveries['order_id']);
                            array_push($total_earning, $deliveries['charges']);
                        }

                    }
                }
            }
            ?>
            <table class="table table-hover table-bordered table-responsive">
                <tbody>
                    <tr>
                        <th>#ID</th>
                        <td>CAPT4565<?php echo $captain_result[0]['id']; ?></td>
                    </tr>
                    <tr>
                        <th>Date Of Joining</th>
                        <td><?php echo $captain_result[0]['doj']; ?></td>
                    </tr>
                    <tr>
                        <th>Name</th>
                        <td><?php echo $captain_result[0]['name']; ?></td>
                    </tr>
                    <tr>
                        <th>Phone No</th>
                        <td><?php echo $captain_result[0]['phone']; ?></td>
                    </tr>
                    <tr>
                        <th>Email ID</th>
                        <td><?php echo $captain_result[0]['email']; ?></td>
                    </tr>
                    <tr>
                        <th>Last Month Earnings</th>
                        <td>₹<?php echo array_sum($last_month_earning); ?></td>
                    </tr>
                    <tr>
                        <th>Todays Earning</th>
                        <td>₹<?php echo array_sum($todays_earning); ?></td>
                    </tr>
                    <tr>
                        <th>Total Earnings Till Date</th>
                        <td>₹<?php echo array_sum($total_earning); ?></td>
                    </tr>
                    <tr>
                        <th>Orders Recieved</th>
                        <td><?php echo $del_num; ?></td>
                    </tr>
                    <tr>
                        <th>Orders Completed</th>
                        <td><?php echo count($total_completed_order); ?></td>
                    </tr>
                </tbody>
            </table>
            <?php
        }
        else
        {
            echo "Server Error !";
        }
        ?>
    </div>

    <div class="mt-4 py-4">
        <h2 class="h4">Total Deliveries</h2>
        <p>All Delivery Done by Delivery Boys Will Appear Here.</p>
    </div>

    <!-- Data -->
    <div class="card card-body border-light shadow-sm table-wrapper table-responsive py-4">
        <?php
        $db = new database();
        $db->connect();

        $sql = "SELECT * FROM deliveries WHERE captain_id = '$id' ORDER BY id DESC";

        if($db->sql($sql))
        {
            $orders_numrows = $db->numrows();
            $orders_result = $db->result();
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
                    <th>Order ID</th>
                    <th>Delivered Date & Time</th>
                    <th>Delivery Charges</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if($orders_numrows > 0)
                {
                    foreach($orders_result as $data)
                    {
                ?>
                <tr>
                    <td>
                        <a href="javascript:void(0);" class="font-weight-bold">
                            ORDR<?php echo 9999 + $data['id']; ?>
                        </a>
                    </td>
                    <td>
                        <span class="font-weight-normal wrap_text_data">ORDER-NO<?php echo $data['order_id']; ?></span>
                    </td>
                    <td>
                        <span class="font-weight-normal wrap_text_data"><?php echo date("d M Y h:i:s a", strtotime($data['delivered_time'])); ?></span>
                    </td>
                    <td>
                        <span class="font-weight-normal wrap_text_data"><?php echo $data['charges']; ?></span>
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
                    <th>Order ID</th>
                    <th>Delivered Date & Time</th>
                    <th>Delivery Charges</th>
                </tr>
            </tfoot>
        </table>

        <div class="total_del_calc mt-4">
            <p><b class="total_earning">Total Earning: </b> ₹<?php echo array_sum($total_earning); ?></p>
            <p><b class="total_earning">Current Month Earning: </b> ₹<?php echo array_sum($this_month_earning); ?></p>
        </div>
    </div>

    <div class="mt-4 py-4">
        <h2 class="h4">Payments</h2>
        <p>All Payments Done to Delivery Boys Will Appear Here.</p>
    </div>

    <!-- Data -->
    <div class="card card-body border-light shadow-sm table-wrapper table-responsive py-4">
        <table class="table table-hover w-100" id="details_table">
            <thead>
                <tr>
                    <th>#ID</th>
                    <th>Month</th>
                    <th>Total Delivery Done</th>
                    <th>Earned</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $get_payment_data = "SELECT * FROM deliveries WHERE captain_id = '$captain_id'";

                if($db->sql($get_payment_data))
                {
                    $payment_res = $db->result();
                    $payment_num = $db->numrows();

                    if($payment_num > 0)
                    {
                        $payment_data = array();
                        
                        foreach($payment_res as $payment)
                        {
                            $months = date("m-Y");
                            $delivery_month = date("m-Y", strtotime($payment['date_time']));

                            if($payment['status'] == "Delivered")
                            {
                                if((array_key_exists($delivery_month, $payment_data)))
                                {
                                    array_push($payment_data[$delivery_month], $payment['charges']);
                                }
                                else
                                {
                                    $payment_data[$delivery_month] = [$payment['charges']];
                                }
                            }
                        }

                        // echo "<pre>";
                        // print_r($payment_data);
                        // echo "</pre>";

                        if(count(array_filter($payment_data)) > 0)
                        {
                            $p = count(array_filter($payment_data)) + 1;
                            foreach($payment_data as $month_year => $payouts)
                            {
                                $p--;
                            ?>
                            <tr>
                                <td>
                                    <a href="javascript:void(0);" class="font-weight-bold">
                                        PAYM<?php echo 4565 + $p; ?>
                                    </a>
                                </td>
                                <td>
                                    <span class="font-weight-normal wrap_text_data"><?php echo $payout_month = date("M Y", strtotime(date("d-".$month_year))); ?></span>
                                </td>
                                <td>
                                    <span class="font-weight-normal wrap_text_data"><?php echo count($payment_data[$month_year]); ?></span>
                                </td>
                                <td>
                                    <span class="font-weight-normal wrap_text_data"><?php echo array_sum($payment_data[$month_year]); ?></span>
                                </td>
                                <td>
                                    <?php
                                    $status_sql = "SELECT * FROM `captain_payments` WHERE month = '$payout_month'";

                                    if($db->sql($status_sql))
                                    {
                                        $status_num = $db->numrows();
                                        $status_res = $db->result();
                                        
                                        if($status_num == 0)
                                        {
                                        ?>
                                        <div class="btn-group">
                                            <button class="btn btn-link dropdown-toggle dropdown-toggle-split m-0 p-0"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <span class="icon icon-sm">
                                                    <span class="fas fa-ellipsis-h icon-dark"></span>
                                                </span>
                                                <span class="sr-only">Toggle Dropdown</span>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a data-captain="<?php echo base64_encode($id); ?>" data-month="<?php echo base64_encode($payout_month); ?>" data-total-delivery="<?php echo base64_encode(count($payment_data[$month_year])); ?>" data-total-earning="<?php echo base64_encode(array_sum($payment_data[$month_year])); ?>" data-payment-mode="<?php echo base64_encode('Paid Through Cash'); ?>" class="dropdown-item pay_delivery_boy_income" href="javascript:void(0);"><span
                                                        class="fas fa-coins mr-2"></span>Paid Through Cash</a>
                                                <a data-captain="<?php echo base64_encode($id); ?>" data-month="<?php echo base64_encode($payout_month); ?>" data-total-delivery="<?php echo base64_encode(count($payment_data[$month_year])); ?>" data-total-earning="<?php echo base64_encode(array_sum($payment_data[$month_year])); ?>" data-payment-mode="<?php echo base64_encode('Paid Through Online'); ?>" class="dropdown-item pay_delivery_boy_income" href="javascript:void(0);"><span
                                                        class="fab fa-google-pay mr-2"></span>Paid Through Online</a>
                                                <a data-captain="<?php echo base64_encode($id); ?>" data-month="<?php echo base64_encode($payout_month); ?>" data-total-delivery="<?php echo base64_encode(count($payment_data[$month_year])); ?>" data-total-earning="<?php echo base64_encode(array_sum($payment_data[$month_year])); ?>" data-payment-mode="<?php echo base64_encode('Paid Through Cheque'); ?>" class="dropdown-item pay_delivery_boy_income" href="javascript:void(0);"><span
                                                        class="fas fa-money-check-alt mr-2"></span>Paid Through Cheque</a>
                                            </div>
                                        </div>
                                        <?php
                                        }
                                        else
                                        {
                                            echo $status_res[0]['payment_mode'].' On '.date("d M Y h:i:s a", strtotime($status_res[0]['date_time']));
                                        }
                                    }
                                    else
                                    {
                                        echo "Server Error !";
                                    }
                                    ?>
                                </td>
                            </tr>
                            <?php
                            }
                        }
                    }
                }
                ?>
            </tbody>
            <tfoot>
                <tr>
                    <th>#ID</th>
                    <th>Month</th>
                    <th>Total Delivery Done</th>
                    <th>Earned</th>
                    <th>Action</th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>

<?php
include("footer.php");
?>