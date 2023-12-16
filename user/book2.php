<?php
session_start();
include('../include/dbconn.php');
include("../session.php");

require 'email.php'; // Include email.php

if (isset($_POST['bookSubmit'])) {
    $userid = $_POST['userid'];
    $dependentid = $_POST['dependentid'];
    $dependentusername = $_POST['dependentusername']; 
    $dependentemail = $_POST['dependentemail']; // Changed variable name to lowercase
    $note = $_POST['note'];
    $dateborrow = $_POST['dateborrow'];
    $equipmentid = $_POST['equipmentid'];
    $qty = $_POST['qty'];
    $datereturn = $_POST['datereturn'];

    $q2 = "select count(return_status) as total from booking where user_id = $userid and return_status = 0";
    $r2 = mysqli_query($dbconn, $q2);
    $data = mysqli_fetch_assoc($r2);
    $count =  $data['total'];

    if ($count < 1) {
        $q3 = "insert into booking (user_id, dependant_id, dependant_username, dependant_email, equipment_id, quantity, note, date_borrow, date_return, status, booking_type, return_status, user_retrieve, dependentapproval)
        values ('$userid', '$dependentid', '$dependentusername', '$dependentemail', '$equipmentid', '$qty', '$note', '$dateborrow', '$datereturn', '3', '2', '0', '0', '0')";
        $r3 = mysqli_query($dbconn, $q3);

        $query = "SELECT MAX(booking_id) AS latest_booking_id FROM booking WHERE user_id = $userid";

        $result = mysqli_query($dbconn, $query);
        
        $row = mysqli_fetch_assoc($result);
        $latestBookingId = $row['latest_booking_id'];

        if ($r3) {
            // Use the function from email.php to send email to dependent
            $emailSent = sendEmailToDependent($dependentemail, $equipmentid, $dependentusername, $latestBookingId);

            if ($emailSent) {
                echo "<script>
                    alert('Booking has been added, please wait for it to be verified.');
                    window.location.href='index.php';
                    </script>";
            } else {
                echo "<script>
                    alert('Message could not be sent to dependent. Please try again later.');
                    window.location.href='index.php';
                    </script>";
            }
        } else {
            echo "<script>
                alert('Failed to add booking.');
                window.location.href='index.php';
                </script>";
        }
    } else {
        echo "<script>
            alert('User can only make one booking at a time');
            window.location.href='index.php';
            </script>";
    }
}
?>
