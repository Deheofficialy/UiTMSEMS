<?php
session_start();
include('../include/dbconn.php');
include("../session.php");
$bookingId = $_GET['id'];
echo $bookingId;
$q2 = "SELECT * FROM booking WHERE booking_id = $bookingId";
$r2 = mysqli_query($dbconn, $q2);
$rr = mysqli_fetch_assoc($r2);
$quantity = $rr['quantity'];
$equipmentId = $rr['equipment_id'];

if (isset($_POST['retrieve'])) {
    $q1 = "UPDATE booking SET user_retrieve = 1 WHERE booking_id = $bookingId";
    $r1 = mysqli_query($dbconn, $q1);
    $q3 = "UPDATE equipment SET equipmentstock = equipmentstock-$quantity WHERE equipmentid = $equipmentId";
    $r3 = mysqli_query($dbconn, $q3);
    if ($r1) {
        if ($r3) {
            echo "<script>
            alert('Here You Go! Dont Forget To Return This Equipment');
            window.location.href='index.php';
            </script>";
        }
    }

    echo "hello i take item";
} else if (isset($_POST['return'])) {
    $q1 = "UPDATE booking SET return_status = 1 WHERE booking_id = $bookingId";
    $r1 = mysqli_query($dbconn, $q1);
    $q3 = "UPDATE equipment SET equipmentstock = equipmentstock+$quantity WHERE equipmentid = $equipmentId";
    $r3 = mysqli_query($dbconn, $q3);
    if ($r1) {
        if ($r3) {
            echo "<script>
            alert('Thank You For Returning This Equipment!,Do Visit Us Again');
            window.location.href='index.php';
            </script>";
        }
    }
}
