<?php
    require "vendor/autoload.php";

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
    
    // require 'PHPMailer/src/Exception.php';
    // require 'PHPMailer/src/PHPMailer.php';
    // require 'PHPMailer/src/SMTP.php';

    require 'credentials.php';

    function send_mail($name,$from,$email,$to, $type,$hodName) {

        $mail = new PHPMailer(true);

        // $mail->SMTPDebug = 4;                               // Enable verbose debug output

        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = EMAIL;                 // SMTP username
        $mail->Password = PASS;                           // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;                           // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 587;                                    // TCP port to connect to

        $mail->setFrom(EMAIL, 'Teamnet Leave Application');
        $mail->addAddress($email);              // Name is optional
        $mail->addReplyTo(EMAIL);
        
        $mail->isHTML(true);                                  // Set email format to HTML

        $mail->Subject = " ".$type." Application";
        $mail->Body    = "
            <p></p><br>
            Hi ".$hodName.",  ".$name." has applied<br>
             for ".$type." from ".$from." to ".$to.".<br><br>
            Kindly login into the Leave Application Portal and review.<br>
            THANK YOU.<br><br>";
        $mail->AltBody = 'Leave Application from the TeamNet';

        if(!$mail->send()) {
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        } else {
            echo "<script>alert('Leave Application was successful.');</script>";
            echo "<script type='text/javascript'> document.location = 'leave_history.php'; </script>";
        }
    }
    function send_business_trip_mail($employeeName, $employeeEmail, $tripPurpose, $tripFromDate, $tripToDate, $tripLocation) {

        $mail = new PHPMailer(true);
    
        // Enable verbose debug output
        // $mail->SMTPDebug = 4;
    
        // Set mailer to use SMTP
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Specify main and backup SMTP servers
        $mail->SMTPAuth = true; // Enable SMTP authentication
        $mail->Username = EMAIL; // SMTP username
        $mail->Password = PASS; // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 587; // TCP port to connect to
    
        // Sender and recipient
        $mail->setFrom(EMAIL, 'Karsh General Trading Co. L.L.C');
        $mail->addAddress($employeeEmail); // Recipient
        $mail->addReplyTo(EMAIL);
    
        // Email content
        $mail->isHTML(true);
        $mail->Subject = "Business Trip Notification";
        $mail->Body = "
            <p>Dear $employeeName,</p>
            <p>You have been scheduled for a business trip.</p>
            <p><strong>Purpose:</strong> $tripPurpose</p>
            <p><strong>From:</strong> $tripFromDate</p>
            <p><strong>To:</strong> $tripToDate</p>
            <p><strong>Location:</strong> $tripLocation</p>
            <p>Please confirm your availability by going to business trip in your teamnet portal. Make necessary arrangements and ensure you are prepared for the trip.</p>
            <p>Thank you.</p>
        ";
    
        try {
            // Send email
            $mail->send();
            echo "<script>alert('Business trip notification email sent successfully.');</script>";
            echo "<script type='text/javascript'> document.location = 'business_trip_history.php'; </script>";
        } catch (Exception $e) {
            echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
        }
    }

    
    function send_event_trip_mail($employee_name, $employee_email, $event_title, $event_date, $event_location, $event_note) {

        $mail = new PHPMailer(true);
    
        // Enable verbose debug output
        // $mail->SMTPDebug = 4;
    
        // Set mailer to use SMTP
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Specify main and backup SMTP servers
        $mail->SMTPAuth = true; // Enable SMTP authentication
        $mail->Username = EMAIL; // SMTP username
        $mail->Password = PASS; // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 587; // TCP port to connect to
    
        // Sender and recipient
        $mail->setFrom(EMAIL, 'Karsh General Trading Co. L.L.C');
        $mail->addAddress($employee_email); // Recipient
        $mail->addReplyTo(EMAIL);
    
        // Email content
        $mail->isHTML(true);
        $mail->Subject = "Event Notification";
        $mail->Body = "
            <p>Dear $employee_name,</p>
            <p>You have been assigned for a Event.</p>
            <p><strong>Event Title:</strong> $event_title</p>
            <p><strong>Event Date:</strong> $event_date</p>
            <p><strong>Event Location:</strong> $event_location</p>
            <p><strong>Note:</strong> $event_note</p>
            <p>Please confirm your availability for the event and make it good for company and also well dressed. Make necessary arrangements and ensure you are prepared for the event.</p>
            <p>Thank you.</p>
        ";
    
        try {
            // Send email
            $mail->send();
            echo "<script>alert('Event notification email sent successfully.');</script>";
            echo "<script type='text/javascript'> document.location = 'event_history.php'; </script>";
        } catch (Exception $e) {
            echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
        }
    }

    function send_broadcast_email($subject, $message,$message_fr, $recipient_emails) {
        
        $mail = new PHPMailer(true);
        
        // Enable verbose debug output
        // $mail->SMTPDebug = 4;
        
        // Set mailer to use SMTP
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Specify main and backup SMTP servers
        $mail->SMTPAuth = true; // Enable SMTP authentication
        $mail->Username = EMAIL; // SMTP username
        $mail->Password = PASS; // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 587; // TCP port to connect to
        // Sender
        $mail->setFrom(EMAIL, 'Karsh General Trading Co. L.L.C');
        
        // Email content
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $message;
        
        try {
            // Send email to each recipient
            foreach ($recipient_emails as $email) {
                $mail->clearAddresses(); // Clear previous recipient
                $mail->addAddress($email); // Add new recipient
                // Email content
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body = "
                <p>Dear recipient,</p>
                <p>{$message}</p>
                <p>{$message_fr}</p>
                <p>Thank you.</p>
            ";

                $mail->send(); // Send email
            }
            echo "<script>alert('Broadcast email sent successfully.');</script>";
            echo "<script type='text/javascript'> document.location = 'announcements.php'; </script>";
        } catch (Exception $e) {
            echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
        }
    }

    function send_remarks_mail($employeeName, $employeeEmail, $datereport) {

        $mail = new PHPMailer(true);
    
        // Enable verbose debug output
        // $mail->SMTPDebug = 4;
    
        // Set mailer to use SMTP
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Specify main and backup SMTP servers
        $mail->SMTPAuth = true; // Enable SMTP authentication
        $mail->Username = EMAIL; // SMTP username
        $mail->Password = PASS; // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 587; // TCP port to connect to
    
        // Sender and recipient
        $mail->setFrom(EMAIL, 'Karsh General Trading Co. L.L.C');
        $mail->addAddress($employeeEmail); // Recipient
        $mail->addReplyTo(EMAIL);
    
        // Email content
        $mail->isHTML(true);
        $mail->Subject = "Remarks on your report";
        $mail->Body = "
            <p>Dear $employeeName,</p>
            <p>There is an remarks updated by Mahtab Gharakhan on your report dated. $datereport</p>
            <p>Kindly check and review.</p>
        
        ";
    
        try {
            // Send email
            $mail->send();
            echo "<script>alert('Remarks notification email sent successfully.');</script>";
            echo "<script type='text/javascript'> document.location = 'view_report.php'; </script>";
        } catch (Exception $e) {
            echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
        }
    }

?>