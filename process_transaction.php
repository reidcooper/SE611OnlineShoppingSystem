<!DOCTYPE html>
<html lang="en">

<?php
include("includes/header.php");
?>

<body>

  <?php
  include("includes/vendor_navbar.php");
  ?>

  <?php

  function dropDownMenu($array, $name, $value){
    echo '<select name='.$name.' class="form-control">';
    foreach ($array as $ar){
      echo '<option value="'.$ar.'"';

      if($ar == $value) echo 'selected = "selected"';

      echo '>'.$ar.'</option>';
    }
    echo '</select>';
  }
  ?>

  <div class="container">
    <div class="starter-template">
      <div id="page_content">
        <div style ="color: red">
          <?php
          if($_SERVER['REQUEST_METHOD'] == 'POST'){

            $processed = $_POST['processed'];
            $transaction_id = $_POST['transaction_id'];

            if ($processed != 'Pending') {
              $date = $_POST['delivery'];
            }

            //Includes database connection file for authorization
            include("includes/db_connection.php");

            if($_POST['Process'] == "Process") {
              if ($processed != "Pending"){

                $q = "UPDATE transactions SET processed='$processed' WHERE transaction_id = '$transaction_id'";

                // execute the query
                $r = mysqli_query($dbc, $q);
                if (!$r) echo "Sorry, failed connection";

                // define a query
                $s = "INSERT INTO reports (status, transaction_id, delivery_date) VALUES ('$processed', '$transaction_id', '$date')";

              // execute the query
                $t = mysqli_query($dbc, $s);
                if ($t) echo "Process Complete";
                else echo "Sorry, failed connection";
              } else {
                echo "You must change the status of the transaction from Pending to say the package has actually been processed.";
              }
            } elseif ($_POST['Update'] == "Update"){

              // Update in both tables
              $q = "UPDATE transactions SET processed='$processed' WHERE transaction_id = '$transaction_id'";
              $s = "UPDATE reports SET status='$processed', delivery_date='$date' WHERE transaction_id = '$transaction_id'";

                // execute the query
              $r = mysqli_query($dbc, $q);
              if (!$r) echo "Sorry, failed connection";

                // execute the query
              $t = mysqli_query($dbc, $s);
              if ($t){echo "Transaction Status Updated";} else {echo "Sorry, failed connection";}

            }
          } else {
            if(isset($_GET['id'])){

              $transaction_id = $_GET['id'];

            }
          }
          ?>
        </div>
        <div class="col-md-12">
          <h1>Process Transaction</h1>
          <div class="col-md-8 process-transaction-customer-info">

            <?php

            //Includes database connection file for authorization
            include("includes/db_connection.php");

            // define a query
            $q = "SELECT * FROM transactions INNER JOIN shopping_users ON transactions.username = shopping_users.username WHERE transactions.transaction_id = '$transaction_id'";

            // define a query
            $s = "SELECT * FROM transactions INNER JOIN product_master ON transactions.product_id = product_master.product_id WHERE transactions.transaction_id = '$transaction_id'";

            $get_Delivery_date = "SELECT * FROM reports WHERE transaction_id = '$transaction_id'";

            // execute the query
            $r = mysqli_query($dbc, $q);
            if (!$r) echo "Sorry, failed connection";

            // execute the query
            $t = mysqli_query($dbc, $s);
            if (!$t) echo "Sorry, failed connection";

            // execute the query
            $retrieveDate = mysqli_query($dbc, $get_Delivery_date);
            if (!$retrieveDate) echo "Sorry, failed connection";

            if (mysqli_num_rows($r) == 1){
              $row = mysqli_fetch_array($r);
              $firstName = $row['firstName'];
              $lastName = $row['lastName'];
              $address = $row['address'];
              $city = $row['city'];
              $state = $row['state'];
              $zipCode = $row['zipCode'];
              $phone = $row['phone'];
              $quantity = $row['quantity'];
              $total_cost = $row['total_cost'];
              $processed = $row['processed'];
            }else {
              echo "Could Not Retrieve Information";
            }

            if (mysqli_num_rows($t) == 1){
              $row2 = mysqli_fetch_array($t);
              $product_name = $row2['name'];
            }else {
              echo "Could Not Retrieve Information";
            }

            if (mysqli_num_rows($retrieveDate) == 1){
              $row3 = mysqli_fetch_array($retrieveDate);
              $delivery = $row3['delivery_date'];
            }else {
              echo "Could Not Retrieve Information";
            }

            ?>

            <div id="customer-info">
              <p><h4><u>-Customer Information-</u></h4></p>
              <p><b>Name: </b><?php echo $firstName . ' ' . $lastName  ?></p>
              <p><b>Address: </b><?php echo $address . ", " . $city . ', ' . $state . $zipCode ?></p>
              <p><b>Phone: </b><?php echo $phone ?></p>
            </div>
          </div>

          <div class="col-md-4 process-transaction-customer-info">
            <form action="" method="POST">
              <div id="customer-info">
                <p><h4><u>-Transaction Information-</u></h4></p>
                <p><b>Product: </b><?php echo $product_name ?></p>
                <p><b>Quantity: </b><?php echo $quantity ?></p>
                <p><b>Total Cost: </b><?php echo $total_cost ?></p>
                <div class="btn-group">
                  <label for="Inputstatus1">Update Status</label>
                  <?php

                  $processed_array = array('Processed', 'On-Delivery', 'Delivered');

                  dropDownMenu($processed_array, "processed", $processed);

                  ?>
                </div>
                <div class="form-group">
                  <label for="InputDelivery1">Delivery Date</label>
                  <input type="date" class="form-control" id="InputDelivery1" name="delivery" placeholder="Enter Delivery Date" value="<?php if(isset($_POST['delivery'])){ echo $_POST['delivery'];} else {echo $delivery;} ?>">
                </div>
              </div>
              <br>
              <input type="hidden" name="transaction_id" value="<?php echo $transaction_id;?>"/>
              <?php

              if ($processed == "Pending"){
                echo "<button type='submit' class='btn btn-success' name='Process' value='Process'>Process</button>";

              } else {
                echo "<button type='submit' class='btn btn-primary' name='Update' value='Update'>Update</button>";
              }

              ?>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div><!-- /.container -->
  <?php
  include("includes/footer.php");
  ?>
</body>
</html>