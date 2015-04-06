<!DOCTYPE html>
<html lang="en">

<?php
include("includes/header.php");
?>

<body>

  <?php
  include("includes/vendor_navbar.php");
  ?>

  <div class="container">

    <div class="user-starter-template">
      <h1>Online Registration System</h1>
      <p class="lead">Welcome, here you can add, edit, and delete products for your account!</p>
    </div>

    <div class="vendor-product-options btn-group btn-group-justified" role="group">
      <div class="btn-group" role="group">
        <p><a class="btn btn-default" href="add_product.php" role="button" value="register">Add Product &raquo;</a></p>
      </div>
    </div>

    <div class="product-listing">
      <table class="table-no-border table-condensed">
        <tr>
          <td><b>Product 1</b></td>
        </tr>
        <tr>
          <td><img src="includes/images/dollar.jpg" alt="dollar.jpg"></td>
          <td>Name: HAHAHAHAHA</td>
          <td>Price: HAHAHAHAHA</td>
          <td>Description: HAHAHAHAHA</td>
          <td>Edit</td>
          <td>Delete</td>
        </tr>
      </table>
    </div>

  </div><!-- /.container -->
  <?php
  include("includes/footer.php");
  ?>
</body>
</html>