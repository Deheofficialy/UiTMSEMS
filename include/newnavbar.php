<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>SEMS</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css'>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.2/css/all.css'>
    <link rel="stylesheet" href="../new/style.css">

</head>

<body>
    <!-- partial:index.partial.html -->
    <nav class="navbar navbar-expand-custom navbar-mainbg">
        <a class="navbar-brand navbar-logo" href="index.php">UITM:Sport Equipment Management System (SEMS)</a>
        <button class="navbar-toggler" type="button" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-bars text-white"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">

                <li class="nav-item">
                <a class="nav-link" href="./recognize.php"target="_blank">Recognition</a>
                <li class="nav-item">
                    <a class="nav-link" href="./updateAdmin.php"></i>Manage Admin</a>
                </li>
                <li class=" nav-item">
                    <a class="nav-link" href="./viewUser.php"></i>View User</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../admin/managebooking.php"></i>Manage Booking</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./viewEquipment.php"></i>View Equipment</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../admin/searchEquipment.php">Search Equipment</a>
                </li>
                <li class="nav-item">
                    <a href="../admin/addEquipment.php"></i>Add Equipment</a>
                </li>
                <li class="nav-item">
                    <a href="../logout.php"></i>Logout</a>
                </li>
            </ul>
        </div>
    </nav>
    <?php include('../include/script.php') ?>
    <!-- partial -->