<?php
include('../include/dbconn.php');
include("../session.php");
session_start();
$userId = $_GET['id'];
$query = " delete from user where user_id = '$userId'";
$res = mysqli_query($dbconn, $query) or die(mysqli_error($dbconn));
if ($res) {
    echo "<script>
alert('User Data has been deleted');
window.location.href='viewUser.php';
</script>";
} else
    echo "<script>
alert('User data failed to be deleted');
window.location.href='viewUser.php';
</script>";

//echo "<h1>data deleted saved.  <a href=index.php>Dashboard</a></h1>";
mysqli_close($dbconn);
