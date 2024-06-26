<?php
session_start();
include('includes/config.php');
if(isset($_POST['signin']))
{
	$username=$_POST['username'];
	$password=md5($_POST['password']);

	$sql ="SELECT * FROM tblemployees where EmailId ='$username' AND Password ='$password'";
	$query= mysqli_query($conn, $sql);
	$count = mysqli_num_rows($query);
	if($count > 0)
	{
		while ($row = mysqli_fetch_assoc($query)) {
		    if ($row['role'] == 'Admin') {
		    	$_SESSION['alogin']=$row['emp_id'];
		    	$_SESSION['arole']=$row['role'];
		    	$_SESSION['adepart']=$row['Department'];
				
			    //login active status
                $emp_id =  $_SESSION['alogin'];
                $result = mysqli_query($conn, "UPDATE tblemployees SET status='Online' WHERE emp_id='$emp_id'");

			 	echo "<script type='text/javascript'> document.location = 'admin/admin_dashboard.php'; </script>";
		    }
		    elseif ($row['role'] == 'Staff') {
		    	$_SESSION['alogin']=$row['emp_id'];
		    	$_SESSION['arole']=$row['role'];
		    	$_SESSION['adepart']=$row['Department'];
				
				//login active status
                $emp_id =  $_SESSION['alogin'];
                $result = mysqli_query($conn, "UPDATE tblemployees SET status='Online' WHERE emp_id='$emp_id'");

			 	echo "<script type='text/javascript'> document.location = 'staff/index.php'; </script>";
		    }
			elseif ($row['role'] == 'RemoteStaff') {
		    	$_SESSION['alogin']=$row['emp_id'];
		    	$_SESSION['arole']=$row['role'];
		    	$_SESSION['adepart']=$row['Department'];
				
				//login active status
                $emp_id =  $_SESSION['alogin'];
                $result = mysqli_query($conn, "UPDATE tblemployees SET status='Online' WHERE emp_id='$emp_id'");

			 	echo "<script type='text/javascript'> document.location = 'remote-staff/index.php'; </script>";
		    }
		    else {
		    	$_SESSION['alogin']=$row['emp_id'];
		    	$_SESSION['arole']=$row['role'];
		    	$_SESSION['adepart']=$row['Department'];
				
			    //login active status
                $emp_id =  $_SESSION['alogin'];
                $result = mysqli_query($conn, "UPDATE tblemployees SET status='Online' WHERE emp_id='$emp_id'");

			 	echo "<script type='text/javascript'> document.location = 'heads/index.php'; </script>";
		    }

		}

	} 
	else{
	  echo "<script>alert('Invalid Details');</script>";

	}

}
// $_SESSION['alogin']=$_POST['username'];
// 	echo "<script type='text/javascript'> document.location = 'changepassword.php'; </script>";
?>

<!DOCTYPE html>
<html>
<head>
	<!-- Basic Page Info -->
	<meta charset="utf-8">
	<title>Teamnet by Karsh</title>

	<!-- Site favicon -->
	<link rel="apple-touch-icon" sizes="180x180" href="vendors/images/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="vendors/images/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="vendors/images/favicon-16x16.png">

	<!-- Mobile Specific Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<!-- Google Font -->
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="vendors/styles/core.css">
	<link rel="stylesheet" type="text/css" href="vendors/styles/icon-font.min.css">
	<link rel="stylesheet" type="text/css" href="vendors/styles/style.css">
	<style>
	
	
		.bg-official {
			background-color:#29265b;
		}

		@media (max-width: 767px) {
    /* Styles for mobile devices go here */
   .leftside{
	display:none;
   }
   .leftside,.rightside{
	height:100vh;
}

    /* Add more styles as needed for mobile devices */
}

.leftside,.rightside{
	height:50vh;
	width:100%;
}
	</style>


</head>
<body class="login-page" style="background-color:#29265b;">

	
			<div class="row  no-gutters" >
				<div class="col-md-6 no-gutters" >
					<div class="leftside  justify-content-center align-items-center">

						<img src="vendors/images/sidebarlogin.jpg" alt="" class="img-fluid sidebarimg" >
						
					</div>
				</div>
				<div class="col-md-6 no-gutters" >
				<div class="rightside  justify-content-center align-items-center">
					<div class="login-box bg-official box-shadow border-radius-10">
						<div class="login-title text-center">
							<h2 class="text-center text-primary">Welcome To Teamnet</h2>
							<img src="vendors/images/teamnetlogo.svg"  class="img-fluid" style="width:70%!important;" alt="">
						</div>
						<form name="signin" method="post">
						
							<div class="input-group custom">
								<input type="text" class="form-control form-control-lg" placeholder="Email ID" name="username" id="username">
								<div class="input-group-append custom">
									<span class="input-group-text"><i class="icon-copy fa fa-envelope-o" aria-hidden="true"></i></span>
								</div>
							</div>
							<div class="input-group custom">
								<input type="password" class="form-control form-control-lg" placeholder="**********"name="password" id="password">
								<div class="input-group-append custom">
									<span class="input-group-text"><i class="dw dw-padlock1"></i></span>
								</div>
							</div>
							<div class="row pb-30">
								
								<div class="col-sm-12">
									<p class="text-white">If you forget the password, contact the IT department</p>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-12">
									<div class="input-group mb-0">
									   <input class="btn btn-primary btn-lg btn-block " name="signin" id="signin" type="submit" value="Sign In" style="background-color:#d1b270!important; color:black;">
									</div>
								</div>


								
								<div class="col-sm-12 text-center justify-content-center mt-5">
<img src="vendors/images/companies.svg" class="img-fluid" style="width:50%;" alt="">
<p class="text-white">Powered by karsh co IT Department</p>

							</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- js -->
	<script src="vendors/scripts/core.js"></script>
	<script src="vendors/scripts/script.min.js"></script>
	<script src="vendors/scripts/process.js"></script>
	<script src="vendors/scripts/layout-settings.js"></script>
</body>
</html>