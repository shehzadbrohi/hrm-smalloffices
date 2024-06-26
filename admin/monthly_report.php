<?php include('../includes/session.php')?>
<?php #error_reporting(0);?>

<?php include('includes/header.php')?>






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

        // echo "<script>window.location.assign('index.php')</script>";

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



                                            <br>

                                            <br>

                                            </td>

                                        </tr>

                                    </tbody>

                                </table>

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