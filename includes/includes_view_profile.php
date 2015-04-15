<div style ="color: red">
  <?php
        // when the form in this page is submitted
  if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if($_POST['Update'] == "Update") {

      $uname = $_POST['username'];
      $fname = $_POST['fname'];
      $lname = $_POST['lname'];
      $address = $_POST['address'];
      $city = $_POST['city'];
      $state = $_POST['state'];
      $email = $_POST['email'];
      $phone = $_POST['phone'];
      $zipCode = $_POST['zip-code'];

            // Define an array of error
      $error = array();

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
      if (empty($zipCode)){
        $error[] = "You forgot to enter a zip code.";
      }
      if (empty($email)){
        $error[] = "You forgot to enter a email.";
      }
      if (empty($phone)){
        $error[] = "You forgot to enter a phone.";
      }

      if (!preg_match("/^\d{5}([\-]?\d{4})?$/i", $zipCode)) {
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
      $q = "UPDATE shopping_users SET firstName= '$fname', lastName='$lname', zipCode='$zipCode', address='$address', city='$city', state='$state', email='$email', phone='$phone' WHERE username = '$uname'";

              // execute the query
      $r = mysqli_query($dbc, $q);
      if ($r) echo "Profile Update Complete!";
      else echo "Sorry, failed connection";

    } else {
      foreach ($error as $msg) {
        echo $msg;
        echo '<br>';
      }
    }
              // Update Password
  }
} else {
  if(isset($_GET['id'])){

    $username = $_GET['id'];
        //Includes database connection file for authorization
    include("includes/db_connection.php");

    $q = "SELECT * FROM shopping_users WHERE username = '$username'";

    $r = mysqli_query($dbc, $q);

    if (mysqli_num_rows($r) == 1){
      $row = mysqli_fetch_array($r);
      $fname = $row['firstName'];
      $lname = $row['lastName'];
      $address = $row['address'];
      $city = $row['city'];
      $state = $row['state'];
      $email = $row['email'];
      $phone = $row['phone'];
      $zipCode = $row['zipCode'];
    }else {
      echo "Could Not Retrieve Account Information";
    }
  }
}
?>
</div>

<div class="update_profile col-md-6 col-md-offset-3">
  <h1>View User's Profile</h1>
  <form action="" method="POST">
    <div class="form-group">
      <label for="InputFirstName1">First Name</label>
      <input type="firstname" class="form-control" id="InputFirstName1" maxlength="255" name="fname" placeholder="Enter First Name" value="<?php echo $fname?>">
    </div>
    <div class="form-group">
      <label for="InputLastName1">Last Name</label>
      <input type="lastname" class="form-control" id="InputLastName1" maxlength="255" name="lname" placeholder="Enter Last Name" value="<?php echo $lname?>">
    </div>
    <div class="form-group">
      <label for="InputEmail1">Email</label>
      <input type="email" class="form-control" id="InputEmail1" maxlength="255" name="email" placeholder="Enter Email" value="<?php echo $email?>">
    </div>

    <div class="form-group">
      <label for="InputAddress1">Address</label>
      <input type="address" class="form-control" id="InputAddress1" maxlength="255" name="address" placeholder="Enter Address" value="<?php echo $address?>">
    </div>
    <div class="form-group">
      <label for="InputCity1">City</label>
      <input type="city" class="form-control" id="InputCity1" maxlength="255" name="city" placeholder="Enter City" value="<?php echo $city?>">
    </div>
    <div class="form-group">
            <!-- Single button
            <input type="state" class="form-control" id="InputState1" placeholder="Enter State"> -->
            <label for="InputState1">State</label>
            <div class="btn-group">
              <?php

              $state_1 = array('AL', 'AK', 'AS', 'AZ', 'AR', 'CA', 'CO', 'CT', 'DE', 'DC', 'FM', 'FL', 'GA', 'GU', 'HI', 'ID',
                'IL', 'IN', 'IA', 'KS', 'KY', 'LA', 'ME', 'MH', 'MD', 'MA', 'MI', 'MN', 'MS', 'MO', 'MT', 'NE', 'NV', 'NH',
                'NJ', 'NM', 'NY', 'NC', 'ND', 'MP', 'OH', 'OK', 'OR', 'PW', 'PA', 'PR', 'RI', 'SC', 'SD', 'TN', 'TX',
                'UT', 'VT', 'VI', 'VA', 'WA', 'WV', 'WI', 'WY', 'AE', 'AA', 'AP');

              dropDownMenu($state_1, "state", $state);

              ?>
            </div>
          </div>
          <div class="form-group">
            <label for="InputZipcode1">Zip-Code</label>
            <input type="zipcode" class="form-control" id="InputZipcode1" maxlength="10" name="zip-code" placeholder="Enter Zipcode" value="<?php echo $zipCode?>">
          </div>
          <div class="form-group">
            <label for="InputPhone1">Phone Number</label>
            <input type="phone" class="form-control" id="InputPhone1" maxlength="15" name="phone" placeholder="Enter Phone Number" value="<?php echo $phone?>">
          </div>
          <input type="hidden" name="username" value="<?php echo $username;?>"/>
          <button type="submit" class="btn btn-default" name="Update" value="Update">Update Profile</button>
        </form>
      </div>