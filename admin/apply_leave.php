<?php include('../includes/session.php');?>
<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

?>
<?php include('../includes/config.php'); ?>
<html>
<head>
    <!-- Basic Page Info -->
    <meta charset="utf-8">
    <title>Karsh TeamUp</title>
    <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.css">
  
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>

    <link type="text/css" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/south-street/jquery-ui.css" rel="stylesheet"> 
    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.9.0/jquery-ui.min.js"></script>

    <!-- Site favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="../vendors/images/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../vendors/images/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../vendors/images/favicon-16x16.png">

    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- CSS -->

    <!-- jQuery UI Signature core CSS -->
    <link href="//ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/south-street/jquery-ui.css" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="../vendors/styles/core.css">
    <link rel="stylesheet" type="text/css" href="../vendors/styles/icon-font.min.css">
    <link rel="stylesheet" type="text/css" href="../src/plugins/jquery-steps/jquery.steps.css">
    <link rel="stylesheet" type="text/css" href="../src/plugins/datatables/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="../src/plugins/datatables/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="../vendors/styles/style.css">



    <link href="../src/css/jquery.signature.css" rel="stylesheet">
    <script src="../src/js/jquery.signature.js"></script>
  <script>
    $ = jQuery;
(function ($) {

    // Detect touch support
    $.support.touch = 'ontouchend' in document;

    // Ignore browsers without touch support
    if (!$.support.touch) {
        return;
    }

    var mouseProto = $.ui.mouse.prototype,
            _mouseInit = mouseProto._mouseInit,
            _mouseDestroy = mouseProto._mouseDestroy,
            touchHandled;

    /**
     * Simulate a mouse event based on a corresponding touch event
     * @param {Object} event A touch event
     * @param {String} simulatedType The corresponding mouse event
     */
    function simulateMouseEvent(event, simulatedType) {

        // Ignore multi-touch events
        if (event.originalEvent.touches.length > 1) {
            return;
        }

        event.preventDefault();

        var touch = event.originalEvent.changedTouches[0],
                simulatedEvent = document.createEvent('MouseEvents');

        // Initialize the simulated mouse event using the touch event's coordinates
        simulatedEvent.initMouseEvent(
                simulatedType, // type
                true, // bubbles                    
                true, // cancelable                 
                window, // view                       
                1, // detail                     
                touch.screenX, // screenX                    
                touch.screenY, // screenY                    
                touch.clientX, // clientX                    
                touch.clientY, // clientY                    
                false, // ctrlKey                    
                false, // altKey                     
                false, // shiftKey                   
                false, // metaKey                    
                0, // button                     
                null              // relatedTarget              
                );

        // Dispatch the simulated event to the target element
        event.target.dispatchEvent(simulatedEvent);
    }

    /**
     * Handle the jQuery UI widget's touchstart events
     * @param {Object} event The widget element's touchstart event
     */
    mouseProto._touchStart = function (event) {

        var self = this;

        // Ignore the event if another widget is already being handled
        if (touchHandled || !self._mouseCapture(event.originalEvent.changedTouches[0])) {
            return;
        }

        // Set the flag to prevent other widgets from inheriting the touch event
        touchHandled = true;

        // Track movement to determine if interaction was a click
        self._touchMoved = false;

        // Simulate the mouseover event
        simulateMouseEvent(event, 'mouseover');

        // Simulate the mousemove event
        simulateMouseEvent(event, 'mousemove');

        // Simulate the mousedown event
        simulateMouseEvent(event, 'mousedown');
    };

    /**
     * Handle the jQuery UI widget's touchmove events
     * @param {Object} event The document's touchmove event
     */
    mouseProto._touchMove = function (event) {

        // Ignore event if not handled
        if (!touchHandled) {
            return;
        }

        // Interaction was not a click
        this._touchMoved = true;

        // Simulate the mousemove event
        simulateMouseEvent(event, 'mousemove');
    };

    /**
     * Handle the jQuery UI widget's touchend events
     * @param {Object} event The document's touchend event
     */
    mouseProto._touchEnd = function (event) {

        // Ignore event if not handled
        if (!touchHandled) {
            return;
        }

        // Simulate the mouseup event
        simulateMouseEvent(event, 'mouseup');

        // Simulate the mouseout event
        simulateMouseEvent(event, 'mouseout');

        // If the touch interaction did not move, it should trigger a click
        if (!this._touchMoved) {

            // Simulate the click event
            simulateMouseEvent(event, 'click');
        }

        // Unset the flag to allow other widgets to inherit the touch event
        touchHandled = false;
    };

    /**
     * A duck punch of the $.ui.mouse _mouseInit method to support touch events.
     * This method extends the widget with bound touch event handlers that
     * translate touch events to mouse events and pass them to the widget's
     * original mouse event handling methods.
     */
    mouseProto._mouseInit = function () {

        var self = this;

        // Delegate the touch handlers to the widget's element
        self.element.bind({
            touchstart: $.proxy(self, '_touchStart'),
            touchmove: $.proxy(self, '_touchMove'),
            touchend: $.proxy(self, '_touchEnd')
        });

        // Call the original $.ui.mouse init method
        _mouseInit.call(self);
    };

    /**
     * Remove the touch event handlers
     */
    mouseProto._mouseDestroy = function () {

        var self = this;

        // Delegate the touch handlers to the widget's element
        self.element.unbind({
            touchstart: $.proxy(self, '_touchStart'),
            touchmove: $.proxy(self, '_touchMove'),
            touchend: $.proxy(self, '_touchEnd')
        });

        // Call the original $.ui.mouse destroy method
        _mouseDestroy.call(self);
    };

})(jQuery);


