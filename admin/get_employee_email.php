<?php
include '../includes/config.php';
// Include your database connection or any necessary files here
// For example:
// include('../includes/db_connection.php');

// Assuming you have a database connection, you can proceed to retrieve the email

// Check if the employee_id parameter is provided in the URL
if(isset($_GET['employee_id'])) {
    // Sanitize the input to prevent SQL injection
    $employee_id = mysqli_real_escape_string($conn, $_GET['employee_id']);

    // Query to retrieve the email of the selected employee based on the provided employee ID
    $query = "SELECT EmailId FROM tblemployees WHERE emp_id = '$employee_id'";

    // Execute the query
    $result = mysqli_query($conn, $query);

    if(mysqli_num_rows($result) > 0) {
        // Fetch the result
        $row = mysqli_fetch_assoc($result);
        // Return the email as the response
        echo $row['EmailId'];
    } else {
        // If no matching employee found, return a message
        echo "Employee not found";
    }
} else {
    // If employee_id parameter is not provided, return an error message
    echo "Employee ID not provided";
}
?>