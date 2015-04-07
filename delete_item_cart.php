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

if ($_SESSION['role'] != 3 || empty($_SESSION['role'])){
	header('LOCATION: index.php');
} else {
	if(isset($_GET['id'])){

		$shopping_tally_id = $_GET['id'];

		//Includes database connection file for authorization
		include("includes/db_connection.php");

		$q = "SELECT * FROM cart WHERE shopping_tally_id = '$shopping_tally_id'";

		$r = mysqli_query($dbc, $q);

		if (mysqli_num_rows($r) == 1){
            $row = mysqli_fetch_array($r);
            $quantity = $row['quantity'];
            $product_id = $row['product_id'];
          }else {
            echo "Could Not Retrieve quantity Information";
          }

		$s = "UPDATE product_master SET stock = stock + '$quantity' WHERE product_id = '$product_id'";

		$t = mysqli_query($dbc, $s);

		$u = "DELETE FROM cart WHERE shopping_tally_id='$shopping_tally_id'";

		$v = mysqli_query($dbc, $u);

		if($r && $t && $v){
			$message = "Successful Deletion of Item from Cart!";
			header('LOCATION: view_cart.php?message='.$message.'');
		} else {
			echo "Cannot Delete Record.";
		}
	}
}

?>