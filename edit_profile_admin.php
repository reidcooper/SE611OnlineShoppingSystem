<!DOCTYPE html>
<html lang="en">

<?php
include("includes/header.php");
?>

<body>

  <?php
  include("includes/admin_navbar.php");
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

        <!-- Since all profile updates go through the same process -->
        <?php
        include("includes/includes_update_profile.php");
        ?>
      </div>
    </div>
  </div><!-- /.container -->
  <?php
  include("includes/footer.php");
  ?>
</body>
</html>