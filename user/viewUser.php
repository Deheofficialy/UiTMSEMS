<?php
include('../include/dbconn.php');
include("../session.php");
session_start();
//navbar
include('../include/newnavbarUser.php');
$username = $_SESSION['username'];
$q = "select * from user where username ='$username' ";
$res = mysqli_query($dbconn, $q) or die(mysqli_error($dbconn));
$r = mysqli_fetch_assoc($res);
//creating a detail table for a specific equipment
?>
<br>
<br>
<div style="margin-left:10% ; margin-right:80%;">
  <h3>Update Profile</h3>
  <form action="updateUserProcess.php" method="POST">
    <table width=200% style="margin-top:20% ;">
      <tr>
        <td class="lead">User id:</td>
        <td><input type="text" class="form-control" name="userid" value="<?php echo $r['user_id']; ?>"style="width:800% ;" readonly></td>
      </tr>
      <tr>
        <td class="lead">username:</td>
        <td><input type="text" class="form-control" name="username" value="<?php echo $r['username']; ?>"style="width:800% ;" readonly></td>
      </tr>
      <tr>
        <td class="lead">Gender:</td>
        <td><input type="text" class="form-control" name="Gender" value="<?php
                                                                          if ($r['gender'] == 1) {
                                                                            echo "Male";
                                                                          } else
                                                                            echo "Female";
                                                                          ?>"style="width:800% ;" readonly></td>
      </tr>
      <tr>
        <td class="lead">Phone Number: </td>
        <td><input type="text" name="telephone" class="form-control" value="<?php echo $r['telephone']; ?>"style="width:800% ;"></td>
      </tr>

      <tr>
        <td class="lead">Email Address:</td>
        <td><input type="text" name="email" class="form-control" value="<?php echo $r['email']; ?>"style="width:800% ;"></td>
      </tr>
      <tr>
        <td class="lead">Student/Staff Number:</td>
        <td><input type="text" maxlength="255" class="form-control" name="address" value="<?php echo $r['address']; ?>" style="width:800% ; height:100px;"></td>
      </tr>
    </table>
    <button type="submit" class="btn btn-primary" name="updatebtn">Update Button</button>
  </form>
</div>

<?php

?>