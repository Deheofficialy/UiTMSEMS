<?php 
include('../include/dbconn.php');
include ("../session.php");
session_start();
$id = $_GET['id'];
$query=" delete from equipment where equipmentid = $id";
$res=mysqli_query($dbconn, $query) or die(mysqli_error($dbconn));
echo "<script>
alert('Data has been deleted');
window.location.href='index.php';
</script>";
//echo "<h1>data deleted saved.  <a href=index.php>Dashboard</a></h1>";
mysqli_close($dbconn);
?>
