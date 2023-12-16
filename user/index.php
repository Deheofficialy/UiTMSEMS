
<?php
include("../session.php");
include('../include/dbconn.php');
session_start();
$username = $_SESSION['username'];
if (!isset($_SESSION['username'])) {
  header('Location: ../login');
}

?>
<?php include('../include/newnavbarUser.php') ?>
<!-- partial -->
<div class="main" style="margin-left: 5%; margin-right: 5%;">
  <br>
  <h3><i class="fas fa-door-open" style="color:#673AB7 "></i> Welcome <?php echo $username; ?></h3>
  <br>
  <?php
  $q1 = "select * from user where username = '$username'";
  $r1 = mysqli_query($dbconn, $q1) or die(mysqli_error($dbconn));
  $r0 = mysqli_fetch_assoc($r1);
  $userId = $r0['user_id'];
  $q2 = "select * from booking where user_id =$userId AND (return_status !=1  OR status=2) order by booking_id desc limit 1";
  $r2 = mysqli_query($dbconn, $q2) or die(mysqli_error($dbconn));
  $rr = mysqli_fetch_assoc($r2);
  if ($rr) {
    $bookingId = $rr['booking_id'];
    $status = $rr['status'];
    $equipmentId = $rr['equipment_id'];
    $quantity = $rr['quantity'];
    $borrowDate = $rr['date_borrow'];
    $returnDate = $rr['date_return'];
    $note = $rr['note'];
    $bookingType = $rr['booking_type'];
    $decline = $rr['decline_reason'];
    $q3 = "select * from equipment where equipmentid= $equipmentId";
    $r3 = mysqli_query($dbconn, $q3) or die("Error: " . mysqli_error($dbconn));
    $rs = mysqli_fetch_assoc($r3);
    $equipmentN = $rs['equipmentname'];
    echo '<table class="table">';
    if ($status == 1) {
      if ($bookingType == 1) { //if he accepted booking is On The Go
        if ($rr['user_retrieve'] == 0) {
          echo '<div class="border border-primary rounded px-3 py-3"><h4><b>Booking ID: ' . $rr['booking_id'] . '</b> </h4>';
          echo '<br>
         Equipment ID:<input type="text" class="form-control"value="' . $equipmentId . '" readonly>
        <br>
        Equipment Name:<input type="text"class="form-control" value="' . $equipmentN . '" readonly>
        <br>
        Quantity:<input type="number" class="form-control"value="' . $quantity . '" readonly>
        <br>
        Borrow Date:<input type="text" class="form-control"name="dateborrow" value=" ' . $rr['booking_date'] . '" readonly>
        <br>
        Purpose of Booking:<input type="text" maxlength="255" class="form-control"name="note" style="width:20% ; height:100px;" value="' . $note . '" readonly>
        <br><b>Your Booking Application Has Been Approved!!:</b>
        <form action="claimRetrieve.php?id=' . $bookingId . '" method="post">
        <br>
        <br>
        <button type="submit" class="btn btn-primary" style="margin-right:10px;" name= "retrieve">Claim Equipment</button>
        <button type="submit" class="btn btn-success" name= "return">Return Equipment</button>
      </form>
       </div>';
        } else { //if user already took the equipment
          echo '<div class="border border-primary rounded px-3 py-3"><h4><b>Booking ID: ' . $rr['booking_id'] . '</b> </h4>';
          echo '<br>
         Equipment ID:<input type="text"class="form-control" value="' . $equipmentId . '" readonly>
        <br>
        Equipment Name:<input type="text"class="form-control" value="' . $equipmentN . '" readonly>
        <br>
        Quantity:<input type="number"class="form-control" value="' . $quantity . '" readonly>
        <br>
        Borrow Date:<input type="text"class="form-control" name="dateborrow" value=" ' . $rr['booking_date'] . '" readonly>
        <br>
        Purpose of Booking:<input type="text" maxlength="255"class="form-control" name="note" style="width:20% ; height:100px;" value="' . $note . '" readonly>
        <br><b>Your Booking Application Has Been Approved!!:</b>
        <form action="claimRetrieve.php?id=' . $bookingId . '" method="post">
        <br>
        <br>
        <button type="submit" class="btn btn-success" name= "return">Return Equipment</button>
      </form>
      </div>';
        }
      } else if ($bookingType == 2 && $status == 1) { //if he accepted booking is durational

        if ($rr['user_retrieve'] == 0) {
          echo '<div class="border border-primary rounded px-3 py-3"><h4><b>Booking ID: ' . $rr['booking_id'] . '</b> </h4>';
          echo '<br>
         Equipment ID:<input type="text" class="form-control"value="' . $equipmentId . '" readonly>
        <br>
        Equipment Name:<input type="text" class="form-control"value="' . $equipmentN . '" readonly>
        <br>
        Quantity:<input type="number" class="form-control"value="' . $quantity . '" readonly>
        <br>
        Borrow Date:<input type="text" class="form-control"name="dateborrow" value=" ' . $borrowDate . '" readonly>
        <br>
        Borrow Date:<input type="text" class="form-control"name="dateborrow" value=" ' . $returnDate . '" readonly>
        <br>
        Purpose of Booking:<input type="text" maxlength="255" class="form-control"name="note" style="width:20% ; height:100px;" value="' . $note . '" readonly>
        <br><b>Your Booking Application Has Been Approved!!:</b>
        <form action="claimRetrieve.php?id=' . $bookingId . '" method="post">
        <br>
        <br>
        <button type="submit" class="btn btn-primary" style="margin-right:10px;" name= "retrieve">Claim Equipment</button>
        <button type="submit" class="btn btn-success" name= "return">Return Equipment</button>
        </form>
        </div>';
        } else {
          echo '<div class="border border-primary rounded px-3 py-3"><h4><b>Booking ID: ' . $rr['booking_id'] . '</b> </h4>';
          echo '<br>
           Equipment ID:<input type="text" class="form-control"value="' . $equipmentId . '" readonly>
          <br>
          Equipment Name:<input type="text" class="form-control"value="' . $equipmentN . '" readonly>
          <br>
          Quantity:<input type="number" class="form-control"value="' . $quantity . '" readonly>
          <br>
          Borrow Date:<input type="text" class="form-control"name="dateborrow" value=" ' . $borrowDate . '" readonly>
          <br>
          Borrow Date:<input type="text" class="form-control"name="dateborrow" value=" ' . $returnDate . '" readonly>
          <br>
          Purpose of Booking:<input type="text" maxlength="255" class="form-control"name="note" style="width:20% ; height:100px;" value="' . $note . '" readonly>
          <br><b>Your Booking Application Has Been Approved!!:</b>
          <form action="claimRetrieve.php?id=' . $bookingId . '" method="post">
          <br>
          <br>
          <button type="submit" class="btn btn-success" name= "return">Return Equipment</button>
        </form>
        </div>';
        }
      }
    } else if ($bookingType == 2 && $status == 2) {
      echo '<div class="border border-danger rounded px-3 py-3"><h4><b>Booking ID: ' . $rr['booking_id'] . '</b> </h4>';
      echo '<br>
       Equipment ID:<input class="form-control" type="text" value="' . $equipmentId . '" readonly>
      <br>
      Equipment Name:<input type="text"class="form-control" value="' . $equipmentN . '" readonly>
      <br>
      Quantity:<input type="number"class="form-control" value="' . $quantity . '" readonly>
      <br>
      Borrow Date:<input type="text"class="form-control" name="dateborrow" value=" ' . $borrowDate . '" readonly>
      <br>
      Return Date:<input type="text"class="form-control" name="dateborrow" value=" ' . $returnDate . '" readonly>
      <br>
      Purpose of Booking:<input type="text" maxlength="255"class="form-control" name="note" style="width:20% ; height:100px;" value="' . $note . '" readonly>
      <br>
      <div class="d-inline p-2 bg-danger text-white">
      <b class="lead">Unfotunately your booking has been rejected! 
      <br> Because: ' . $decline . ' </b>
      <br>
      </div>
      <br> <b class="lead">If you wish to make another booking click the button below!</b>
      <br>
      <a href="bookEquipment.php" class="btn btn-danger">Book an Equipment</a>
    </div>';
    } else {
      //if he pending booking is durational
      echo '<div class="border border-warning rounded px-3 py-3"><h4><b>Booking ID: ' . $rr['booking_id'] . '</b> </h4>';
      echo '<br>
         Equipment ID:<input type="text" class="form-control" value="' . $equipmentId . '" readonly>
        <br>
        Equipment Name:<input type="text" class="form-control" value="' . $equipmentN . '" readonly>
        <br>
        Quantity:<input type="number" class="form-control" value="' . $quantity . '" readonly>
        <br>
        Borrow Date:<input type="text" class="form-control" name="dateborrow" value=" ' . $borrowDate . '" readonly>
        <br>
        Borrow Date:<input type="text" class="form-control" name="dateborrow" value=" ' . $returnDate . '" readonly>
        <br>
        Purpose of Booking:<input type="text" maxlength="255" class="form-control" name="note" style="width:20% ; height:100px;" value="' . $note . '" readonly>';

      echo '<br><button class="btn btn-warning">Your Booking Application Is Still Processing Please Wait:</button>
      <a class="btn btn-danger" onclick="javascript:confirmationDelete($(this));return false;" href="deleteUserBooking.php?id='.$bookingId.'">Delete</a>
        </div>';
    }
  } else {
    echo 
    '<table class="table">
        <div class="card text-center">
      <div class="card-body">
        <h5 class="card-title"> Seems like you havent made any booking request yet! Lets Book the Equipment</h5>
        <p class="card-text">Click The button below to start book a sport equipment</p>
        <a href="bookEquipment.php" class="btn btn-primary">Book Equipment</a>
      </div>
    </div>
        </table>';
  }
  ?>
</div>
</div>
<script>
    function confirmationDelete(anchor) {
        var conf = confirm('Are you sure want to delete this record?');
        if (conf)
            window.location = anchor.attr("href");
    }
</script>
</body>

</div>


</html>