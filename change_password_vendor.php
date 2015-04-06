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
      <?php
      include("includes/change_password.php");
      ?>
    </div>
  </div><!-- /.container -->
  <?php
  include("includes/footer.php");
  ?>
</body>
</html>