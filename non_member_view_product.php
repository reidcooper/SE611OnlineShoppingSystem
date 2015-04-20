<!DOCTYPE html>
<html lang="en">

<?php
include("includes/header.php");
?>

<body>

  <?php
  include("includes/nonuser_navbar.php");
  ?>

  <div class="container user-starter-template">

    <div style ="color: red">

      <?php
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
      } else {
        header('LOCATION: nonmember_products.php');
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
        echo '<img src="http://lorempixel.com/200/200/food/" alt="includes/images/dollar.jpg">';
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

        echo '</table>';
        echo '</div>';
        ?>
      </form>
    </div>
  </div><!-- /.container -->
  <?php
  include("includes/footer.php");
  ?>
</body>
</html>