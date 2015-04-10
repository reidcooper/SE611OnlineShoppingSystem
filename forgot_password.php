<!DOCTYPE html>
<html lang="en">

<?php
include("includes/header.php");
?>

<body>
  <?php
  include("includes/login_navbar.php");
  ?>

  <!-- Main jumbotron for a primary marketing message or call to action -->
  <div class="jumbotron">
    <div class="container">
      <h1>Reset Password</h1>
      <div style ="color: red">

        <?php

                // Generate Random Password String
        function generateRandomString($length = 8) {
          $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
          $charactersLength = strlen($characters);
          $randomString = '';
          for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
          }
          return $randomString;
        }

        function send_email($new_password, $user_email, $username){
                    // the message
          $msg = "Hi '$username',\n\nYou have reset your password. Please refer to the information below for your new temporary password. Use this password to login with your account and then use the Change Password tab to change your account password. Your current password is listed below.\n\nNew Password:\n'$new_password'\n\nThank you for your understanding. We hope to see you soon!\n\n- Online Shopping System";

                    // use wordwrap() if lines are longer than 70 characters
          $msg = wordwrap($msg,100);

                    // send email
          mail($user_email,"Your Password Has Been Reset - Online Shopping System",$msg);
        }

        session_start();
        $_SESSION = array();
        session_destroy();

        setcookie('uname');
        setcookie('fname');

                // If gives you a warning about not having a time zone set or not relying on server time
        date_default_timezone_set("America/New_York");

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
          if($_POST['button'] == "Reset") {

            $uname = $_POST['uname'];

                        // Define an array of error
            $error = array();

            if (empty($uname)){
              $error[] = "You forgot to enter username.";

            }

                        // Check to see if anything in $error.
            if (empty($error)){
                            //Includes database connection file for authorization
              include("includes/db_connection.php");

              $q = "SELECT * FROM shopping_users WHERE uname = '$uname'";

              $r = mysqli_query($dbc, $q);

              if (mysqli_num_rows($r) == 1){
                $row = mysqli_fetch_array($r);

                $email = $row['email'];
                $uname = $row['username'];

                                // default is 8 characters
                $random_password = generateRandomString();

                                // define a query
                $b = "UPDATE users SET psword=SHA1('$random_password') WHERE uname = '$uname'";

                                // execute the query
                $r = mysqli_query($dbc, $b);
                if ($r){
                  send_email($random_password, $email, $uname);
                  header('LOCATION: index.php');
                }
                else {
                  echo "Sorry, failed connection";
                }
              } else {
                echo "Wrong Username";
              }
            }  else {
              foreach ($error as $msg) {
                echo $msg;
              }
            }
          }
        }
        ?>

      </div>
    </div>
  </div>

  <div class="container">
    <!-- Example row of columns -->
    <div class="row">
      <center><h2>Enter your username to reset your password then click Reset to submit your request.</h2></center>
      <div class="col-md-6 col-md-offset-3">
        <form action="" method="POST">
          <div class="form-group">
            <label for="InputUsername1">Username</label>
            <input type="username" class="form-control" id="InputUsername1" name="uname" placeholder="Enter Username" value="<?php if(isset($_POST['uname'])) echo $_POST['uname']; ?>">
          </div>
          <button type="submit" class="btn btn-default" name="button" value="Reset">Submit</button>
        </form>

      </div>
    </div>
  </div><!-- /.container -->
  <?php
  include("includes/footer.php");
  ?>
</body>
</html>