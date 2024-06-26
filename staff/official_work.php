<?php include('../includes/session.php')?>
<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>

<?php include('includes/header.php')?>




<!-- process_request.php -->

<?php
// Assuming you have a database connection established

if (isset($_POST['btnsubmit'])) {
    // Retrieve form data
    $employee_name = $conn->real_escape_string($_POST['employee_name']);
    $department_name = $conn->real_escape_string($_POST['department_name']);
    $worktype = $conn->real_escape_string($_POST['worktype']);
    $date_from = $conn->real_escape_string($_POST['date_from']);
    $start_time = $conn->real_escape_string($_POST['start_time']);
    $end_time = $conn->real_escape_string($_POST['end_time']);
    $reason = $conn->real_escape_string($_POST['reason']);

    // Retrieve other form fields

    // Insert data into the database
    $sql = "INSERT INTO OfficialWork (empid,empname,empdepartment,request_type,reason,work_date,from_time,to_time) VALUES ('$session_id','$employee_name','$department_name','$worktype','$reason','$date_from','$start_time','$end_time')";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Form submitted successfully!')</script>";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
} else {
    echo "Invalid request method";
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

                                <h4>Add Request Info</h4>

                            </div>

                            <nav aria-label="breadcrumb" role="navigation">

                                <ol class="breadcrumb">

                                    <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>

                                    <li class="breadcrumb-item active" aria-current="page">Request Anything</li>

                                </ol>

                            </nav>

                        </div>

                    </div>

                 </div>

                 <div style="margin-left: 30px; margin-right: 30px;" class="pd-20 card-box mb-30">

                    <div class="clearfix">

                        <div class="pull-left">

                            <h4 class="text-blue h4">Request Anything FORM</h4>

                            <p class="mb-20"></p>

                        </div>

                    </div>

                    <div class="wizard-content">

                    <form  method="post">

                            <section>

                            <?php if ($role_id = 'Staff'): ?>

<?php $query= mysqli_query($conn,"select * from tblemployees where emp_id = '$session_id'")or die(mysqli_error());

    $row = mysqli_fetch_array($query);

    // echo var_dump($row);
?>       

<div class="row">

<div class="col-md-6 col-sm-12">

    <div class="form-group">
<!-- Include form fields here -->
        <!-- For example: -->
        <label>Employee Name:</label>
        <input type="text" name="employee_name" class="form-control wizard-required" required="true" readonly autocomplete="off" value="<?php echo $row['FirstName']; ?>">
        
        <!-- Add other form fields -->

    </div>
    </div>
    
<div class="col-md-6 col-sm-12">

<div class="form-group">
<!-- Include form fields here -->
    <!-- For example: -->
    <label>Department Name:</label>
    <input type="text" name="department_name" class="form-control wizard-required" required="true" readonly autocomplete="off" value="<?php echo $row['Department']; ?>">
    
    <!-- Add other form fields -->

</div>
</div>
</div>

<div class="row">

<div class="col-lg-6 col-sm-12">

<div class="form-group">
<label for="worktype">Work Type:</label>
<select class="form-select" aria-label="Default select example" name="worktype" required >



<option value="Late Coming">Late Coming</option>

<option value="Early Sign Out">Early Sign Out</option>


</select>

</div></div>
<div class="col-md-6 col-sm-12">
                <div class="form-group">
                    <label> Date :</label>
                    <input id="date_form" name="date_from"  type="date" class="form-control" required="true" autocomplete="off">
                </div>
            </div>
</div>


        <div class="row">
            <div class="col-md-6 col-sm-12">
                <div class="form-group">
                    <label>Start Time :</label>
                    <input type="time" id="start_time" name="start_time" class="form-control" required="true" >
                </div>
            </div>
            <div class="col-md-6 col-sm-12">
                <div class="form-group">
                    <label>End Time :</label>
                    <input type="time" id="end_time" name="end_time" class="form-control" required="true" ">                </div>
            </div>
        </div>

<div class="row">
<div class="col-lg-12 col-sm-12">

<div class="form-group">
            <label for="reason">Reason:</label>
            <textarea name="reason" required class="form-control"></textarea>
</div>
</div>
</div>  
<div class="row">

                                   

                                 

<div class="col-md-4 col-sm-12">

    <div class="form-group">

        <label style="font-size:16px;"><b></b></label>

        <div class="modal-footer justify-content-center">

            <button type="submit" name="btnsubmit" class="btn btn-primary">Submit Request</button>

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
        <?php endif ?>

    </div>

  



<script>



    $(document).ready(function(){



        $('#add_more').click(function(event){

            event.preventDefault();



            $('#multiple_field').append(`     <div class="row">

                        <div class="col-md-6 col-sm-12">

                            

                           

                                    <div class="form-group">

                                            <label>Description :</label>

                                            <input  name="description[]" type="text" class="form-control" required="true" autocomplete="off">

                                        </div>

                                    </div>



                                    <div class="col-md-4 col-sm-12">

                                    <div class="form-group">

                                            <label>Status :</label>

                                            <select class="form-select" size="3" aria-label="size 3 select example" name="status[]" required >



  <option value="70ad45" class="completedwork">Completed</option>

  <option value="fdc010" class="progresswork">In process</option>

  <option value="ed2024" class="rejectedwork">Rejected</option>

</select>

                                        </div>

                                    </div>

                                    </div>

                                  

                                    

                        </div>`);



        });





    });



    function onChange(control, oldValue, newValue, isLoading) {

    if (newValue == '') {

        return;

    }



    var field = g_form.getControl('project_health');  // name of choice field

    if (newValue == 'on track') {

        field.style.backgroundColor = "green";

    } else if (newValue == 'at risk') {

        field.style.backgroundColor = 'yellow';

    } else if (newValue == 'off track') {

        field.style.backgroundColor = 'red';

    }

}

    </script>



    <script src="../vendors/scripts/core.js"></script>

    <script src="../vendors/scripts/script.min.js"></script>

    <script src="../vendors/scripts/process.js"></script>

    <script src="../vendors/scripts/layout-settings.js"></script>

  

</body>



</html>