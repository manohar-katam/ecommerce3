<?php

include("includes/db.php");
session_start();

$c_id = $_SESSION["delete_id"];

	$delete_customer = "DELETE FROM `customers` WHERE `customer_id` = '$c_id'";
	$run_delete = mysqli_query($con, $delete_customer);

	$delete_customer_details = "DELETE FROM `customer_details` WHERE `cus_id` = '$c_id'";
	$run_delete_details = mysqli_query($con, $delete_customer_details);

	$delete_customer_pay = "DELETE FROM `customer_pay` WHERE `c_id` = '$c_id'";
	$run_delete_pay = mysqli_query($con, $delete_customer_pay);

	echo "Successful";

?>