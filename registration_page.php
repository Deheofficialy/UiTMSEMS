<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Registration</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href='https://fonts.googleapis.com/css?family=Roboto:300,400,600' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" href="./css/style.css">
  <style>
    /* Additional inline styles can be added here */
    body {
      background-image: url('background.jpg'); /* Specify the path to your background image */
      background-size: cover; /* Adjust this property as needed */
      background-repeat: no-repeat;
      background-attachment: fixed;
    }

    .registration-container {
      background: #FFFF;
      max-width: 400px;
      margin: 0 auto;
      padding: 20px;
      border: 1px solid #ddd;
      border-radius: 5px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .form-element {
      margin-bottom: 20px;
    }

    .form-label {
      font-weight: 600;
    }

    .form-input {
      width: 100%;
      padding: 10px;
      border: 1px solid #ddd;
      border-radius: 5px;
    }

    .radio-label {
      margin-right: 10px;
    }

    .form-submit {
      text-align: center;
    }

    .register-button {
      background: #007BFF;
      color: #fff;
      border: none;
      padding: 10px 20px;
      border-radius: 5px;
      cursor: pointer;
    }

    .register-button:hover {
      background: #0056b3;
    }

    .error-message {
      color: #FF0000;
      margin-top: 5px;
    }
  </style>
</head>

<body>
  <div class="registration-container">
    <h2>Registration</h2>
    <form id="form-signup" method="post" action="./db_add_user.php">
      <div class="form-element">
        <label for="email" class="form-label">Email</label>
        <input id="email" type="email" name="email" class="form-input" required>
      </div>
      <div class="form-element">
        <label for="username-signup" class="form-label">Username</label>
        <input id="username-signup" type="text" name="username" pattern="^(?=.*[a-zA-Z])[a-zA-Z0-9]+$" title="Must contain at least one letter, and can include numbers" class="form-input" required>
      </div>
      <div class="form-element">
        <label for="password-signup" class="form-label">Password</label>
        <input id="password-signup" type="password" name="password" minlength="6" class="form-input" required>
      </div>
      <div class="form-element">
        <label for="telephone-signup" class="form-label">Telephone Number</label>
        <input id="telephone-signup" type="tel" name="telephone" pattern="[0-9]{10,11}" title="Please enter a valid 10-digit phone number" class="form-input" required>
      </div>
      <div class="form-element">
        <label for="address-signup" class="form-label">Matric/Staff Number</label>
        <input id="address-signup" type="text" name="address" class="form-input" required>
      </div>
      <div class="form-element">
        <label class="form-label">Gender</label>
        <label for="male" class="radio-label">
          <input id="male" type="radio" name="gender" value="1" required> Male
        </label>
        <label for="female" class="radio-label">
          <input id="female" type="radio" name="gender" value="2" required> Female
        </label>
      </div>
      <div class="form-element form-submit">
        <button class="register-button" type="submit" name="submit" value="save">Register</button>
      </div>
      <a href="index.php" class="login-button">Login</a>
    </form>
  </div>
</body>

</html>
