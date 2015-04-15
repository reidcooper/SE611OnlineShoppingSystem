<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
    </div>
    <div id="navbar" class="collapse navbar-collapse">
      <ul class="nav navbar-nav">
        <li><a href="user.php">Home</a></li>
        <li><a href="products.php">Products</a></li>
        <li><a href="user_transactions.php">Transactions</a></li>
        <li><a href="view_reports_user.php">Reports</a></li>
        <li><a href="edit_profile_user.php">Edit Profile</a></li>
        <li><a href="change_password_user.php">Change Password</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="view_cart.php">View Cart</a></li>
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
  if ($_SESSION['role'] != 3 || !isset($_SESSION['role'])){
    header('LOCATION: index.php');
  }

  ?>
</nav>