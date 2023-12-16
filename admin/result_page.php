<?php
include('../include/newnavbar.php');
?>

<!DOCTYPE html>
<html>
<head>
    <title>Recognition Result</title>
    <style type="text/css">
        body {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin: 0;
        }

        .container {
            text-align: center;
            margin-top: 20px; /* Adjust the margin as needed */
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Recognition Result</h1>
    
        <?php
        // Connect to the database
        $db = new mysqli("localhost", "root", "", "esukandb");

        if ($db->connect_error) {
            die("Connection failed: " . $db->connect_error);
        }

        // Retrieve the last saved image from the "webcam" table
        $sql = "SELECT * FROM webcam ORDER BY id DESC LIMIT 1";
        $result = $db->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $image_path = $row['image_path'];
            $name = $row['name'];

            // Display the saved image and additional data
            echo '<img src="' . $image_path . '" alt="Saved Image"><br>';
            echo '<p>Equipment Name: ' . $name . '</p>';
        } else {
            echo "No images found in the database.";
        }

        $db->close();
        ?>
    </div>
</body>
</html>
