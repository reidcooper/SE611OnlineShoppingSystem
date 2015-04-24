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
      <p class="lead">Welcome, here you can add, edit, and delete products! Below is the list of products. Only some of the product's attributes are displayed.</p>
      <?php
      if(isset($_GET['message'])){
        echo '<div style ="color: red">'.$_GET['message'].'</div>';
      }
      ?>
    </div>
    <div class="search col-md-2" align="center">
      <form action="" method="POST">
        <div class="form-group">
          <label for="InputSearch1"><h4>Search</h4></label>
          <input type="search" class="form-control" id="InputSearch1" maxlength="10" name="search" placeholder="Search" value="">
        </div>
        <button type="submit" class="btn btn-default btn-primary" name="button" value="search">Search</button>

        <?php
        // when the form in this page is submitted
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
          if($_POST['button'] == "search") {
            $search_term = $_POST['search'];
            header('LOCATION: search_products_admin.php?search='.$search_term.'');
          }
        }
        ?>
      </form>
    </div>
    <div class="product-listing col-md-10">

      <?php

  //Includes database connection file for authorization
      include("includes/db_connection.php");

  // define a query
      $q = "SELECT * FROM product_master WHERE deleted != 'yes'";

  // execute the query
      $r = mysqli_query($dbc, $q);
      if (!$r) echo "Sorry, failed connection";

      ?>
      <?php
      if(isset($r)){
        if (mysqli_num_rows($r)){
          echo '<table class="table table-striped table-bordered">';
          while ($row = mysqli_fetch_array($r)) {

            echo '<tr>';
            if ($row['deleted'] == 'no') {
              echo '<td><b>'.($row['name']).'</b></td>';
            } else {
              echo '<td><b><font color="red">'.($row['name']).' - Needs Approval</font></b></td>';
            }
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
            if ($row['deleted'] == 'apr'){
              echo '<td><a id="enable-link" href="enable_product_admin.php?id='.$row['product_id'].'"><b>Enable?</b></a></td>';
            }
            echo '</tr>';

          }
          echo '</table>';
        }  else {
          echo '<div style ="color: red">';
          echo 'There are no products entered.';
          echo '</div>';
        }
      }else {
        echo '<div style ="color: red">';
        echo 'There are no products entered.';
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