$(document).ready(function() {
    


    $("#leave_type").on("change", function() {
        var leaveType = $(this).val(); // Get the selected leave type
        if (leaveType === "Short Leave") {
            $("#requested_days").val("0.5"); // Set requested days to 0.5 for short leave
            $("#date_to").prop("readonly", true); // Make the end leave date input read-only
            document.getElementById("leave_duration_result").style.display="block";
            $("#medical_certificate_field").hide(); // Hide the medical certificate input field
            document.getElementById("medical_certificate").required = false;        

        } 
        if (leaveType === "Medical Leave") {
            $("#medical_certificate_field").show(); // Show the medical certificate input field
            document.getElementById("medical_certificate").required = true;        

        } 
        else {
            $("#requested_days").val(""); // Reset requested days for other leave types
            $("#date_to").prop("readonly", false); // Make the end leave date input editable

            $("#medical_certificate_field").hide(); // Hide the medical certificate input field
            document.getElementById("medical_certificate").required = false;        

        }

         // Validate file format for medical certificate attachment
    $("#medical_certificate").on("change", function() {
        var fileName = $(this).val();
        var ext = fileName.split('.').pop().toLowerCase();
        if ($.inArray(ext, ['jpg', 'jpeg', 'png']) === -1) {
            alert("Please upload a JPG or PNG file for the medical certificate.");
            $(this).val(""); // Clear the file input
        }
    });
        $("#date_form").on("change", function() {
       
       if (leaveType === "Short Leave") {
var startDate = $(this).val(); // Get the value of the start date
      
       $("#date_to").val(startDate); // Set the value of the end date to the start date

       $("#requested_days").val("0.5"); // Set requested days to 0.5 for short leave
       }
   });
    });
    
});



  </script>
    <style>
        .kbw-signature { width: 100%; height: 100px;}
        #sig canvas{
            width: 100% !important;
            height: auto;
        }
    </style>
  
</head>



