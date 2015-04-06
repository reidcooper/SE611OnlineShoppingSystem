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
      <h1>Welcome to the Online Shopping System!</h1>
      <p>This system helps in buying of goods, products and services online by choosing the listed products from this website.</p>
    </div>
  </div>

  <div class="container">
    <!-- Example row of columns -->
    <div class="row">
      <div class="col-md-6">
        <h2>Customers</h2>
        <p>You are allowed to visit the website and buy products online from the various vendors/sellers registered.</p>
      </div>
      <div class="col-md-6">
        <h2>Vendors</h2>
        <p>Vendors will add their products to the database, which will be seen in the website to the end users or say customers who can buy the products by selecting the one they need. Vendors will have the special privileges than the customers, and have the ability to manage the products added by them.</p>
        <!-- <p><a class="btn btn-default" href="#" role="button">View details &raquo;</a></p> -->
      </div>
    </div>

    <hr>

    <div class="row">
      <div class="col-md-6 text-center">
        <h2>Register?</h2>
        <p><a class="btn btn-default" href="register.php" role="button" value="register">Click Here to Register! &raquo;</a></p>
      </div>
      <div class="col-md-6 text-center">
        <h2>Forgot Password?</h2>
        <p><a class="btn btn-default" href="forgot_password.php" role="button" value="forgot_password">Click Here to Reset Your Password! &raquo;</a></p>
      </div>
    </div>
  </div><!-- /.container -->
  <?php
  include("includes/footer.php");
  ?>
</body>
</html>