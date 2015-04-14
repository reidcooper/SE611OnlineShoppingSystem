<!DOCTYPE html>
<html lang="en">

<?php
include("includes/header.php");
?>

<body>

  <?php
  include("includes/user_navbar.php");
  ?>

  <div class="container user-starter-template">

    <div style ="color: red">

      <?php

        // when the form in this page is submitted
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        if($_POST['button'] == "cart") {

          $product_id = $_POST['product_id'];
          $cost = $_POST['calculated_price'];
          $quantity = $_POST['quantity'];
          $stock = $_POST['stock'];

            // Define an array of error
          $error = array();

          if (empty($quantity)){
            $error[] = "You forgot to enter a quantity.";
          }

          if (!filter_var($quantity, FILTER_VALIDATE_INT)) {
            $error[] = "Enter a valid quantity.";
          }

            // Check to see if anything in $error.
          if (empty($error)){

            $date = date("Y-m-d");

              //Includes database connection file for authorization
            include("includes/db_connection.php");

            $q = "INSERT INTO cart (username, product_id, cost, quantity, trans_date) VALUES ('$uname', '$product_id', '$cost', '$quantity', '$date')";

              // execute the query
            $r = mysqli_query($dbc, $q);

            $new_stock = ($stock - $quantity);

            $s = "UPDATE product_master SET stock = '$new_stock' WHERE product_id = '$product_id'";

            // execute the query
            $t = mysqli_query($dbc, $s);

            if ($r && $t) {
              echo "Product Placed Into Cart!";
              header('LOCATION: view_cart.php');
            }

          } else {
            foreach ($error as $msg) {
              echo $msg;
              echo '<br>';
            }
            if(isset($_GET['id'])){

              $product_id = $_GET['id'];

            //Includes database connection file for authorization
              include("includes/db_connection.php");

              $q = "SELECT * FROM product_master WHERE product_id='$product_id'";

              $r = mysqli_query($dbc, $q);

              if (mysqli_num_rows($r) == 1){
                $row = mysqli_fetch_array($r);
                $name = $row['name'];
                $category = $row['category'];
                $image = $row['image'];
                $description = $row['description'];
                $features = $row['features'];
                $constraints = $row['constraints_of_products'];
                $stock = $row['stock'];
                $cost = $row['cost'];
                $discount_amount = $row['discounted_amount'];
                $discount_bool = $row['discounted'];
              }else {
                echo "Could Not Retrieve Product Information";
              }
            }
          }
        }
      } else {
        if(isset($_GET['id'])){

          $product_id = $_GET['id'];

            //Includes database connection file for authorization
          include("includes/db_connection.php");

          $q = "SELECT * FROM product_master WHERE product_id='$product_id'";

          $r = mysqli_query($dbc, $q);

          if (mysqli_num_rows($r) == 1){
            $row = mysqli_fetch_array($r);
            $name = $row['name'];
            $category = $row['category'];
            $image = $row['image'];
            $description = $row['description'];
            $features = $row['features'];
            $constraints = $row['constraints_of_products'];
            $stock = $row['stock'];
            $cost = $row['cost'];
            $discount_amount = $row['discounted_amount'];
            $discount_bool = $row['discounted'];
          }else {
            echo "Could Not Retrieve Product Information";
          }
        }
      }
      ?>

    </div>

    <div class="add-product col-md-12">
      <h1><?php echo "Product: ".$name; ?></h1>
    </div>
    <div class="add-product col-md-12">
      <form action="" method="POST">
        <?php
        // echo '<td><img src="'.($row['image']).'" alt="'.($row['image']).'"></td>';
        echo '<div class="col-md-3">';
        echo '<img src="http://placekitten.com/g/200/300" alt="includes/images/dollar.jpg">';
        echo '</div>';

        echo '<div class="col-md-9">';
        echo '<table class="table-no-border table-condensed">';

        echo '<tr>';
        if ($row['discounted'] == "yes"){
          $calculated_price = ($row['cost'] - $row['discounted_amount']);
          echo '<td><b><font color="red">Discounted Price: $'.($calculated_price).'</font></b></td>';
          echo '<input type="hidden" name="calculated_price" value="'.($calculated_price).'"/>';
        } else {
          $calculated_price = $row['cost'];
          echo '<td><b>Price: </b>$'.($row['cost']).'</td>';
          echo '<input type="hidden" name="calculated_price" value="'.($calculated_price).'"/>';
        }
        echo '</tr>';

        echo '<tr>';
        if ($row['stock'] <= 0){
          echo '<td><b><font color="red">Out of Stock</font></b></td>';
        } else {
          echo '<td><b>Stock: </b>'.($row['stock']).'</td>';
          echo '<input type="hidden" name="stock" value="'.($row['stock']).'"/>';
        }
        echo '</tr>';

        echo '<tr>';
        echo '<td><b>Description: </b>'.($row['description']).'</td>';
        echo '</tr>';

        echo '<tr>';
        echo '<td><b>Features: </b>'.($row['features']).'</td>';
        echo '</tr>';

        echo '<tr>';
        echo '<td><b>Constraints: </b>'.($row['constraints_of_products']).'</td>';
        echo '</tr>';

        echo '<tr>';
        echo '<td><b>Category: </b>'.($row['category']).'</td>';
        echo '</tr>';

        echo '<tr>';
        echo '<td><b>Sold By: </b>'.($row['username']).'</td>';
        echo '</tr>';

        echo '<tr>';
        if ($row['stock'] > 0){
          echo '<td>';
          echo '<div class="form-group">';
          echo '<label for="InputQuantity1">Quantity</label>';
          echo '<input type="quantity" class="form-control" id="Input" name="quantity" placeholder="Enter Quantity" value="'.$_POST['quantity'].'">';

          echo '</div>';
          echo '</td>';
        }
        echo '</tr>';

        echo '<tr>';
        if ($row['stock'] <= 0){
          echo '<td><b><font color="red">Out of Stock</font></b></td>';
        } else {
          echo '<td><button type="submit" class="btn btn-default" name="button" value="cart">Add to Cart</button></td>';
        }
        echo '</tr>';

        echo '</table>';
        echo '</div>';
        ?>
        <input type="hidden" name="product_id" value="<?php echo $product_id;?>"/>
      </form>
    </div>
  </div><!-- /.container -->
  <?php
  include("includes/footer.php");
  ?>
</body>
</html>