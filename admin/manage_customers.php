<?php
$page="Manage Customers";
include("header.php");

$db = new database();
$db->connect();

$sql = "SELECT * FROM customers";

if($db->sql($sql))
{
    $numrows = $db->numrows();
    $result = $db->result();
}
else
{
    echo "Server Error !";
}

if($numrows > 0)
{
?>

<div class="container-fluid my-5">
    <div class="d-flex mt-4 justify-content-between flex-wrap flex-md-nowrap align-items-center">
        <h2 class="h4">Manage Customers</h2>
    </div>
    <div class="row mt-4 text-center">
        <div class="col-lg-4 col-md-6 col-sm-6 col-12 my-2">
            <?php
            $todays_date = strtotime(date("d-m-Y"));
            
            $this_month_first_date = strtotime(date("d-m-Y", strtotime("first day of this month")));
            $this_month_last_date = strtotime(date("d-m-Y", strtotime("last day of this month")));

            $todays_registration = array();
            $this_month_registration = array();
            $total_registration = array();
            
            foreach ($result as $d => $cust)
            {
                $reg_date = strtotime(date("d-m-Y", strtotime($cust['date_time'])));

                if(($reg_date >= $this_month_first_date) && ($reg_date <= $this_month_last_date))
                {
                    array_push($this_month_registration, $cust['id']);
                }

                if($reg_date == $todays_date)
                {
                    array_push($todays_registration, $cust['id']);
                }

                array_push($total_registration, $cust['id']);
            }
            ?>
            <div class="main_header_div_card">
                <i class="fas fa-user"></i>
                <h4>Today's Registrations - <?php echo count($todays_registration); ?></h4>
            </div>
        </div>
        
        <div class="col-lg-4 col-md-6 col-sm-6 col-12 my-2">
            <div class="main_header_div_card">
                <i class="fas fa-user-friends"></i>
                <h4>Month Registrations - <?php echo count($this_month_registration); ?></h4>
            </div>
        </div>

        <div class="col-lg-4 col-md-6 col-sm-6 col-12 my-2">
            <div class="main_header_div_card">
                <i class="fas fa-users"></i>
                <h4>Total Customers - <?php echo count($total_registration); ?></h4>
            </div>
        </div>
    </div>


    <!-- Data -->
    <div class="d-flex mt-4 justify-content-between flex-wrap flex-md-nowrap align-items-center py-4">
        <div class="d-block mb-4 mb-md-0">
            <h2 class="h4">Customers</h2>
            <p class="mb-0">All Your Customers Will Appear Here.</p>
        </div>
    </div>
    <div class="mt-4 card card-body border-light shadow-sm table-wrapper table-responsive py-4">
        <table class="table table-hover w-100" id="details_table">
            <thead>
                <tr>
                    <th>#ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Registered On</th>
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
                            CUST<?php echo 999 + $data['id']; ?>
                        </a>
                    </td>
                    <td>
                        <span class="font-weight-normal wrap_text_data"><?php echo $data['name']; ?></span>
                    </td>
                    <td>
                        <span class="font-weight-normal wrap_text_data"><?php echo $data['email']; ?></span>
                    </td>
                    <td>
                        <span class="font-weight-normal wrap_text_data"><?php echo !empty($data['phone']) ? $data['phone'] : "No Details Available"; ?></span>
                    </td>
                    <td>
                        <span class="font-weight-normal wrap_text_data"><?php echo date("d M Y h:i:s a", strtotime($data['date_time'])); ?></span>
                    </td>
                    <td>
                        <div class="btn-group">
                            <button class="btn btn-link dropdown-toggle dropdown-toggle-split m-0 p-0"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="icon icon-sm">
                                    <span class="fas fa-ellipsis-h icon-dark"></span>
                                </span>
                                <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item view_customer"
                                    href="view_customer?data=<?php echo base64_encode($data['name']).'&id='.base64_encode($data['id']); ?>"><span class="far fa-eye mr-2"></span>View Details</a>

                                <?php
                                /*
                                <a class="dropdown-item text-danger delete_customer" href="javascript:void(0);"
                                    product-id="<?php echo base64_encode($data['id']); ?>"><span
                                        class="fas fa-trash-alt mr-2"></span>Delete</a>
                                */
                                ?>
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
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Registered On</th>
                    <th>Action</th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>

<?php
}
include("footer.php");
?>