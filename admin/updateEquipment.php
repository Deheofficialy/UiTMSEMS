<?php
include('../include/dbconn.php');
include("../session.php");
session_start();
//navbar
include('../include/newnavbar.php');
$id = $_GET['id'];
$q = "select * from equipment where equipmentid=$id";
$res = mysqli_query($dbconn, $q) or die(mysqli_error($dbconn));
$r = mysqli_fetch_assoc($res);
$stock = $r['equipmentstock'];
//creating a detail table for a specific equipment
?>
<br>
<div style="margin-left: 5%; margin-right: 5%;">
    <h1>Update Equipment</h1>
    <form action="updateEquipmentProcess.php" method="POST" enctype="multipart/form-data">
        <table class="table" width=98% style="margin-top:5%;">
            <tr>
                <td>Equipment ID:</td>
                <td><input type="text" class="form-control" name="equipmentid" value="<?php echo $id; ?>" readonly></td>
            </tr>
            <tr>
                <td>Equipment Name:</td>
                <td><input type="text" class="form-control" name="equipmentname" value="<?php echo $r['equipmentname']; ?>" readonly></td>
            </tr>
            <tr>
                <td>Equipment Stock: </td>
                <td><input class="form-control" type="number" name="stock" value="<?php echo $stock; ?>"></td>
            </tr>
            <tr>
                <td>Equipment Description:</td>
                <td><input class="form-control" type="text" maxlength="255" name="desc" value="<?php echo $r['equipmentdesc']; ?>"
                        style="width:100% ; height:100px;"></td>
            </tr>
            <tr>
                <td>Update Equipment Photo:</td>
                <td><input type="file" name="equipmentimage"></td>
            </tr>
        </table>
        <button type="submit" class="btn btn-primary" name="updatebtn">Update Equipment</button>
    </form>
</div>
