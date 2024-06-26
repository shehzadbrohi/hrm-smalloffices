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

				<h2 class="h3 mb-0">View Employee Daily Report</h2>

			</div>

			<div class="row pb-10">

				<div class="col-xl-3 col-lg-3 col-md-6 mb-20">

					<div class="card-box height-100-p widget-style3">



						<?php

						$sql = "SELECT * FROM tblemployees JOIN tbldailyreport ON tblemployees.emp_id=tbldailyreport.empid WHERE tblemployees.role='RemoteStaff' Order By staffreportdate desc ";

						$query = $dbh -> prepare($sql);

						$query->execute();

						$results=$query->fetchAll(PDO::FETCH_OBJ);

						$empcount=$query->rowCount();

						?>



						<div class="d-flex flex-wrap">

							<div class="widget-data">

								<div class="weight-700 font-24 text-dark"><?php echo($empcount);?></div>

								<div class="font-14 text-secondary weight-500">All Report</div>

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

						<h2 class="text-blue h4">Daily Reports</h2>

					</div>

				<div class="pb-20">

					<table class="table table-responsive hover nowrap" id="mytb">

						<thead>

							<tr>

								<th class="datatable-nosort">View/Print</th>

								<th class="table-plus">Full Name</th>

								<th>Position</th>

								<th>Report Date</th>

								<th>Tasks</th>

								<th>Task Status</th>

							</tr>

						</thead>

						<tbody>

							<tr>

								

								 <?php 

                                    $sql = "SELECT * FROM tblemployees JOIN tbldailyreport ON tblemployees.emp_id=tbldailyreport.empid WHERE tblemployees.role='RemoteStaff' Order By tbldailyreport.staffreportdate desc";

                                    $query = $dbh -> prepare($sql);

                                    $query->execute();

                                    $results=$query->fetchAll(PDO::FETCH_OBJ);

                                    $cnt=1;

                                    if($query->rowCount() > 0)

                                    {

                                    foreach($results as $result)

                                    {               ?>  

  <td>

									   <div class="table-actions">

										<a title="VIEW" href="singlereport.php?id=<?php echo htmlentities($result->id);?>&date=<?php echo htmlentities($result->staffreportdate);?>" data-color="#265ed7"><i class="icon-copy dw dw-eye"></i></a>

									  </div>

								   </td>

								  <td><?php echo htmlentities($result->fullname);?></td>

                                  <td><?php echo htmlentities($result->staffposition);?></td>

                                  <td><?php echo date("d-M-Y", strtotime($result->staffreportdate));?></td>

                                  <?php

                                  //first convert the bullet to its htmlentity , this is safer

 $str = htmlentities($result->finaldescription);



 //split str

$split_str = explode(":-:",$str);



//lets rebuild string using loop

$built_string = "";



foreach($split_str AS $str_item){

    $built_string .= "<li>$str_item</li>";

}











                                  

                                  ?>

                                <td>  <?php echo $str_list  = "<ul>$built_string</ul>";?></td>

                       

                       <?php

                        $str1 = htmlentities($result->finalstatus);



                        //split str

                       $split_str1 = explode(":-:",$str1);

                       

                       //lets rebuild string using loop

                       $built_string1 = "";

                       

                       foreach($split_str1 AS $str_item1){



                        

                        if($str_item1=='70ad45'){

                            

                            $built_string1 .= "<div style='height:50px; width:90px; background-color:#$str_item1'>Completed</div>";

                            

                            }

                            if($str_item1=='fdc010'){

                                

                                $built_string1 .= "<div style='height:50px; width:90px; background-color:#$str_item1'>In-Progress</div>";

                                

                                }

                                if($str_item1=='ed2024'){

                                

                                    $built_string1 .= "<div style='height:50px; width:90px; background-color:#$str_item1'>Rejected</div>";

                                  

                                    }



                        

                       }

                       ?>

                                <td>

                                  

                                        

                                <?php echo $built_string1;?></td>



                           

								 

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