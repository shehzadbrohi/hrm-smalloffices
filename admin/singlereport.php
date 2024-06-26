<?php include('../includes/session.php')?>
<?php #error_reporting(0);?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<?php 
include('includes/header.php');
include('../sendmail.php');
?>




<?php 
if(isset($_POST['btnupdate'])){

    $reportremarks=$_POST['remarks'];
    $reportid=$_POST['reportid'];



    $query=mysqli_query($conn,"update tbldailyreport set remarks='$reportremarks' where id='$reportid'");


   

    $emailquery=mysqli_query($conn,"SELECT * FROM `tbldailyreport` JOIN tblemployees ON tbldailyreport.empid=tblemployees.emp_id where id='$reportid'");
    $finaldata=mysqli_fetch_assoc($emailquery);
    $employeeName=$finaldata['FirstName'];
    $employeeEmail=$finaldata['EmailId'];
    $datereport=$finaldata['staffreportdate'];

    if($query){

        send_remarks_mail($employeeName, $employeeEmail, $datereport);
        echo "<script>window.alert('Remarks added successfully');</script>";

    }

}
?>


<style>

	input[type="text"]

	{

	    font-size:16px;

	    color: #0f0d1b;

	    font-family: Verdana, Helvetica;

	}



	.btn-outline:hover {

	  color: #fff;

	  background-color: #524d7d;

	  border-color: #524d7d; 

	}



	textarea { 

		font-size:16px;

	    color: #0f0d1b;

	    font-family: Verdana, Helvetica;

	}



	textarea.text_area{

        height: 8em;

        font-size:16px;

	    color: #0f0d1b;

	    font-family: Verdana, Helvetica;

      }
      td {
  white-space: normal !important; 
  word-wrap: break-word; 
  
}



	</style>

    



<body  onload="window.print()">

	<!-- <div class="pre-loader">

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

	</div> -->

<div  id="print-btn">



    <?php include('includes/navbar.php')?>

    

	<?php include('includes/right_sidebar.php')?>

    

	<?php include('includes/left_sidebar.php')?>

</div>



	<div class="mobile-menu-overlay"></div>



	<div class="main-container">

		<div class="pd-ltr-20">

			<div class="min-height-200px">

				<div class="page-header" id="print-btn" >

					<div class="row">

						<div class="col-md-6 col-sm-12">

							<div class="title">

								<h4>Daily Report</h4>

							</div>

							<nav aria-label="breadcrumb" role="navigation">

								<ol class="breadcrumb">

									<li class="breadcrumb-item"><a href="view_report.php">View Daily Report</a></li>

									<li class="breadcrumb-item active" aria-current="page">Single Daily Report</li>

<br>



                                </ol>

							</nav>

						</div>

					</div>

				</div>



                <div class="page-header" id="print-btn" >

					<div class="row">

						<div class="col-md-6 col-sm-12">

							<div class="title">

							</div>

							<nav aria-label="breadcrumb" role="navigation">

								<ol class="breadcrumb">

