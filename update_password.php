<?php

include("includes/db.php");
session_start();

$c_id = $_SESSION["c_id"];
$oldpassword = md5($_POST["oldpassword"]);
$newpassword = $_POST["newpassword"];
$newpasswordagain = $_POST["newpasswordagain"];

$verify_password = "SELECT * FROM `customers` WHERE `customer_password` = '$oldpassword' AND `customer_id` = '$c_id'";

$run_password = mysqli_query($con, $verify_password);

$check_password = mysqli_num_rows($run_password);
if ($check_password == 0) {
	echo "
	<div class = 'alert alert-warning'>
		<a href = '#' class = 'close' data-dismiss = 'alert' aria-label = 'close'>&times;</a>
		<b> Your Current Password is wrong!</b>
		";
	exit();
} 

if ($newpassword != $newpasswordagain) {
	echo "
	<div class = 'alert alert-warning'>
		<a href = '#' class = 'close' data-dismiss = 'alert' aria-label = 'close'>&times;</a>
		<b> Your New passwords do not match!</b>
		";
	exit();
}
$newpassword = md5($newpassword);
if ($oldpassword == $newpassword) {
	echo "
	<div class = 'alert alert-warning'>
		<a href = '#' class = 'close' data-dismiss = 'alert' aria-label = 'close'>&times;</a>
		<b> Old password and New password cannot be same</b>
		";
	exit();
}

$updatepass = "UPDATE `customers` SET `customer_password` = '$newpassword' WHERE `customer_id` = '$c_id'";
$run_update = mysqli_query($con, $updatepass);

echo "
	<div class = 'alert alert-success'>
		<a href = '#' class = 'close' data-dismiss = 'alert' aria-label = 'close'>&times;</a>
		<b> Your Password is Successfully updated !!!</b>
		";
	exit();


?>