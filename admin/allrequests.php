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

				<h2 class="h3 mb-0">View Requests</h2>

			</div>

			<div class="row pb-10">

				<div class="col-xl-3 col-lg-3 col-md-6 mb-20">

					<div class="card-box height-100-p widget-style3">



						<?php

						$sql = "SELECT request_id from request_data";

						$query = $dbh -> prepare($sql);

						$query->execute();

						$results=$query->fetchAll(PDO::FETCH_OBJ);

						$empcount=$query->rowCount();

						?>



						<div class="d-flex flex-wrap">

							<div class="widget-data">

								<div class="weight-700 font-24 text-dark"><?php echo($empcount);?></div>

								<div class="font-14 text-secondary weight-500">All Requests</div>

							</div>

							<div class="widget-icon">

								<div class="icon" data-color="#00eccf"><i class="icon-copy dw dw-user-2"></i></div>

							</div>

						</div>

					</div>

				</div>

		



			</div>



			<div class="card-box mb-30">

				<div class="pd-20">

						<h2 class="text-blue h4">View All Requests</h2>

					</div>

				<div class="pb-20">

					<table class="table table-responsive  hover nowrap">

						<thead>

							<tr>



                                <th>NO.</th>
                                <th>Requester Name</th>
                                    <th>Department</th>
                                    <th>Request Description</th>
                                    <th>Reason</th>
                                    <th>Urgency</th>
                                    <th>Request Date</th>
                                    <th>CEO Approval</th>


							</tr>

						</thead>

			
                        <tbody>



    

<?php
// Assuming you have a database connection established

// Fetch requests with HOD approval status 'Approved'
$sql = "SELECT * FROM request_data";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0)   {

	foreach($result as $row)

	{    

?>

<tr>

<td><?php echo htmlentities($row['request_id']);?></td>
<td><?php echo htmlentities($row['requester_name']);?></td>

<td><?php echo htmlentities($row['department']);?></td>
<td><?php echo htmlentities($row['request_description']);?></td>
<td><?php echo htmlentities($row['reason']);?></td>
<td><?php echo htmlentities($row['urgency']);?></td>
<td><?php echo htmlentities($row['request_date']);?></td>
<td><?php echo htmlentities($row['admin_approval_status']);?></td>
</tr>

<?php


}
} 
?>


</tbody>

					</table>

			   </div>

			</div>



			<?php include('includes/footer.php'); ?>

		</div>

	</div>

	<!-- js -->



	<?php include('includes/scripts.php')?>

</body>

</html>