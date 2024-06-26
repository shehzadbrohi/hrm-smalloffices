<?php include('../includes/session.php')?>
<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include('includes/header.php')?>






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

		<div class="pd-ltr-20">

			<div class="title pb-20">

				<h2 class="h3 mb-0">Schedule a Meeting</h2>

			</div>

			<div class="row pb-10">

				<div class="col-lg-12 col-md-6 mb-20">

					<div class="card-box height-100-p widget-style3 p-2">
                    <label>
            Select Meeting Type:</label>

<?php
// Check if the form is submitted
if (isset($_POST['btnmeeting'])) {
    // Retrieve form data
    $meetingType = $_POST['meeting_type'];
    $meetingPurpose = $_POST['meeting_purpose'];
    $meetingDate = $_POST['meeting_date'];
    $meetingTime = $_POST['meeting_time'];

    // Additional check for Person to Person type to get the selected employee
    $selectedEmployee = '';
    if ($meetingType === 'person_to_person') {
        $selectedEmployee = $_POST['selected_employee'];
    }

    // Additional check for Department Wise type to get the selected department
    $selectedDepartment = '';
    if ($meetingType === 'department_wise') {
        $selectedDepartment = $_POST['selected_department'];
    }

    // Add your logic to schedule the meeting based on the selected type and other details
    // For simplicity, let's just echo the selected details
    // echo "Meeting scheduled:\nType: $meetingType\nPurpose: $meetingPurpose\nDate: $meetingDate\nTime: $meetingTime";
   
   $query="insert into tblmeetings (MeetingType,MeetingPurpose,MeetingDate,MeetingTime,SelectedEmployee,SelectedDepartment) values('$meetingType','$meetingPurpose','$meetingDate','$meetingTime','$selectedEmployee','$selectedDepartment')";
    $sql=mysqli_query($conn,$query);
    if($sql){
echo "success";
    }
    else{
        echo "error";
    }
}
?>
					<div class="wizard-content">


<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
<div class="row">
									<div class="col-md-4 col-sm-12">

    <div class="form-check">
        <label>
            <input type="radio" name="meeting_type" value="person_to_person" required>
            Person to Person
        </label>
    </div>
</div>
<div class="col-md-4 col-sm-12">

    <div class="form-check">
        <label>
            <input type="radio" name="meeting_type" value="department_wise" required>
            Department Wise
        </label>
    </div>
</div>
<div class="col-md-4 col-sm-12">

    <div class="form-check">
        <label>
            <input type="radio" name="meeting_type" value="for_all" required>
            For All
        </label>
    </div>

</div>
</div>
    <br>
<!-- Show employee dropdown only when Person to Person is selected -->

<div id="employeeDropdown" style="display: none;">
<div class="pd-5 row">
									<div class="col-md-4 col-sm-12">

    <div class="form-group">
        <label>
            Select Employee:
            <select name="selected_employee" class="form-select">
                <?php 
                $query="select * from tblemployees";
                $data=mysqli_query($conn,$query);

                foreach($data as $emp){

                    ?>
<option value="<?php echo $emp['emp_id'];?>"><?php echo $emp['FirstName']; echo "&nbsp;"; echo $emp['LastName']?></option>

<?php
}
                ?>
            
            </select>
        </label>
    </div>
                                    </div>
</div>
</div>

<!-- Show department dropdown only when Department Wise is selected -->
<div id="departmentDropdown" style="display: none;"  >
<div class="pd-5 row">
									<div class="col-md-4 col-sm-12">

    <div class="form-group">
        <label>
            Select Department:
            <select name="selected_department" class="form-select">
            <?php 
                $query="select * from tbldepartments";
                $data=mysqli_query($conn,$query);

                foreach($data as $emp){

                    ?>
<option value="<?php echo $emp['DepartmentShortName'];?>"><?php echo $emp['DepartmentShortName'];?></option>

<?php
}
                ?>
            
            </select>
        </label>
    </div>
                                    </div>
</div>
    </div>


    <div class="pd-5 row">
    <div class="col-md-4 col-sm-12">


    <div class="form-group">
    <label>
        Meeting Purpose:
    </label>
        <input type="text" name="meeting_purpose" class="form-control" required>
    </div>
    </div>
    <div class="col-md-4 col-sm-12">

    <div class="form-group">    
    <label>
        Meeting Date:
    </label>
        <input type="date" name="meeting_date"  class="form-control" required>
    </div>
    </div>
    <div class="col-md-4 col-sm-12">

    <div class="form-group">
    <label>
        Meeting Time:
    </label>
        <input type="time" name="meeting_time"  class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary" name="btnmeeting">Schedule Meeting</button>
    </div>
</div>
    <br>

    <!-- JavaScript to show/hide the employee and department dropdowns based on meeting type -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var meetingTypeRadio = document.querySelectorAll('input[name="meeting_type"]');
            var employeeDropdown = document.getElementById('employeeDropdown');
            var departmentDropdown = document.getElementById('departmentDropdown');

            function toggleDropdowns() {
                employeeDropdown.style.display = this.value === 'person_to_person' ? 'block' : 'none';
                departmentDropdown.style.display = this.value === 'department_wise' ? 'block' : 'none';
            }

            meetingTypeRadio.forEach(function (radio) {
                radio.addEventListener('change', toggleDropdowns);
            });
        });
    </script>
</form>
                    </div>
                </div>
            </div>
            <?php include('includes/footer.php'); ?>

</div>
        </div>

</div>

<!-- js -->



<?php include('includes/scripts.php')?>

</body>

</html>