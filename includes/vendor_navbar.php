<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="vendor.php">Online Shopping System</a>
    </div>
    <div id="navbar" class="collapse navbar-collapse">
      <ul class="nav navbar-nav">
        <li><a href="vendor.php">Home</a></li>
        <li><a href="vendor_products.php">Products</a></li>
        <li><a href="edit_profile_vendor.php">Edit Profile</a></li>
        <li><a href="change_password_vendor.php">Change Password</a></li>
        <li><a href="vendor_transactions.php">Transactions</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="index.php">Log Out</a></li>
      </ul>
    </div><!--/.nav-collapse -->
  </div>

  <?php
// Maintain the session that is being used by a particular USER
  session_start();

  if(empty($_COOKIE['uname'])){
    header('LOCATION: index.php');
  } else {
    $uname = $_COOKIE['uname'];
    $fname = $_COOKIE['fname'];
  }

// If the user role does not equal 3 (Student) then redirect page back to index
  if ($_SESSION['role'] != 2 || !isset($_SESSION['role'])){
    header('LOCATION: index.php');
  }

  ?>

</nav>