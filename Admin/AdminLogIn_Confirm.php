<?php

include("../includes/db.php");

session_start();

$signinEmail = $_POST["adminsigninEmail"];
$signinPassword = $_POST["adminsigninPassword"];

$emailValidation = "/^[_a-z0-9-.]+(\.[._a-z0-9-])*@[a-z0-9]+(\.[a-z]{2,4})$/";

if(empty($signinEmail) || empty($signinPassword)){
	echo "
		<div class = 'alert alert-warning'>
		<a href = '#' class = 'close' data-dismiss = 'alert' aria-label = 'close'>&times;</a>
		<b> Please fill out all fields !!!</b>
		";
}else{
	if(!preg_match($emailValidation, $signinEmail)){
		echo "
		<div class = 'alert alert-warning'>
		<a href = '#' class = 'close' data-dismiss = 'alert' aria-label = 'close'>&times;</a>
		<b> $signinEmail is not a valid email id !!!</b>
		";
	exit();
	}

	if(strlen($signinPassword)<6){
		echo "
		<div class = 'alert alert-warning'>
		<a href = '#' class = 'close' data-dismiss = 'alert' aria-label = 'close'>&times;</a>
		<b> Password should be atleast 6 characters !!!</b>
		";
	exit();
	}

	$signinEmail = mysqli_real_escape_string($con, $_POST["adminsigninEmail"]); // Protecting from hackers
	$signinPassword = md5($_POST["adminsigninPassword"]);  //converting password to md5 format

	$sql = "SELECT * FROM customers WHERE customer_email = '$signinEmail' AND customer_password = '$signinPassword' AND customer_type=1 ";
	$run_query = mysqli_query($con, $sql);
	$count = mysqli_num_rows($run_query);
	if ($count == 1) {
		$row = mysqli_fetch_array($run_query);
		$_SESSION["c_id"] = $row["customer_id"];
		$_SESSION["c_name"] = $row["customer_name"];
		$_SESSION["c_type"] = 1 ; 
		echo "true";
    exit(); 
	}else{
		echo "
		<div class = 'alert alert-warning'>
		<a href = '#' class = 'close' data-dismiss = 'alert' aria-label = 'close'>&times;</a>
		<b>Email or Password is incorrect</b>
		";
	exit();
	}

	
}


?>