<?php
    include('../includes/config.php');
    $notifications_name =  $_POST["notifications_name"];
    $message            =  $_POST["message"];

    $insert_query = "INSERT INTO notifications(notifications_name,message,active)VALUES('".$notifications_name."','".$message."','1')";
    
    $result = mysqli_query($conn,$insert_query);
    
?>