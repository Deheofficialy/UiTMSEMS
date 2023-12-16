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

$query = "SELECT equipment_id,count(equipment_id) as total from booking where booking_type = 2 group by equipment_id order by total desc limit 1";
$rCountQ = mysqli_query($dbconn, $query);
$ru = mysqli_fetch_assoc($rCountQ);
$mostUser = $ru['equipment_id'];
$numberOfData = $ru['total'];

$q = "select * from equipment where equipmentid=$mostUser";
$res = mysqli_query($dbconn, $q) or die(mysqli_error($dbconn));
$r = mysqli_fetch_assoc($res);
$ename = $r['equipmentname'];

$query2 = "Select count(booking_id) as total from booking where booking_type = 2";
$rCountb = mysqli_query($dbconn, $query2);
$rb = mysqli_fetch_assoc($rCountb);
$countBooking = $rb['total'];
?>
<!-- partial -->
<div class="main" style="margin-left: 5%; margin-right:5%">
    <br>
    <br>
    <?PHP
    $q = "select * from booking where booking_type = 2 ";
    $r = mysqli_query($dbconn, $q) or die(mysqli_error($dbconn));
    $numrow = mysqli_num_rows($r);
    ?>
    <p class="lead">Durational Booking Records</p>
    <button type="button" class="btn btn-warning" data-bs-toggle="tooltip" data-bs-placement="top" title="Tooltip on top">
        Number Of Bookings :
    </button>
    <button type="button" class="btn btn-warning" data-bs-toggle="tooltip" data-bs-placement="top" title="Tooltip on top">
        <?php echo $countBooking ?>
    </button>
    <button type="button" class="btn btn-success" style="margin-left: 20px;" data-bs-toggle="tooltip" data-bs-placement="top" title="Tooltip on top">
        Most Booked Equipment:
    </button>
    <button type="button" class="btn btn-success" data-bs-toggle="tooltip" data-bs-placement="top" title="Tooltip on top">
        <?php echo $ename ?>
    </button>
    <button type="button" class="btn btn-primary" style="margin-left: 20px;" data-bs-toggle="tooltip" data-bs-placement="top" title="Tooltip on top">
        Number Of Booked:
    </button>
    <button type="button" class="btn btn-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Tooltip on top">
        <?php echo $numberOfData ?>
    </button>
    <td>
    <td>
        <br>
        <br>
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
        $row = mysqli_fetch_array($r);

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