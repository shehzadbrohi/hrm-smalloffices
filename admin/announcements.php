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
						<div class="d-flex justify-content-between">
							<div class="h5 mb-0">Important Announcments</div>
						
						</div>
<div class="row">

	<?php 
						
						$query = "SELECT * FROM notifications order by n_id DESC";
						$data = mysqli_query($conn, $query);
						
						// Check if the query was successful
						if ($data) {
							// Fetch associative array
							while ($row = mysqli_fetch_assoc($data)) {
								// Access the 'message' column from the $row array
								$message = $row['message'];
								$message_fr = $row['message_fr'];
								$title = $row['notifications_name'];
						
								?>
							<div class="col-lg-12">
								
								<div class="card  bg-light" >
									<div class="card-body">
										<h5 class="card-title "><?php echo $title;?></h5>
										<?php echo $message_fr;?>
										<?php echo "<br>";?>
										<?php echo $message;?>
									</div>
								</div>
								<br>
							</div>
							
							<?php 
							}
							
							// Free the result set
							mysqli_free_result($data);
						} else {
							// Handle the case where the query failed
							echo "Error: " . mysqli_error($conn);
						}
						
						// Close the connection
						mysqli_close($conn);
						
						?>

</div>

					

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