<?php
$page = "Edit ".base64_decode($_GET['data']);
include("header.php");

$db = new database();
$db->connect();

$name = $db->clean(base64_decode($_GET['data']));
$id = $db->clean(base64_decode($_GET['id']));

$sql = "SELECT * FROM captain WHERE id = '$id'";

if($db->sql($sql))
{
    $numrows = $db->numrows();
    $result = $db->result();

    if($numrows == 0)
    {
        echo '<script>window.location.href="./manage_delivery_boys";</script>';
        exit();
    }
}
else
{
    echo "Server Error !";
}
?>

<div class="container-fluid my-5">
    <div class="d-flex mt-4 justify-content-between flex-wrap flex-md-nowrap align-items-center py-4">
        <h2 class="h4"><?php echo $page; ?> Details</h2>
    </div>

    <div class="main_form_div card card-body border-light shadow-sm p-3">
        <form id="update_delivery_boy_module" enctype="multipart/form-data" data-id="<?php echo base64_encode($id); ?>">
            <div class="row main_row_form">
                <div class="col-lg-12 col-12 main_form_col">
                    <div class="form-group my-4">
                        <div id="profile_pic">
                            <div class="profile_pic_edit">
                                <input type='file' name="delivery_boy_image" id="profile_upload"
                                    accept=".png, .jpg, .jpeg" class="form-control">
                                <label for="profile_upload" id="profile_pic_btn"></label>
                            </div>
                            <div class="profile_pic_preview">
                                <div class="add_testimonials_images" id="profile_pic_preview"
                                    style="background-image: url(<?php echo !empty($result[0]['photo']) ? '../captain/assets/images/profiles/'.$result[0]['photo'] : './assets/images/placeholder.jpg'; ?>);">
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
                    placeholder="Enter Delivery Boy Name" value="<?php echo $result[0]['name']; ?>">
            </div>

            <div class="form-group mb-4">
                <label for="gender">Select Gender</label>
                <select required="required" type="text" class="form-control" id="gender" name="gender"
                    placeholder="Select Gender">
                    <option <?php echo $result[0]['gender'] == "Male" ? "selected" : '' ; ?> value="Male">Male</option>
                    <option <?php echo $result[0]['gender'] == "Female" ? "selected" : '' ; ?> value="Female">Female</option>
                </select>
            </div>

            <div class="form-group mb-4">
                <label for="email">Enter Email ID</label>
                <input required="required" type="email" class="form-control" id="email" name="email"
                    placeholder="Enter Delivery Boy Email" value="<?php echo $result[0]['email']; ?>">
            </div>

            <div class="form-group mb-4">
                <label for="phone">Enter Phone No</label>
                <input required="required" type="number" class="form-control" id="phone" name="phone"
                    placeholder="Enter Delivery Boy Phone" value="<?php echo $result[0]['phone']; ?>">
            </div>

            <div class="form-group mb-4">
                <label for="dob">Select Date Of Birth</label>
                <input required="required" type="date" class="form-control" id="dob" name="dob"
                    placeholder="Enter Delivery Boy Date Of Birth" value="<?php echo $result[0]['dob']; ?>">
            </div>

            <div class="form-group mb-4">
                <label for="doj">Select Date Of Joining</label>
                <input required="required" type="date" class="form-control" id="doj" name="doj"
                    placeholder="Enter Delivery Boy Date Of Joining" value="<?php echo $result[0]['doj']; ?>">
            </div>

            <div class="form-group mb-4">
                <label for="aadhar">Enter Aadhar No</label>
                <input required="required" type="number" class="form-control" id="aadhar" name="aadhar"
                    placeholder="Enter Delivery Boy Aadhar No" value="<?php echo $result[0]['aadhar']; ?>">
            </div>

            <div class="form-group mb-4">
                <label for="pancard">Enter Pancard No</label>
                <input required="required" type="text" class="form-control" id="pancard" name="pancard"
                    placeholder="Enter Delivery Boy Pancard No" value="<?php echo $result[0]['pancard']; ?>">
            </div>

            <div class="form-group mb-4">
                <label for="address">Enter Address</label>
                <textarea type="text" class="form-control" id="address" name="address"
                    placeholder="Enter Delivery Boy Address"><?php echo $result[0]['address']; ?></textarea>
            </div>

            <div class="form-group mb-4">
                <label for="city">Enter City</label>
                <input required="required" type="text" class="form-control" id="city" name="city"
                    placeholder="Enter Delivery Boy City" value="<?php echo $result[0]['city']; ?>">
            </div>

            <div class="form-group mb-4">
                <label for="state">Enter State</label>
                <input required="required" type="text" class="form-control" id="state" name="state"
                    placeholder="Enter Delivery Boy State" value="<?php echo $result[0]['state']; ?>">
            </div>

            <div class="form-group mb-4">
                <label for="pincode">Enter Pincode</label>
                <input required="required" type="number" class="form-control" id="pincode" name="pincode"
                    placeholder="Enter Delivery Boy Pincode" value="<?php echo $result[0]['pincode']; ?>">
            </div>

            <div class="form-group mb-4">
                <label for="vaccination_status">Select Vaccination Status</label>
                <select required="required" type="text" class="form-control" id="vaccination_status"
                    name="vaccination_status" placeholder="Select Vaccination Status">
                    <option <?php echo $result[0]['vaccination'] == "Fully Vaccinated" ? "selected" : '' ; ?> value="Fully Vaccinated">Fully Vaccinated</option>
                    <option <?php echo $result[0]['vaccination'] == "1 Dose Completed" ? "selected" : '' ; ?> value="1 Dose Completed">1 Dose Completed</option>
                    <option <?php echo $result[0]['vaccination'] == "Non-Vaccinated" ? "selected" : '' ; ?> value="Non-Vaccinated">Non-Vaccinated</option>
                </select>
            </div>
            
            <div class="form-group">
                <div class="btn_group_div_main">
                    <button type="submit" class="btn btn-tertiary submit_btn">Update Delivery Boy</button>
                </div>
            </div>
        </form>
    </div>
</div>

<?php
include("footer.php");
?>