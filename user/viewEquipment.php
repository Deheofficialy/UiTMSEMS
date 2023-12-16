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
include('../include/newnavbarUser.php')
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
    <tr align="left" bgcolor="#f2f2f2">
      <td>
      <td>
        <table class="table table-striped table-hover">
      </td>
      <thead class="table-light" style="width:100%;">
        <th width="4%">No</th>
        <th width="17%">Equipment ID</th>
        <th width="23%">Equipment Name</th>
        <th width="11%">Equipment Stock</th>
        <th width="25%">Equipment Desc</th>
        <th width="10%">Equipment Image</th> <!-- New column for Equipment Image -->
      </thead>
    </tr>

    <?php
    $color = "1";

    for ($a = 0; $a < $numrow; $a++) {
      $row = mysqli_fetch_array($result);

      if ($color == 1) {
        echo "<tr bgcolor='#c8c9ce'>";
      } else {
        echo "<tr bgcolor='#FFFFFF'>";
      }
    ?>
      <td>&nbsp;<?php echo $a + 1; ?></td>
      <td>&nbsp;<?php echo ucwords(strtolower($row['equipmentid'])); ?></td>
      <td>&nbsp;<?php echo ucwords(strtolower($row['equipmentname'])); ?></td>
      <td>&nbsp;<?php echo ucwords(strtolower($row['equipmentstock'])); ?></td>
      <td>&nbsp;<?php echo ucwords(strtolower($row['equipmentdesc'])); ?></td>
      <td>
        <?php
        $imageDirectory = "../admin/";

        $imagePath = $imageDirectory . $row['equipmentimage'];
        if (file_exists($imagePath)) {
          echo '<img src="' . $imagePath . '" alt="Equipment Image" width="100" height="100">';
        }
        ?>
      </td>
      </tr>
    <?php
      $color = ($color == "1") ? "2" : "1";
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
</div>
</body>
</html>
