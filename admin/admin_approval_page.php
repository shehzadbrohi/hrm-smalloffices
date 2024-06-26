<?php include('../includes/session.php')?>
<!-- admin_approval_page.php -->
<!-- approval_page.php -->
<?php include('includes/header.php')?>


<body>
<!-- process_admin_approval.php -->

<?php
// Assuming you have a database connection established

if (isset($_POST['request_id'])) {
        // Retrieve form data
    $requestId = $_POST['request_id'];

    // Check if 'admin_approve' or 'admin_reject' button was clicked
    if (isset($_POST['admin_approve'])) {
        // Update Admin approval status to 'Approved' in the database
        $sql = "UPDATE request_data SET admin_approval_status = 'Approved' WHERE request_id = $requestId";
    } elseif (isset($_POST['admin_reject'])) {
        // Update Admin approval status to 'Rejected' in the database
        $sql = "UPDATE request_data SET admin_approval_status = 'Rejected' WHERE request_id = $requestId";
    }

    if (mysqli_query($conn, $sql)) {
        echo "CEO approval status updated successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
} else {
    echo "Invalid request method";
}
?>

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
            
			<div class="card-box mb-30">
            <div class="pb-20">

<table class="table table-responsive  hover nowrap">

    <thead>

        <tr>



        <th>NO.</th>
            <th>Requester Name</th>
                <th>Department</th>
                <th>Request Description</th>
                <th>Reason</th>
                <th>Urgency</th>
                <th>Request Date</th>
                <th>CEO Approval</th>


        </tr>

    </thead>

    <tbody>

        

            

<?php
// Assuming you have a database connection established

// Fetch requests with HOD approval status 'Approved'
$sql = "SELECT * FROM request_data WHERE admin_approval_status='Pending'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        // Display request information
        // Display other fields

        ?>

<tr>

<td><?php echo htmlentities($row['request_id']);?></td>
<td><?php echo htmlentities($row['requester_name']);?></td>

<td><?php echo htmlentities($row['department']);?></td>
<td><?php echo htmlentities($row['request_description']);?></td>
<td><?php echo htmlentities($row['reason']);?></td>
<td><?php echo htmlentities($row['urgency']);?></td>
<td><?php echo htmlentities($row['request_date']);?></td>

<td>
    <?php
       // Display approval option for Admin
       echo "<form  method='post'>";
       echo "<input type='hidden' name='request_id' value='" . $row['request_id'] . "'>";
       echo "<button type='submit' class='btn btn-success' name='admin_approve'>Approve</button>";
       echo "<button type='submit' class='btn btn-danger' name='admin_reject'>Reject</button>";
       echo "</form>";

       echo "<hr>";
    ?>
</td>
</tr>
        <?php

     
    }
} else {
    echo "No requests found with HOD approval.";
}
?>

        
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