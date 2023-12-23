<?php
$page="Manage Delivery Boys";
include("header.php");

$db = new database();
$db->connect();

?>

<div class="container-fluid my-5">
    <div class="d-flex mt-4 bg-white shadow p-3 rounded justify-content-between flex-wrap flex-md-nowrap align-items-center py-4">
        <h2 class="h4">Manage Delivery Boys</h2>
        <button type="button" class="btn btn-tertiary" data-toggle="modal" data-target="#add_delivery_boy">Add
            New</button>
    </div>

    <div class="modal fade" id="add_delivery_boy" tabindex="-1" aria-labelledby="add_delivery_boyLabel"
        aria-hidden="true">
        <form id="add_delivery_boy_module" enctype="multipart/form-data">
            <div class="modal-dialog modal-xl modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="add_delivery_boyLabel">Add Delivery Boy</h5>
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="main_form_div p-0">
                            <div class="row main_row_form">
                                <div class="col-lg-12 col-12 main_form_col">
                                    <div class="form-group my-4">
                                        <div id="profile_pic">
                                            <div class="profile_pic_edit">
                                                <input required="required" type='file' name="delivery_boy_image"
                                                    id="profile_upload" accept=".png, .jpg, .jpeg" class="form-control">
                                                <label for="profile_upload" id="profile_pic_btn"></label>
                                            </div>
                                            <div class="profile_pic_preview">
                                                <div class="add_testimonials_images" id="profile_pic_preview"
                                                    style="background-image: url('./assets/images/placeholder.jpg');">
                                                </div>
                                            </div>
                                        </div>
                                        <p class="text-center mt-4">Select Delivery Boy Photo</p>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mb-4">
                                <label for="name">Enter Full Name</label>
                                <input required="required" type="text" class="form-control" id="name" name="name"
                                    placeholder="Enter Delivery Boy Name">
                            </div>

                            <div class="form-group mb-4">
                                <label for="gender">Select Gender</label>
                                <select required="required" type="text" class="form-control" id="gender" name="gender"
                                    placeholder="Select Gender">
                                    <option value="" selected disabled>Select Gender</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>

                            <div class="form-group mb-4">
                                <label for="email">Enter Email ID</label>
                                <input required="required" type="email" class="form-control" id="email" name="email"
                                    placeholder="Enter Delivery Boy Email">
                            </div>

                            <div class="form-group mb-4">
                                <label for="phone">Enter Phone No</label>
                                <input required="required" type="number" class="form-control" id="phone" name="phone"
                                    placeholder="Enter Delivery Boy Phone">
                            </div>

                            <div class="form-group mb-4">
                                <label for="dob">Select Date Of Birth</label>
                                <input required="required" type="date" class="form-control" id="dob" name="dob"
                                    placeholder="Enter Delivery Boy Date Of Birth">
                            </div>

                            <div class="form-group mb-4">
                                <label for="doj">Select Date Of Joining</label>
                                <input required="required" type="date" class="form-control" id="doj" name="doj"
                                    placeholder="Enter Delivery Boy Date Of Joining">
                            </div>

                            <div class="form-group mb-4">
                                <label for="aadhar">Enter Aadhar No</label>
                                <input required="required" type="number" class="form-control" id="aadhar" name="aadhar"
                                    placeholder="Enter Delivery Boy Aadhar No">
                            </div>

                            <div class="form-group mb-4">
                                <label for="pancard">Enter Pancard No</label>
                                <input required="required" type="text" class="form-control" id="pancard" name="pancard"
                                    placeholder="Enter Delivery Boy Pancard No">
                            </div>

                            <div class="form-group mb-4">
                                <label for="address">Enter Address</label>
                                <textarea type="text" class="form-control" id="address" name="address"
                                    placeholder="Enter Delivery Boy Address"></textarea>
                            </div>

                            <div class="form-group mb-4">
                                <label for="city">Enter City</label>
                                <input required="required" type="text" class="form-control" id="city" name="city"
                                    placeholder="Enter Delivery Boy City">
                            </div>

                            <div class="form-group mb-4">
                                <label for="state">Enter State</label>
                                <input required="required" type="text" class="form-control" id="state" name="state"
                                    placeholder="Enter Delivery Boy State">
                            </div>

                            <div class="form-group mb-4">
                                <label for="pincode">Enter Pincode</label>
                                <input required="required" type="number" class="form-control" id="pincode"
                                    name="pincode" placeholder="Enter Delivery Boy Pincode">
                            </div>

                            <div class="form-group mb-4">
                                <label for="vaccination_status">Select Vaccination Status</label>
                                <select required="required" type="text" class="form-control" id="vaccination_status"
                                    name="vaccination_status" placeholder="Select Vaccination Status">
                                    <option value="" selected disabled>Select Vaccination Status</option>
                                    <option value="Fully Vaccinated">Fully Vaccinated</option>
                                    <option value="1 Dose Completed">1 Dose Completed</option>
                                    <option value="Non-Vaccinated">Non-Vaccinated</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <div class="btn_group_div_main">
                            <button type="submit" class="btn btn-tertiary submit_btn">Add Delivery Boy</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    
    <div class="row mt-4 text-center">
        <div class="col-lg-4 col-md-6 col-sm-6 col-12 my-2">
            <?php
            $sql = "SELECT * FROM captain";

            if($db->sql($sql))
            {
                $total_delivery_boys_numrows = $db->numrows();
            }
            else
            {
                echo "Server Error !";
            }
            ?>
            <div class="main_header_div_card">
                <i class="fas fa-users"></i>
                <h4>Total Delivery Boys - <?php echo $total_delivery_boys_numrows; ?></h4>
            </div>
        </div>
        
        <div class="col-lg-4 col-md-6 col-sm-6 col-12 my-2">
            <?php
            $sql = "SELECT * FROM captain WHERE `active` = 1 ORDER BY id DESC";

            if($db->sql($sql))
            {
                $active_numrows = $db->numrows();
            }
            else
            {
                echo "Server Error !";
            }
            ?>
            <div class="main_header_div_card">
                <i class="fas fa-user-check"></i>
                <h4>Total Active Delivery Boys - <?php echo $active_numrows; ?></h4>
            </div>
        </div>
        
        <div class="col-lg-4 col-md-6 col-sm-6 col-12 my-2">
            <?php
            $sql = "SELECT * FROM captain WHERE `active` = 0 ORDER BY id DESC";

            if($db->sql($sql))
            {
                $inactive_numrows = $db->numrows();
            }
            else
            {
                echo "Server Error !";
            }
            ?>
            <div class="main_header_div_card">
                <i class="fas fa-user-alt-slash"></i>
                <h4>Total Inactive Delivery Boys - <?php echo $inactive_numrows; ?></h4>
                <a href="orders" class="stretched_link"></a>
            </div>
        </div>
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
                    <th>Photo</th>
                    <th>Name</th>
                    <th>Gender</th>
                    <th>Email</th>
                    <th>Phone</th>
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
                            CAPT4565<?php echo $data['id']; ?>
                        </a>
                    </td>
                    <td>
                        <img class="img-fluid profile_img_listed"
                            src="<?php echo !empty($data['photo']) ? '../captain/assets/images/profiles/'.$data['photo'] : "./assets/images/placeholder.png"; ?>" />
                    </td>
                    <td>
                        <span class="font-weight-normal wrap_text_data"><?php echo $data['name']; ?></span>
                    </td>
                    <td>
                        <span class="font-weight-normal wrap_text_data"><?php echo $data['gender']; ?></span>
                    </td>
                    <td>
                        <span class="font-weight-normal wrap_text_data"><?php echo !empty($data['email']) ? $data['email'] : "No Details Available"; ?></span>
                    </td>
                    <td>
                        <span class="font-weight-normal wrap_text_data"><?php echo $data['phone']; ?></span>
                    </td>
                    <td>
                        <span class="font-weight-normal wrap_text_data"><?php echo date("d M Y h:i:s a", strtotime($data['date_time'])); ?></span>
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
                                <a class="dropdown-item text-dark view_delivery_boy"
                                    href="view_delivery_boy?data=<?php echo base64_encode($data['name']).'&id='.base64_encode($data['id']); ?>"><span class="far fa-eye mr-2"></span>View Details</a>

                                <a class="dropdown-item text-dark edit_delivery_boy"
                                    href="edit_delivery_boy?data=<?php echo base64_encode($data['name']).'&id='.base64_encode($data['id']); ?>"><span class="fas fa-edit mr-2"></span>Edit</a>

                                <a class="dropdown-item text-danger delete_delivery_boy" href="javascript:void(0);"
                                    captain-id="<?php echo base64_encode($data['id']); ?>"><span
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
                    <th>Photo</th>
                    <th>Name</th>
                    <th>Gender</th>
                    <th>Email</th>
                    <th>Phone</th>
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