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
      <p class="lead">Welcome! Here are your recent transactions.</p>

      <?php

      function outPutItems($array){
        // Output product names

        foreach ($array as $item) {

          //Includes database connection file for authorization
          include("includes/db_connection.php");

          // define a query
          $q = "SELECT * FROM product_master WHERE product_id = '$item'";

          // execute the query
          $r = mysqli_query($dbc, $q);
          if (!$r) echo "Sorry, failed connection";

          if(mysqli_num_rows($r)){
            while ($row = mysqli_fetch_array($r)){

              $string =  $row['name'] . ', ' . $string;
              return $string;
            }
          }
        }
      }

      ?>

      <?php

      //Includes database connection file for authorization
      include("includes/db_connection.php");

      // define a query
      $q = "SELECT * FROM transactions WHERE username = '$uname'";

      // execute the query
      $r = mysqli_query($dbc, $q);
      if (!$r) echo "Sorry, failed connection";

      if(isset($r)){
        if (mysqli_num_rows($r)){

          $unserial = array();

          echo '<table class="table-no-border table-condensed">';
          while ($row = mysqli_fetch_array($r)) {

            $unserial = unserialize($row['items_bought']);

            echo '<tr>';
            echo '<td><b>Transaction Date: </b>'.($row['trans_date']).'</td>';
            echo '<td><b>Total Cost: </b>$'.($row['total_cost']).'</td>';
            echo '<td><b>Processed?: </b>'.($row['processed']).'</td>';
            echo '<td><b>Items Bought: </b>'.outPutItems($unserial).'</td>';
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
  </div><!-- /.container -->
  <?php
  include("includes/footer.php");
  ?>
</body>
</html>