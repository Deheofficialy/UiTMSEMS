<?php
include("../include/dbconn.php");
include("../session.php");
session_start();

require 'email.php'; // Include email.php

if (!isset($_SESSION['username'])) {
    header('Location: ../login');
}
$adminname = $_SESSION['username'];
$bookingId = $_GET['id'];
include("../include/newnavbar.php");

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
        <div style="display:flex ; flex-direction:column; float:left; margin-right:20px;">
            User ID:<input class="form-control" type="text" value="<?php echo $r['user_id']; ?>" name="userid" readonly>
            Username:<input class="form-control" type="text" value="<?php echo $r3['username']; ?>" readonly>
            Telephone Number:<input class="form-control" type="text" value="<?php echo $r3['telephone']; ?>" readonly>
            Email:<input class="form-control" type="text" value="<?php echo $r3['email']; ?>" readonly>
            Address:<input type="text" class="form-control" value="<?php echo $r3['address']; ?>" readonly>
        </div>
        <div class="dependent" style="display:flex ; flex-direction:column; width:30% ;margin-left:100px;">
            <p><b> Dependent(Witness)</b></p>
            dependentId:<input type="text" class="form-control" name="dependentid" value="<?PHP echo $dependantid; ?>" readonly>
            dependentUsername:<input type="text" class="form-control" name="dependentusername" value="<?PHP echo $dependantusername ?>" readonly>
            dependentEmail:<input type="email" class="form-control" name="dependentemail" value="<?PHP echo $dependantemail ?>" readonly>
        </div>
        <br><br><br><br><br><br>
        <hr>
        <h1>Booking Equipment Info</h1>
        <div>
            Equipment ID:<input type="text" class="form-control" value="<?php echo $r2['equipmentid']; ?>" name="equipmentid" readonly>
            Equipment Name:<input type="text" class="form-control" value="<?php echo $r2['equipmentname']; ?>" readonly>
            Quantity:<input type="number" class="form-control" value="<?PHP echo $r['quantity']; ?>" name="qty" readonly>
            <br>
            Borrow Date:<input type="text" class="form-control" name="dateborrow" value="<?PHP echo $r['date_borrow']; ?>" readonly>
            <br>
            Return Date:<input type="text" class="form-control" name="datereturn" value="<?PHP echo $r['date_return']; ?>" readonly>
            <br>
            Purpose of Booking:<input type="text" maxlength="255" class="form-control" name="note" style="width:20% ; height:100px;" value="<?PHP echo $r['note']; ?>" readonly>
            <br>
            Dependent Approval:<input type="text" maxlength="255" class="form-control" name="dependentapproval" style="width:20% ; height:100px;" value="<?PHP echo $dependentapproval; ?>" readonly>
            <br>

            Rejection Note:<input type="text" maxlength="255" class="form-control" name="reject" style="width:30% ; height:100px;" placeholder="If you reject this booking application,please insert why">
            <br><br>
            <select name="status" class="form-control" style="margin-right:5px; padding-right:50px;">
                <option value=1>Accept </option>
                <option value=2>Decline</option>
            </select>
            <br>
            <input type="submit" value="verify" class="btn btn-primary" name="book" >
            
    </form>
    </td>
    </tr>
</div>