<?php include('../includes/session.php')?>
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
				<a href="leaves.php">

					<div class="card-box bg-primary height-50-p pd-20 min-height-100px text-center">
						<img src="../vendors/images/leave.svg" alt="" class="img-fluid" height="80px" width="80px">
						<p class="text-white">Leave</p>
					</div>
				</a>
				</div>
				<div class="col-md-3 col-6 mb-20">
				<a href="chat.php?sender=21&receiver=10">
					<div class="card-box bg-primary height-50-p pd-20 min-height-100px text-center">
						<img src="../vendors/images/chat.svg" alt="" class="img-fluid" height="80px" width="80px">
						<p class="text-white">Chat</p>
					</div>
				</a>
				</div>
	
				<div class="col-md-3 col-6 mb-20">
				<a href="view_report.php">
					<div class="card-box bg-primary height-50-p pd-20 min-height-100px text-center">
						<img src="../vendors/images/dailyreport.svg" alt="" class="img-fluid" height="80px" width="80px">
						<p class="text-white">Report</p>
					</div>
				</a>
				</div>
				<div class="col-md-3 col-6 mb-20">
					<a href="announcements.php">

						<div class="card-box bg-primary height-50-p pd-20 min-height-100px text-center">
							<img src="../vendors/images/news.svg" alt="" class="img-fluid" height="80px" width="80px">
							<p class="text-white">News</p>
						</div>
					</a>
				</div>
				
				<div class="col-md-3 col-6 mb-20">
				<a href="admin_approval_page.php">
					<div class="card-box bg-primary height-50-p pd-20 min-height-100px text-center">
						<img src="../vendors/images/request.svg" alt="" class="img-fluid" height="80px" width="80px">
						<p class="text-white">Request</p>
					</div>
				</a>
				</div>
	
	
			
				<div class="col-md-3 col-6 mb-20">
				<a href="view_officialwork.php">
					<div class="card-box bg-primary height-50-p pd-20 min-height-100px text-center">
						<img src="../vendors/images/timing.svg" alt="" class="img-fluid" height="80px" width="80px">
						<p class="text-white">Official Work</p>
					</div>
				</a>
				</div>
	
				
	
				<div class="col-md-3 col-6 mb-20">
					<a href="add_businesstrip.php">

						<div class="card-box bg-primary height-50-p pd-20 min-height-100px text-center">
							<img src="../vendors/images/businesstrip.svg" alt="" class="img-fluid" height="80px" width="80px">
							<p class="text-white">Business</p>
						</div>
					</a>
				</div>
	
				<div class="col-md-3 col-6 mb-20">
					<div class="card-box bg-primary height-50-p pd-20 min-height-100px text-center">
						<img src="../vendors/images/event.svg" alt="" class="img-fluid" height="80px" width="80px">
						<p class="text-white">Event</p>
					</div>
				</div>
	
				
			</div>


			<div class="row">
				<div class="col-lg-12 col-md-6 mb-20">
					<div class="card-box height-100-p pd-20 min-height-200px">
						<div class="d-flex justify-content-between">
							<div class="h5 mb-0">Important Announcments</div>
							<div class="table-actions">
								<a title="VIEW" href="announcements.php"><i class="icon-copy ion-disc" data-color="#17a2b8"></i></a>	
							</div>
						</div>
<div class="row">

	<?php 
						
						$query = "SELECT * FROM notifications order by n_id DESC limit 3";
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
						
					
						
						?>

