<?php
include('../include/dbconn.php');
include("../session.php");

if (isset($_POST['search'])) {
  $searchname = $_POST['searchname'];
} else {
  header("location:index.php");
}
?>
<style>
  #tableSearch {
    margin: 0;
    padding: 0;
    border-radius: 2px;
  }

  .main {
    top: 20%;
  }

  .container {
    top: 20%;
  }
</style>
<?php
include('./searchEquipment.php');
?>
<?php
$query = "SELECT * FROM equipment WHERE equipmentname LIKE '%$searchname%' ";
$result = mysqli_query($dbconn, $query) or die("Error: " . mysqli_error($dbconn));
$numrow = mysqli_num_rows($result);
?>
<div class="main">
  <div class="container">
    <br>
    <br>
    <br><br><br><br><br>
    <tr align="left" bgcolor="#f2f2f2">
      <td>
        <table class="table table-striped table-hover">
          <thead class="table-light" style="width:100%;">
            <th width="4%">No</th>
            <th width="17%">Equipment ID</th>
            <th width="23%">Equipment Name</th>
            <th width="15%">Equipment Stock</th>
            <th width="25%">Equipment Image</th>
            <th width="25%">Equipment Desc</th>
            <th align="center" colspan="2" style="text-align:center ;">Action</th>
          </thead>
          <?php
          $color = "1";

          for ($a = 0; $a < $numrow; $a++) {
            $row = mysqli_fetch_array($result);

            echo "<tr bgcolor='" . ($color == 1 ? '#c8c9ce' : '#FFFFFF') . "'>";
          ?>
            <td>&nbsp;<?php echo $a + 1; ?></td>
            <td>&nbsp;<?php echo ucwords(strtolower($row['equipmentid'])); ?></td>
            <td>&nbsp;<?php echo ucwords(strtolower($row['equipmentname'])); ?></td>
            <td>&nbsp;<?php echo ucwords(strtolower($row['equipmentstock'])); ?></td>
            <td>
              <?php
              $imagePath = $row['equipmentimage'];
              if (!empty($imagePath) && file_exists($imagePath)) {
                echo "<img src='$imagePath' alt='Equipment Image' width='100' height='100'>";
              }
              ?>
            </td>
            <td>&nbsp;<?php echo ucwords(strtolower($row['equipmentdesc'])); ?></td>
            <td width="5%" align="center"><a class="btn btn-primary" href="updateEquipment.php?id=<?php echo $row['equipmentid']; ?>">Update</a></td>
            <td width="5%" align="center"><a class="btn btn-danger" onclick='javascript:confirmationDelete($(this));return false;' href="deleteEquipment.php?id=<?php echo $row['equipmentid']; ?>">Delete</a></td>
            </tr>
          <?php
            $color = ($color == 1 ? "2" : "1");
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