<?php 
    if(isset($_POST['upload']))
    {
        $query= mysqli_query($conn,"select * from tblemployees where emp_id = '$session_id'")or die(mysqli_error());
        $row = mysqli_fetch_assoc($query);

        $firstname = $row['FirstName'];

        $cut = substr($firstname, 1, 2);

         $folderPath = "../signature/";
  
        $image_parts = explode(";base64,", $_POST['signed']);
            
        $image_type_aux = explode("image/", $image_parts[0]);
          
        $image_type = $image_type_aux[1];
          
        $image_base64 = base64_decode($image_parts[1]);
          
        $file = $folderPath ."sig_" .$cut. "_".$row['Phonenumber']. "_" .$session_id . '.'.$image_type;
          
        file_put_contents($file, $image_base64);

        $signature ="sig_" .$cut. "_".$row['Phonenumber']. "_" .$session_id . '.'.$image_type;

        $result = mysqli_query($conn,"update tblemployees set signature='$signature' where emp_id='$session_id'         
        ")or die(mysqli_error());
        if ($result) {
        echo "<script>alert('Signature Inserted successfully');</script>";
        } else{
          die(mysqli_error());
       }

}

?>

<?php
    include('../sendmail.php');

	if(isset($_POST['apply']))
	{
	$empid=$session_id;
	$leave_type=$_POST['leave_type'];
	$fromdate=date('d-m-Y', strtotime($_POST['date_from']));
	$todate=date('d-m-Y', strtotime($_POST['date_to']));
	$requested_days=$_POST['requested_days'];  
    // echo $requested_days;
	$hod_status=1;
	$reg_status=0;
	$isread=0;
	$leave_days=$_POST['leave_days'];
	$work_cover=$_POST['work_cover'];
	$datePosting = date("Y-m-d");
    
	$DF = date_create($_POST['date_from']);
	$DT = date_create($_POST['date_to']);
    
    // echo var_dump($DF);
    // echo var_dump($DT);
    $diff = date_diff($DF, $DT);   // Calculate the difference between two DateTime objects
// echo var_dump($diff);
    $total_days = $diff->format("%a");  // Get the total number of days
    
    // Loop through each day in the range
    for ($i = 0; $i <= $total_days; $i++) {
        $current_date = clone $DF;
        $current_date->modify("+" . $i . " days");
    
        // Check if the current day is Sunday
        if ($current_date->format("N") == 7) {
            // Exclude Sundays
            $total_days--;
        } elseif ($current_date->format("N") == 6) {
            // Treat Saturdays as 0.5 days
            $total_days -= 0.5;
        }
    }
    
    $num_days = $total_days + 1;  // Add 1 to include the starting day
    

	$query= mysqli_query($conn,"select * from tblemployees where emp_id = '$session_id'")or die(mysqli_error());
        $row = mysqli_fetch_assoc($query);

        $firstname = $row['FirstName'];

        $cut = substr($firstname, 1, 2);

         $folderPath = "../signature/";
  
        $image_parts = explode(";base64,", $_POST['signed']);
            
        $image_type_aux = explode("image/", $image_parts[0]);
          
        $image_type = $image_type_aux[1];
          
        $image_base64 = base64_decode($image_parts[1]);
          
        $file = $folderPath ."sig_" .$cut. "_".$row['Phonenumber']. "_" .$session_id . '.'.$image_type;
          
        file_put_contents($file, $image_base64);

        $signature ="sig_" .$cut. "_".$row['Phonenumber']. "_" .$session_id . '.'.$image_type;

	if($leave_days <= 0)
	{
	    echo "<script>alert('YOU HAVE EXCEEDED YOUR LEAVE LIMIT. LEAVE APPLICATION FAILED');</script>";
	  }

	  elseif($requested_days > $leave_days)
	{
	    echo "<script>alert('YOU HAVE EXCEEDED YOUR LEAVE LIMIT. LEAVE APPLICATION FAILED');</script>";
	  }

	else {
            $staffQuery= mysqli_query($conn,"select * from tblemployees where emp_id = '$session_id'")or die(mysqli_error());
            //getEmailStaff
            $staffRow = mysqli_fetch_assoc($staffQuery);
            $staffEmailId = $staffRow['EmailId'];
            $firstname = $staffRow['FirstName'];
            $lastname = $staffRow['LastName'];
            $fullname = "".$firstname."  ".$lastname."";

            $hodQuery= mysqli_query($conn,"select * from tblemployees where tblemployees.role = 'HOD' and tblemployees.Department = '$session_depart'")or die(mysqli_error());
            //getEmail
            $row = mysqli_fetch_assoc($hodQuery);
            $hEmailId = $row['EmailId'];
            $firstName = $row['FirstName'];
            $lastName = $row['LastName'];
            $hodFullname = "".$firstName."  ".$lastName."";
            $file_tmp = $_FILES['medical_certificate']['tmp_name'];
            $file_name = $_FILES['medical_certificate']['name'];
            $file_type = $_FILES['medical_certificate']['type'];

            if (filter_var($staffEmailId, FILTER_VALIDATE_EMAIL)) {
                
                if (filter_var($hEmailId, FILTER_VALIDATE_EMAIL)) {
                   
                  
            
                    // Specify folder where the image will be saved
                    $folder_path = "../medical_certificates/";
            
                    // Move the uploaded file to the specified folder
                    $file_destination = $folder_path . $file_name;
                    move_uploaded_file($file_tmp, $file_destination);
            
                    // Insert the file path into the database
                    $image_path = $file_destination;

                    $sql="INSERT INTO tblleave(LeaveType,ToDate,FromDate,RequestedDays,DaysOutstand,Sign,WorkCovered,HodRemarks,RegRemarks,IsRead,empid,num_days,PostingDate,Imagepath)	VALUES('$leave_type','$todate','$fromdate', '$requested_days','$leave_days','$signature','$work_cover','$hod_status','$reg_status','$isread','$empid', '$requested_days', '$datePosting','$image_path')";
                    $lastInsertId = mysqli_query($conn, $sql) or die(mysqli_error());
                    if($lastInsertId)
                    {
                        //echo "<script>alert('Number of Days: ".$requested_days."');</script>";
                        send_mail($fullname,$fromdate,$hEmailId,$todate, $leave_type, $hodFullname);
                        echo "good to go";
                    }
                    else 
                    {
                        echo "<script>alert('Something went wrong. Please try again');</script>";
                    }
                }
                else {
                    echo "<script>alert('HOD EMAIL IS INVALID. LEAVE APPLICATION FAILED');</script>";
                 }
            }
            else {
                echo "<script>alert('YOUR EMAIL IS INVALID. LEAVE APPLICATION FAILED');</script>";
            }
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

    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">

                <div class="page-header">
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="title">
                                <h4>Leave Type List</h4>
                            </div>
                            <nav aria-label="breadcrumb" role="navigation">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="admin_dashboard.php">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Signature Module</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                 </div>
                 <div style="margin-left: 30px; margin-right: 30px;" class="pd-20 card-box mb-30">
                    <div class="clearfix">
                        <div class="pull-left">
                            <h4 class="text-blue h4">Staff Form</h4>
                            <p class="mb-20"></p>
                        </div>
                    </div>
                    <div class="wizard-content">
                        <form method="post" action=""  enctype="multipart/form-data">
                            <section>

                                <?php if ($role_id = 'Staff'): ?>
                                <?php $query= mysqli_query($conn,"select * from tblemployees where emp_id = '$session_id'")or die(mysqli_error());
                                    $row = mysqli_fetch_array($query);
                                ?>
                        
                                <div class="row">
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label >First Name </label>
                                            <input name="firstname" type="text" class="form-control wizard-required" required="true" readonly autocomplete="off" value="<?php echo $row['FirstName']; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label >Last Name </label>
                                            <input name="lastname" type="text" class="form-control" readonly required="true" autocomplete="off" value="<?php echo $row['LastName']; ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label>Position</label>
                                            <input name="postion" type="text" class="form-control" required="true" autocomplete="off" readonly value="<?php echo $row['Position_Staff']; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label>Staff ID Number </label>
                                            <input name="staff_id" type="text" class="form-control" required="true" autocomplete="off" readonly value="<?php echo $row['Staff_ID']; ?>">
                                        </div>
                                    </div>
                                    <?php endif ?>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 col-sm-12">
                                        <div class="form-group">
                                            <label>Leave Type :</label>
                                            <select name="leave_type" id="leave_type" class="custom-select form-control" required="true" autocomplete="off">
                                            <option value="">Select leave type...</option>
                                            <?php $sql = "SELECT  LeaveType from tblleavetype";
                                            $query = $dbh -> prepare($sql);
                                            $query->execute();
                                            $results=$query->fetchAll(PDO::FETCH_OBJ);
                                            $cnt=1;
                                            if($query->rowCount() > 0)
                                            {
                                            foreach($results as $result)
                                            {   ?>                                            
                                            <option value="<?php echo htmlentities($result->LeaveType);?>"><?php echo htmlentities($result->LeaveType);?></option>
                                            <?php }} ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row" id="medical_certificate_field" style="display: none;">
    <div class="col-md-6 col-sm-12">
        <div class="form-group">
            <label for="medical_certificate">Medical Certificate Attachment:</label>
            <input type="file" name="medical_certificate" id="medical_certificate" class="form-control-file" required>
            <small class="form-text text-muted">Please upload a JPG or PNG file for the medical certificate.</small>
        </div>
    </div>
</div>
                                <div class="row">
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label>Start Leave Date :</label>
                                            <input id="date_form" name="date_from"  type="date" class="form-control" required="true" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label>End Leave Date :</label>
                                            <input id="date_to" name="date_to" type="date" class="form-control" required="true" autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="row">
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label>Approved outstanding from previous year(State days)</label>
                                            <input name="approved_outstanding" type="text" class="form-control" required="true" autocomplete="off" value="">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label>Leave Entitlement </label>
                                            <input name="leave_entitled" type="text" class="form-control" required="true" autocomplete="off" value="">
                                        </div>
                                    </div>
                                </div>  -->

                                <div class="row">
                                    <div class="col-md-12 col-sm-12">
                                        <div class="form-group" id="leave_duration_result"   style="display: none;">
                                        <label for="leave_duration">Select Leave Duration:</label>
<select id="leave_duration" name="leave_duration" onchange="updateHours()" class="form-select"  >
  <option value="0">Select...</option>
  <option value="1">1 Hour</option>
  <option value="2">2 Hours</option>
  <option value="3">3 Hours</option>
</select>
                                        </div>
                                    </div>
   
    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label>Leave Days Requested</label>
                                            <input id="requested_days" name="requested_days" type="text" class="form-control" required="true" autocomplete="off" readonly value="">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label>Number Days still outstanding </label>
                                            <input id="leave_days" name="leave_days" type="text" class="form-control" required="true" autocomplete="off" readonly value="<?php echo $row['Av_leave']; ?>">
                                        </div>
                                    </div>
                                </div>
                         


                                
                                <div class="row">
                                    <div class="col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label>Reason </label>
                                            <input id="work_cover" name="work_cover" type="text" class="form-control" required="true" autocomplete="off" value="">
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label>Signature </label>
                                            <div id="sig" ></div>
                                            <br/>
                                            <p style="clear: both;" class="btn btn-group">
                                                
                                            </p>
                                            <div class="dropdown">
                                               <button class="btn btn-outline-danger" id="clear">Clear Signature</button>
                                            </div>
                                            <br/>
                                            <textarea id="signature64" name="signed" style="display: none" required="true"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label style="font-size:16px;"><b></b></label>
                                            <div class="modal-footer justify-content-center">
                                                <button class="btn btn-primary" name="apply" id="apply" data-toggle="modal">Apply&nbsp;Leave</button>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                            </section>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

<script type="text/javascript">
    var sig = $('#sig').signature({syncField: '#signature64', syncFormat: 'PNG'});
    $('#clear').click(function(e) {
        e.preventDefault();
        sig.signature('clear');
        $("#signature64").val('');
    });
</script>

<script>
    const picker = document.getElementById('date_form');
    picker.addEventListener('input', function(e){
    var day = new Date(this.value).getUTCDay();
    if(day === 0){
      e.preventDefault();
      this.value = '';
      alert('Sundays not allowed');
    } else {
        calc();
    }
   });

   const pickers = document.getElementById('date_to');
    pickers.addEventListener('input', function(e){
    var day = new Date(this.value).getUTCDay();
    if(day === 0){
      e.preventDefault();
      this.value = '';
      alert('Sundays not allowed');
    }else {
        calc();
    }
   });


    function calc() {
      const date_to = document.getElementById('date_to');
      const date_from = document.getElementById('date_form');
      result = getBusinessDateCount(new Date(date_from.value), new Date(date_to.value));
      var work = document.getElementById("requested_days");
      work.value = result;

      // Calculate hours requested and outstanding
    var hours_requested = result * 8;
    var leave_outstanding = parseFloat(document.getElementById("leave_days").value) * 8;
    
    document.getElementById("requested_hours").value = hours_requested;
    document.getElementById("leave_hours").value = leave_outstanding;
}

    function getBusinessDateCount(startDate, endDate) {
        var count = 0;
        var curDate = new Date(startDate.getTime());
        while (curDate <= endDate) {
            var dayOfWeek = curDate.getDay();
            if(dayOfWeek != 0 && dayOfWeek != 6) {
                count++;
            } else if(dayOfWeek == 6) {
                count += 0.5;
            }
            curDate.setDate(curDate.getDate() + 1);
        }
        return count;
     }


     function updateHours() {
  const selectedHours = document.getElementById("leave_duration").value;


  // Check if "short leave" option is selected
  if (selectedHours > 0 && selectedHours <= 3) {
    // Calculate and display leave days in hours
    const leaveDays = selectedHours / 8;
    document.getElementById("requested_days").value = leaveDays.toFixed(2);
  } else {
    // Clear leave days if non-short leave option is selected
    document.getElementById("requested_days").value = "";
  }
}


</script>



    <script src="../vendors/scripts/core.js"></script>
    <script src="../vendors/scripts/script.min.js"></script>
    <script src="../vendors/scripts/process.js"></script>
    <script src="../vendors/scripts/layout-settings.js"></script>
  
</body>
</html>