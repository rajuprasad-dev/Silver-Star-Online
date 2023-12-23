<?php
$page = base64_decode($_GET['data'])." Details";
include("header.php");

$db = new database();
$db->connect();

$id = $db->clean(base64_decode($_GET['id']));

$sql = "SELECT * FROM customers WHERE id = '$id'";

if($db->sql($sql))
{
    $numrows = $db->numrows();
    $result = $db->result();

    if($numrows == 0)
    {
        echo '<script>window.location.href="./manage_customers"</script>';
        exit();
    }
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
            <h2 class="h4"><?php echo $result[0]['name']; ?></h2>
            <p class="mb-0"><?php echo $result[0]['address']; ?>, <?php echo $result[0]['city']; ?>, <?php echo $result[0]['state']; ?> - <?php echo $result[0]['pincode']; ?></p>
        </div>
    </div>
    <div class="card card-body border-light shadow-sm table-wrapper table-responsive py-4">
        <table class="table table-hover table-bordered table-responsive">
            <tbody>
                <tr>
                    <th>#ID</th>
                    <td>CUST<?php echo 999 + $result[0]['id']; ?></td>
                </tr>
                <tr>
                    <th>Name</th>
                    <td><?php echo $result[0]['name']; ?></td>
                </tr>
                <tr>
                    <th>Phone No</th>
                    <td><?php echo $result[0]['phone']; ?></td>
                </tr>
                <tr>
                    <th>Email ID</th>
                    <td><?php echo $result[0]['email']; ?></td>
                </tr>
                <tr>
                    <th>Address</th>
                    <td><?php echo !empty($result[0]['address']) ? $result[0]['address'] : "Not Available"; ?></td>
                </tr>
                <tr>
                    <th>City</th>
                    <td><?php echo !empty($result[0]['city']) ? $result[0]['city'] : "Not Available"; ?></td>
                </tr>
                <tr>
                    <th>State</th>
                    <td><?php echo !empty($result[0]['state']) ? $result[0]['state'] : "Not Available"; ?></td>
                </tr>
                <tr>
                    <th>Pincode</th>
                    <td><?php echo !empty($result[0]['pincode']) ? $result[0]['pincode'] : "Not Available"; ?></td>
                </tr>
                <tr>
                    <th>Registration Date</th>
                    <td><?php echo date("d M Y h:i:s a", strtotime($result[0]['date_time'])); ?></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<?php
include("footer.php");
?>