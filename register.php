<!DOCTYPE html>
<html lang="en">

<?php
include("includes/header.php");
?>

<body>

  <?php

  function dropDownMenu($array, $name, $value){
    echo '<select name='.$name.' class="form-control">';
    foreach ($array as $ar){
      echo '<option value="'.$ar.'"';

      if($ar == $value) echo 'selected = "selected"';

      echo '>'.$ar.'</option>';
    }
    echo '</select>';
  }
  ?>

  <?php
  include("includes/login_navbar.php");
  ?>


  <!-- Main jumbotron for a primary marketing message or call to action -->
  <div class="jumbotron">
    <div class="container">
      <h1>Registration</h1>
      <div style ="color: red">

        <?php

        // when the form in this page is submitted
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
          if($_POST['button'] == "Register") {

            $uname = $_POST['uname'];
            $psword = $_POST['psword'];
            $confirm_password = $_POST['confirm_password'];
            $fname = $_POST['fname'];
            $lname = $_POST['lname'];
            $address = $_POST['address'];
            $city = $_POST['city'];
            $state = $_POST['state'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $role = $_POST['role'];
            $zip_code = $_POST['zip-code'];

                // Role Numbers
            if ($role == 'Admin'){
              $role = 1;
            }

            if ($role == 'Vendor'){
              $role = 2;
            }

            if ($role == 'User'){
              $role = 3;
            }

            // Define an array of error
            $error = array();

            if (empty($uname)){
              $error[] = "You forgot to enter username.";
            }
            if (empty($psword)){
              $error[] = "You forgot to enter password.";
            }
            if (empty($confirm_password)){
              $error[] = "You forgot to confirm your password.";
            }
            if (empty($fname)){
              $error[] = "You forgot to enter a first name.";
            }
            if (empty($lname)){
              $error[] = "You forgot to enter a last name.";
            }
            if (empty($address)){
              $error[] = "You forgot to enter a address.";
            }
            if (empty($city)){
              $error[] = "You forgot to enter a city.";
            }
            if (empty($zip_code)){
              $error[] = "You forgot to enter a zip code.";
            }
            if (empty($email)){
              $error[] = "You forgot to enter a email.";
            }
            if (empty($phone)){
              $error[] = "You forgot to enter a phone.";
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

            if (!preg_match("/^\d{5}([\-]?\d{4})?$/i", $zip_code)) {
              $error[] = "Enter a valid zip code in the US.";
            }

            $email = filter_var($email, FILTER_SANITIZE_EMAIL);
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
              $error[] = "Enter a valid email.";
            }

            if (!preg_match("/^[0-9\_]{7,20}/",$phone)){
               $error[] = "Enter a valid phone number.";
            }

            // Check to see if anything in $error.
            if (empty($error)){

              //Includes database connection file for authorization
              include("includes/db_connection.php");

              // define a query
              $q = "INSERT INTO shopping_users (username, password, firstName, lastName, zipCode, address, city, state, email, phone, role, reg_date) VALUES ('$uname', SHA1('$psword'), '$fname', '$lname', '$zip_code', '$address', '$city', '$state', '$email', '$phone', '$role', now())";

              // execute the query
              $r = mysqli_query($dbc, $q);
              if ($r) echo "Registration Complete!";
              else echo "Sorry, failed connection";

            } else {
              foreach ($error as $msg) {
                echo $msg;
                echo '<br>';
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
      <center><h2>Please Enter in the Following Information to Register!</h2></center>
      <div class="col-md-6 col-md-offset-3">
        <form action="" method="POST">
          <div class="form-group">
            <label for="InputUsername1">Username</label>
            <input type="username" class="form-control" id="InputUsername1" maxlength="255" name="uname" placeholder="Enter Username" value="<?php if(isset($_POST['uname'])) echo $_POST['uname']; ?>">
          </div>
          <div class="form-group">
            <label for="InputFirstName1">First Name</label>
            <input type="firstname" class="form-control" id="InputFirstName1" maxlength="255" name="fname" placeholder="Enter First Name" value="<?php if(isset($_POST['fname'])) echo $_POST['fname']; ?>">
          </div>
          <div class="form-group">
            <label for="InputLastName1">Last Name</label>
            <input type="lastname" class="form-control" id="InputLastName1" maxlength="255" name="lname" placeholder="Enter Last Name" value="<?php if(isset($_POST['lname'])) echo $_POST['lname']; ?>">
          </div>
          <div class="form-group">
            <label for="InputPassword1">Password</label>
            <input type="password" class="form-control" id="InputPassword1" maxlength="255" name="psword" placeholder="Password">
          </div>
          <div class="form-group">
            <label for="InputConfirmPassword1">Confirm Password</label>
            <input type="password" class="form-control" id="InputConfirmPassword1" maxlength="255" name="confirm_password" placeholder="Confirm Password">
          </div>

          <div class="form-group">
            <label for="InputEmail1">Email</label>
            <input type="email" class="form-control" id="InputEmail1" maxlength="255" name="email" placeholder="Enter Email" value="<?php if(isset($_POST['email'])) echo $_POST['email']; ?>">
          </div>

          <div class="form-group">
            <label for="InputAddress1">Address</label>
            <input type="address" class="form-control" id="InputAddress1" maxlength="255" name="address" placeholder="Enter Address" value="<?php if(isset($_POST['address'])) echo $_POST['address']; ?>">
          </div>
          <div class="form-group">
            <label for="InputCity1">City</label>
            <input type="city" class="form-control" id="InputCity1" maxlength="255" name="city" placeholder="Enter City" value="<?php if(isset($_POST['city'])) echo $_POST['city']; ?>">
          </div>
          <div class="form-group">
                <!-- Single button
                <input type="state" class="form-control" id="InputState1" placeholder="Enter State"> -->
                <label for="InputState1">State</label>
                <div class="btn-group">
                  <?php

                  $state = array('AL', 'AK', 'AS', 'AZ', 'AR', 'CA', 'CO', 'CT', 'DE', 'DC', 'FM', 'FL', 'GA', 'GU', 'HI', 'ID',
                    'IL', 'IN', 'IA', 'KS', 'KY', 'LA', 'ME', 'MH', 'MD', 'MA', 'MI', 'MN', 'MS', 'MO', 'MT', 'NE', 'NV', 'NH',
                    'NJ', 'NM', 'NY', 'NC', 'ND', 'MP', 'OH', 'OK', 'OR', 'PW', 'PA', 'PR', 'RI', 'SC', 'SD', 'TN', 'TX',
                    'UT', 'VT', 'VI', 'VA', 'WA', 'WV', 'WI', 'WY', 'AE', 'AA', 'AP');

                  dropDownMenu($state, "state", $_POST['state']);

                  ?>
                </div>
              </div>
              <div class="form-group">
                <label for="InputZipcode1">Zip-Code</label>
                <input type="zipcode" class="form-control" id="InputZipcode1" maxlength="10" name="zip-code" placeholder="Enter Zipcode" value="<?php if(isset($_POST['zip-code'])) echo $_POST['zip-code']; ?>">
              </div>

              <div class="form-group">
                <label for="InputPhone1">Phone Number</label>
                <input type="phone" class="form-control" id="InputPhone1" maxlength="15" name="phone" placeholder="Enter Phone Number" value="<?php if(isset($_POST['phone'])) echo $_POST['phone']; ?>">
              </div>

              <div class="form-group">
                <b>Select Role</b>
                <div class="radio">
                  <label>
                    <input type="radio" name="role" id="vendor_role" value="Vendor" <?php if (isset($_POST['role']) && $_POST['role']=="Vendor") echo "checked";?>>
                    Vendor/Seller
                  </label>
                </div>
                <div class="radio">
                  <label>
                    <input type="radio" name="role" id="user_role" value="User" <?php if (isset($_POST['role']) && $_POST['role']=="User") echo "checked";?>>
                    User/Customer
                  </label>
                </div>
              </div>
              <button type="submit" class="btn btn-default" name="button" value="Register">Submit</button>
            </form>
          </div>
        </div>
      </div><!-- /.container -->
      <?php
      include("includes/footer.php");
      ?>
    </body>
    </html>