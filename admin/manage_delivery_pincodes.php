<?php
$page="Manage Deliverable Address & Delivery Charges";
include("header.php");

$db = new database();
$db->connect();

$sql = "SELECT * FROM pincode";

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
    <div class="d-flex mt-4 justify-content-between flex-wrap flex-md-nowrap align-items-center py-4">
        <h2 class="h4">Manage Deliverable Address & Delivery Charges</h2>
    </div>

    <div class="row card card-body border-light shadow-sm px-md-3 px-2">
        <div class="main_form_div p-0">
            <form id="add_delivery_pincode_module" enctype="multipart/form-data">
                <div class="form-group mb-4">
                    <label for="pincode">Enter Pincode</label>
                    <input required="required" type="number" class="form-control" id="pincode" name="pincode" placeholder="Enter Pincode">
                </div>

                <div class="form-group mb-4">
                    <label for="delivery_charges">Enter Delivery Charges</label>
                    <input required="required" type="number" class="form-control" id="delivery_charges" name="delivery_charges" placeholder="Enter Delivery Charges">
                </div>

                <div class="form-group mb-4">
                    <label for="expected_delivery_time" class="form-label">Select Expected Delivery Time</label>
                    <select name="expected_delivery_time" class="form-control" id="expected_delivery_time" name="expected_delivery_time" required="">
                        <option value="" disabled="" selected="">Select Delivery Time</option>
                        <option value="Delivery by Today">Delivery by Today</option>
                        <option value="Delivery by Tomorrow">Delivery by Tomorrow</option>
                        <option value="Delivery in 2 to 3 Days">Delivery in 2 to 3 Days</option>
                        <option value="Delivery in 4 Days">Delivery in 4 Days</option>
                        <option value="Delivery in 5 Days">Delivery in 5 Days</option>
                        <option value="Delivery in 6 Days">Delivery in 6 Days</option>
                        <option value="Delivery in 7 Days">Delivery in 7 Days</option>
                    </select>
                </div>

                <div class="form-group mb-3 btn_group_div_main">
                    <input type="submit" name="add_delivery_pincode" class="btn btn-primary submit_btn" value="Add Pincode">
                </div>
            </form>
        </div>
    </div>

    <!-- Data -->
    <div class="d-flex mt-4 justify-content-between flex-wrap flex-md-nowrap align-items-center py-4">
        <div class="d-block mb-4 mb-md-0">
            <h2 class="h4">Added Pincodes</h2>
            <p class="mb-0">All Your Added Pincodes Will Appear Here.</p>
        </div>
    </div>
    <div class="card card-body border-light shadow-sm table-wrapper table-responsive py-4">
        <?php
        $db = new database();
        $db->connect();

        $sql = "SELECT * FROM pincode ORDER BY id DESC";

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
                    <th>Pincode</th>
                    <th>Delivery Charges</th>
                    <th>Expected Delivery Date</th>
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
                ?>
                <tr>
                    <td>
                        <a href="javascript:void(0);" class="font-weight-bold">
                        PINC4565<?php echo $data['id']; ?>
                        </a>
                    </td>
                    <td>
                        <span class="font-weight-normal wrap_text_data"><?php echo $data['pincode']; ?></span>
                    </td>
                    <td>
                        <span class="font-weight-normal wrap_text_data"><?php echo $data['charges']; ?></span>
                    </td>
                    <td>
                        <span class="font-weight-normal wrap_text_data"><?php echo $data['expected_on']; ?></span>
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
                                <a class="dropdown-item text-danger delete_pincode_btn" href="javascript:void(0);" pincode-id="<?php echo base64_encode($data['id']); ?>"><span class="fas fa-trash-alt mr-2"></span>Delete</a>
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
                    <th>Pincode</th>
                    <th>Delivery Charges</th>
                    <th>Expected Delivery Date</th>
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