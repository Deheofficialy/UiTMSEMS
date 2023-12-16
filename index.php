<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <link rel="icon" href="your-logo.png">
  <title>Login/Sign Up Page</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href='https://fonts.googleapis.com/css?family=Roboto:300,400,600' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" href="./css/style.css">
</head>
<body>
<style>
    /* Add CSS styles to adjust the image width */
    .backLeft {
      width: 50%; /* Set the width to 50% of the left page */
      display: flex;
      align-items: center;
      justify-content: center;
    }
    .backLeft img {
      max-width: 100%; /* Ensure the image doesn't exceed its container */
    }
  </style>
</head>
<body>
<div id="back">
  <canvas id="canvas" class="canvas-back"></canvas>
  <div class="backLeft">
    <!-- Place your image here -->
    <img src="system-covers.png" alt="Image">
  </div>
  <div class="backRight">    
  </div>
</div>

<div id="slideBox">
  <div class="topLayer">
    <div class="right">
      <div class="content">
      <img src="your-logo.png" alt="Logo" style="max-width: 150px;"> <!-- Adjust the width as needed -->
        <h2>Welcome to UiTM SEMS</h2>
        <h2>Login Page</h2>
        <form id="form-login" method="POST" action="process.php">
          <div class="form-element form-stack">
            <label for="username-login" class="form-label">Username</label>
            <input id="username-login" type="text" name="username">
          </div>
          <div class="form-element form-stack">
            <label for="password-login" class="form-label">Password</label>
            <input id="password-login" type="password" name="password">
          </div>
          <div class="form-element form-submit">
            <button type="submit" id="logIn" class="login" name="login">Log In</button>
            <button type="button" id="showSignUp" class="login off" onclick="window.location.href = 'registration_page.php';">Sign Up</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- JavaScript code for handling sign-up pop-up -->
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/paper.js/0.11.3/paper-full.min.js'></script>
<script src="./js/script.js"></script>
</body>
</html>
