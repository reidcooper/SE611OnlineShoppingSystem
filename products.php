<!DOCTYPE html>
<html lang="en">

<?php
include("includes/header.php");
?>

<body>

  <?php
  include("includes/user_navbar.php");
  ?>

  <div class="container">

    <div class="user-starter-template">
      <h1>Online Registration System</h1>
      <p class="lead">Available Products</p>
      <?php
      if(isset($_GET['message'])){
        echo '<div style ="color: red">'.$_GET['message'].'</div>';
      }
      ?>
    </div>

    <!-- <div class="vendor-product-options btn-group btn-group-justified" role="group">
      <div class="btn-group" role="group">
        <p><a class="btn btn-success" href="add_product.php" role="button" value="register">Add Product &raquo;</a></p>
      </div>
    </div> -->

    <div class="product-listing">

      <?php

  //Includes database connection file for authorization
      include("includes/db_connection.php");

  // define a query
      $q = "SELECT * FROM product_master";

  // execute the query
      $r = mysqli_query($dbc, $q);
      if (!$r) echo "Sorry, failed connection";

      ?>
      <?php
      if(isset($r)){
        if (mysqli_num_rows($r)){
          echo '<table class="table">';
          while ($row = mysqli_fetch_array($r)) {

            echo '<tr>';
            echo '<td><b>'.($row['name']).'</b></td>';
            echo '</tr>';

            echo '<tr>';
            // echo '<td><img src="'.($row['image']).'" alt="'.($row['image']).'"></td>';
            echo '<td><img src="http://placekitten.com/g/408/287" alt="includes/images/dollar.jpg"></td>';
            //echo '<td><b>Item: </b>'.($row['name']).'</td>';
            if ($row['discounted'] == "yes"){
              echo '<td><b><font color="red">Discounted Price: $'.($row['cost'] - $row['discounted_amount']).'</font></b></td>';
            } else {
              echo '<td><b>Price: </b>$'.($row['cost']).'</td>';
            }
            if ($row['stock'] <= 0){
              echo '<td><b><font color="red">Out of Stock</font></b></td>';
            } else {
              echo '<td><b>Stock: </b>'.($row['stock']).'</td>';
            }
            echo '<td><b>Description: </b>'.($row['description']).'</td>';
            echo '<td><a href="view_product.php?id='.$row['product_id'].'"><b>View</b></a></td>';
            echo '</tr>';

          }
          echo '</table>';
        }  else {
          echo '<div style ="color: red">';
          echo 'There are no products Available.';
          echo '</div>';
        }
      }else {
        echo '<div style ="color: red">';
        echo 'There are no products Available.';
        echo '</div>';
      }


      ?>
    </div>

  </div><!-- /.container -->
  <?php
  include("includes/footer.php");
  ?>
</body>
</html>