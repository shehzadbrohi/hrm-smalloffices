<?php include('../includes/session.php')?>
<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

include('includes/header.php');
include('../sendmail.php');
?>


<?php 
  if(isset($_POST['btnsubmit']))
  {
    $content = $_POST['content'];
    $notifications_name = $_POST['notifications_name'];
	$new_column_content = $_POST['new_column_content']; // New input from the form

	echo "Notifications Name: $notifications_name<br>";
	echo "Content: $content<br>";
	echo "New Column Content: $new_column_content<br>";

	
	$stmt = $conn->prepare("INSERT INTO notifications (notifications_name, message, message_fr, active) VALUES (?, ?, ?, 1)");
    $stmt->bind_param("sss", $notifications_name, $content, $new_column_content);
    $insert_query = $stmt->execute();
    $stmt->close();

// Query to fetch email addresses
$qur = mysqli_query($conn, "SELECT EmailId FROM tblemployees");

// Initialize an empty array to store email addresses
$emailArray = array();

// Loop through the result set and extract email addresses
while ($datanot = mysqli_fetch_assoc($qur)) {
    $emailArray[] = $datanot['EmailId'];
}
	
var_dump($emailArray);

if($insert_query)
    {
		send_broadcast_email($notifications_name, $content,$new_column_content, $emailArray);

      $msg = "Notification Sent Successfully to Staff Members";
    }
    else
    {
      $msg = "Error";
    }
  }
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



	<div class="mobile-menu-overlay"></div>



	<div class="main-container">

		<div class="pd-ltr-20 xs-pd-20-10">

			<div class="min-height-200px">

				<div class="page-header">

					<div class="row">

						<div class="col-md-6 col-sm-12">

							<div class="title">

								<h4>Announcement Form</h4>

							</div>
				
                 

							<nav aria-label="breadcrumb" role="navigation">

								<ol class="breadcrumb">

									<li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>

									<li class="breadcrumb-item active" aria-current="page">Announcement Form</li>

								</ol>

							</nav>

						</div>

					</div>

				</div>



				<div class="pd-20 card-box mb-30">

					<div class="clearfix">

						<div class="pull-left">
						<div class="error"><?php if(!empty($msg)){ echo $msg; } ?></div>

							<h4 class="text-blue h4">Announcement Form</h4>

							<p class="mb-20"></p>

						</div>

					</div>

					<div class="wizard-content">
					<form class="form-horizontal" method="post">
                         <div class="form-group row">
                            <label class="control-label col-md-4" for="notification">Name</label>
                            <div class="col-md-6">
                              <input type="text" name="notifications_name" id="notifications_name" class="form-control" placeholder="Notification name" required/>
                            </div> 
                         </div>   
                         <div class="form-group row">
                            <label class="control-label col-md-4" for="notification">Message (English)</label>
                            <div class="col-md-6">
							<textarea id="content" name="content" class="form-control" required></textarea>
                            </div> 
                         </div>
						 <div class="form-group row">
    <label class="control-label col-md-4" for="new_column_content">Message (Persian)</label>
    <div class="col-md-6">
        <textarea id="new_column_content" name="new_column_content" class="form-control"></textarea>
    </div> 
</div>

                         <div class="form-group row">
                            <div class="col-md-10 col-offset-2" style="text-align:center;">
                            <input type="submit" name="btnsubmit" class="btn btn-danger" value="NOTIFY"/>
                            </div>
                         </div>   
                     </form>       

					</div>

		
    </div>

</div>

<div class="col-md-4 col-sm-12">



					</div>

				</div>



			</div>

			<?php include('includes/footer.php'); ?>

		</div>

	</div>

	<?php include('includes/scripts.php')?>


</body>

</html>