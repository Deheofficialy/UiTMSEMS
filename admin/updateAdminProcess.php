<?php
include('../include/dbconn.php');
include("../session.php");
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: ../login');
}
if (isset($_POST['updatebtn'])) {
    $telephone = $_POST['telephone'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $userid = $_POST['userid'];
    $q1 = "UPDATE user SET telephone = '$telephone', email = '$email',address='$address' where user_id = $userid";
    $r1 = mysqli_query($dbconn, $q1) or die(mysqli_error($dbconn));
    if ($r1) {
        echo "
<script>
    alert('Admin data has been updated');
    window.location.href = 'updateAdmin.php';
</script>";
    } else
        echo "
<script>
    alert('Admin data failed to be deleted');
    window.location.href = 'updateAdmin.php';
</script>";
}
echo "rerror";
mysqli_close($dbconn);
