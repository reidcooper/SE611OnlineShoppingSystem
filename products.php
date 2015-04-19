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

    <div class="search col-md-4 col-md-offset-4" align="center">
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
            header('LOCATION: search_products.php?search='.$search_term.'');
          }
        }
        ?>
      </form>
    </div>

    <div class="product-listing col-md-12">

      <?php

  //Includes database connection file for authorization
      include("includes/db_connection.php");

  // define a query
      $q = "SELECT * FROM product_master WHERE deleted = 'no'";

  // execute the query
      $r = mysqli_query($dbc, $q);
      if (!$r) echo "Sorry, failed connection";

      ?>
      <?php
      if(isset($r)){
        if (mysqli_num_rows($r)){
          echo '<table class="table-no-border">';
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
            echo '<td><b>Category: </b>'.($row['category']).'</td>';
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