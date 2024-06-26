<?php include('../includes/session.php');?>
<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

?>
<!DOCTYPE html>

<html>

<head>

    <!-- Basic Page Info -->

    <meta charset="utf-8">

    <title>Karsh TeamUp</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

  

    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> 

    <link type="text/css" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/south-street/jquery-ui.css" rel="stylesheet"> 

    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>



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



<style>

    .completedwork{ background-color:#70ad45}.progresswork{ background-color:#fdc010}.rejectedwork{ background-color:#ed2024;}

</style>



    

  

  

</head>



<?php include('../includes/config.php'); ?>




<?php 

    if(isset($_POST['apply']))

    {



        $firstname = $_POST['firstname'];

        $lastname = $_POST['lastname'];

        #final

        $fullname = "".$firstname."  ".$lastname."";

        $staffposition=$_POST['postion'];

        $staffidnumber=$_POST['staff_id'];

        $staffreportdate=$_POST['date_from'];



        $description=$_POST['description'];

        $status=$_POST['status'];

        #final

        $finaldescription = implode(":-:",$description);




        #final

        $finalstatus = implode(":-:",$status);

        $empid=$session_id;





        $query = "INSERT INTO tbldailyreport (empid, fullname, staffposition, staffidnumber, staffreportdate, finaldescription, finalstatus) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "issssss", $empid, $fullname, $staffposition, $staffidnumber, $staffreportdate, $finaldescription, $finalstatus);
        
        // Execute the statement
        $insertdata = mysqli_stmt_execute($stmt);
        $last_inserted_id = mysqli_insert_id($conn);
        
        if ($insertdata) {
            echo "<script>alert('Daily Report Inserted successfully');</script>";
            echo "<script>window.location.assign('singlereport.php?id=$last_inserted_id&date=$staffreportdate')</script>";
        } else {
            die(mysqli_error());
        }
        

        // echo $finaldescription;

        // echo $finalstatus;







        

        



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

                                <h4>Daily Report</h4>

                            </div>

                            <nav aria-label="breadcrumb" role="navigation">

                                <ol class="breadcrumb">

                                    <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>

                                    <li class="breadcrumb-item active" aria-current="page">Add Daily Report</li>

                                </ol>

                            </nav>

                        </div>

                    </div>

                 </div>

                 <div style="margin-left: 30px; margin-right: 30px;" class="pd-20 card-box mb-30">

                    <div class="clearfix">

                        <div class="pull-left">

                            <h4 class="text-blue h4">Staff Form</h4>

                            <p class="mb-20"></p>

                        </div>

                    </div>
                    <?php if ($role_id = 'Staff'): ?>

<?php $query= mysqli_query($conn,"select * from tblemployees where emp_id = '$session_id'")or die(mysqli_error());

    $row = mysqli_fetch_array($query);

    // echo var_dump($row);
?>
                    <div class="wizard-content">

                        <form method="post" action="">

                            <section>



                          

                        

                                <div class="row">

                                    <div class="col-md-6 col-sm-12">

                                        <div class="form-group">

                                            <label >First Name </label>

                                            <input name="firstname" type="text" class="form-control wizard-required" required="true" readonly autocomplete="off" value="<?php echo $row['FirstName']; ?>">

                                        </div>

                                    </div>

                                    <div class="col-md-6 col-sm-12">

                                        <div class="form-group">

                                            <label >Last Name </label>

                                            <input name="lastname" type="text" class="form-control" readonly required="true" autocomplete="off" value="<?php echo $row['LastName']; ?>">

                                        </div>

                                    </div>

                                </div>

                                <div class="row">

                                    <div class="col-md-6 col-sm-12">

                                        <div class="form-group">

                                            <label>Position</label>

                                            <input name="postion" type="text" class="form-control" required="true" autocomplete="off" readonly value="<?php echo $row['Position_Staff']; ?>">

                                        </div>

                                    </div>

                                    <div class="col-md-6 col-sm-12">

                                        <div class="form-group">

                                            <label>Staff ID Number </label>

                                            <input name="staff_id" type="text" class="form-control" required="true" autocomplete="off" readonly value="<?php echo $row['Staff_ID']; ?>">

                                        </div>

                                    </div>

                                    <?php endif ?>

                                </div>

                     

                           <div class="row">

                           <div class="col-md-6 col-sm-12">

                                    <div class="form-group">

                                            <label>Report Date :</label>

                                            <input id="date_form" name="date_from" type="date" class="form-control" required="true" autocomplete="off" min="<?php echo date('Y-m-d', strtotime('-2 days')); ?>" max="<?php echo date('Y-m-d'); ?>">

                                        </div>

                                    </div>





                           </div>

                           <div id="multiple_field">

                        <div class="row">

                        <div class="col-md-6 col-sm-12">

                            

                           

                                    <div class="form-group">

                                            <label>Description :</label>

                                            <textarea name="description[]" class="form-control description-input" rows="4" required="true" autocomplete="off"></textarea>

                                        </div>

                                    </div>



                                    <div class="col-md-4 col-sm-12">

                                    <div class="form-group">

                                            <label>Status :</label>

                                            <select class="form-select"  aria-label="size 3 select example" name="status[]" required>



  <option value="70ad45" class="completedwork">Completed</option>

  <option value="fdc010" class="progresswork">In process</option>

  <option value="ed2024" class="rejectedwork">Rejected</option>

</select>

                                        </div>

                                    </div>

                                    </div>

                                  

                                    

                        </div>

                                </div>

                                <div class="row">

                                <div class="col-md-2 col-sm-12">

                                    <div class="form-group">

                                        <Br>

                                            <button id="add_more" class="btn btn-success btn-lg">Add More</button>

                                        </div>

                                </div>

                                <div class="row">

                                   

                                 

                                    <div class="col-md-4 col-sm-12">

                                        <div class="form-group">

                                            <label style="font-size:16px;"><b></b></label>

                                            <div class="modal-footer justify-content-center">

                                                <button class="btn btn-primary" name="apply" id="apply" data-toggle="modal">Submit&nbsp;Report</button>

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



    $(document).ready(function(){



        $('#add_more').click(function(event){

            event.preventDefault();



            $('#multiple_field').append(`     <div class="row">

                        <div class="col-md-6 col-sm-12">

                            

                           

                                    <div class="form-group">

                                            <label>Description :</label>

                                            <textarea name="description[]" class="form-control description-input" rows="4" required="true" autocomplete="off"></textarea>

                                        </div>

                                    </div>



                                    <div class="col-md-4 col-sm-12">

                                    <div class="form-group">

                                            <label>Status :</label>

                                            <select class="form-select"  aria-label="size 3 select example" name="status[]" required >



  <option value="70ad45" class="completedwork">Completed</option>

  <option value="fdc010" class="progresswork">In process</option>

  <option value="ed2024" class="rejectedwork">Rejected</option>

</select>

                                        </div>

                                    </div>
                                    <div class="col-md-2 col-sm-12">
                                <div class="form-group">
                                    <br>
                                    <button class="btn btn-danger btn-sm remove_field">Remove</button>
                                </div>
                            </div>
                                    </div>

                                

                                    

                        </div>`);



        });




    });

// Remove button functionality
$('#multiple_field').on('click', '.remove_field', function(event) {
            event.preventDefault();
            console.log($(this).closest('.row'));
            $(this).closest('.row').remove();
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