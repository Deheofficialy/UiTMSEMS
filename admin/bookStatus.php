<?php
session_start();
include('../include/dbconn.php');
include("../session.php");
require 'email.php'; // Include the email functions file

$adminname = $_SESSION['username'];
$q1 = "select user_id from user where username = '".$adminname."'";
$r1 = mysqli_query($dbconn, $q1) or die("Error: " . mysqli_error($dbconn));
$rr = mysqli_fetch_assoc($r1);
$adminid = $rr['user_id'];

if (isset($_POST['book'])) {
    $status = $_POST['status'];
    $bookingId = $_GET['id'];
    $reject = $_POST['reject'];
    
    if ($status == 1) {
        $q = "update booking set adminid = ".$adminid.", status = 1 WHERE booking_id = ".$bookingId;
        $res = mysqli_query($dbconn, $q) or die(mysqli_error($dbconn));
        
        if ($res) {
            // Fetch user email from the database
            $getUserEmailQuery = "SELECT email, username FROM user WHERE user_id = (SELECT user_id FROM booking WHERE booking_id = $bookingId)";
            $userEmailResult = mysqli_query($dbconn, $getUserEmailQuery);
            $userData = mysqli_fetch_assoc($userEmailResult);
            $userEmail = $userData['email'];
            $username = $userData['username'];

            // Send successful booking email
            $emailSent = sendSuccessfulBookingEmail($userEmail, $username, $bookingId);
            
            if ($emailSent) {
                echo "<script>
                alert('Booking application has been approved and notification sent.');
                window.location.href='managebooking.php';
                </script>";
            } else {
                echo "<script>
                alert('Booking application has been approved but notification could not be sent.');
                window.location.href='managebooking.php';
                </script>";
            }
        } else {
            echo "<script>
            alert('Booking Application Error!!');
            window.location.href='managebooking.php';
            </script>";
        }
    } elseif ($status == 2) {
        $q = "UPDATE booking SET adminid = $adminid, status = 2, decline_reason = '$reject', return_status = 1 WHERE booking_id = $bookingId";
        $res = mysqli_query($dbconn, $q) or die(mysqli_error($dbconn));
        
        if ($res) {
            // Fetch user email from the database
            $getUserEmailQuery = "SELECT email FROM user WHERE user_id = (SELECT user_id FROM booking WHERE booking_id = $bookingId)";
            $userEmailResult = mysqli_query($dbconn, $getUserEmailQuery);
            $userData = mysqli_fetch_assoc($userEmailResult);
            $userEmail = $userData['email'];
            $username = $userData['username'];

            // Send declined booking email
            $emailSent = sendBookingDeclinedEmail($userEmail, $username, $bookingId);
            
            if ($emailSent) {
                echo "<script>
                alert('Booking application has been denied and notification sent.');
                window.location.href='managebooking.php';
                </script>";
            } else {
                echo "<script>
                alert('Booking application has been denied but notification could not be sent.');
                window.location.href='managebooking.php';
                </script>";
            }
        } else {
            echo "<script>
            alert('Booking Application Error!!');
            window.location.href='managebooking.php';
            </script>";
        }
    } else {
        // Additional logic for other statuses
    }
}
?>
