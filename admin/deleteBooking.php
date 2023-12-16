<?php
include('../include/dbconn.php');
include("../session.php");
session_start();
$id = $_GET['id'];
$query = " delete from booking where booking_id = $id";
$res = mysqli_query($dbconn, $query) or die(mysqli_error($dbconn));
if ($res) {
    echo "<script>
alert('Booking Data has been deleted');
window.location.href='managebooking.php';
</script>";
} else
    echo "<script>
alert('Booking data failed to be deleted');
window.location.href='index.php';
</script>";

//echo "<h1>data deleted saved.  <a href=index.php>Dashboard</a></h1>";
mysqli_close($dbconn);
