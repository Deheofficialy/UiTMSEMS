<?php
include('../include/dbconn.php');
include("../session.php");
session_start();
//navbar
include('../include/newnavbar.php');
$username = $_SESSION['username'];
$q = "select * from user where username ='$username' ";
$res = mysqli_query($dbconn, $q) or die(mysqli_error($dbconn));
$r = mysqli_fetch_assoc($res);
//creating a detail table for a specific equipment
?>
<br>

<div class="main" style="margin-left:5% ; margin-right:70%;">
    <h3 class="display-4">Update Profile</h3>
    <form action="updateAdminProcess.php" method="POST">
        <table class="table " width=50% style="margin-top:5% ;">
            <tr>
                <td>Admin id:</td>
                <td><input type="text" class="form-control" name="userid" value="<?php echo $r['user_id']; ?>"style="width:550% ;" readonly></td>
            </tr>
            <tr>
                <td>username:</td>
                <td><input type="text" class="form-control" name="username" value="<?php echo $r['username']; ?>"style="width:550% ;" readonly></td>
            </tr>
            <tr>
                <td>Gender:</td>
                <td><input type="text" class="form-control" name="Gender" value="<?php
                                                                                    if ($r['gender'] == 1) {
                                                                                        echo "Male";
                                                                                    } else
                                                                                        echo "Female";
                                                                                    ?>"style="width:550% ;" readonly></td>
            </tr>
            <tr>
                <td>Phone Number: </td>
                <td><input type="text" class="form-control" name="telephone" value="<?php echo $r['telephone']; ?>"style="width:550% ;"></td>
            </tr>

            <tr>
                <td>Email Address:</td>
                <td><input type="text" class="form-control" name="email" value="<?php echo $r['email']; ?>"style="width:550% ;"></td>
            </tr>
            <tr>
                <td>Home Address:</td>
                <td><input type="text" class="form-control" maxlength="255" name="address" value="<?php echo $r['address']; ?>" style="width:550% ; height:100px;"></td>
            </tr>
        </table>
        <button type="submit" class="btn btn-primary" name="updatebtn">Update Button</button>
    </form>
</div>

<?php include('../include/script.php') ?>

<script></script>