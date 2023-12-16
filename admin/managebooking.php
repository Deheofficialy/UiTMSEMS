<?php
include("../include/dbconn.php");
include("../session.php");
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: ../login');
}

include("../include/newnavbar.php");
?>

<head>
    <title>Manage Booking</title>
</head>
<br>
<div class="main" style="margin-left:5% ; margin-right:5%;">
    <h3>Manage Booking Application</h3>
    <?php
    $q1 = "select * from booking where booking_type = 2 and status = 3 and return_status=0";
    $r1 = mysqli_query($dbconn, $q1) or die("Error: " . mysqli_error($dbconn));
    $numrow = mysqli_num_rows($r1);
    ?>
    <tr align="left" bgcolor="#f2f2f2">
        <td>
        <td>
            <table class="table table-striped table-hover" style="width:100% ;">
        </td>
        <thead class="table-light" style="width:100% ;">
            <th width="2%">No
            <th width="5%">Booking ID</th>
            <th width="5%">User ID</th>
            <th width="5%">Equipment ID</th>
            <th width="5%">Date Borrow</th>
            <th width="5%">Date Return</th>
            <th width="5%">Quantity</th>
            <th width="5%" align="center" style="text-align:center;" colspan="2">Action</th>
        </thead>
    </tr>
    <?php
    $color = "1";

    for ($a = 0; $a < $numrow; $a++) {
        $row = mysqli_fetch_array($r1);

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
            <td width="7%" align="center"><a class="btn btn-success" href="verifyBooking.php?id=<?php echo $row['booking_id']; ?>">Detail</a></td>
            <td width="3%" align="center"><a class="btn btn-danger " onclick='javascript:confirmationDelete($(this));return false;' href=" deleteBooking.php?id=<?php echo $row['booking_id']; ?>">Delete</a></td>
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
            <td width="7%" align="center"><a class="btn btn-success" href="verifyBooking.php?id=<?php echo $row['booking_id']; ?>">Detail</a></td>
            <td width="3%" align="center"><a class="btn btn-danger" onclick='javascript:confirmationDelete($(this));return false;' href="deleteBooking.php?id=<?php echo $row['booking_id']; ?>">Delete</a></td>
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
</div>

</body>
<script>
    function confirmationDelete(anchor) {
        var conf = confirm('Are you sure want to delete this record?');
        if (conf)
            window.location = anchor.attr("href");
    }
</script>