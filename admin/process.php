<?php
if (isset($_POST['submit'])) {
    $image_data = $_POST['image'];
    
    // Generate a unique filename for the image
    $image_filename = 'snapshot/' . uniqid() . '.jpg';
    
    // Save the image to the 'snapshot' folder
    file_put_contents($image_filename, base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $image_data)));

    // Store the image path and additional data in the database
    $db = new mysqli("localhost", "root", "", "esukandb");

    if ($db->connect_error) {
        die("Connection failed: " . $db->connect_error);
    }

    $name = "Your Name"; // Change this to the actual name
    $image_path = $image_filename;

    $sql = "INSERT INTO webcam (name, image_path) VALUES ('$name', '$image_path')";

    if ($db->query($sql) === TRUE) {
        // Image and data saved successfully, show a pop-up alert
        echo '<script>alert("Image and data saved successfully!");</script>';

        // Redirect to a result page
        header("Location: result_page.php");
        exit(); // Terminate the script after the redirection
    } else {
        echo "Error: " . $sql . "<br>" . $db->error;
    }

    $db->close();
}
?>
