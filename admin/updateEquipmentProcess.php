<?php
include('../include/dbconn.php');
include("../session.php");
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: ../login');
}

if (isset($_POST['updatebtn'])) {
    $equipmentStock = $_POST['stock'];
    $equipmentDesc = $_POST['desc'];
    $equipmentId = $_POST['equipmentid'];

    // Check if a new file was uploaded
    if (isset($_FILES["equipmentimage"]) && $_FILES["equipmentimage"]["error"] == UPLOAD_ERR_OK) {
        $targetDir = "image/"; // Specify your upload directory
        $targetFile = $targetDir . basename($_FILES["equipmentimage"]["name"]);

        // Move the uploaded file to the target directory
        if (move_uploaded_file($_FILES["equipmentimage"]["tmp_name"], $targetFile)) {
            // The file was successfully uploaded, so you can save its path in the database
            $imagePath = $targetFile;

            // Update equipment information in the database, including the new image path
            $q1 = "UPDATE equipment SET equipmentstock = $equipmentStock, equipmentdesc = '$equipmentDesc', equipmentimage = '$imagePath' WHERE equipmentid = $equipmentId";
            $r1 = mysqli_query($dbconn, $q1) or die(mysqli_error($dbconn));

            if ($r1) {
                echo "
<script>
    alert('Equipment data has been updated');
    window.location.href = 'viewEquipment.php';
</script>";
            } else {
                echo "
<script>
    alert('Equipment data failed to be updated');
    window.location.href = 'viewEquipment.php';
</script>";
            }
        } else {
            echo "
<script>
    alert('Error: File upload failed.');
    window.location.href = 'viewEquipment.php';
</script>";
        }
    } else {
        // If no new file was uploaded, update equipment information without changing the image path
        $q1 = "UPDATE equipment SET equipmentstock = $equipmentStock, equipmentdesc = '$equipmentDesc' WHERE equipmentid = $equipmentId";
        $r1 = mysqli_query($dbconn, $q1) or die(mysqli_error($dbconn));

        if ($r1) {
            echo "
<script>
    alert('Equipment data has been updated');
    window.location.href = 'viewEquipment.php';
</script>";
        } else {
            echo "
<script>
    alert('Equipment data failed to be updated');
    window.location.href = 'viewEquipment.php';
</script>";
        }
    }
}
mysqli_close($dbconn);
?>