</div>

					

					</div>
				</div>
		</div>
		<div class="title pb-20">
				<h2 class="h3 mb-0">Data Information</h2>
			</div>
			<div class="row pb-10">
				<div class="col-xl-3 col-lg-3 col-md-6 mb-20">
					<div class="card-box height-100-p widget-style3">

						<?php
						$sql = "SELECT emp_id from tblemployees";
						$query = $dbh -> prepare($sql);
						$query->execute();
						$results=$query->fetchAll(PDO::FETCH_OBJ);
						$empcount=$query->rowCount();
						?>

						<div class="d-flex flex-wrap">
							<div class="widget-data">
								<div class="weight-700 font-24 text-dark"><?php echo($empcount);?></div>
								<div class="font-14 text-secondary weight-500">Total Staffs</div>
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
						$sql = "SELECT id from tblleave where RegRemarks=:status";
						$query = $dbh -> prepare($sql);
						$query->bindParam(':status',$status,PDO::PARAM_STR);
						$query->execute();
						$results=$query->fetchAll(PDO::FETCH_OBJ);
						$leavecount=$query->rowCount();
						?>        

						<div class="d-flex flex-wrap">
							<div class="widget-data">
								<div class="weight-700 font-24 text-dark"><?php echo htmlentities($leavecount); ?></div>
								<div class="font-14 text-secondary weight-500">Approved Leave</div>
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
						$sql = "SELECT id from tblleave where RegRemarks=:status";
						$query = $dbh -> prepare($sql);
						$query->bindParam(':status',$status,PDO::PARAM_STR);
						$query->execute();
						$results=$query->fetchAll(PDO::FETCH_OBJ);
						$leavecount=$query->rowCount();
						?>        

						<div class="d-flex flex-wrap">
							<div class="widget-data">
								<div class="weight-700 font-24 text-dark"><?php echo($leavecount); ?></div>
								<div class="font-14 text-secondary weight-500">Pending Leave</div>
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
						$sql = "SELECT id from tblleave where RegRemarks=:status";
						$query = $dbh -> prepare($sql);
						$query->bindParam(':status',$status,PDO::PARAM_STR);
						$query->execute();
						$results=$query->fetchAll(PDO::FETCH_OBJ);
						$leavecount=$query->rowCount();
						?>  

						<div class="d-flex flex-wrap">
							<div class="widget-data">
								<div class="weight-700 font-24 text-dark"><?php echo($leavecount); ?></div>
								<div class="font-14 text-secondary weight-500">Rejected Leave</div>
							</div>
							<div class="widget-icon">
								<div class="icon" data-color="#ff5b5b"><i class="icon-copy fa fa-hourglass-o" aria-hidden="true"></i></div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-lg-4 col-md-6 mb-20">
					<div class="card-box height-100-p pd-20 min-height-200px">
						<div class="d-flex justify-content-between pb-10">
							<div class="h5 mb-0">Department Heads</div>
							<div class="table-actions">
								<a title="VIEW" href="staff.php"><i class="icon-copy ion-disc" data-color="#17a2b8"></i></a>	
							</div>
						</div>
						<div class="user-list">
							<ul>
								<?php
		                         $query = mysqli_query($conn,"select * from tblemployees where role='HOD' ORDER BY tblemployees.emp_id desc limit 4") or die(mysqli_error());
		                         while ($row = mysqli_fetch_array($query)) {
		                         $id = $row['emp_id'];
		                             ?>

								<li class="d-flex align-items-center justify-content-between">
									<div class="name-avatar d-flex align-items-center pr-2">
										<div class="avatar mr-2 flex-shrink-0">
											<img src="<?php echo (!empty($row['location'])) ? '../uploads/'.$row['location'] : '../uploads/NO-IMAGE-AVAILABLE.jpg'; ?>" class="border-radius-100 box-shadow" width="50" height="50" alt="">
										</div>
										<div class="txt">
											<span class="badge badge-pill badge-sm" data-bgcolor="#e7ebf5" data-color="#265ed7"><?php echo $row['Department']; ?></span>
											<div class="font-14 weight-600"><?php echo $row['FirstName'] . " " . $row['LastName']; ?></div>
											<div class="font-12 weight-500" data-color="#b2b1b6"><?php echo $row['EmailId']; ?></div>
										</div>
									</div>
									<div class="font-12 weight-500" data-color="#17a2b8"><?php echo $row['Phonenumber']; ?></div>
								</li>
								<?php }?>
							</ul>
						</div>
					</div>
				</div>
			
						<div class="col-lg-4 col-md-6 mb-20">
					<div class="card-box height-100-p pd-20 min-height-200px">
						<div class="d-flex justify-content-between">
							<div class="h5 mb-0">Staff</div>
							<div class="table-actions">
								<a title="VIEW" href="staff.php"><i class="icon-copy ion-disc" data-color="#17a2b8"></i></a>	
							</div>
						</div>

						<div class="user-list">
							<ul>
								<?php
		                         $query = mysqli_query($conn,"select * from tblemployees where role = 'Staff' ORDER BY tblemployees.emp_id desc limit 4") or die(mysqli_error());
		                         while ($row = mysqli_fetch_array($query)) {
		                         $id = $row['emp_id'];
		                             ?>

								<li class="d-flex align-items-center justify-content-between">
									<div class="name-avatar d-flex align-items-center pr-2">
										<div class="avatar mr-2 flex-shrink-0">
											<img src="<?php echo (!empty($row['location'])) ? '../uploads/'.$row['location'] : '../uploads/NO-IMAGE-AVAILABLE.jpg'; ?>" class="border-radius-100 box-shadow" width="50" height="50" alt="">
										</div>
										<div class="txt">
											<span class="badge badge-pill badge-sm" data-bgcolor="#e7ebf5" data-color="#265ed7"><?php echo $row['Department']; ?></span>
											<div class="font-14 weight-600"><?php echo $row['FirstName'] . " " . $row['LastName']; ?></div>
											<div class="font-12 weight-500" data-color="#b2b1b6"><?php echo $row['EmailId']; ?></div>
										</div>
									</div>
									<div class="font-12 weight-500" data-color="#17a2b8"><?php echo $row['Phonenumber']; ?></div>
								</li>
								<?php }?>
							</ul>
						</div>
					</div>
				</div>
			</div>
			<?php 
		
			if($session_id == 2){
				?>


<div class="card-box mb-30">
				<div class="pd-20">
						<h2 class="text-blue h4">LATEST LEAVE APPLICATIONS OF STAFF</h2>
					</div>
				<div class="pb-20">
					<table class="table table-responsive hover nowrap">
						<thead>
							<tr>
								<th class="table-plus datatable-nosort">STAFF NAME</th>
								<th>LEAVE TYPE</th>
								<th>APPLIED DATE</th>
								<th>MY REMARKS</th>
								<th>CEO REMARKS</th>
								<th class="datatable-nosort">ACTION</th>
							</tr>
						</thead>
						<tbody>
							<tr>


								<?php $sql = "SELECT tblleave.id as lid,tblemployees.FirstName,tblemployees.LastName,tblemployees.emp_id,tblemployees.Gender,tblemployees.Phonenumber,tblemployees.EmailId,tblemployees.Av_leave,tblemployees.Position_Staff,tblemployees.Staff_ID,tblleave.LeaveType,tblleave.ToDate,tblleave.FromDate,tblleave.PostingDate,tblleave.RequestedDays,tblleave.DaysOutstand,tblleave.Sign,tblleave.WorkCovered,tblleave.HodRemarks,tblleave.RegRemarks,tblleave.HodSign,tblleave.RegSign,tblleave.HodDate,tblleave.RegDate,tblleave.num_days from tblleave join tblemployees on tblleave.empid=tblemployees.emp_id where (tblemployees.role = 'RemoteStaff')  and Department = '$session_depart' order by lid desc limit 5";
									$query = $dbh -> prepare($sql);
									$query->execute();
									$results=$query->fetchAll(PDO::FETCH_OBJ);
									$cnt=1;
									if($query->rowCount() > 0)
									{
									foreach($results as $result)
									{         
								 ?>  

								<td class="table-plus">
									<div class="name-avatar d-flex align-items-center">
										<div class="txt mr-2 flex-shrink-0">
											<b><?php echo htmlentities($cnt);?></b>
										</div>
										<div class="txt">
											<div class="weight-600"><?php echo htmlentities($result->FirstName." ".$result->LastName);?></div>
										</div>
									</div>
								</td>
								<td><?php echo htmlentities($result->LeaveType);?></td>
	                            <td><?php echo htmlentities($result->PostingDate);?></td>
								<td><?php $stats=$result->HodRemarks;
	                             if($stats==1){
	                              ?>
	                                  <span style="color: green">Approved</span>
	                                  <?php } if($stats==2)  { ?>
	                                 <span style="color: red">Rejected</span>
	                                  <?php } if($stats==0)  { ?>
	                             <span style="color: blue">Pending</span>
	                             <?php } ?>
	                            </td>
	                            <td><?php $stats=$result->RegRemarks;
	                             if($stats==1){
	                              ?>
	                                  <span style="color: green">Approved</span>
	                                  <?php } if($stats==2)  { ?>
	                                 <span style="color: red">Rejected</span>
	                                  <?php } if($stats==0)  { ?>
	                             <span style="color: blue">Pending</span>
	                             <?php } ?>
	                            </td>
								<td>
									<div class="dropdown">
										<a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
											<i class="dw dw-more"></i>
										</a>
										<div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
											<a class="dropdown-item" href="leave_details.php?leaveid=<?php echo htmlentities($result->lid);?>"><i class="dw dw-eye"></i> View</a>
											<a class="dropdown-item" href="admin_dashboard.php?leaveid=<?php echo htmlentities($result->lid);?>"><i class="dw dw-delete-3"></i> Delete</a>
										</div>
									</div>
								</td>
							</tr>
							<?php $cnt++;} }?>
						</tbody>
					</table>
			   </div>
			</div>

<?php

			}
			?>
			<div class="card-box mb-30">
				<div class="pd-20">
						<h2 class="text-blue h4">LATEST LEAVE APPLICATIONS</h2>
					</div>
				<div class="pb-20">
					<table class="table table-responsive hover nowrap" id="mytb">
						<thead>
							<tr>
								<th class="table-plus datatable-nosort">STAFF NAME</th>
								<th>LEAVE TYPE</th>
								<th>APPLIED DATE</th>
								<th>HOD STATUS</th>
								<th>CEO STATUS</th>
								<th class="datatable-nosort">ACTION</th>
							</tr>
						</thead>
						<tbody>
							<tr>

								<?php 
								$status=1;
								$sql = "SELECT tblleave.id as lid,tblemployees.FirstName,tblemployees.LastName,tblemployees.emp_id,tblemployees.Gender,tblemployees.Phonenumber,tblemployees.EmailId,tblemployees.Av_leave,tblemployees.Position_Staff,tblemployees.Staff_ID,tblleave.LeaveType,tblleave.ToDate,tblleave.FromDate,tblleave.PostingDate,tblleave.RequestedDays,tblleave.DaysOutstand,tblleave.Sign,tblleave.WorkCovered,tblleave.HodRemarks,tblleave.RegRemarks,tblleave.HodSign,tblleave.RegSign,tblleave.HodDate,tblleave.RegDate,tblleave.num_days from tblleave join tblemployees on tblleave.empid=tblemployees.emp_id where tblleave.HodRemarks= '$status' order by         CASE WHEN tblleave.RegRemarks = 'pending' THEN 0 ELSE 1 END, lid DESC limit 5";
									$query = mysqli_query($conn, $sql) or die(mysqli_error());
									while ($row = mysqli_fetch_array($query)) {
									  $cnt=1;
								 ?>  

								<td class="table-plus">
									<div class="name-avatar d-flex align-items-center">
										<div class="txt mr-2 flex-shrink-0">
											<b><?php echo htmlentities($cnt);?></b>
										</div>
										<div class="txt">
											<div class="weight-600"><?php echo $row['FirstName']." ".$row['LastName'];?></div>
										</div>
									</div>
								</td>
								<td><?php echo $row['LeaveType']; ?></td>
	                            <td><?php echo $row['PostingDate']; ?></td>
								<td><?php $stats=$row['HodRemarks'];
	                             if($stats==1){
	                              ?>
	                                  <span style="color: green">Approved</span>
	                                  <?php } if($stats==2)  { ?>
	                                 <span style="color: red">Rejected</span>
	                                  <?php } if($stats==0)  { ?>
	                             <span style="color: blue">Pending</span>
	                             <?php } ?>
	                            </td>
	                            <td><?php $stats=$row['RegRemarks'];
	                             if($stats==1){
	                              ?>
	                                  <span style="color: green">Approved</span>
	                                  <?php } if($stats==2)  { ?>
	                                 <span style="color: red">Rejected</span>
	                                  <?php } if($stats==0)  { ?>
	                             <span style="color: blue">Pending</span>
	                             <?php } ?>
	                            </td>
								<td>
									<div class="dropdown">
										<a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
											<i class="dw dw-more"></i>
										</a>
										<div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
											<a class="dropdown-item" href="leave_details.php?leaveid=<?php echo $row['lid']; ?>"><i class="dw dw-eye"></i> View</a>
											<a class="dropdown-item" href="admin_dashboard.php?leaveid=<?php echo $row['lid']; ?>"><i class="dw dw-delete-3"></i> Delete</a>
										</div>
									</div>
								</td>
							</tr>
							<?php $cnt++; }?>
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
	
	<!-- js -->



<script>

$('#mytb').DataTable({
responsive: true
});
</script>
</body>
</html>