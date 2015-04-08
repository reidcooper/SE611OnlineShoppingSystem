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
      <h1>Cart</h1>
      <p class="lead">Here is your cart!</p>
      <?php
      if(isset($_GET['message'])){
        echo '<div style ="color: red">'.$_GET['message'].'</div>';
      }
      ?>
    </div>

    <div class="product-listing">

      <?php

  //Includes database connection file for authorization
      include("includes/db_connection.php");

  // define a query
      $q = "SELECT * FROM cart INNER JOIN product_master ON cart.product_id = product_master.product_id WHERE cart.username = '$uname'";

  // execute the query
      $r = mysqli_query($dbc, $q);
      if (!$r) echo "Sorry, failed connection";

      ?>
      <?php

      $total_cost_array = array();
      $products_bought = array();

      if(isset($r)){
        if (mysqli_num_rows($r)){

          echo '<table class="table table-striped table-bordered">';
          echo '<tr>';
          echo '<td></td>';
          echo '<td><b>Item: </b></td>';
          echo '<td><b>Cost (Per Unit): </b>$</td>';
          echo '<td><b>Quantity: </b></td>';
          echo '<td><b>Final Product Cost: </b></td>';
          echo '<td></td>';
          echo '</tr>';
          while ($row = mysqli_fetch_array($r)) {

            $discount_cost = ($row['cost'] - $row['discounted_amount']);
            $total_cost_array[] = ($row['quantity'] * $discount_cost);
            // $products_bought[] = $row['product_id'];

            // Each item bought will contain an array which holds [Product ID, Quantity of that Product, Product Vendor, and Total Cost for that Product]
            array_push($products_bought, array($row['product_id'], $row['quantity'], $row['username'], ($row['quantity'] * $discount_cost)));

            echo '<tr>';
            // echo '<td><img src="'.($row['image']).'" alt="'.($row['image']).'"></td>';
            echo '<td><img src="http://placekitten.com/g/200/138" alt="includes/images/dollar.jpg"></td>';
            echo '<td>'.($row['name']).'</td>';
            echo '<td>$'.($discount_cost).'</td>';
            echo '<td>'.($row['quantity']).'</td>';
            echo '<td>$'.($row['quantity']* $discount_cost).'</td>';
            echo '<td><a href="delete_item_cart.php?id='.$row['shopping_tally_id'].'"><b>Remove</b></a></td>';
            echo '</tr>';

          }
          echo '</table>';
        }  else {
          echo '<div style ="color: red">';
          echo 'Your Cart is Empty.';
          echo '</div>';
        }
      }else {
        echo '<div style ="color: red">';
        echo 'Your Cart is Empty.';
        echo '</div>';
      }

      // print_r($products_bought);
      // echo '<br>';

      // Serialize array
      // $serial = serialize($products_bought);

      // foreach ($products_bought as $item){
      //   echo $item[0];
      //   echo $item[1];
      // }

      // $unserial = unserialize($serial);
      // echo $unserial;

      ?>
    </div>

    <div class="col-md-2 col-md-offset-10">
      <?php
      foreach ($total_cost_array as $value){
        $total_cost = $total_cost + $value;
      }
      ?>
      <b><u>Your Total: $<?php echo $total_cost ?></u></b>

      <div style ="color: red">

        <?php

        // when the form in this page is submitted
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
          if($_POST['button'] == "Purchase") {

            $category = $_POST['category'];
            $processed = "Pending";
            $date = date("Y-m-d");

              //Includes database connection file for authorization
            include("includes/db_connection.php");

            // Each item bought will contain an array which holds [Product ID, Quantity of that Product, Product Vendor, and Total Cost for that Product]
            foreach ($products_bought as $item){
              // define a query
              $q = "INSERT INTO transactions (username, product_id, processed, total_cost, trans_date, quantity, vendor) VALUES ('$uname', '$item[0]', '$processed', '$item[3]', '$date', '$item[1]', '$item[2]')";
              // execute the query
              $r = mysqli_query($dbc, $q);

            }

            $u = "DELETE FROM cart WHERE username='$uname'";

            $v = mysqli_query($dbc, $u);

            if($v && $r){
              $message = "Transaction Complete";
              header('LOCATION: view_cart.php?message='.$message.'');
            } else {
              $message = "Cannot Complete Purchase";
              header('LOCATION: view_cart.php?message='.$message.'');
            }

          }
        }
        ?>
        <form action="" method="POST">
          <div class="vendor-product-options btn-group btn-group-justified" role="group">
            <div class="btn-group" role="group">
              <p><button type="submit" class="btn btn-success" name="button" value="Purchase" <?php if(!mysqli_num_rows($r)){ echo "disabled"; } ?>>Purchase</button></p>
            </div>
          </div>
        </form>
      </div>

    </div><!-- /.container -->
    <?php
    include("includes/footer.php");
    ?>
  </body>
  </html>