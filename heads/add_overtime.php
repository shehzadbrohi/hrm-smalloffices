<?php include('../includes/session.php');?>
<!DOCTYPE html>
<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

?>
<?php include('../includes/config.php'); ?>
<html>
<head>
    <!-- Basic Page Info -->
    <meta charset="utf-8">
    <title>Karsh TeamUp</title>
    <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.css">
  
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>

    <link type="text/css" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/south-street/jquery-ui.css" rel="stylesheet"> 
    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.9.0/jquery-ui.min.js"></script>

    <!-- Site favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="../vendors/images/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../vendors/images/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../vendors/images/favicon-16x16.png">

    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- CSS -->

    <!-- jQuery UI Signature core CSS -->
    <link href="//ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/south-street/jquery-ui.css" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="../vendors/styles/core.css">
    <link rel="stylesheet" type="text/css" href="../vendors/styles/icon-font.min.css">
    <link rel="stylesheet" type="text/css" href="../src/plugins/jquery-steps/jquery.steps.css">
    <link rel="stylesheet" type="text/css" href="../src/plugins/datatables/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="../src/plugins/datatables/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="../vendors/styles/style.css">



    <link href="../src/css/jquery.signature.css" rel="stylesheet">
    <script src="../src/js/jquery.signature.js"></script>
 

  
</head>


<?php 
// Check if the form is submitted
if (isset($_POST['apply'])) {
    // Collect form data
    $first_name = $_POST['firstname'];
    $last_name = $_POST['lastname'];
    $position = $_POST['position'];
    $staff_id = $_POST['staff_id'];
    $overtime_date = $_POST['date_from'];
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];
    $total_hours = $_POST['hours'];
    $details = $_POST['work_cover'];

    // SQL insert statement
    $sql = "INSERT INTO overtime_requests (employee_id, first_name, last_name, position, staff_id, overtime_date, start_time, end_time, total_hours, details,hod_approval) 
            VALUES ('$session_id', '$first_name', '$last_name', '$position', '$staff_id', '$overtime_date', '$start_time', '$end_time', '$total_hours', '$details',1)";

    if ($conn->query($sql) === TRUE) {
        echo "<script>window.alert('Overtime is added successfully');</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

?>

<body>
    <div class="pre-loader">
        <div class="pre-loader-box">
            <div class="loader-logo"><img src="../vendors/images/deskapp-logo-svg.png" alt=""></div>
            <div class='loader-progress' id="progress_div">
                <div class='bar' id='bar1'></div>
            </div>
            <div class='percent' id='percent1'>0%</div>
            <div class="loading-text">
                Loading...
            </div>
        </div>
    </div>
    
    <?php include('includes/navbar.php')?>

    <?php include('includes/right_sidebar.php')?>

    <?php include('includes/left_sidebar.php')?>

    <div class="mobile-menu-overlay"></div>

    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">

                <div class="page-header">
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="title">
                                <h4>Overtime Request Form</h4>
                            </div>
                            <nav aria-label="breadcrumb" role="navigation">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="admin_dashboard.php">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Overtime Request</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                 </div>
                 <div style="margin-left: 30px; margin-right: 30px;" class="pd-20 card-box mb-30">
                    <div class="clearfix">
                        <div class="pull-left">
                            <h4 class="text-blue h4">
Overtime Request Form
</h4>
                            <p class="mb-20"></p>
                        </div>
                    </div>
                    <div class="wizard-content">
                    <form method="post" action="">
    <section>
        <?php if ($role_id = 'RemoteStaff '): ?>
        <?php $query= mysqli_query($conn,"select * from tblemployees where emp_id = '$session_id'")or die(mysqli_error());
            $row = mysqli_fetch_array($query);
        ?>
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <div class="form-group">
                    <label>First Name </label>
                    <input name="firstname" type="text" class="form-control wizard-required" required="true" readonly autocomplete="off" value="<?php echo $row['FirstName']; ?>">
                </div>
            </div>
            <div class="col-md-6 col-sm-12">
                <div class="form-group">
                    <label>Last Name </label>
                    <input name="lastname" type="text" class="form-control" readonly required="true" autocomplete="off" value="<?php echo $row['LastName']; ?>">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <div class="form-group">
                    <label>Position</label>
                    <input name="position" type="text" class="form-control" required="true" autocomplete="off" readonly value="<?php echo $row['Position_Staff']; ?>">
                </div>
            </div>
            <div class="col-md-6 col-sm-12">
                <div class="form-group">
                    <label>Staff ID Number </label>
                    <input name="staff_id" type="text" class="form-control" required="true" autocomplete="off" readonly value="<?php echo $row['Staff_ID']; ?>">
                </div>
            </div>
        </div>
        <?php endif ?>
        
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <div class="form-group">
                    <label>Overtime Date :</label>
                    <input id="date_form" name="date_from"  type="date" class="form-control" required="true" autocomplete="off">
                </div>
            </div>
            <div class="col-md-6 col-sm-12">
                <div class="form-group">
                    <label>Total Hours :</label>
                    <input type="text" id="hours" name="hours" readonly  class="form-control" required="true" autocomplete="off">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 col-sm-12">
                <div class="form-group">
                    <label>Start Time :</label>
                    <input type="time" id="start_time" name="start_time" class="form-control" required="true" autocomplete="off" onchange="calculateHours()">
                </div>
            </div>
            <div class="col-md-6 col-sm-12">
                <div class="form-group">
                    <label>End Time :</label>
                    <input type="time" id="end_time" name="end_time" class="form-control" required="true" autocomplete="off" onchange="calculateHours()">                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4 col-sm-12">
                <div class="form-group">
                    <label>Details </label>
                    <input id="work_cover" name="work_cover" type="text" class="form-control" required="true" autocomplete="off" value="">
                </div>
            </div>

            <div class="col-md-4 col-sm-12">
                <div class="form-group">
                    <label style="font-size:16px;"><b></b></label>
                    <div class="modal-footer justify-content-center">
                        <button class="btn btn-primary" name="apply" id="apply" data-toggle="modal">Request&nbsp;Overtime</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
</form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
    function calculateHours() {
        // Get the start and end time values
        var startTime = document.getElementById('start_time').value;
        var endTime = document.getElementById('end_time').value;

        // If both start time and end time are provided
        if (startTime && endTime) {
            // Create Date objects for the start and end times
            var startDate = new Date('1970-01-01T' + startTime + ':00Z');
            var endDate = new Date('1970-01-01T' + endTime + ':00Z');

            // Adjust end time if it is earlier in the day to handle overnight shifts
            if (endDate < startDate) {
                endDate.setDate(endDate.getDate() + 1);
            }

            // Calculate the difference in milliseconds
            var diffMs = endDate - startDate;

            // Convert milliseconds to hours
            var hours = diffMs / (1000 * 60 * 60);

            // Update the total hours input field
            document.getElementById('hours').value = hours.toFixed(2);
        } else {
            // Clear the total hours input field if either start time or end time is not provided
            document.getElementById('hours').value = '';
        }
    }
</script>


    <script src="../vendors/scripts/core.js"></script>
    <script src="../vendors/scripts/script.min.js"></script>
    <script src="../vendors/scripts/process.js"></script>
    <script src="../vendors/scripts/layout-settings.js"></script>
  
</body>
</html>