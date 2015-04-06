<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="index.php">Online Shopping System</a>
    </div>
    <div id="navbar" class="navbar-collapse collapse">
      <form class="navbar-form navbar-right" method="POST" action="">
        <div class="form-group">
          <input type="text" placeholder="Username" class="form-control" name="uname" value="<?php if(isset($_POST['uname'])) echo $_POST['uname']; ?>">
        </div>
        <div class="form-group">
          <input type="password" placeholder="Password" class="form-control" name="psword">
        </div>
        <input type="submit" class="btn btn-success" role="button" value="Login" name="Login">
      </form>
    </div><!--/.navbar-collapse -->
  </div>
  <div style ="color: red" class="col-md-6 col-md-offset-7">
    <?php

        // Logging In Log
    function logging_in($uname){
      include("includes/db_connection.php");
      $action = "Log In";

          // define a query
      $bb = "INSERT INTO log (username, time, action) VALUES ('$uname', now(), '$action')";

          // execute the query
      $qq = mysqli_query($dbc, $bb);
      if (!$qq) echo "Sorry, failed connection";
    }

    session_start();
    $_SESSION = array();
    session_destroy();

    setcookie('uname');
    setcookie('fname');

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
      if($_POST['Login'] == "Login") {

        $uname = $_POST['uname'];
        $psword = $_POST['psword'];

            // Define an array of error
        $error = array();

        if (empty($uname)){
          $error[] = "You forgot to enter username.";

        }

        if (empty($psword)){
          $error[] = "You forgot to enter password.";
        }

            // Check to see if anything in $error.
        if (empty($error)){
              //Includes database connection file for authorization
          include("includes/db_connection.php");

          $q = "SELECT * FROM shopping_users WHERE username = '$uname'";

          $r = mysqli_query($dbc, $q);

          if (mysqli_num_rows($r) == 1){
            $row = mysqli_fetch_array($r);
            $check_count = $row['login_attempts'];
            $last_attempt = $row['last_attempt'];

                // Check the time difference between last attempt time vs now time
            $diff = abs(strtotime($last_attempt) - strtotime(date('Y-m-d H:i:s')));
                $criteria = 300; //time to have the user wait (seconds) 300 = 5 minutes

                // If the time difference is greater than the criteria of login attempt time frame,
                // then the check_count resets to 0 so the user CAN login again based on their account
                //
                // If the time difference is less than the criteria of login attempt time frame,
                // then the check_count remains 3 or above so the user CANNOT login again
                if ($diff > $criteria) {
                  $check_count = 0;
                }

                // User gets 3 chances to enter in the correct username password
                if ($check_count < 3){
                  if ($row['password'] == SHA1($psword)){

                    // echo "This is a valid user.";

                  // define a query
                    $q = "UPDATE shopping_users SET login_attempts=0, last_login=NOW() WHERE username = '$uname'";

                  // execute the query
                    $r = mysqli_query($dbc, $q);

                    if ($r) {

                    // Week 4 of PHP
                    // start a session
                      session_start();

                    //set session variable
                      $_SESSION['uname'] = $uname;
                      $_SESSION['fname'] = $row['firstname'];

                    // Week 5 of PHP
                      setcookie('uname', $uname, time()+600);
                      setcookie('fname', $row['firstname'], time()+600);

                    //check the role of the user
                    // Student = 0 Admin = 1
                      if($row['role'] == 1){
                        $_SESSION['role'] = 1;
                        //logging_in($uname);
                        header('LOCATION: admin.php');
                      } elseif ($row['role'] == 2) {
                        $_SESSION['role'] = 2;
                        //logging_in($uname);
                        header('LOCATION: vendor.php');
                      } else {
                        $_SESSION['role'] = 3;
                        //logging_in($uname);
                        header('LOCATION: user.php');
                      }
                    //if student, jump to student.php
                    //otherwise, jump to admin.php
                    } else {
                      echo " Sorry, failed connection.";
                    }

                  } else {
                    echo " Wrong Password";

                    $check_count = $check_count + 1;

                  // define a query
                    $q = "UPDATE shopping_users SET login_attempts='$check_count', last_attempt=NOW() WHERE username = '$uname'";

                  // execute the query
                    $r = mysqli_query($dbc, $q);
                    if ($r) echo " - Attempts Left: ".(3-$check_count);
                    else echo " Sorry, failed connection.";

                  }
                }  else {
                  echo '<br>';
                  echo "You are blocked from accessing the system. You need to wait for ".gmdate("i:s", ($criteria-$diff))." (mm:ss) minutes.";
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
    </nav>