<?php
include('../include/dbconn.php');
include("../session.php");
session_start();

if (!isset($_SESSION['username'])) {
  header('Location: ../login');
}

if (isset($_POST['addEq'])) {
    $equipmentName = $_POST['equipmentname'];
    $equipmentStock = $_POST['equipmentstock'];
    $equipmentDesc = $_POST['equipmentdesc'];

    // Check if a file was uploaded
    if (isset($_FILES["equipmentimage"]) && $_FILES["equipmentimage"]["error"] == UPLOAD_ERR_OK) {
        $targetDir = "image/"; // Specify your upload directory
        $targetFile = $targetDir . basename($_FILES["equipmentimage"]["name"]);

        // Move the uploaded file to the target directory
        if (move_uploaded_file($_FILES["equipmentimage"]["tmp_name"], $targetFile)) {
            // The file was successfully uploaded, so you can save its path in the database
            $imagePath = $targetFile;

            // Insert equipment information into the database, including the image path
            $query = "INSERT INTO equipment (equipmentname, equipmentstock, equipmentdesc, equipmentimage) VALUES ('$equipmentName', '$equipmentStock', '$equipmentDesc', '$imagePath')";
            $result = mysqli_query($dbconn, $query);

            if ($result) {
                echo "<script>
                    alert('Equipment has been added');
                    window.location.href='viewEquipment.php';
                </script>";
            } else {
                echo "Error: Failed to insert equipment information.";
            }
        } else {
            // Handle the case when the file upload fails
            echo "Error: File upload failed.";
        }
    } else {
        // Handle the case when no file was uploaded
        echo "Error: No file uploaded.";
    }
}
?>
