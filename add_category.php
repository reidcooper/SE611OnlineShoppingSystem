<!DOCTYPE html>
<html lang="en">

<?php
include("includes/header.php");
?>

<body>

  <?php
  include("includes/admin_navbar.php");
  ?>

  <div class="container user-starter-template">

    <div style ="color: red">

      <?php

        // when the form in this page is submitted
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        if($_POST['button'] == "Add Category") {

          $name = $_POST['name'];

            // Define an array of error
          $error = array();

          if (empty($name)){
            $error[] = "You forgot to enter name.";
          }
            // Check to see if anything in $error.
          if (empty($error)){

              //Includes database connection file for authorization
            include("includes/db_connection.php");

              // define a query
            $q = "INSERT INTO categories (category) VALUES ('$name')";

              // execute the query
            $r = mysqli_query($dbc, $q);
            if ($r) echo "Category Entered!";

          } else {
            foreach ($error as $msg) {
              echo $msg;
              echo '<br>';
            }
          }
        }
      }
      ?>

    </div>

    <div class="add-product col-md-6 col-md-offset-3">
      <h1>Add a Category</h1>
      <form action="" method="POST">
        <div class="form-group">
          <label for="InputName1">Name Of Category</label>
          <input type="name" class="form-control" id="InputName1" maxlength="255" name="name" placeholder="Enter Name" value="<?php if(isset($_POST['name'])) echo $_POST['name']; ?>">
        </div>
        <button type="submit" class="btn btn-default" name="button" value="Add Category">Submit</button>
      </form>
    </div>
  </div><!-- /.container -->
  <?php
  include("includes/footer.php");
  ?>
</body>
</html>