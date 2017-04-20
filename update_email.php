<?php

include("includes/db.php");
session_start();

$c_id = $_SESSION["c_id"];

$oldemail = $_POST["oldemail"];
$newemail = $_POST["newemail"];


$verify_email = "SELECT * FROM `customers` WHERE `customer_email` = '$oldemail' AND `customer_id` = '$c_id'";

$run_email = mysqli_query($con, $verify_email);

$check_email = mysqli_num_rows($run_email);
if ($check_email == 0) {
	echo "
	<div class = 'alert alert-warning'>
		<a href = '#' class = 'close' data-dismiss = 'alert' aria-label = 'close'>&times;</a>
		<b> Your Current Email is incorrect!</b>
		";
	exit();
} 

if ($oldemail == $newemail) {
	echo "
	<div class = 'alert alert-warning'>
		<a href = '#' class = 'close' data-dismiss = 'alert' aria-label = 'close'>&times;</a>
		<b> Old Email and New Email cannot be same</b>
		";
	exit();
}

$newold_email = "SELECT * FROM `customers` WHERE `customer_email` = '$newemail' LIMIT 1";

$newold_run_email = mysqli_query($con, $newold_email);

$newold_check_email = mysqli_num_rows($newold_run_email);

if($newold_check_email > 0 ){
	echo "
	<div class = 'alert alert-warning'>
		<a href = '#' class = 'close' data-dismiss = 'alert' aria-label = 'close'>&times;</a>
		<b> This Email id already exists !!!</b>
		";
	exit();
}else{

$updateEmail = "UPDATE `customers` SET `customer_email` = '$newemail' WHERE `customer_id` = '$c_id'";
$run_update = mysqli_query($con, $updateEmail);

echo "
	<div class = 'alert alert-success'>
		<a href = '#' class = 'close' data-dismiss = 'alert' aria-label = 'close'>&times;</a>
		<b> Your Email is Successfully updated !!!</b>
		";
	exit();
}

?>