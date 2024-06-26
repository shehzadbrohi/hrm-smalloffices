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
if (isset($_POST['btnevent'])) {
    // Retrieve form data
    $selected_employee = $_POST['selected_employee'];
    $event_title = $_POST['event_title'];
    $role_event = $_POST['role_event'];
    $event_date = $_POST['event_date'];
    $event_location = $_POST['event_location'];
    $event_note = $_POST['event_note'];

    // Fetch the email of the selected employee from the database
    $query = "SELECT EmailId,FirstName FROM tblemployees WHERE emp_id = '$selected_employee'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    $employee_email = $row['EmailId'];
    $employee_name = $row['FirstName'];

    // Email content
    $subject = "Event Schedule";
    $message = "Dear Employee,\n\nYou have been assigned for a Event : $event_title .\n\nEvent Date is : $event_date\nLocation: $event_location\n\nNote: $event_note";

    // Send email
    $headers = "From: info@karsh.ae"; // Change this to your email address
    send_event_trip_mail($employee_name, $employee_email, $event_title, $event_date, $event_location, $event_note);
        $sql = mysqli_query($conn,"INSERT INTO tblevents (emp_id, title, role, date, location, note) 
        VALUES ('$selected_employee', '$event_title', '$role_event', '$event_date', '$event_location', '$event_note')");
        if($sql){

            echo "<script>alert('Email sent successfully.')</script>";
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
                        <label>Select Person for Event</label>
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
                                            <label>Event Title:</label>
                                            <input type="text" name="event_title" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-12">
                                        <div class="form-group">    
                                            <label>Role of Event</label>
                                            <input type="text" name="role_event"  class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label>Event Date:</label>
                                            <input type="date" name="event_date"  class="form-control" required>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label>Event Location:</label>
                                            <input type="text" name="event_location"  class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <textarea name="event_note" id="" cols="30" rows="5" placeholder="Enter Your Note" required></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-12">
                                        <div class="form-group">
                                        <button type="submit" class="btn btn-primary" name="btnevent">Schedule Business Trip</button>

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