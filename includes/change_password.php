<div id="page_content">
  <div style ="color: red">
    <?php

        // when the form in this page is submitted
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
      if ($_POST['Update_Password'] == "Update_Password") {

        $psword = $_POST['psword'];
        $confirm_password = $_POST['confirm_password'];
        $current_password = $_POST['current_psword'];
        $uname = $_COOKIE['uname'];

        if (empty($psword)){
          $error[] = "You forgot to enter a new password.";
        }
        if (empty($confirm_password)){
          $error[] = "You forgot to confirm your password.";
        }
        if (empty($current_password)){
          $error[] = "You forgot to enter your current password.";
        }
        if ($psword != $confirm_password){
          $error[] = "Your passwords do not match.";
        }

        // Password Requirements
        if( strlen($psword) < 8) {
         $error[] = "Password too short!";
        }

        if( !preg_match("#[0-9]+#", $psword) ) {
         $error[] = "Password must include at least one number! ";
        }

              // Check to see if anything in $error.
        if (empty($error)){

              //Includes database connection file for authorization
          include("includes/db_connection.php");

          $q = "SELECT * FROM shopping_users WHERE username = '$uname'";

          $r = mysqli_query($dbc, $q);

          if (mysqli_num_rows($r) == 1){
            $row = mysqli_fetch_array($r);
            if ($row['password'] == SHA1($current_password)){

              // define a query
              $q = "UPDATE shopping_users SET password=SHA1('$psword') WHERE username = '$uname'";

              // execute the query
              $r = mysqli_query($dbc, $q);
              if ($r) echo "Password Change Complete!";
              else echo "Sorry, failed connection";

            } else {
              echo "Your passwords do not match!";
            }
          } else {
            echo "Could Not Retrieve Account Information";
          }
        } else {
          foreach ($error as $msg) {
            echo $msg;
            echo '<br>';
          }
        }
  } // end Update password
}
?>
</div>
<div class="update_password col-md-6 col-md-offset-3">
  <h1>Update Password</h1>
  <form action="" method="POST">
    <div class="form-group">
      <label for="InputPassword1">Current Password</label>
      <input type="password" class="form-control" id="InputPassword1" name="current_psword" placeholder="Current Password">
    </div>
    <div class="form-group">
      <label for="InputPassword1">New Password</label>
      <input type="password" class="form-control" id="InputPassword1" name="psword" placeholder="Password">
    </div>
    <div class="form-group">
      <label for="InputConfirmPassword1">Confirm Password</label>
      <input type="password" class="form-control" id="InputConfirmPassword1" name="confirm_password" placeholder="Confirm Password">
    </div>
    <button type="submit" class="btn btn-default" name="Update_Password" value="Update_Password">Update Password</button>
  </form>
</div>
</div>