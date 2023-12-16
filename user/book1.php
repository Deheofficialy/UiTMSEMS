<?php
session_start();
include('../include/dbconn.php');
include("../session.php");

if (isset($_POST['bookSubmit'])) {
    $userid = $_POST['userid'];
    $dependentid = $_POST['dependentid'];
    $dependentusername = $_POST['dependentusername'];
    $note = $_POST['note'];
    $dateborrow = $_POST['dateborrow'];
    $equipmentid = $_POST['equipmentid'];
    $qty = $_POST['qty'];

    $q2 = "select count(return_status) as total from booking where user_id = $userid and return_status = 0";
    $r2 = mysqli_query($dbconn, $q2);
    $data = mysqli_fetch_assoc($r2);
    $count = $data['total'];

    if ($count < 1) {
        // Making sure that the user can only make one booking
        $q3 = "insert into booking (user_id, dependant_id, dependant_username, equipment_id, quantity, note, booking_date, status, booking_type, return_status, user_retrieve)
        values('$userid','$dependentid', '$dependentusername', '$equipmentid','$qty','$note','$dateborrow','1','1','0','0')";
        // Status = auto confirm, 1=accepted, 2=declined, 3=pending
        $r3 = mysqli_query($dbconn, $q3);

        if ($r3) {
            // Successfully booked
            echo "<script>
                alert('Booking has been verified and processed, please go to the Unit Sukan to claim your item');
                window.location.href='index.php';
                </script>";
        }
    } else {
        // User can only make one booking at a time
        echo "<script>
            alert('User can only make one booking at a time');
            window.location.href='index.php';
            </script>";
    }
}
?>
