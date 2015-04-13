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
      <p class="lead">Welcome! Here are your all your transactions.</p>
      <?php
      if(isset($_GET['message'])){
        echo '<div style ="color: red">'.$_GET['message'].'</div>';
      }
      ?>

      <?php

      // This function is to unserialize an multi-dimensional array which is stored in the items_bought in transaction table
      // Takes the de-serialized array as input
      // For each item in the array, that represents an item bought
      // Each item bought has two things: [0] the product name & [1] the quantity of that product purchased
      // 1. locates the item based on spot [0]
      // 2. while composing each string, it obtains the quantity associated with that product name
      // 3. Returns string
      // function outPutItems($array){
      //   // Output product names
      //   foreach ($array as $item) {
      //     //Includes database connection file for authorization
      //     include("includes/db_connection.php");

      //     // define a query
      //     $q = "SELECT * FROM product_master WHERE product_id = '$item[0]'";

      //     // execute the query
      //     $r = mysqli_query($dbc, $q);
      //     if (!$r) echo "Sorry, failed connection";

      //     if(mysqli_num_rows($r)){
      //       while ($row = mysqli_fetch_array($r)){
      //         $string =  $row['name'] . ' (' . $item[1] . ') ' . ' [' . $item[2] . '] ' . ' ($' . $item[3] . ') ' . ', ' . $string;
      //       }
      //     }
      //   }
      //   return rtrim($string, ", ");
      // }

      ?>

      <div class="col-md-12" align="center" style="text-align: center">
        <?php

      //Includes database connection file for authorization
        include("includes/db_connection.php");

      // define a query
        $q = "SELECT * FROM transactions INNER JOIN product_master ON transactions.product_id = product_master.product_id WHERE transactions.username = '$uname'";

      // execute the query
        $r = mysqli_query($dbc, $q);
        if (!$r) echo "Sorry, failed connection";

        if(isset($r)){
          if (mysqli_num_rows($r)){

            // $unserial = array();

            echo '<table class="table table-striped table-bordered">';
            echo '<tr>';
            echo '<td><b>Transaction Date: </b></td>';
            echo '<td><b>Vendor: </b></td>';
            echo '<td><b>Total Cost: </b></td>';
            echo '<td><b>Status: </b></td>';
            echo '<td><b>Item Bought: </b></td>';
            echo '<td><b>Quantity: </b></td>';
            // echo '<td></td>';
            echo '</tr>';
            while ($row = mysqli_fetch_array($r)) {

              // $unserial = unserialize($row['items_bought']);

              echo '<tr>';
              echo '<td>'.($row['trans_date']).'</td>';
              echo '<td>'.($row['vendor']).'</td>';
              echo '<td>$'.($row['total_cost']).'</td>';
              include("includes/process_color_processed.php");
              // echo '<td>'.outPutItems($unserial).'</td>';
              echo '<td>'.($row['name']).'</td>';
              echo '<td>'.($row['quantity']).'</td>';
              echo '</tr>';

            }
            echo '</table>';
          }  else {
            echo '<div style ="color: red">';
            echo 'No Recent Purchases.';
            echo '</div>';
          }
        }else {
          echo '<div style ="color: red">';
          echo 'No Recent Purchases.';
          echo '</div>';
        }

        ?>
      </div>

    </div>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <div class="col-md-6 col-md-offset-3" style="text-align: center">
      <center><small> Certain items may not exist anymore, therefore only numbers will show up for the deleted item.</small></center>
    </div>
  </div><!-- /.container -->
  <?php
  include("includes/footer.php");
  ?>
</body>
</html>