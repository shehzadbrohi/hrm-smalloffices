<?php include('../includes/session.php')?>
<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include('includes/header.php');
include('../sendmail.php');
?>

<body>

    <div class="pre-loader">
        <div class="pre-loader-box">
            <div class="loader-logo"><img src="../vendors/images/deskapp-logo-svg.png" alt=""></div>
            <div class='loader-progress' id="progress_div">
                <div class='bar' id='bar1'></div>
            </div>
            <div class='percent' id='percent1'>0%</div>
            <div class="loading-text">Loading...</div>
        </div>
    </div>

    <?php

    // Check if the form is submitted
if (isset($_POST['btntrip'])) {
    // Retrieve form data
    $selected_employee = $_POST['selected_employee'];
    $trip_purpose = $_POST['trip_purpose'];
    $trip_date_from = $_POST['trip_date_from'];
    $trip_date_to = $_POST['trip_date_to'];
    $trip_note = $_POST['trip_note'];
    $trip_location = $_POST['trip_location'];

    // Fetch the email of the selected employee from the database
    $query = "SELECT EmailId FROM tblemployees WHERE emp_id = '$selected_employee'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    $employee_email = $row['EmailId'];
    $employee_name = $row['FirstName'];

    // Email content
    $subject = "Business Trip Schedule";
    $message = "Dear Employee,\n\nYou have been scheduled for a business trip.\n\nPurpose: $trip_purpose\nFrom: $trip_date_from\nTo: $trip_date_to\nLocation: $trip_location\n\nNote: $trip_note";

    // Send email
    $headers = "From: info@karsh.ae"; // Change this to your email address
    send_business_trip_mail($employee_name, $employee_email, $trip_purpose, $trip_date_from, $trip_date_to, $trip_location);
        $sql = mysqli_query($conn,"INSERT INTO tblbusiness_trips (emp_id, Purpose, DateFrom, DateTo, Location, Note,trip_status) 
        VALUES ('$selected_employee', '$trip_purpose', '$trip_date_from', '$trip_date_to', '$trip_note', '$trip_location',0)");
        if($sql){

            echo "<script>window.location.assign('Email sent successfully.')</script>";
        }
     else {
        echo "Failed to send email.";
    }
}
?>

    <?php include('includes/navbar.php')?>
    <?php include('includes/right_sidebar.php')?>
    <?php include('includes/left_sidebar.php')?>
    <div class="mobile-menu-overlay"></div>
    <div class="main-container">
        <div class="pd-ltr-20">
            <div class="title pb-20">
                <h2 class="h3 mb-0">Schedule a Business Trip</h2>
            </div>
            <div class="row pb-10">
                <div class="col-lg-12 col-md-6 mb-20">
                    <div class="card-box height-100-p widget-style3 p-2">
                        <label>Select Person for Business Trip</label>
                        <div class="wizard-content">
                            <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                                <div id="employeeDropdown">
                                    <div class="pd-5 row">
                                        <div class="col-md-4 col-sm-12">
                                            <div class="form-group">
                                                <label>Select Employee:</label>
                                                <select name="selected_employee" class="form-select" id="selected_employee" required>
                                                <option selected disabled value="">Select Employee</option>
                                                    <?php 
                                                        $query="select * from tblemployees";
                                                        $data=mysqli_query($conn,$query);
                                                        foreach($data as $emp){
                                                    ?>
                                                    <option value="<?php echo $emp['emp_id'];?>"><?php echo $emp['FirstName'] . ' ' . $emp['LastName']; ?></option>
                                                    <?php
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <!-- Add an input field to display the selected employee's email -->
                                        <div class="col-md-4 col-sm-12">
                                            <div class="form-group">
                                                <label>Employee's Email:</label>
                                                <input type="text" id="selected_employee_email" name="selected_employee_email" class="form-control" readonly required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="pd-5 row">
                                    <div class="col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label>Business Trip Purpose:</label>
                                            <input type="text" name="trip_purpose" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-12">
                                        <div class="form-group">    
                                            <label>Business Trip From:</label>
                                            <input type="date" name="trip_date_from"  class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label>Business Trip To:</label>
                                            <input type="date" name="trip_date_to"  class="form-control" required>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label>Business Trip Location:</label>
                                            <input type="text" name="trip_location"  class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <textarea name="trip_note" id="" cols="30" rows="5" placeholder="Enter Your Note" required></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-12">
                                        <div class="form-group">
                                        <button type="submit" class="btn btn-primary" name="btntrip">Schedule Business Trip</button>

                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <?php include('includes/footer.php'); ?>
            </div>
        </div>
    </div>
    <?php include('includes/scripts.php')?>
    <script>
        // JavaScript to fetch employee email when the employee selection changes
        document.getElementById('selected_employee').addEventListener('change', function() {
            var selectedEmployeeId = this.value;
            // Send an AJAX request to fetch the email of the selected employee
            var xhr = new XMLHttpRequest();
            xhr.open('GET', 'get_employee_email.php?employee_id=' + selectedEmployeeId, true);
            xhr.onload = function() {
                if (xhr.status === 200) {
                    // Update the input field with the fetched email
                    document.getElementById('selected_employee_email').value = xhr.responseText;
                }
            };
            xhr.send();
        });
    </script>
</body>
</html>