<?php

include("includes/db.php");

$signupName = $_POST["signupName"];
$signupEmail = $_POST["signupEmail"];
$signupPassword = ($_POST["signupPassword"]);
$signupPasswordagain = ($_POST["signupPasswordagain"]);

$name = "/^[a-zA-Z ]+$/";
$emailValidation = "/^[_a-z0-9-.]+(\.[._a-z0-9-])*@[a-z0-9]+(\.[a-z]{2,4})$/";
$number = "/^[0-9]+$/";

if(empty($signupName) || empty($signupEmail) || empty($signupPassword) || empty($signupPasswordagain)){
	echo "
		<div class = 'alert alert-warning'>
		<a href = '#' class = 'close' data-dismiss = 'alert' aria-label = 'close'>&times;</a>
		<b> Please fill out all fields !!!</b>
		";
}else{
	if(!preg_match($name, $signupName)){
	echo "
	<div class = 'alert alert-warning'>
		<a href = '#' class = 'close' data-dismiss = 'alert' aria-label = 'close'>&times;</a>
		<b> $signupName is not a valid Name !!!</b>
		";
	exit();
	}

	if(!preg_match($emailValidation, $signupEmail)){
		echo "
		<div class = 'alert alert-warning'>
		<a href = '#' class = 'close' data-dismiss = 'alert' aria-label = 'close'>&times;</a>
		<b> $$signupEmail is not a valid email id !!!</b>
		";
	exit();
	}

	if(strlen($signupPassword)<6){
		echo "
		<div class = 'alert alert-warning'>
		<a href = '#' class = 'close' data-dismiss = 'alert' aria-label = 'close'>&times;</a>
		<b> Password should be atleast 6 characters !!!</b>
		";
	exit();
	}
	
	if($signupPassword == $signupName){
		echo "
	    <div class = 'alert alert-warning'>
		<a href = '#' class = 'close' data-dismiss = 'alert' aria-label = 'close'>&times;</a>
		<b> Password cannot be same as user name !!!</b>
		";
	exit();
	}

	if($signupPassword != $signupPasswordagain){
		echo "
	    <div class = 'alert alert-warning'>
		<a href = '#' class = 'close' data-dismiss = 'alert' aria-label = 'close'>&times;</a>
		<b> Passwords doesn't match !!!</b>
		";
	exit();
	}

	// check for existing email adress in database
	$sql = "SELECT customer_id FROM customers WHERE customer_email = '$signupEmail' LIMIT 1 " ;
	$check_query = mysqli_query($con, $sql);
	$count_email = mysqli_num_rows($check_query);
	if ($count_email > 0) {
		echo "
	    <div class = 'alert alert-warning'>
		<a href = '#' class = 'close' data-dismiss = 'alert' aria-label = 'close'>&times;</a>
		<b>$signupEmail already exists, Try with another email !!!</b>
		";
	}else{
		// if there is no existing email then insert into database
		$signupPassword = md5($signupPassword);
		$sql = "INSERT INTO `customers` (`customer_id`, `customer_name`, `customer_email`, `customer_password`) VALUES (NULL, '$signupName', '$signupEmail', '$signupPassword')";
		$run_query = mysqli_query($con, $sql);
		if($run_query){
			echo "Successful";
		}
	}
}

?>
