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

		$username = $_GET['id'];

		//Includes database connection file for authorization
		include("includes/db_connection.php");

		$q = "UPDATE shopping_users SET role = '9' WHERE username='$username'";

		$r = mysqli_query($dbc, $q);

		if($r){
			$message = "Vendor has Been Disabled!";
			header('LOCATION: view_customers.php?message='.$message.'');
		} else {
			echo "Cannot Disable Record.";
		}
	}
}

?>