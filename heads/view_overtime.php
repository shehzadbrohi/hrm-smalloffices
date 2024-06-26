<?php include('../includes/session.php')?>
<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>
<?php include('includes/header.php')?>


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
<?php 
if(isset($_GET['approve'])){

$rmid=$_GET['approve'];

$query="update overtime_requests set hod_approval=1 where id='$rmid'";
$sql=mysqli_query($conn,$query);
echo "<script>alert('Overtime Approved Successfully')</script>";
echo "<script>window.location.assign('view_overtime.php')</script>";

}
else if(isset($_GET['reject'])){

	$rmid=$_GET['reject'];

	$query="update overtime_requests set hod_approval=2 where id='$rmid'";
	$sql=mysqli_query($conn,$query);
	echo "<script>alert('Overtime rejected Successfully')</script>";
	echo "<script>window.location.assign('view_overtime.php')</script>";

}
?>
	<div class="main-container">
		<div class="pd-ltr-20">
			<div class="title pb-20">
				<h2 class="h3 mb-0">Overtime Breakdown</h2>
			</div>
			<div class="row pb-10">
				<div class="col-xl-3 col-lg-3 col-md-6 mb-20">
					<div class="card-box height-100-p widget-style3">

						<?php
						$sql = "SELECT id from overtime_requests ";
						$query = $dbh -> prepare($sql);
						$query->execute();
						$results=$query->fetchAll(PDO::FETCH_OBJ);
						$empcount=$query->rowCount();
						?>

						<div class="d-flex flex-wrap">
							<div class="widget-data">
								<div class="weight-700 font-24 text-dark"><?php echo($empcount);?></div>
								<div class="font-14 text-secondary weight-500">All Applied Overtime</div>
							</div>
							<div class="widget-icon">
								<div class="icon" data-color="#00eccf"><i class="icon-copy dw dw-user-2"></i></div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xl-3 col-lg-3 col-md-6 mb-20">
					<div class="card-box height-100-p widget-style3">

						<?php 
						 $status=1;
						 $query = mysqli_query($conn,"select * from overtime_requests where  hod_approval = '$status'")or die(mysqli_error());
						 $count_reg_staff = mysqli_num_rows($query);
						 ?>

						<div class="d-flex flex-wrap">
							<div class="widget-data">
								<div class="weight-700 font-24 text-dark"><?php echo htmlentities($count_reg_staff); ?></div>
								<div class="font-14 text-secondary weight-500">Approved</div>
							</div>
							<div class="widget-icon">
								<div class="icon" data-color="#09cc06"><span class="icon-copy fa fa-hourglass"></span></div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xl-3 col-lg-3 col-md-6 mb-20">
					<div class="card-box height-100-p widget-style3">

						<?php 
						 $status=0;
						 $query_pend = mysqli_query($conn,"select * from overtime_requests where  hod_approval = '$status'")or die(mysqli_error());
						 $count_pending = mysqli_num_rows($query_pend);
						 ?>

						<div class="d-flex flex-wrap">
							<div class="widget-data">
								<div class="weight-700 font-24 text-dark"><?php echo($count_pending); ?></div>
								<div class="font-14 text-secondary weight-500">Pending</div>
							</div>
							<div class="widget-icon">
								<div class="icon"><i class="icon-copy fa fa-hourglass-end" aria-hidden="true"></i></div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xl-3 col-lg-3 col-md-6 mb-20">
					<div class="card-box height-100-p widget-style3">

						<?php 
						 $status=2;
						 $query_reject = mysqli_query($conn,"select * from overtime_requests where  hod_approval = '$status'")or die(mysqli_error());
						 $count_reject = mysqli_num_rows($query_reject);
						 ?>

						<div class="d-flex flex-wrap">
							<div class="widget-data">
								<div class="weight-700 font-24 text-dark"><?php echo($count_reject); ?></div>
								<div class="font-14 text-secondary weight-500">Rejected</div>
							</div>
							<div class="widget-icon">
								<div class="icon" data-color="#ff5b5b"><i class="icon-copy fa fa-hourglass-o" aria-hidden="true"></i></div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="card-box mb-30">
				<div class="pd-20">
						<h2 class="text-blue h4">View Overtime Details</h2>
					</div>
				<div class="pb-20">
					<table class="table table-responsive hover nowrap" id="mytb">
						<thead>
							<tr>
							<th>HOD STATUS</th>
								<th>CEO/Manager. STATUS</th>
								<th>Employee Name</th>
								<th>Overtime Date</th>
								<th>Start Time</th>
								<th>End Time</th>
								<th>Total Hours</th>
								<th>Details</th>
								
							</tr>
						</thead>
						<tbody>
							<tr>
								
								 <?php 

                                    $sql = "select * FROM overtime_requests JOIN tblemployees ON overtime_requests.employee_id=tblemployees.emp_id WHERE hod_approval=0 and Department='$session_depart' And position!='Social Media Admin';";
                                    $query = $dbh -> prepare($sql);
                                    $query->execute();
                                    $results=$query->fetchAll(PDO::FETCH_OBJ);
                                    $cnt=1;
                                    if($query->rowCount() > 0)
                                    {
                                    foreach($results as $result)
                                    {               ?>  

<td><?php $stats=$result->hod_approval;
                                       if($stats==1){
                                        ?>
                                           <span style="color: green">Approved</span>
                                            <?php } if($stats==2)  { ?>
                                           <span style="color: red">Not Approved</span>
                                            <?php } if($stats==0)  { ?>
												<a class="btn btn-success" href="?approve=<?php echo htmlentities($result->id);?>">Approve</a>
        <a class="btn btn-danger" href="?reject=<?php echo htmlentities($result->id);?>">Reject</a>
	                                       <?php } ?>

                                    </td>
                                    <td><?php $stats=$result->ceo_approval;
                                       if($stats==1){
                                        ?>
                                           <span style="color: green">Approved</span>
                                            <?php } if($stats==2)  { ?>
                                           <span style="color: red">Not Approved</span>
                                            <?php } if($stats==0)  { ?>
	                                       <span style="color: blue">Pending</span>
	                                       <?php } ?>

                                    </td>
							
							<td><?php echo htmlentities($result->first_name ." " .$result->last_name);?></td>
							<td><?php echo htmlentities($result->overtime_date);?></td>
                                  <td><?php echo htmlentities($result->start_time);?></td>
                                  <td><?php echo htmlentities($result->end_time);?></td>
                                  <td><?php echo htmlentities($result->total_hours);?></td>
								  <td><?php echo htmlentities($result->details, ENT_QUOTES, "UTF-8"); ?></td>

                                
							</tr>
							<?php $cnt++;} }?>  
						</tbody>
					</table>
			   </div>
			</div>

			<?php include('includes/footer.php'); ?>
		</div>
	</div>
	<!-- js -->

	<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<?php include('includes/scripts.php')?>

<script>

$('#mytb').DataTable();
</script>
</body>
</html>