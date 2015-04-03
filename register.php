
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <meta name="Online Shopping System, a project built for my SE-611 class" content="">
  <meta name="James Reid Cooper" content="">

  <title>Online Shopping System</title>

  <!-- Bootstrap core CSS -->
  <link href="includes/css/bootstrap.min.css" rel="stylesheet">

  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <![endif]-->
    </head>

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
            <form class="navbar-form navbar-right">
              <div class="form-group">
                <input type="text" placeholder="Email" class="form-control">
              </div>
              <div class="form-group">
                <input type="password" placeholder="Password" class="form-control">
              </div>
              <button type="submit" class="btn btn-success">Sign in</button>
            </form>
          </div><!--/.navbar-collapse -->
        </div>
      </nav>

      <!-- Main jumbotron for a primary marketing message or call to action -->
      <div class="jumbotron">
        <div class="container">
          <h1>Registration</h1>
        </div>
      </div>

      <div class="container">
        <!-- Example row of columns -->
        <div class="row">
          <center><h2>Please Enter in the Following Information to Register!</h2></center>
          <div class="col-md-6 col-md-offset-3">
            <form>
              <div class="form-group">
                <label for="InputUsername1">Username</label>
                <input type="username" class="form-control" id="InputUsername1" placeholder="Enter Username">
              </div>
              <div class="form-group">
                <label for="InputFirstName1">First Name</label>
                <input type="firstname" class="form-control" id="InputFirstName1" placeholder="Enter First Name">
              </div>
              <div class="form-group">
                <label for="InputLastName1">Last Name</label>
                <input type="lastname" class="form-control" id="InputLastName1" placeholder="Enter Last Name">
              </div>

              <div class="form-group">
                <label for="InputPassword1">Password</label>
                <input type="password" class="form-control" id="InputPassword1" placeholder="Password">
              </div>
              <div class="form-group">
                <label for="InputConfirmPassword1">Confirm Password</label>
                <input type="confirm_password" class="form-control" id="InputConfirmPassword1" placeholder="Confirm Password">
              </div>

              <div class="form-group">
                <label for="InputEmail1">Email</label>
                <input type="email" class="form-control" id="InputEmail1" placeholder="Enter Email">
              </div>

              <div class="form-group">
                <label for="InputAddress1">Address</label>
                <input type="address" class="form-control" id="InputAddress1" placeholder="Enter Address">
              </div>
              <div class="form-group">
                <label for="InputCity1">City</label>
                <input type="city" class="form-control" id="InputCity1" placeholder="Enter City">
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
                <label for="InputZipcode1">Zipcode</label>
                <input type="zipcode" class="form-control" id="InputZipcode1" placeholder="Enter Zipcode">
              </div>

              <div class="form-group">
                <label for="InputPhone1">Phone Number</label>
                <input type="phone" class="form-control" id="InputPhone1" placeholder="Enter Phone Number">
              </div>


              <button type="submit" class="btn btn-default">Submit</button>
            </form>

          </div>
        </div>

        <?php
        include("includes/footer.php");
        ?>


      </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="includes/js/bootstrap.min.js"></script>
  </body>
  </html>
