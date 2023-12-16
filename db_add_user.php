<?php

session_start();
include('./include/dbconn.php');

// REGISTER USER
if (isset($_POST['submit'])) {
  // Receive and sanitize input values
  $email = mysqli_real_escape_string($dbconn, $_POST['email']);
  $username = mysqli_real_escape_string($dbconn, $_POST['username']);
  $password = mysqli_real_escape_string($dbconn, $_POST['password']); // Store plain text password
  $telephone = mysqli_real_escape_string($dbconn, $_POST['telephone']);
  $address = mysqli_real_escape_string($dbconn, $_POST['address']);
  $gender = mysqli_real_escape_string($dbconn, $_POST['gender']);

  // Check if the email, username, or address already exists in the database
  $checkQuery = "SELECT * FROM user WHERE email = '$email' OR username = '$username' OR address = '$address'";
  $checkResult = mysqli_query($dbconn, $checkQuery);

  if (mysqli_num_rows($checkResult) > 0) {
    echo "<script>
      alert('Error: Email, username, or address already exists. Please provide unique information.');
      window.location.href = 'registration_page.php'; // Redirect to registration page
    </script>";
  } else {
    // Proceed with the registration process since the information is unique
    $query = "INSERT INTO user (username, email, password, gender, address, telephone, level_id) 
              VALUES ('$username', '$email', '$password', '$gender', '$address', '$telephone', '2')";
    
    $result = mysqli_query($dbconn, $query);
    if ($result) {
      echo "<script>
        alert('User data successfully registered');
        window.location.href = 'index.php';
      </script>";
    } else {
      echo "Error: " . mysqli_error($dbconn);
    }
  }
}
?>



// ... 