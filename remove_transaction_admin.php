<?php

// Maintain the session that is being used by a particular USER
session_start();

// If there is no cookie with a username, redirect to Index
// Else set the cookies to the username and first name for personal greeting (possibly)
if(empty($_COOKIE['uname'])){
	header('LOCATION: index.php');
} else {
	$uname = $_COOKIE['uname'];
	$fname = $_COOKIE['fname'];
}

if ($_SESSION['role'] != 1 || empty($_SESSION['role'])){
	header('LOCATION: index.php');
} else {
	if(isset($_GET['id'])){



      // This function is to unserialize an multi-dimensional array which is stored in the items_bought in transaction table
      // Takes the de-serialized array as input
      // For each item in the array, that represents an item bought
      // Each item bought has two things: [0] the product name & [1] the quantity of that product purchased
      // 1. locates the item based on spot [0]
      // 2. while composing each string, it obtains the quantity associated with that product name
      // 3. Returns string
      // function outPutItems($array){
      //       // Output product names
      //       foreach ($array as $item) {
      //         //Includes database connection file for authorization
      //         include("includes/db_connection.php");

      //         // define a query
      //         $q = "SELECT * FROM product_master WHERE product_id = '$item[0]'";

      //         // execute the query
      //         $r = mysqli_query($dbc, $q);
      //         if (!$r) echo "Sorry, failed connection";

      //         if(mysqli_num_rows($r)){
      //           while ($row = mysqli_fetch_array($r)){
      //             $string =  $row['name'] . ' (' . $item[1] . ') ' . ', ' . $string;
      //           }
      //         }
      //       }
      //   return rtrim($string, ", ");
      //   }

		$transaction_id = $_GET['id'];

		//Includes database connection file for authorization
		include("includes/db_connection.php");

		$q = "SELECT * FROM transactions WHERE transaction_id = '$transaction_id'";

		$r = mysqli_query($dbc, $q);

    // $unserial = array();

    if (mysqli_num_rows($r) == 1){
      $row = mysqli_fetch_array($r);
      // $unserial = unserialize($row['items_bought']);
      $transaction_id = $row['transaction_id'];
      $product_id = $row['product_id'];
      $quantity = $row['quantity'];
    }else {
      echo "Could Not Retrieve Information";
    }

    // Updates the stock count for that one product
    $s = "UPDATE product_master SET stock = stock + '$quantity' WHERE product_id = '$product_id'";

    $t = mysqli_query($dbc, $s);

    $u = "DELETE FROM transactions WHERE transaction_id = '$transaction_id'";

    $v = mysqli_query($dbc, $u);

    if($r && $t && $v){
     $message = "Successful Deletion of Transaction!";
     header('LOCATION: admin_transactions.php?message='.$message.'');
   } else {
     echo "Cannot Delete Record.";
   }
 }
}

?>