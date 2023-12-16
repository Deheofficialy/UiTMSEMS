<?php
// Include database connection settings
include('../include/dbconn.php');
include("../session.php");
session_start();
$username = $_SESSION['username'];
if (!isset($_SESSION['username'])) {
  header('Location: ../login');
}

?>

<!DOCTYPE html>
<html>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<?php
include("../include/newnavbar.php")
?>

<body>
  <br>
  <div class="main" style="margin-left: 5%; margin-right:5%">
    <h3 class="display-4">Users' Personal Data</h3>
    <br>
    <?php
    $username = $_SESSION['username'];
    $query = "SELECT * FROM user where level_id !=1 ORDER BY user_id";
    $result = mysqli_query($dbconn, $query) or die("Error: " . mysqli_error($dbconn));
    $numrow = mysqli_num_rows($result);

    //$query = "SELECT * FROM user ORDER BY name";
    //$result = mysqli_query($query) or die(mysqli_error());
    //$numrow = mysqli_num_rows($result);
    ?>
    <tr align="left" bgcolor="#f2f2f2">
      <td>
        <table class="table table-striped table-hover">
      </td>
      <thead class="table-light" style="width:100% ;">
        <th width="2%">No
        <th width="5%">No ID</td>
        <th width="26%">Name</td>
        <th width="8%">Gender</td>
        <th width="10%">Telephone</td>
        <th width="10%">email</td>
        <th width="27%">Address</td>
        <th align="center">Action</td>
      </thead>
    </tr>

    <?php
    $color = "1";

    for ($a = 0; $a < $numrow; $a++) {
      $row = mysqli_fetch_array($result);

      if ($color == 1) {
        //echo "<tr bgcolor='#FFFFCC'>"

    ?>
        <td>&nbsp;<?php echo $a + 1; ?></td>
        <td>&nbsp;<?php echo $row['user_id'] ?></td>
        <td>&nbsp;<?php echo ucwords(strtolower($row['username'])); ?></td>
        <td>&nbsp;<?php if ($row['gender'] == 1) {
                    echo 'Male';
                  } else {
                    echo 'Female';
                  } ?></td>
        <td>&nbsp;<?php echo $row['telephone']; ?></td>
        <td>&nbsp;<?php echo $row['email']; ?></td>
        <td><?php echo ucwords(strtolower($row['address'])); ?></td>
        <td width="5%" align="center"><a class="btn btn-danger " onclick='javascript:confirmationDelete($(this));return false;' href="deleteUser.php?id=<?php echo $row['user_id']; ?>">Delete</a></td>
        </tr>
      <?php
        $color = "2";
      } else {
        //echo "<tr bgcolor='#FFCC99'>"

      ?>
        <td>&nbsp;<?php echo $a + 1; ?></td>
        <td>&nbsp;<?php echo $row['user_id'] ?></td>
        <td>&nbsp;<?php echo ucwords(strtolower($row['username'])); ?></td>
        <td>&nbsp;<?php if ($row['gender'] == 1) {
                    echo 'Male';
                  } else {
                    echo 'Female';
                  } ?></td>
        <td>&nbsp;<?php echo $row['telephone']; ?></td>
        <td>&nbsp;<?php echo $row['email']; ?></td>
        <td><?php echo ucwords(strtolower($row['address'])); ?></td>
        <td width="5%" align="center"><a class="btn btn-danger" onclick='javascript:confirmationDelete($(this));return false;' href="deleteUser.php?id=<?php echo $row['user_id']; ?>">Delete</a></td>
        </tr>
    <?php
        $color = "1";
      }
    }
    if ($numrow == 0) {
      echo '<tr>
    				<td colspan="10"><font color="#FF0000">No record avaiable.</font></td>
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
<script>
  function confirmationDelete(anchor) {
    var conf = confirm('Are you sure want to delete this record?');
    if (conf)
      window.location = anchor.attr("href");
  }
</script>

</html>