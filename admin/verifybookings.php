<?php
include("../include/dbconn.php");
include("../session.php");
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: ../login');
}
$adminname = $_SESSION['username'];
$bookingId = $_GET['id'];
include("../include/newnavbar.php");

require 'email.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $bookingStatus = $_POST['status'];
    
    // Fetch necessary details
    $bookingQuery = "SELECT * FROM booking WHERE booking_id = $bookingId";
    $bookingResult = mysqli_query($dbconn, $bookingQuery);
    $bookingData = mysqli_fetch_assoc($bookingResult);

    $equipmentId = $bookingData['equipment_id'];
    $userId = $bookingData['user_id'];

    // Fetch user email
    $userQuery = "SELECT * FROM user WHERE user_id = $userId";
    $userResult = mysqli_query($dbconn, $userQuery);
    $userData = mysqli_fetch_assoc($userResult);

    $email = $userData['email'];

    // Update the booking status in the database based on the $bookingStatus
    $updateQuery = "UPDATE booking SET status = $bookingStatus WHERE booking_id = $bookingId";

    if (mysqli_query($dbconn, $updateQuery)) {
        if ($bookingStatus == 1) {
            // If booking is accepted
            $emailSent = sendEmailToUser($email, $bookingId, $bookingData['equipmentname'], $bookingData['quantity'], $bookingData['date_borrow'], $bookingData['date_return']);

            if ($emailSent) {
                // Email sent successfully
                echo "<script>
                    alert('Booking has been successfully verified.');
                    window.location.href='index.php';
                    </script>";
            } else {
                // Email sending failed
                echo "<script>
                    alert('Booking verification successful, but notification email could not be sent.');
                    window.location.href='index.php';
                    </script>";
            }
        } elseif ($bookingStatus == 2) {
            // If booking is declined
            $emailSent = sendBookingDeclinedEmail($email);

            if ($emailSent) {
                // Email sent successfully
                echo "<script>
                    alert('Booking has been declined.');
                    window.location.href='index.php';
                    </script>";
            } else {
                // Email sending failed
                echo "<script>
                    alert('Booking decline successful, but notification email could not be sent.');
                    window.location.href='index.php';
                    </script>";
            }
        }
    } else {
        // If the update query fails
        echo "<script>
            alert('Failed to update booking status.');
            window.location.href='index.php';
            </script>";
    }
}
?>

<head>
    <title>Manage Booking</title>
</head>

<div style="margin-left: 5%; margin-right: 5%;">
    <br>
    <h1>Booking Applicant Info</h1>
    <?php
    $q1 = "select * from booking where booking_id= $bookingId";
    $r1 = mysqli_query($dbconn, $q1) or die("Error: " . mysqli_error($dbconn));
    $r = mysqli_fetch_assoc($r1);
    $userid = $r['user_id'];
    $equipmentid = $r['equipment_id'];
    $dependentapproval = $r['dependentapproval'];

    if ($dependentapproval == "0")
    {
        $dependentapproval = "pending";
    } 
    else
    {
        $dependentapproval = "approved";
    }
    //variables for accessing booking 
    $q2 = "select * from equipment where equipmentid=$equipmentid";
    $res = mysqli_query($dbconn, $q2) or die(mysqli_error($dbconn));
    $r2 = mysqli_fetch_assoc($res);
    //variables for accessing equipment
    $q3 = "select * from user where user_id= $userid";
    $result = mysqli_query($dbconn, $q3) or die("Error: " . mysqli_error($dbconn));
    $r3 = mysqli_fetch_assoc($result);
    //variables for accessing user
    $dependantid = $r['dependant_id'];
    $dependantusername = $r['dependant_username'];
    $dependantemail = $r['dependant_email'];
    $q4 = "select * from user where user_id = $dependantid";
    $result4 = mysqli_query($dbconn, $q4) or die("Error: " . mysqli_error($dbconn));
    $r4 = mysqli_fetch_assoc($result4);
    $q4 = "select * from user where user_id = $dependantusername";

    $q5 = "select user_id from user where username = '$adminname'";
    $r5 = mysqli_query($dbconn, $q5) or die("Error: " . mysqli_error($dbconn));
    $rr5 = mysqli_fetch_assoc($r5);
    $adminid = $rr5['user_id'];
    ?>
    <br>
    <form action="bookStatus.php?id=<?php echo $bookingId; ?>" method="post">
        <!-- Rest of your form -->
    </form>
</div>
