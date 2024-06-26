<!-- approval_page.php -->
<?php include('includes/header.php')?>

<?php include('../includes/session.php')?>

<!-- process_approval.php -->

<?php
// Assuming you have a database connection established

if (isset($_POST['request_id'])) {
    // Retrieve form data
    $requestId = $_POST['request_id'];

    // Check if 'approve' or  'reject' button was clicked
    if (isset($_POST['approve'])) {
        // Update approval status to 'Approved' in the database
        $sql = "UPDATE request_data SET hod_approval_status = 'Approved' WHERE request_id = $requestId";
    } elseif (isset($_POST['reject'])) {
        // Update approval status to 'Rejected' in the database
        $sql = "UPDATE request_data SET hod_approval_status = 'Rejected' WHERE request_id = $requestId";
    }

    if (mysqli_query($conn, $sql)) {
        echo "Approval status updated successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
} else {
    // echo "Invalid request method";
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



<div class="main-container">

    <div class="pd-ltr-20">

        <div class="title pb-20">

            <h2 class="h3 mb-0">Daily Report</h2>

        </div>
<?php
// Assuming you have a database connection established

// Fetch all requests
$sql = "SELECT * FROM request_data WHERE hod_approval_status = 'Pending'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        // Display request information
        echo "Request ID: " . $row['request_id'] . "<br>";
        echo "Requester Name: " . $row['requester_name'] . "<br>";
        // Display other fields

        // Display approval options (approve, reject buttons)
        echo "<form  method='post'>";
        echo "<input type='hidden' name='request_id' value='" . $row['request_id'] . "'>";
        echo "<button type='submit' name='approve'>Approve</button>";
        echo "<button type='submit' name='reject'>Reject</button>";
        echo "</form>";

        echo "<hr>";
    }
} else {
    echo "No requests found.";
}
?>



<?php include('includes/footer.php'); ?>

		</div>

	</div>

	<!-- js -->



	<?php include('includes/scripts.php')?>

</body>

</html>