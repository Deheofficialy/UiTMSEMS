<?php
// Get the command to execute the Python script from the query parameter
$command = urldecode($_GET['command']);

// Execute the Python script in the new tab
exec($command);
?>
