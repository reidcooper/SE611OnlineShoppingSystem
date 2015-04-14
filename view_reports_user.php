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
      <p class="lead">Welcome! Here are your reports.</p>
      <?php
      if(isset($_GET['message'])){
        echo '<div style ="color: red">'.$_GET['message'].'</div>';
      }
      ?>

      <h4>Order Report:</h4>

      <div class="col-md-12" align="center" style="text-align: center">
        <?php

      //Includes database connection file for authorization
        include("includes/db_connection.php");

      // define a query
        $q = "SELECT * FROM reports INNER JOIN transactions ON reports.transaction_id = transactions.transaction_id WHERE status != 'Delivered' AND username = '$uname'";

      // execute the query
        $r = mysqli_query($dbc, $q);
        if (!$r) echo "Sorry, failed connection";

        if(isset($r)){
          if (mysqli_num_rows($r)){

            // $unserial = array();

            echo '<table class="table table-striped table-bordered">';
            echo '<tr>';
            echo '<td><b>Order ID: </b></td>';
            echo '<td><b>Transaction ID: </b></td>';
            echo '<td><b>Status: </b></td>';
            echo '<td><b>Delivery Date: </b></td>';
            echo '</tr>';
            while ($row = mysqli_fetch_array($r)) {

              echo '<tr>';
              echo '<td>'.($row['order_id']).'</td>';
              echo '<td>'.($row['transaction_id']).'</td>';
              // echo '<td>'.($row['status']).'</td>';
              include("includes/process_color_status.php");
              echo '<td>'.($row['delivery_date']).'</td>';
              echo '</tr>';

            }
            echo '</table>';
          }  else {
            echo '<div style ="color: red">';
            echo 'No Orders Added.';
            echo '</div>';
          }
        }else {
          echo '<div style ="color: red">';
          echo 'No Orders Added.';
          echo '</div>';
        }

        ?>
      </div>

      <h4>Delivery Report:</h4>

      <div class="col-md-12" align="center" style="text-align: center">
        <?php

      //Includes database connection file for authorization
        include("includes/db_connection.php");

        // define a query
        $s = "SELECT * FROM reports INNER JOIN transactions ON reports.transaction_id = transactions.transaction_id WHERE status = 'Delivered' AND username = '$uname'";

      // execute the query
        $rt = mysqli_query($dbc, $s);
        if (!$rt) echo "Sorry, failed connection";

        if(isset($rt)){
          if (mysqli_num_rows($rt)){

            echo '<table class="table table-striped table-bordered">';
            echo '<tr>';
            echo '<td><b>Order ID: </b></td>';
            echo '<td><b>Transaction ID: </b></td>';
            echo '<td><b>Status: </b></td>';
            echo '<td><b>Delivery Date: </b></td>';
            echo '</tr>';
            while ($row = mysqli_fetch_array($rt)) {

              echo '<tr>';
              echo '<td>'.($row['order_id']).'</td>';
              echo '<td>'.($row['transaction_id']).'</td>';
              // echo '<td>'.($row['status']).'</td>';
              include("includes/process_color_status.php");
              echo '<td>'.($row['delivery_date']).'</td>';
              echo '</tr>';

            }
            echo '</table>';
          }  else {
            echo '<div style ="color: red">';
            echo 'No Deliveries Added.';
            echo '</div>';
          }
        }else {
          echo '<div style ="color: red">';
          echo 'No Deliveries Added.';
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