<?php include('../includes/session.php');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>
<?php include('includes/header.php')?>
<body>
	<div class="pre-loader">
		<div class="pre-loader-box">
			<div class="loader-logo"><img src="../vendors/images/deskapp-logo.svg" alt=""></div>
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

	<?php
// Assuming you have a database connection established

if (isset($_POST['request_id'])) {
        // Retrieve form data
    $requestId = $_POST['request_id'];

    // Check if 'admin_approve' or 'admin_reject' button was clicked
    if (isset($_POST['confirm'])) {
        // Update Admin approval status to 'Approved' in the database
        $sql = "UPDATE tblbusiness_trips SET trip_status = '1' WHERE trip_id = $requestId";
    } elseif (isset($_POST['reject'])) {
        // Update Admin approval status to 'Rejected' in the database
        $sql = "UPDATE tblbusiness_trips SET trip_status = '2' WHERE trip_id = $requestId";
    }

    if (mysqli_query($conn, $sql)) {
        echo "Business Trip Confirmed updated successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
} else {
    echo "Invalid request method";
}
?>
	<div class="main-container">
		<div class="pd-ltr-20">
			<div class="page-header">
				<div class="row">
						<div class="col-md-6 col-sm-12">
							<div class="title">
								<h4>Business Trip History</h4>
							</div>
							<nav aria-label="breadcrumb" role="navigation">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="admin_dashboard.php">Dashboard</a></li>
									<li class="breadcrumb-item active" aria-current="page">Business Trip History</li>
								</ol>
							</nav>
						</div>
				</div>
			</div>

			<div class="card-box mb-30">
				<div class="pd-20">
						<h2 class="text-blue h4">Business Trip History</h2>
					</div>
				<div class="pb-20">
					<table class="table table-responsive hover nowrap">
						<thead>
							<tr>
								<th class="table-plus datatable-nosort">STAFF NAME</th>
								<th>Meeting Purpose</th>
								<th>Business Trip From</th>
								<th>Business Trip To</th>
								<th>Location</th>
								<th>Note</th>
								<th>Trip Confirmation</th>
							</tr>
						</thead>
						<tbody>
							<tr>

								<?php 
								$sql = "SELECT em.FirstName,em.LastName,bt.Purpose,bt.trip_id,bt.DateFrom,bt.DateTo,bt.Location,bt.emp_id,bt.Note,bt.trip_status FROM tblbusiness_trips bt JOIN tblemployees em ON bt.emp_id=em.emp_id where bt.emp_id='$session_id'";
									$query = mysqli_query($conn, $sql) or die(mysqli_error());
									while ($row = mysqli_fetch_array($query)) {
								 ?>  
								<td><?php echo $row['FirstName']." ".$row['LastName'];?></td>
	                            <td><?php echo $row['Purpose']; ?></td>
	                            <td><?php echo $row['DateFrom']; ?></td>
	                            <td><?php echo $row['DateTo']; ?></td>
	                            <td><?php echo $row['Location']; ?></td>
	                            <td><?php echo $row['Note']; ?></td>
								<td><?php $stats=$row['trip_status'];
	                             if($stats==1){
	                              ?>
	                                  <span style="color: green">Confirmed</span>
	                                  <?php } if($stats==2)  { ?>
	                                 <span style="color: red">Rejected</span>
	                                  <?php } if($stats==0)  { ?>
    <form  method='post'>
       <input type='hidden' name='request_id' value='<?php echo $row['trip_id'] ?>'>
       <button type='submit' class='btn btn-success' name='confirm'>Confirm</button>
       <button type='submit' class='btn btn-danger' name='reject'>Reject</button>
       </form>
<hr>
	                             <?php } ?>
	                            </td>
	                       
							
							</tr>
							<?php }?>
						</tbody>
					</table>
			   </div>
			</div>

			<?php include('includes/footer.php'); ?>
		</div>
	</div>
	<!-- js -->

	<script src="../vendors/scripts/core.js"></script>
	<script src="../vendors/scripts/script.min.js"></script>
	<script src="../vendors/scripts/process.js"></script>
	<script src="../vendors/scripts/layout-settings.js"></script>
	<script src="../src/plugins/apexcharts/apexcharts.min.js"></script>
	<script src="../src/plugins/datatables/js/jquery.dataTables.min.js"></script>
	<script src="../src/plugins/datatables/js/dataTables.bootstrap4.min.js"></script>
	<script src="../src/plugins/datatables/js/dataTables.responsive.min.js"></script>
	<script src="../src/plugins/datatables/js/responsive.bootstrap4.min.js"></script>

	<!-- buttons for Export datatable -->
	<script src="../src/plugins/datatables/js/dataTables.buttons.min.js"></script>
	<script src="../src/plugins/datatables/js/buttons.bootstrap4.min.js"></script>
	<script src="../src/plugins/datatables/js/buttons.print.min.js"></script>
	<script src="../src/plugins/datatables/js/buttons.html5.min.js"></script>
	<script src="../src/plugins/datatables/js/buttons.flash.min.js"></script>
	<script src="../src/plugins/datatables/js/vfs_fonts.js"></script>
	
	<script src="../vendors/scripts/datatable-setting.js"></script></body>
</body>
</html>