<?php include('../includes/session.php')?>
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include('includes/header.php')

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
		<div class="pd-ltr-20">
			

	
			<div class="row">
				<div class="col-lg-12 col-md-6 mb-20">
					<div class="card-box height-100-p pd-20 min-height-200px">
					

						<?php 
$sql="select * from tblmeetings";
$sql1=mysqli_query($conn,$sql);
$data=mysqli_fetch_assoc($sql1);


if($data){


if($data['MeetingType'] === 'person_to_person'){

	?>



	<?php 
						
						$query = "SELECT * FROM tblmeetings where SelectedEmployee='$session_id'";
						$data1 = mysqli_query($conn, $query);
						
						// Check if the query was successful
						if ($data) {
							// Fetch associative array
							while ($row = mysqli_fetch_assoc($data1)) {
								// Access the 'message' column from the $row array
								$purpose = $row['MeetingPurpose'];
								$date = $row['MeetingDate'];
								$time = $row['MeetingTime'];
						
								?>
								<div class="row">
				<div class="col-lg-12 col-md-6 mb-20">
					<div class="card-box height-100-p pd-20 min-height-200px">
						<div class="d-flex justify-content-between">
							<div class="h5 mb-0">Meeting Announcments For You With Khanam Mahtab</div>
							<div class="table-actions">
								<a title="VIEW" href="announcments.php"><i class="icon-copy ion-disc" data-color="#17a2b8"></i></a>	
							</div>
						</div>
<div class="row">
							<div class="col-lg-12">
								
								<div class="card  bg-light" >
									<div class="card-body">
										<h5 class="card-title ">Meeting Purpose: <?php echo $purpose;?></h5>
										Meeting Date: <?php echo $date;?>
										<?php echo "<br>";?>
										Meeting Time: <?php echo $time;?>
									</div>
								</div>
								<br>
							</div>
							
</div>

					

</div>
</div>
</div>

							<?php 
							}
							
							// Free the result set
							mysqli_free_result($data1);
						} else {
							// Handle the case where the query failed
							echo "No meeting Available ";
						}
						
						
						
						?>

	<?php
}
}
else{

}
?>








<?php 
					
					$query = "SELECT * FROM tblmeetings where SelectedDepartment='$session_depart'";
					$data1 = mysqli_query($conn, $query);
					
					// Check if the query was successful
					if ($data) {
						// Fetch associative array
						while ($row = mysqli_fetch_assoc($data1)) {
							// Access the 'message' column from the $row array
							$purpose = $row['MeetingPurpose'];
							$date = $row['MeetingDate'];
							$time = $row['MeetingTime'];
					
							?>
							<div class="row">
			<div class="col-lg-12 col-md-6 mb-20">
				<div class="card-box height-100-p pd-20 min-height-200px">
					<div class="d-flex justify-content-between">
						<div class="h5 mb-0">Meeting Announcments For <?php echo $session_depart;?> Department With Khanam Mahtab</div>
						
					</div>
<div class="row">

						<div class="col-lg-12">
							
							<div class="card  bg-light" >
							<div class="card-body">
										<h5 class="card-title ">Meeting Purpose: <?php echo $purpose;?></h5>
										Meeting Date: <?php echo $date;?>
										<?php echo "<br>";?>
										Meeting Time: <?php echo $time;?>
									</div>
							</div>
							<br>
						</div>
						</div>

				

				</div>
			</div>
	</div>
	
						<?php 
						}
						
						// Free the result set
						mysqli_free_result($data1);
					} else {
						// Handle the case where the query failed
					}
					
					
					
					?>





<?php 
					
					$query = "SELECT * FROM tblmeetings where MeetingType='for_all'";
					$data1 = mysqli_query($conn, $query);
					
					// Check if the query was successful
					if ($data) {
						// Fetch associative array
						while ($row = mysqli_fetch_assoc($data1)) {
							// Access the 'message' column from the $row array
							$purpose = $row['MeetingPurpose'];
							$date = $row['MeetingDate'];
							$time = $row['MeetingTime'];
					
							?>
								<div class="row">
			<div class="col-lg-12 col-md-6 mb-20">
				<div class="card-box height-100-p pd-20 min-height-200px">
					<div class="d-flex justify-content-between">
						<div class="h5 mb-0">Meeting announcements For All With Khanam Mahtab</div>
				
					</div>
<div class="row">

						<div class="col-lg-12">
							
							<div class="card  bg-light" >
							<div class="card-body">
										<h5 class="card-title ">Meeting Purpose: <?php echo $purpose;?></h5>
										Meeting Date: <?php echo $date;?>
										<?php echo "<br>";?>
										Meeting Time: <?php echo $time;?>
									</div>
							</div>
							<br>
						</div>
						</div>

				

				</div>
			</div>
	</div>
						<?php 
						}
						
						// Free the result set
						mysqli_free_result($data1);
					} else {
						// Handle the case where the query failed
					}
					
					
					
					?>


	
					

					</div>
				</div>
		</div>

			

		

			<?php include('includes/footer.php'); ?>
		</div>
	</div>
	<!-- js -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

	<?php include('includes/scripts.php')?>

	<script>

$('#mytb').DataTable({
	responsive: true
});
	</script>
</body>
</html>