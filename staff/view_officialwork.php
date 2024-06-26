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

			<div class="title pb-20">

				<h2 class="h3 mb-0">View Requests</h2>

			</div>

			<div class="row pb-10">

				<div class="col-xl-3 col-lg-3 col-md-6 mb-20">

					<div class="card-box height-100-p widget-style3">



						<?php

						$sql = "SELECT id from OfficialWork where empid='$session_id'";

						$query = $dbh -> prepare($sql);

						$query->execute();

						$results=$query->fetchAll(PDO::FETCH_OBJ);

						$empcount=$query->rowCount();

						?>



						<div class="d-flex flex-wrap">

							<div class="widget-data">

								<div class="weight-700 font-24 text-dark"><?php echo($empcount);?></div>

								<div class="font-14 text-secondary weight-500">All Official Works</div>

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

						<h2 class="text-blue h4">Official Work</h2>

					</div>

				<div class="pb-20">

					<table class="table table-responsive  hover nowrap">

						<thead>

							<tr>



                                <th>Employee Name</th>
                                    <th>Department</th>
                                    <th>Type</th>
                                    <th>Reason</th>
                                    <th>Official Work Date</th>
                                    <th>From Time</th>
                                    <th>To Time</th>
                                    <th>CEO Approval</th>


							</tr>

						</thead>

						<tbody>

							

								

								 <?php 

                                    $sql = "SELECT * from OfficialWork where empid = '$session_id'";

                                    $query = $dbh -> prepare($sql);

                                    $query->execute();

                                    $results=$query->fetchAll(PDO::FETCH_OBJ);

                                    $cnt=1;

                                    if($query->rowCount() > 0)

                                    {

                                    foreach($results as $result)

                                    {               ?>  

<tr>
								  <td><?php echo htmlentities($result->empname);?></td>

                                  <td><?php echo htmlentities($result->empdepartment);?></td>

                                  <td><?php echo htmlentities($result->request_type);?></td>
                                  <td><?php echo htmlentities($result->reason);?></td>
                                  <td><?php echo htmlentities($result->work_date);?></td>
                                  <td><?php echo htmlentities($result->from_time);?></td>
                                  <td><?php echo htmlentities($result->to_time);?></td>
                                  <td><?php echo htmlentities($result->admin_approval);?></td>
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



	<?php include('includes/scripts.php')?>

</body>

</html>