<!DOCTYPE html>
<html lang="en">

<?php
include("includes/header.php");
?>

<body>

  <?php
  include("includes/admin_navbar.php");
  ?>

  <div class="container">

    <div class="user-starter-template">
      <h1>Online Registration System</h1>
      <p class="lead">Searched Available Products</p>
      <?php
      if(isset($_GET['message'])){
        echo '<div style ="color: red">'.$_GET['message'].'</div>';
      }
      ?>
    </div>

    <div class="product-listing">
      <?php

      if(isset($_GET['search'])){

        $search_term = $_GET['search'];

          //Includes database connection file for authorization
        include("includes/db_connection.php");

        // define a query
        $q = "SELECT name, category, stock, cost, username, description, discounted, discounted_amount, product_id, image FROM product_master WHERE (deleted = 'no' OR deleted = 'apr') AND (name LIKE '%" . $search_term . "%' OR category LIKE '%" . $search_term . "%' OR stock LIKE '%" . $search_term . "%' OR cost LIKE '%" . $search_term . "%' OR username LIKE '%" . $search_term . "%')";

        // execute the query
        $r = mysqli_query($dbc, $q);
        if (!$r) echo "Sorry, failed connection";

        if(isset($r)){
          if (mysqli_num_rows($r)){
            echo '<table class="table-no-border">';
            while ($row = mysqli_fetch_array($r)) {

              echo '<tr>';
              echo '<td><b>'.($row['name']).'</b></td>';
              echo '</tr>';

              echo '<tr>';
              echo '<td><img src="'.($row['image']).'" alt="'.($row['image']).'"></td>';
              // echo '<td><img src="http://lorempixel.com/200/200/food/" alt="includes/images/dollar.jpg"></td>';
              echo '<td><b>Name: </b>'.($row['name']).'</td>';
              echo '<td><b>Vendor: </b>'.($row['username']).'</td>';
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
              echo '<td><b>Category: </b>'.($row['category']).'</td>';
              echo '<td><a href="edit_product_admin.php?id='.$row['product_id'].'"><b>Edit</b></a></td>';
              echo '<td><a href="delete_product_admin.php?id='.$row['product_id'].'"><b>Delete</b></a></td>';
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

      } else {
        header('LOCATION: products.php');
      }
      ?>
    </div>

  </div><!-- /.container -->
  <?php
  include("includes/footer.php");
  ?>
</body>
</html>