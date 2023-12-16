<?php
include('../include/dbconn.php');
include("../session.php");
session_start();

if (!isset($_SESSION['username'])) {
  header('Location: ../login');
}
?>

<?php
// Navbar
include('../include/newnavbar.php')
?>
<!-- partial -->
<div class="main">
  <div class="container">
    <br>
    <h3>Equipment Available</h3>
    <?php
    $query = "SELECT * FROM equipment WHERE equipmentstock > '1' ORDER BY equipmentid";
    $result = mysqli_query($dbconn, $query) or die("Error: " . mysqli_error($dbconn));
    $numrow = mysqli_num_rows($result);
    ?>
    <table class="table table-striped table-hover">
      <thead class="table-light">
        <tr>
          <th>No</th>
          <th>Equipment ID</th>
          <th>Equipment Name</th>
          <th>Equipment Stock</th>
          <th>Equipment Desc</th>
          <th>Equipment Image</th> <!-- New column for Equipment Image -->
          <th>Action</th>
        </tr>
      </thead>

      <?php
      $color = "1";

      for ($a = 0; $a < $numrow; $a++) {
        $row = mysqli_fetch_array($result);
        if ($color == 1) {
          echo "<tr bgcolor='#c8c9ce'>";
        ?>
          <td>&nbsp;<?php echo $a + 1; ?></td>
          <td>&nbsp;<?php echo ucwords(strtolower($row['equipmentid'])); ?></td>
          <td>&nbsp;<?php echo ucwords(strtolower($row['equipmentname'])); ?></td>
          <td>&nbsp;<?php echo ucwords(strtolower($row['equipmentstock'])); ?></td>
          <td>&nbsp;<?php echo ucwords(strtolower($row['equipmentdesc'])); ?></td>
          <td>
            <?php
            $imagePath = $row['equipmentimage'];
            if (!empty($imagePath)) {
              echo "<img src='$imagePath' alt='Equipment Image' width='100' height='100'>";
            }
            ?>
          </td>
          <td width="5%" align="center"><a class="btn btn-primary" href="updateEquipment.php?id=<?php echo $row['equipmentid']; ?>">Update</a></td>
          <td width="5%" align="center"><a class="btn btn-danger" onclick='javascript:confirmationDelete($(this));return false;' href="deleteEquipment.php?id=<?php echo $row['equipmentid']; ?>">Delete</a></td>
          </tr>
        <?php
          $color = "2";
        } else {
          echo "<tr bgcolor='#FFFFFF'>";
        ?>
          <td>&nbsp;<?php echo $a + 1; ?></td>
          <td>&nbsp;<?php echo ucwords(strtolower($row['equipmentid'])); ?></td>
          <td>&nbsp;<?php echo ucwords(strtolower($row['equipmentname'])); ?></td>
          <td>&nbsp;<?php echo ucwords(strtolower($row['equipmentstock'])); ?></td>
          <td>&nbsp;<?php echo ucwords(strtolower($row['equipmentdesc'])); ?></td>
          <td>
            <?php
            $imagePath = $row['equipmentimage'];
            if (!empty($imagePath)) {
              echo "<img src='$imagePath' alt='Equipment Image' width='100' height='100'>";
            }
            ?>
          </td>
          <td width="5%" align="center"><a class="btn btn-primary" href="updateEquipment.php?id=<?php echo $row['equipmentid']; ?>">Update</a></td>
          <td width="5%" align="center"><a class="btn btn-danger" onclick='javascript:confirmationDelete($(this));return false;' href="deleteEquipment.php?id=<?php echo $row['equipmentid']; ?>">Delete</a></td>
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
  </div>
</div>
</body>
<script>
  function confirmationDelete(anchor) {
    var conf = confirm('Are you sure want to delete this record?');
    if (conf)
      window.location = anchor.attr("href");
  }
</script>

</html>
