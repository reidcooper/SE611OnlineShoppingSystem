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
      <p class="lead">Welcome! Manage the Customers.</p>
      <?php
      if(isset($_GET['message'])){
        echo '<div style ="color: red">'.$_GET['message'].'</div>';
      }
      ?>

      <div class="col-md-12" align="center" style="text-align: center">
        <?php

      //Includes database connection file for authorization
        include("includes/db_connection.php");

      // define a query
        $q = "SELECT * FROM shopping_users WHERE role = '9' OR role ='3'";

      // execute the query
        $r = mysqli_query($dbc, $q);
        if (!$r) echo "Sorry, failed connection";

        if(isset($r)){
          if (mysqli_num_rows($r)){

            // $unserial = array();

            echo '<table class="table table-striped table-bordered">';
            echo '<tr>';
            echo '<td><b>Vendor Username: </b></td>';
            echo '<td><b>First Name: </b></td>';
            echo '<td><b>Last Name: </b></td>';
            echo '<td><b>Email: </b></td>';
            echo '<td><b>Last Login: </b></td>';
            echo '<td></td>';
            echo '<td></td>';
            echo '</tr>';
            while ($row = mysqli_fetch_array($r)) {

              // $unserial = unserialize($row['items_bought']);

              echo '<tr>';
              if ($row['role'] == 3) {
                echo '<td><font color="green">'.($row['username']).'</font></td>';
              } else {
                echo '<td><font color="red">'.($row['username']).'</font></td>';
              }
              echo '<td>'.($row['firstName']).'</td>';
              echo '<td>'.($row['lastName']).'</td>';
              echo '<td>'.($row['email']).'</td>';
              echo '<td>'.($row['last_login']).'</td>';
              echo '<td><a href="view_customer.php?id='.$row['username'].'"><b>View?</b></a></td>';
              if ($row['role'] == 3){
                echo '<td><a href="disable_user.php?id='.$row['username'].'"><b>Disable?</b></a></td>';
              } else {
                echo '<td><a id="enable-link" href="enable_customers.php?id='.$row['username'].'"><b>Enable?</b></a></td>';
              }
              echo '</tr>';

            }
            echo '</table>';
          }  else {
            echo '<div style ="color: red">';
            echo 'No Categories Added.';
            echo '</div>';
          }
        }else {
          echo '<div style ="color: red">';
          echo 'No Categories Added.';
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
      <center><p class="small">Disabling Customers will prevent logging in.</p></center>
      <center><small> Certain items may not exist anymore, therefore only numbers will show up for the deleted item.</small></center>
    </div>
  </div><!-- /.container -->
  <?php
  include("includes/footer.php");
  ?>
</body>
</html>