<!DOCTYPE html>
<html>
<head>
    <style>

        .button-container {
            text-align: center;
        }

        /* Style for the button */
        button {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 10px 20px;
            font-size: 18px;
            background-color: #0074d9; /* Choose your desired background color */
            color: #ffffff; /* Text color */
        }

        button:hover {
        background-color: #0056b3; /* New background color on hover */
    }

        .message-container {
            text-align: center;
            margin-top: 60px;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }
    </style>
    <title>Run Sport Equipment Recognition</title>
</head>
<body>

<?php
include('../include/newnavbar.php');


// Define the path to the Python executable
$pythonExecutable = "python"; // Adjust this if needed

// Define the path to the Python script
$pythonScriptPath = "yolov8_n_opencv.py"; // Adjust this with the correct path

// Construct the command to run the Python script
$command = $pythonExecutable . " " . $pythonScriptPath;
?>

<!-- Container for the button -->
<div class="button-container">
    <button onclick="runPythonScript('<?php echo urlencode($command); ?>')">Run Webcam for Object Recognition</button>
</div>

<!-- JavaScript function to open a new tab and run the Python script -->
<script>
    function runPythonScript(command) {
        // Open the Python script in a new tab
        window.open("run_python.php?command=" + command, "_blank");
    }
</script>

<!-- Message container -->
<div class="message-container">
    <?php
    function displayMessage() {
        echo "The button Run Webcam for Object Recognition open a webcam to recognize the equipment, press 'Q' to shut down the webcam.";
    }
    
    // Call the function to display the message
    displayMessage();
    ?>
</div>

</body>
</html>
