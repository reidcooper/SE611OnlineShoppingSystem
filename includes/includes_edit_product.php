<div class="container user-starter-template">

  <div style ="color: red">

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

    <?php

        // when the form in this page is submitted
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
      if($_POST['button'] == "Update") {

        // Define an array of error
        $error = array();
        $image = $_POST['hidden-image'];

        $allowed = array('image/png', 'image/jpeg', 'image/gif', 'image/jpg');
        if(is_uploaded_file($_FILES['image']['tmp_name'])){
          if ($_FILES["image"]["error"] > 0){
            echo "Return Code: " . $_FILES["image"]["error"] . "<br>";
          } else{
            echo "Upload: " . $_FILES["image"]["name"] . "<br>";
            echo "Type: " . $_FILES["image"]["type"] . "<br>";
            echo "Size: " . ($_FILES["image"]["size"] / 1024) . " kB<br>";
            if (file_exists("/includes/images/" . $_FILES["image"]["name"])){
              echo "Using Stored Photo";
              $image = "includes/images/" . $_FILES["image"]["name"];
            }else{
              if(in_array($_FILES["image"]["type"], $allowed)){
                $image = "includes/images/" . $_FILES["image"]["name"];
                move_uploaded_file($_FILES["image"]["tmp_name"], "includes/images/" . $_FILES["image"]["name"]);
                //change upload to whatever path
                echo "Upload Successful!<br>";
              }
            }
          }
        }

        $name = $_POST['name'];
        $category = $_POST['category'];
        $description = $_POST['description'];
        $features = $_POST['features'];
        $constraints = $_POST['constraints'];
        $stock = $_POST['stock'];
        $cost = $_POST['cost'];
        $discount_amount = $_POST['discount_amount'];
        $product_id = $_POST['product_id'];

        if (!empty($discount_amount) && $discount_amount != "0.00"){
          $discount_bool = "yes";
        } else {
          $discount_bool = "no";
        }

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
        if (empty($constraints)){
          $error[] = "You forgot to enter constraints.";
        }
        if (!isset($stock)){
          $error[] = "You forgot to enter stock.";
        }
        if (empty($cost)){
          $error[] = "You forgot to enter cost.";
        }
        if ($discount_amount > $cost) {
          $error[] = "Cannot have discount greater than price.";
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

          $q = "UPDATE product_master SET name = '$name', category = '$category', image = '$image', description = '$description', features = '$features', constraints_of_products = '$constraints', stock = '$stock', cost = '$cost', discounted = '$discount_bool', discounted_amount = '$discount_amount' WHERE product_id = '$product_id'";

              // execute the query
          $r = mysqli_query($dbc, $q);
          if ($r) echo "Product Updated!";

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
            // $discount_amount = $row['discounted_amount'];
          $discount_bool = $row['discounted'];
        }else {
          echo "Could Not Retrieve Product Information";
        }

        include("includes/obtain_categories.php");

      }
    }

    /* <input type="discount_amount" id="InputInput1" placeholder="Enter Discount ($0.00)" name="discount_amount" value="<?php if(isset($_POST['discount_amount'])){ echo $_POST['discount_amount'];} else { echo $discount_amount;}?>" min="0" step="0.01" data-number-to-fixed="2" data-number-stepfactor="100" class="form-control currency" id="c2" /> */

    ?>

  </div>

  <div class="add-product col-md-6 col-md-offset-3">
    <h1>Edit a Product</h1>
    <form action="" method="POST" enctype = "multipart/form-data">
      <div class="form-group">
        <label for="InputName1">Name</label>
        <input type="name" class="form-control" id="InputName1" name="name" maxlength="254" placeholder="Enter Name" value="<?php if(isset($_POST['name'])){ echo $_POST['name'];} else { echo $name;}?>">
      </div>
      <div class="form-group">
                <!-- Single button
                <input type="state" class="form-control" id="InputState1" placeholder="Enter State"> -->
                <label for="InputCategory1">Category</label>
                <div class="btn-group">
                  <?php

                  dropDownMenu($category_array, "category", $category);

                  ?>
                </div>
              </div>
              <div class="form-group">
                <label for="InputLastName1">Image</label>
                <input id="image" type="file" class="file form-control" name="image">
                <input readonly name="hidden-image" value="<?php echo $image;?>"/>
              </div>
              <div class="form-group">
                <label for="InputPassword1">Description</label>
                <input type="description" class="form-control" id="InputDescription1" maxlength="254" name="description" placeholder="Description" value="<?php if(isset($_POST['description'])){ echo $_POST['description'];} else { echo $description;}?>">
              </div>
              <div class="form-group">
                <label for="InputFeatures1">Features</label>
                <input type="feature" class="form-control" id="InputFeatures1" name="features" maxlength="254" placeholder="Features" value="<?php if(isset($_POST['features'])){ echo $_POST['features'];} else { echo $features;}?>">
              </div>

              <div class="form-group">
                <label for="InputConstraints1">Constraints of Products</label>
                <input type="constraints" class="form-control" id="Input" name="constraints" maxlength="254" placeholder="Enter Constraints" value="<?php if(isset($_POST['constraints'])){ echo $_POST['constraints'];} else { echo $constraints;}?>">
              </div>

              <div class="form-group">
                <label for="c2">Discount Amount $</label>
                <div class="input-group">
                  <span class="input-group-addon">$</span>
                  <input type="discount_amount" id="InputInput1" placeholder="Enter Discount ($0.00)" name="discount_amount" min="0" step="0.01" data-number-to-fixed="2" data-number-stepfactor="100" class="form-control currency" id="c2" />
                </div>
              </div>
              <div class="form-group">
                <label for="InputStock1">Stock</label>
                <input type="stock" class="form-control" id="InputStock1" name="stock" placeholder="Enter Stock" value="<?php if(isset($_POST['stock'])){ echo $_POST['stock'];} else { echo $stock;}?>">
              </div>
              <div class="form-group">
                <label for="c2">Cost $</label>
                <div class="input-group">
                  <span class="input-group-addon">$</span>
                  <input type="number" placeholder="Enter Cost ($0.00)" name="cost" value="<?php if(isset($_POST['cost'])){ echo $_POST['cost'];} else { echo $cost;}?>" min="0" step="0.01" data-number-to-fixed="2" data-number-stepfactor="100" class="form-control currency" id="c2" />
                </div>
              </div>
              <input type="hidden" name="product_id" value="<?php echo $product_id;?>"/>
              <button type="submit" class="btn btn-default" name="button" value="Update">Update</button>
            </form>
          </div>
  </div><!-- /.container -->