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
      <p class="lead">Welcome! Here are your all your categories.</p>
      <?php
      if(isset($_GET['message'])){
        echo '<div style ="color: red">'.$_GET['message'].'</div>';
      }
      ?>


      <div class="col-md-4 col-md-offset-4" align="center" style="text-align: center">

        <div class="vendor-product-options btn-group btn-group-justified" role="group">
          <div class="btn-group" role="group">
            <p><a class="btn btn-success" href="add_category.php" role="button" value="category">Add Category &raquo;</a></p>
          </div>
        </div>
        <?php

      //Includes database connection file for authorization
        include("includes/db_connection.php");

      // define a query
        $q = "SELECT * FROM categories";

      // execute the query
        $r = mysqli_query($dbc, $q);
        if (!$r) echo "Sorry, failed connection";

        if(isset($r)){
          if (mysqli_num_rows($r)){

            // $unserial = array();

            echo '<table class="table table-striped table-bordered">';
            echo '<tr>';
            echo '<td><b>Category: </b></td>';
            echo '<td></td>';
            echo '</tr>';
            while ($row = mysqli_fetch_array($r)) {

              // $unserial = unserialize($row['items_bought']);

              echo '<tr>';
              echo '<td>'.($row['category']).'</td>';
              echo '<td><a href="edit_category.php?id='.$row['category_id'].'"><b>Edit?</b></a></td>';
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
      <center><small> Certain items may not exist anymore, therefore only numbers will show up for the deleted item.</small></center>
    </div>
  </div><!-- /.container -->
  <?php
  include("includes/footer.php");
  ?>
</body>
</html>