<br>

                                    <button onclick="window.print();" class="btn btn-primary ">Print</button>



                                </ol>

							</nav>

						</div>

					</div>

				</div>



                <div class="pd-20 card-box mb-30">

    <div class="clearfix">





    <?php 

    if (!isset($_GET['id']) && empty($_GET['id']) && !isset($_GET['date']) && empty($_GET['date'])){

        echo "<script>window.location.assign('admin_dashboard.php')</script>";

    } else {

        $id=intval($_GET['id']);

        $date=$_GET['date'];
        $date2= date("d-M-Y", strtotime($_GET['date']));



        $query="select * from tbldailyreport where id='$id' AND staffreportdate='$date'";

        $sql=mysqli_query($conn,$query);

        $data=mysqli_fetch_assoc($sql);



        //join employee and daily report table



        $jn=mysqli_query($conn,"select * from tbldailyreport join tblemployees ON tbldailyreport.empid=tblemployees.emp_id where tbldailyreport.id='$id'; ");

        $jnass=mysqli_fetch_assoc($jn);



        $str = htmlentities($data['finaldescription']);

        $str1 = htmlentities($data['finalstatus']);

        $date1= htmlentities($data['staffreportdate']);

        $empname= htmlentities($data['fullname']);
        $remarks= htmlentities($data['remarks']);



        // Split str

        $split_str = explode(":-:",$str);

        $split_str1 = explode(":-:",$str1);



        // Rebuild strings using loop

        $built_string = "";



        foreach($split_str AS $index => $str_item){

            $status = isset($split_str1[$index]) ? $split_str1[$index] : '';

            $status_color = getStatusColor($status); // Function to get color based on status

            $status_text = getStatusText($status); // Function to get text based on status



            $built_string .= "<tr><td style='width:90%'>$str_item</td><td style='width:10%'><div style='height:50px; width:90px; background-color:$status_color'>$status_text</div></td></tr>";

        }

    }



    function getStatusColor($status) {

        switch ($status) {

            case '70ad45':

                return '#70ad45'; // Completed - Green

            case 'fdc010':

                return '#fdc010'; // In-Progress - Yellow

            case 'ed2024':

                return '#ed2024'; // Rejected - Red

            default:

                return '#ffffff'; // Default color

        }

    }



    function getStatusText($status) {

        switch ($status) {

            case '70ad45':

                return 'Completed';

                

            case 'fdc010':

                return 'In Progress';

            case 'ed2024':

                return 'Rejected';

            default:

                return 'Unknown';

        }

    }

    ?>

    <div class="pull-left">

            <img src="../staff/uploads/logo.png" alt="Company Logo" style="max-width: 200px; max-height: 200px;">

        </div>

        <div class="pull-left">

            <h4 class="text-blue h4">Daily Report</h4>

            <p>Date: <?php echo $date2; ?></p>

            <p>Employee ID: <?php echo $data['staffidnumber']?></p>

            <p>Prepared by: <?php echo $empname; ?></p>

            <p><?php echo $jnass['Department']?> Department</p>

        </div>

        <div class="pull-right">

            <img src="../staff/uploads/info.png" alt="Company Logo" style="max-width: 200px; max-height: 200px;">

        </div>

    </div>

    <table class="table table-responsive" border="1">

        <thead>

            <tr>

                <th>Description</th>

                <th>Status</th>

            </tr>

        </thead>

        <tbody>

            <?php echo $built_string;?>

        </tbody>

    </table>

    



    <div class="page-header">

					<div class="row">

						<div class="col-md-6 col-sm-12">

							<div class="title">

							</div>

							<nav aria-label="breadcrumb" role="navigation">

								<table border="1" class="table table-responsive ">

                                    <thead>

                                        <tr>

                                            <th>Review by : CEO (Amir Kakvand – Mahtab Gharakhan )</th>
                                            
                                        </tr>

                                    </thead>

                                    <tbody>

                                        <tr>

                                            <td>

                                            <?php 
                                            if(!empty($remarks)){
                                                ?>

<p><?php echo $remarks;?></p>
                                                <?php
                                            }
                                            else{
                                                ?>
<a  type="button"   class="btn btn-info" data-bs-toggle="modal" data-bs-target="#remarksmodal" >add remarks</a>
                                                <?php
                                            }
                                            ?>

                                            <br>

                                            <br>

                                            </td>

                                        </tr>

                                    </tbody>

                                </table>

                                <div class="modal fade" id="remarksmodal">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">

                                            </div>
                                            <div class="modal-body">
                                                <form id="remarksForm" method="post">
                                                <div class="form-group">
                                                    
                                                    <label for="remarks">Remarks:</label>
                                                    <input type="text" id="remarks" name="remarks" class="form-control">
                                                    <input type="hidden" id="reportid" value="<?php echo $data['id'];?>" name="reportid" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    
                                                    <button  class="btn btn-primary" name="btnupdate" type="submit">Submit</button>
                                                </div>
    </form>
                                            </div>
                                            <div class="modal-footer">

                                            </div>
                                        </div>
                                    </div>
                                </div>



							</nav>

						</div>

					</div>

				</div>

</div>







			

			<?php include('includes/footer.php'); ?>

		</div>

	</div>

	<!-- js -->



	<?php include('includes/scripts.php')?>

</body>

</html>