<?php

//Includes database connection file for authorization
include("includes/db_connection.php");

// define a query
$get_categories = "SELECT * FROM categories";

// execute the query
$execute_categories = mysqli_query($dbc, $get_categories);
if (!$execute_categories) echo "Cannot obtain categories.";

$category_array = array();

if(isset($execute_categories)){
    if (mysqli_num_rows($execute_categories)){
        while ($row = mysqli_fetch_array($execute_categories)) {
            $category_array[] = $row['category'];
        }
    }
}

?>