<?php
$page = base64_decode($_GET['data'])." Details";
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
    <div class="d-flex mt-4 justify-content-between flex-wrap flex-md-nowrap align-items-cpy-4">
        <h2 class="h4"><?php echo $page; ?></h2>
    </div>

    <div class="main_form_div card card-body border-light shadow-sm p-3">
        <form id="add_subcategory_module" enctype="multipart/form-data">
            <div class="row main_row_form">
                <div class="col-lg-12 col-12 main_form_col">
                    <div class="form-group my-4">
                        <div id="profile_pic">
                            <div class="profile_pic_preview">
                                <div class="add_testimonials_images" id="profile_pic_preview"
                                    style="background-image: url(<?php echo !empty($result[0]['photo']) ? '../captain/assets/images/profiles/'.$result[0]['photo'] : './assets/images/placeholder.jpg'; ?>);">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group mb-4">
                <label for="name">Full Name</label>
                <input readonly disabled required="required" type="text" class="form-control bg-white" id="name" name="name"
                    placeholder="Delivery Boy Name" value="<?php echo $result[0]['name']; ?>">
            </div>

            <div class="form-group mb-4">
                <label for="gender">Gender</label>
                <input readonly disabled required="required" type="text" class="form-control bg-white" id="name" name="name"
                    placeholder="Delivery Boy Name" value="<?php echo $result[0]['gender']; ?>">
            </div>

            <div class="form-group mb-4">
                <label for="email">Email ID</label>
                <input readonly disabled required="required" type="email" class="form-control bg-white" id="email" name="email"
                    placeholder="Delivery Boy Email" value="<?php echo $result[0]['email']; ?>">
            </div>

            <div class="form-group mb-4">
                <label for="phone">Phone No</label>
                <input readonly disabled required="required" type="number" class="form-control bg-white" id="phone" name="phone"
                    placeholder="Delivery Boy Phone" value="<?php echo $result[0]['phone']; ?>">
            </div>

            <div class="form-group mb-4">
                <label for="dob">Date Of Birth</label>
                <input readonly disabled required="required" type="date" class="form-control bg-white" id="dob" name="dob"
                    placeholder="Delivery Boy Date Of Birth" value="<?php echo $result[0]['dob']; ?>">
            </div>

            <div class="form-group mb-4">
                <label for="doj">Date Of Joining</label>
                <input readonly disabled required="required" type="date" class="form-control bg-white" id="doj" name="doj"
                    placeholder="Delivery Boy Date Of Joining" value="<?php echo $result[0]['doj']; ?>">
            </div>

            <div class="form-group mb-4">
                <label for="aadhar">Aadhar No</label>
                <input readonly disabled required="required" type="number" class="form-control bg-white" id="aadhar" name="aadhar"
                    placeholder="Delivery Boy Aadhar No" value="<?php echo $result[0]['aadhar']; ?>">
            </div>

            <div class="form-group mb-4">
                <label for="pancard">Pancard No</label>
                <input readonly disabled required="required" type="text" class="form-control bg-white" id="pancard" name="pancard"
                    placeholder="Delivery Boy Pancard No" value="<?php echo $result[0]['pancard']; ?>">
            </div>

            <div class="form-group mb-4">
                <label for="address">Address</label>
                <textarea readonly disabled type="text" class="form-control bg-white" id="address" name="address"
                    placeholder="Delivery Boy Address"><?php echo $result[0]['address']; ?></textarea>
            </div>

            <div class="form-group mb-4">
                <label for="city">City</label>
                <input readonly disabled required="required" type="text" class="form-control bg-white" id="city" name="city"
                    placeholder="Delivery Boy City" value="<?php echo $result[0]['city']; ?>">
            </div>

            <div class="form-group mb-4">
                <label for="state">State</label>
                <input readonly disabled required="required" type="text" class="form-control bg-white" id="state" name="state"
                    placeholder="Delivery Boy State" value="<?php echo $result[0]['state']; ?>">
            </div>

            <div class="form-group mb-4">
                <label for="pincode">Pincode</label>
                <input readonly disabled required="required" type="number" class="form-control bg-white" id="pincode" name="pincode"
                    placeholder="Delivery Boy Pincode" value="<?php echo $result[0]['pincode']; ?>">
            </div>

            <div class="form-group mb-4">
                <label for="vaccination_status">Vaccination Status</label>
                <input readonly disabled required="required" type="text" class="form-control bg-white" id="name" name="name"
                    placeholder="Delivery Boy Name" value="<?php echo $result[0]['vaccination']; ?>">
            </div>
        </form>
    </div>
</div>

<?php
include("footer.php");
?>