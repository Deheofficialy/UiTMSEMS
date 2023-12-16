<?php
include("../session.php");
include('../include/dbconn.php');
session_start();

if (!isset($_SESSION['username'])) {
  header('Location: ../login');
}

?>

<?php
include('../include/newnavbar.php');

$query = "Select count(user_id) as total from user";
$rCountQ = mysqli_query($dbconn, $query);
$ru = mysqli_fetch_assoc($rCountQ);
$countUser = $ru['total'];

$query1 = "Select count(equipmentid) as total from equipment";
$rCount = mysqli_query($dbconn, $query1);
$re = mysqli_fetch_assoc($rCount);
$countEquipment = $re['total'];

$query2 = "Select count(booking_id) as total from booking";
$rCountb = mysqli_query($dbconn, $query2);
$rb = mysqli_fetch_assoc($rCountb);
$countBooking = $rb['total'];

$query3 = "Select count(booking_id) as total from booking where status = 3";
$rCountbp = mysqli_query($dbconn, $query3);
$rbp = mysqli_fetch_assoc($rCountbp);
$countBookingp = $rbp['total'];
?>
<!-- partial -->
<div class="main" style="margin-left: 5%; margin-right:5%">
  <br>
  <br>
  <h3 class="display-4"><i class="fas fa-door-open" style="color:#673AB7 ;"></i> Welcome <?php echo $_SESSION['username']; ?> </h3>
  <br>
  <div style="display:flex; justify-content:space-between;">
    <div class="card text-white bg-primary mb-3" style="width: 18rem; height:196;">
      <div class="card-body">
        <h5 class="card-title"><i class="fas fa-users"></i> Users: <?php echo $countUser; ?></h5>

      </div>
    </div>
    <div class="card text-white bg-success mb-3" style="width: 18rem; height:196;">
      <div class="card-body">
        <h5 class="card-title"><i class="fas fa-basketball-ball"></i> Equipments: <?php echo $countEquipment; ?></h5>
      </div>
    </div>

    <div class="card text-white bg-danger mb-3" style="width: 18rem; height:196;">
      <div class="card-body">
        <h5 class="card-title"><i class="fas fa-book"></i> Bookings: <?php echo $countBooking; ?></h5>

      </div>
    </div>
    <div class="card text-white bg-warning mb-3" style="width: 18rem; height:196;">
      <div class="card-body">
        <h5 class="card-title"><i class="fas fa-exclamation"></i> Pending Bookings: <?php echo $countBookingp; ?></h5>

      </div>
    </div>

  </div>
  <br>
  <?PHP
  $q = "select * from booking where booking_type = 1 and status != 2 limit 5";
  $r = mysqli_query($dbconn, $q) or die(mysqli_error($dbconn));
  $numrow = mysqli_num_rows($r);
  ?>
  <p class="lead">On The Go Booking Records</p>
  <td>
    <table class="table table-striped table-hover">
  </td>
  <thead class="table-light" style="width:100% ;">
    <th width="2%">No
    <th width="5%">Booking ID</th>
    <th width="5%">User ID</th>
    <th width="5%">Equipment ID</th>
    <th width="5%">Booking Date</th>
    <th width="5%">Quantity</th>
    <th width="5%">Status</th>
    <th width="5%">Return</th>
  </thead>
  <?php
  $color = "1";

  for ($a = 0; $a < $numrow; $a++) {
    $row = mysqli_fetch_array($r);

    if ($color == 1) {
      //echo "<tr bgcolor='#c8c9ce'>"
  ?>
      <td>&nbsp;<?php echo $a + 1; ?></td>
      <td>&nbsp;<?php echo ucwords(strtolower($row['booking_id'])); ?></td>
      <td>&nbsp;<?php echo ucwords(strtolower($row['user_id'])); ?></td>
      <td>&nbsp;<?php echo ucwords(strtolower($row['equipment_id'])); ?></td>
      <td>&nbsp;<?php echo ucwords(strtolower($row['booking_date'])); ?></td>
      <td>&nbsp;<?php echo ucwords(strtolower($row['quantity'])); ?></td>
      <td><?PHP
          if ($row['status'] == 1) {
            echo "accepted";
          } else {
            echo "declined";
          }
          ?></td>
      <td>&nbsp;
        <?PHP
        if ($row['return_status'] == 1) {
          echo "returned";
        } else {
          echo "pending";
        }
        ?>
      </td>
      </tr>
    <?php
      $color = "2";
    } else {
      //echo "<tr bgcolor='#FFFFFF'>"
    ?>
      <td>&nbsp;<?php echo $a + 1; ?></td>
      <td>&nbsp;<?php echo ucwords(strtolower($row['booking_id'])); ?></td>
      <td>&nbsp;<?php echo ucwords(strtolower($row['user_id'])); ?></td>
      <td>&nbsp;<?php echo ucwords(strtolower($row['equipment_id'])); ?></td>
      <td>&nbsp;<?php echo ucwords(strtolower($row['booking_date'])); ?></td>
      <td>&nbsp;<?php echo ucwords(strtolower($row['quantity'])); ?></td>
      <td>
        <?PHP
        if ($row['status'] == 1) {
          echo "accepted";
        } else {
          echo "declined";
        }
        ?>
      </td>
      </td>
      <td>&nbsp;
        <?PHP
        if ($row['return_status'] == 1) {
          echo "returned";
        } else {
          echo "pending";
        }
        ?>
      </td>

      </tr>
  <?php
      $color = "1";
    }
  }
  if ($numrow == 0) {
    echo '<tr>
    				<td colspan="8"><font color="#FF0000">No record available.</font></td>
 			   </tr>';
  }
  ?>
  </table>
  </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  </table>
  <br>
  <a href="./otg.php" class="btn btn-outline-primary">More Detail</a>
  <br>
  <br>
  <!-- For second type of booking,durational-->
  <p class="lead">Durational Booking Records</p>
  <?php
  $q1 = "select * from booking where booking_type = 2 limit 5";
  $r1 = mysqli_query($dbconn, $q1) or die("Error: " . mysqli_error($dbconn));
  $numrow = mysqli_num_rows($r1);
  ?>
  <td>
    <table class="table table-striped table-hover">
  </td>
  <thead class="table-light" style="width:100% ;">
    <th width="2%">No
    <th width="5%">Booking ID</th>
    <th width="5%">User ID</th>
    <th width="5%">Equipment ID</th>
    <th width="5%">Date Borrow</th>
    <th width="5%">Expected Date Return</th>
    <th width="5%">Quantity</th>
    <th width="5%">Status</th>
    <th width="5%">Return</th>
  </thead>
  <?php
  $color = "1";

  for ($a = 0; $a < $numrow; $a++) {
    $row = mysqli_fetch_array($r1);

    if ($color == 1) {
      //echo "<tr bgcolor='#c8c9ce'>"
  ?>
      <td>&nbsp;<?php echo $a + 1; ?></td>
      <td>&nbsp;<?php echo ucwords(strtolower($row['booking_id'])); ?></td>
      <td>&nbsp;<?php echo ucwords(strtolower($row['user_id'])); ?></td>
      <td>&nbsp;<?php echo ucwords(strtolower($row['equipment_id'])); ?></td>
      <td>&nbsp;<?php echo ucwords(strtolower($row['date_borrow'])); ?></td>
      <td>&nbsp;<?php echo ucwords(strtolower($row['date_return'])); ?></td>
      <td>&nbsp;<?php echo ucwords(strtolower($row['quantity'])); ?></td>
      <td>
        <?PHP
        if ($row['status'] == 1) {
          echo "accepted";
        } else if ($row['status'] == 3) {
          echo "pending";
        } else {
          echo "declined";
        }
        ?>
      </td>
      </td>
      <td>&nbsp;
        <?PHP
        if ($row['return_status'] == 1) {
          echo "returned";
        } else {
          echo "pending";
        }
        ?>
      </td>
      </tr>
    <?php
      $color = "2";
    } else {
      //echo "<tr bgcolor='#FFFFFF'>"
    ?>
      <td>&nbsp;<?php echo $a + 1; ?></td>
      <td>&nbsp;<?php echo ucwords(strtolower($row['booking_id'])); ?></td>
      <td>&nbsp;<?php echo ucwords(strtolower($row['user_id'])); ?></td>
      <td>&nbsp;<?php echo ucwords(strtolower($row['equipment_id'])); ?></td>
      <td>&nbsp;<?php echo ucwords(strtolower($row['date_borrow'])); ?></td>
      <td>&nbsp;<?php echo ucwords(strtolower($row['date_return'])); ?></td>
      <td>&nbsp;<?php echo ucwords(strtolower($row['quantity'])); ?></td>
      <td>
        <?PHP
        if ($row['status'] == 1) {
          echo "accepted";
        } else if ($row['status'] == 3) {
          echo "pending";
        } else {
          echo "declined";
        }
        ?>
      </td>
      <td>&nbsp;
        <?PHP
        if ($row['return_status'] == 1) {
          echo "returned";
        } else {
          echo "pending";
        }
        ?>
      </td>
      </tr>
  <?php
      $color = "1";
    }
  }
  if ($numrow == 0) {
    echo '<tr>
    				<td colspan="8"><font color="#FF0000">No record available.</font></td>
 			   </tr>';
  }
  ?>
  </table>
  <a href="./durationaldata.php" class="btn btn-outline-primary">More Detail</a>
  <br>
  <br>
  </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  </table>
  <p class="lead">Pending Bookings</p>
  <?php
  $q2 = "select * from booking where status = 3 limit 5";
  $r2 = mysqli_query($dbconn, $q2) or die("Error: " . mysqli_error($dbconn));
  $numrow = mysqli_num_rows($r2);
  ?>
  <tr align="left" bgcolor="#f2f2f2">
    <td>
    <td>
      <table class="table table-striped table-hover">
    </td>
    <thead class="table-light" style="width:100% ;">
      <th width="2%">No
        </td>
      <th width="5%">Booking ID</th>
      <th width="5%">User ID</th>
      <th width="5%">Equipment ID</th>
      <th width="5%">Date Borrow</th>
      <th width="5%">Expected Date Return</th>
      <th width="5%">Quantity</th>
      <th width="5%">Status</th>
    </thead>
  </tr>
  <?php
  $color = "1";

  for ($a = 0; $a < $numrow; $a++) {
    $row = mysqli_fetch_array($r2);

    if ($color == 1) {
      echo "<tr bgcolor='#c8c9ce'>"
  ?>
      <td>&nbsp;<?php echo $a + 1; ?></td>
      <td>&nbsp;<?php echo ucwords(strtolower($row['booking_id'])); ?></td>
      <td>&nbsp;<?php echo ucwords(strtolower($row['user_id'])); ?></td>
      <td>&nbsp;<?php echo ucwords(strtolower($row['equipment_id'])); ?></td>
      <td>&nbsp;<?php echo ucwords(strtolower($row['date_borrow'])); ?></td>
      <td>&nbsp;<?php echo ucwords(strtolower($row['date_return'])); ?></td>
      <td>&nbsp;<?php echo ucwords(strtolower($row['quantity'])); ?></td>
      </td>
      <td>&nbsp;
        <?PHP
        if ($row['status'] == 1) {
          echo "accepted";
        } else if ($row['status'] == 2) {
          echo "declined";
        } else {
          echo "pending";
        }
        ?>
      </td>
      </tr>
    <?php
      $color = "2";
    } else {
      echo "<tr bgcolor='#FFFFFF'>"
    ?>
      <td>&nbsp;<?php echo $a + 1; ?></td>
      <td>&nbsp;<?php echo ucwords(strtolower($row['booking_id'])); ?></td>
      <td>&nbsp;<?php echo ucwords(strtolower($row['user_id'])); ?></td>
      <td>&nbsp;<?php echo ucwords(strtolower($row['equipment_id'])); ?></td>
      <td>&nbsp;<?php echo ucwords(strtolower($row['date_borrow'])); ?></td>
      <td>&nbsp;<?php echo ucwords(strtolower($row['date_return'])); ?></td>
      <td>&nbsp;<?php echo ucwords(strtolower($row['quantity'])); ?></td>
      </td>
      <td>&nbsp;
        <?PHP
        if ($row['status'] == 1) {
          echo "accepted";
        } else if ($row['status'] == 2) {
          echo "declined";
        } else {
          echo "pending";
        }
        ?>
      </td>
      </tr>
  <?php
      $color = "1";
    }
  }
  if ($numrow == 0) {
    echo '<tr>
    				<td colspan="10"><font color="#FF0000">No record available.</font></td>
 			   </tr>';
  }
  ?>
  </table>
  <br>
  <a href="./managebooking.php" class="btn btn-outline-primary">More Detail</a>
  <br>
  <br>
  </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  </table>
</div>
<?php include('../include/script.php') ?>