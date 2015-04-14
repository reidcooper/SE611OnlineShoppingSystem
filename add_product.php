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

  <div class="container user-starter-template">

    <div style ="color: red">

      <?php

        // when the form in this page is submitted
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        if($_POST['button'] == "Add Product") {

          $name = $_POST['name'];
          $category = $_POST['category'];
          $image = $_POST['image'];
          $description = $_POST['description'];
          $features = $_POST['features'];
          $contraintOfProducts = $_POST['contraintOfProducts'];
          $stock = $_POST['stock'];
          $cost = $_POST['cost'];
          $deleted = 'no';
          $discounted = 'no';

            // Define an array of error
          $error = array();

          if (empty($name)){
            $error[] = "You forgot to enter name.";
          }
          if (empty($category)){
            $error[] = "You forgot to enter category.";
          }
          if (empty($description)){
            $error[] = "You forgot to enter description.";
          }
          if (empty($features)){
            $error[] = "You forgot to enter feature.";
          }
          if (empty($contraintOfProducts)){
            $error[] = "You forgot to enter contraintOfProducts.";
          }
          if (empty($stock)){
            $error[] = "You forgot to enter stock.";
          }
          if (empty($cost)){
            $error[] = "You forgot to enter cost.";
          }

          if (filter_var($stock, FILTER_VALIDATE_INT) === 0 || !filter_var($stock, FILTER_VALIDATE_INT) === false) {
          } else {
            $error[] = "Enter a valid numerical stock.";
          }

          if (!preg_match("/\b\d{1,3}(?:,?\d{3})*(?:\.\d{2})?\b/", $cost)) {
            $error[] = "Enter a valid cost.";
          }

            // Check to see if anything in $error.
          if (empty($error)){

              //Includes database connection file for authorization
            include("includes/db_connection.php");

              // define a query
            $q = "INSERT INTO product_master (name, category, image, description, features, constraints_of_products, stock, cost, username, deleted, discounted) VALUES ('$name', '$category', '$image', '$description', '$features', '$contraintOfProducts', '$stock', '$cost', '$uname', '$deleted', '$discounted')";

              // execute the query
            $r = mysqli_query($dbc, $q);
            if ($r) echo "Product Entered!";

            include("includes/obtain_categories.php");

          } else {
            include("includes/obtain_categories.php");
            foreach ($error as $msg) {
              echo $msg;
              echo '<br>';
            }
          }
        }
      } else {
        // Obtain Categories
        include("includes/obtain_categories.php");
      }
      ?>

    </div>

    <div class="add-product col-md-6 col-md-offset-3">
      <h1>Add a Product</h1>
      <form action="" method="POST">
        <div class="form-group">
          <label for="InputName1">Name</label>
          <input type="name" class="form-control" id="InputName1" name="name" placeholder="Enter Name" value="<?php if(isset($_POST['name'])) echo $_POST['name']; ?>">
        </div>
        <div class="form-group">
                <!-- Single button
                <input type="state" class="form-control" id="InputState1" placeholder="Enter State"> -->
                <label for="InputCategory1">Category</label>
                <div class="btn-group">
                  <?php

                  dropDownMenu($category_array, "category", $_POST['category']);

                  ?>
                </div>
              </div>
              <div class="form-group">
                <label for="InputLastName1">Image</label>
                <input id="input-1" type="file" class="file form-control" name="image" value="<?php if(isset($_POST['image'])) echo $_POST['image']; ?>">
              </div>
              <div class="form-group">
                <label for="InputPassword1">Description</label>
                <input type="description" class="form-control" id="InputDescription1" maxlength="255" name="description" placeholder="Description" value="<?php if(isset($_POST['description'])) echo $_POST['description']; ?>">
              </div>
              <div class="form-group">
                <label for="InputFeatures1">Features</label>
                <input type="feature" class="form-control" id="InputFeatures1" maxlength="255" name="features" placeholder="Features" value="<?php if(isset($_POST['features'])) echo $_POST['features']; ?>">
              </div>

              <div class="form-group">
                <label for="InputContraintsOfProducts1">Constraints of Products</label>
                <input type="contraintOfProducts" class="form-control" id="Input" maxlength="255" name="contraintOfProducts" placeholder="Enter Constraints" value="<?php if(isset($_POST['contraintOfProducts'])) echo $_POST['contraintOfProducts']; ?>">
              </div>

              <div class="form-group">
                <label for="InputStock1">Stock</label>
                <input type="stock" class="form-control" id="InputStock1" maxlength="10" name="stock" placeholder="Enter Stock" value="<?php if(isset($_POST['stock'])) echo $_POST['stock']; ?>">
              </div>
              <div class="form-group">
                <label for="c2">Cost $</label>
                <div class="input-group">
                  <span class="input-group-addon">$</span>
                  <input type="number" placeholder="Enter Cost ($0.00)" maxlength="15" name="cost" value="<?php if(isset($_POST['cost'])) echo $_POST['cost']; ?>" min="0" step="0.01" data-number-to-fixed="2" data-number-stepfactor="100" class="form-control currency" id="c2" />
                </div>
              </div>

              <button type="submit" class="btn btn-default" name="button" value="Add Product">Submit</button>
            </form>
          </div>
        </div><!-- /.container -->
        <?php
        include("includes/footer.php");
        ?>
      </body>
      </html>