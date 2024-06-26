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
			<div class="card-box pd-20 height-100-p mb-30">
				<div class="row align-items-center">
					<div class="col-md-4 user-icon">
						<img src="../vendors/images/dashboard.svg" alt="">
					</div>
					<div class="col-md-4">

						<?php $query= mysqli_query($conn,"select * from tblemployees where emp_id = '$session_id'")or die(mysqli_error());
								$row = mysqli_fetch_array($query);
						?>

						<h4 class="font-20 weight-500 mb-10 text-capitalize">
							Welcome back <div class="weight-600 font-30 text-blue"><?php echo $row['FirstName']. " " .$row['LastName']; ?>,</div>
						</h4>
						<p class="font-18 max-width-600">You are in portal of dubai based shipping company Karsh.</p>
					</div>

					<div class="col-md-4">

<?php


 $fmt1 = datefmt_create(
          'en_US',
          IntlDateFormatter::FULL,
          IntlDateFormatter::FULL,
          'Asia/Dubai',
          IntlDateFormatter::GREGORIAN
       );

 $fmt = new IntlDateFormatter(
          'ar_SA@calendar=ISLAMIC',
          IntlDateFormatter::FULL,
          IntlDateFormatter::FULL,
          'Asia/Dubai',
          IntlDateFormatter::TRADITIONAL
       );

?>
<h4 class="font-20 weight-500 mb-10 text-capitalize">
	Today's Date:<br>
<?php
 	echo datefmt_format( $fmt1 , time());

?>
	</h4>
<h4 class="font-20 weight-500 mb-10 text-capitalize">
	Islamic Date:<br>
	<?php
 	echo datefmt_format( $fmt , time());

 ?></h4>
	
</div>
				</div>
			</div>

			<div class="row">
			<div class="col-md-3 col-6 mb-20">
				<a href="apply_leaves.php">

					<div class="card-box bg-primary height-50-p pd-20 min-height-100px text-center">
						<img src="../vendors/images/leaverequest.svg" alt="" class="img-fluid" height="80px" width="80px">
						<p class="text-white">Leave</p>
					</div>
				</a>
				</div>
		
	
				<div class="col-md-3 col-6 mb-20">
				<a href="add_report.php">
					<div class="card-box bg-primary height-50-p pd-20 min-height-100px text-center">
						<img src="../vendors/images/dailyreport.svg" alt="" class="img-fluid" height="80px" width="80px">
						<p class="text-white">Report</p>
					</div>
				</a>
				</div>
			
				
			
	
	
			
	
				
	
	
				
			</div>


			

			<div class="card-box mb-30">
				<div class="pd-20">
					<h2 class="text-blue h4">LEAVE HISTORY</h2>
				</div>
				<div class="pb-20">
					<table class="table table-responsive nowrap" id="mytb">
						<thead>
							<tr>
								<th class="table-plus">LEAVE TYPE</th>
								<th>DATE FROM</th>
								<th>DATE TO</th>
								<th>NO. OF DAYS</th>
								<th>HOD STATUS</th>
								<th>CEO/Manager. STATUS</th>
								<th class="datatable-nosort">ACTION</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								
								 <?php 
                                    $sql = "SELECT * from tblleave where empid = '$session_id'";
                                    $query = $dbh -> prepare($sql);
                                    $query->execute();
                                    $results=$query->fetchAll(PDO::FETCH_OBJ);
                                    $cnt=1;
                                    if($query->rowCount() > 0)
                                    {
                                    foreach($results as $result)
                                    {               ?>  

								  <td><?php echo htmlentities($result->LeaveType);?></td>
                                  <td><?php echo htmlentities($result->FromDate);?></td>
                                  <td><?php echo htmlentities($result->ToDate);?></td>
                                  <td><?php echo htmlentities($result->num_days);?></td>
                                  <td><?php $stats=$result->HodRemarks;
                                       if($stats==1){
                                        ?>
                                           <span style="color: green">Approved</span>
                                            <?php } if($stats==2)  { ?>
                                           <span style="color: red">Not Approved</span>
                                            <?php } if($stats==0)  { ?>
	                                       <span style="color: blue">Pending</span>
	                                       <?php } ?>

                                    </td>
                                    <td><?php $stats=$result->RegRemarks;
                                       if($stats==1){
                                        ?>
                                           <span style="color: green">Approved</span>
                                            <?php } if($stats==2)  { ?>
                                           <span style="color: red">Not Approved</span>
                                            <?php } if($stats==0)  { ?>
	                                       <span style="color: blue">Pending</span>
	                                       <?php } ?>

                                    </td>
								   <td>
									  <div class="table-actions">
										<a title="VIEW" href="view_leaves.php?edit=<?php echo htmlentities($result->id);?>" data-color="#265ed7"><i class="icon-copy dw dw-eye"></i></a>
									  </div>
								   </td>
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

$('#mytb').DataTable({
	responsive: true
});
	</script>
</body>
</html>