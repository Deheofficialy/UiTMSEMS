<?php
// Define the path to the Python executable
$pythonExecutable = "python"; // Adjust this if needed

// Define the path to the Python script
$pythonScriptPath = "yolov8_n_opencv.py"; // Adjust this with the correct path

// Construct the command to run the Python script
$command = $pythonExecutable . " " . $pythonScriptPath;

// Execute the Python script in a new tab
echo '<script>window.open("run_python.php?command=' . urlencode($command) . '", "_blank");</script>';
?>

