<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/3.3.7/paper/bootstrap.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
  <link rel="stylesheet" href="./css/style.css">

</head>

<body>
  <!-- partial:index.partial.html -->
  <nav class="navbar navbar-inverse navbar-fixed-left">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-controls="navbar">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
      </div>
      <div id="navbar" class="navbar-collapse collapse">
        <ul class="nav navbar-nav">
          <li class="arrow"><a href="../admin/index.php"><i class="fa fa-tachometer"></i><br>Recognition</a></li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"><i class="fa fa-user-circle-o" aria-hidden="true"></i><br>Manage<span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="./updateAdmin.php">Manage Admin Account</a></li>
              <li><a href="./viewUser.php">Manage User Account</a></li>
            </ul>
          </li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"><i class="fa fa-pencil" aria-hidden="true"></i><br>Manage<span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="../admin/managebooking.php">Manage Booking</a></li>
              <li><a href="./viewEquipment.php">Manage Equipment</a></li>
            </ul>
          </li>
          <li><a href="searchEquipment.php"><i class="fa fa-search" aria-hidden="true"></i><br>Search Equipment</a></li>
          <li><a href="../admin/addEquipment.php"><i class="fa fa-plus" aria-hidden="true"></i><br>Add Equipment</a></li>
          <li><a href="../logout.php"><i class="fa fa-sign-out"></i><br>Logout</a></li>
        </ul>
      </div>
    </div>
  </nav>