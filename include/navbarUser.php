<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/3.3.7/paper/bootstrap.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" /><link rel="stylesheet" href="./css/style.css">

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
          <li class="arrow"><a href="../user/index.php"><i class="fa fa-tachometer"></i><br>Dashboard</a></li>
              <li class="arrow"><a href="../user/viewUser.php"><i class="fa fa-user-circle-o"></i><br>Account</a></li>
          <li><a href="../user/viewEquipment.php"><i class="fa fa-futbol-o" aria-hidden="true"></i><br>View Equipment</a></li>
          <li><a href="../user/searchEquipment.php"><i class="fa fa-search" aria-hidden="true"></i><br>Search Equipment</a></li>
          <li><a href="bookEquipment.php"><i class="fa fa-file-text-o" aria-hidden="true"></i><br>Book Equipment</a></li>
          <li><a href="../logout.php"><i class="fa fa-sign-out"></i><br>Logout</a></li>
        </ul>
      </div>
    </div>
  </nav>