<?php
if(isset($_GET['id']))
{
    $id=base64_decode($_GET['id']);
    $title = "Question Bank";
}
else
{
    if(isset($_SERVER['HTTP_REFERER']))
    {
        header('location:'.$_SERVER['HTTP_REFERER']);
    }
    else
    {
        header('location: index');
    }
}

$page="View Question Banks";
include("header.php");

$db = new database();
$db->connect();

if(isset($id))
{
    $sql = "SELECT * FROM test_series WHERE id='$id'";
}

if($db->sql($sql))
{
    $numrows = $db->numrows();
    if($numrows > 0)
    {
        $result = $db->result();
    }
    else
    {
        echo "<script>window.location.href='add_Question Bank_series';</script>";
        exit();
    }
}
?>

<div class="container-fluid my-5">
    <div class="d-flex mt-4 justify-content-between flex-wrap flex-md-nowrap align-items-center py-4">
        <h2 class="h4"><?php echo $result[0]['course'].' - '.$result[0]['subject']; ?> Question Bank</h2>
        <p class="btn mb-0 btn-success text-left px-4 btn-sm" onclick="window.history.go(-1);"><i class="fas fa-arrow-left mr-2"></i>Go Back</p>
    </div>

    <div class="row card card-body border-light shadow-sm px-md-3 px-2">
        <div class="main_form_div p-0">
            <div class="form-group mb-3">
                <label class="form-label"><?php echo $title; ?> Course</label>
                <p class="form-control"><?php echo $result[0]['course']; ?></p>
            </div>

            <div class="form-group mb-3">
                <label class="form-label"><?php echo $title; ?> Subject</label>
                <p class="form-control"><?php echo $result[0]['subject']; ?></p>
            </div>

            <div class="form-group mb-3">
                <label class="form-label"><?php echo $title; ?> Chapters Covered</label>
                <p class="form-control"><?php echo $result[0]['chapters_covered']; ?></p>
            </div>

            <div class="form-group mb-3">
                <label class="form-label"><?php echo $title; ?> Question Paper</label>
                <iframe src="../assets/question_tests/<?php echo $result[0]['question_paper']; ?>" width="100%" height="400"></iframe>
            </div>

            <div class="form-group mb-3">
                <label class="form-label"><?php echo $title; ?> Marks</label>
                <p class="form-control"><?php echo $result[0]['marks']; ?></p>
            </div>

            <div class="form-group mb-3">
                <label class="form-label"><?php echo $title; ?> Duration</label>
                <p class="form-control"><?php echo $result[0]['duration']; ?></p>
            </div>

            <div class="form-group mb-3">
                <label class="form-label"><?php echo $title; ?> Added Date</label>
                <p class="form-control"><?php echo $result[0]['date_time']; ?></p>
            </div>
            
            <div class="form-group mb-3">
                <label class="form-label"><?php echo $title; ?> Last Updated at</label>
                <p class="form-control"><?php echo !empty($result[0]['update_date_time']) ? $result[0]['update_date_time'] : 'No Update Till Date !'; ?></p>
            </div>
        </div>
    </div>
</div>

<?php
include("footer.php");
?>