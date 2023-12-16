<?php
include('../include/dbconn.php');
include("../session.php");
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: ../login');
}

?>
<?php
//navbar
include('../include/newnavbar.php')
?>
<div style="margin-left: 5%; margin-right: 5%;">
    <br>
    <h1>Add an Equipment</h1>
    <br>
    <form action="saveEquipment.php" method="post" enctype="multipart/form-data">
        <input type="text" class="form-control" name="equipmentname" placeholder="Equipment Name" required><br><br>
        <input type="text" class="form-control" name="equipmentstock" placeholder="Equipment Stock" required><br><br>
        <input type="text" class="form-control" name="equipmentdesc" placeholder="Equipment Description" required><br><br>
        <h6>Equipment image:</h6><input type="file" name="equipmentimage">
        <input  type="submit" class="btn btn-primary" name="addEq" value="Submit">
    </form>
</div>

</body>

</html>