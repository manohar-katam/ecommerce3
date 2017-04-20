<?php

include("../includes/db.php");

$AdminsignupName = $_POST["AdminsignupName"];
$AdminsignupEmail = $_POST["AdminsignupEmail"];
$AdminsignupPassword = ($_POST["AdminsignupPassword"]);
$AdminsignupPasswordagain = ($_POST["AdminsignupPasswordagain"]);
$securityPassword = ($_POST["AdminsecurityPassword"]);

echo "
		<div class = 'alert alert-warning'>
		<a href = '#' class = 'close' data-dismiss = 'alert' aria-label = 'close'>&times;</a>
		";

$name = "/^[a-zA-Z ]+$/";
$emailValidation = "/^[_a-z0-9-.]+(\.[._a-z0-9-])*@[a-z0-9]+(\.[a-z]{2,4})$/";
$number = "/^[0-9]+$/";

if(empty($AdminsignupName) || empty($AdminsignupEmail) || empty($AdminsignupPassword) || empty($AdminsignupPasswordagain) || empty($securityPassword)){
	echo "
		<div class = 'alert alert-warning'>
		<a href = '#' class = 'close' data-dismiss = 'alert' aria-label = 'close'>&times;</a>
		<b> Please fill out all fields !!!</b>
		";
}else{
	if(!preg_match($name, $AdminsignupName)){
	echo "
	<div class = 'alert alert-warning'>
		<a href = '#' class = 'close' data-dismiss = 'alert' aria-label = 'close'>&times;</a>
		<b> $signupName is not a valid Name !!!</b>
		";
	exit();
	}

	if(!preg_match($emailValidation, $AdminsignupEmail)){
		echo "
		<div class = 'alert alert-warning'>
		<a href = '#' class = 'close' data-dismiss = 'alert' aria-label = 'close'>&times;</a>
		<b> $$signupEmail is not a valid email id !!!</b>
		";
	exit();
	}

	if(strlen($AdminsignupPassword)<6){
		echo "
		<div class = 'alert alert-warning'>
		<a href = '#' class = 'close' data-dismiss = 'alert' aria-label = 'close'>&times;</a>
		<b> Password should be atleast 6 characters !!!</b>
		";
	exit();
	}
	
	if($AdminsignupPassword == $AdminsignupName){
		echo "
	    <div class = 'alert alert-warning'>
		<a href = '#' class = 'close' data-dismiss = 'alert' aria-label = 'close'>&times;</a>
		<b> Password cannot be same as user name !!!</b>
		";
	exit();
	}

	if($AdminsignupPassword != $AdminsignupPasswordagain){
		echo "
	    <div class = 'alert alert-warning'>
		<a href = '#' class = 'close' data-dismiss = 'alert' aria-label = 'close'>&times;</a>
		<b> Passwords doesn't match !!!</b>
		";
	exit();
	}

	// check for existing email adress in database
	$sql = "SELECT customer_id FROM customers WHERE customer_email = '$AdminsignupEmail' AND customer_type=1  LIMIT 1 " ;
	if ($securityPassword != 'welcome'){
		echo "
	    <div class = 'alert alert-warning'>
		<a href = '#' class = 'close' data-dismiss = 'alert' aria-label = 'close'>&times;</a>
		<b> Security Password is Incorrect</b>
		";
	exit();
	}
			
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
		$AdminsignupPassword = md5($AdminsignupPassword);
		$sql = "INSERT INTO `customers` (`customer_id`, `customer_name`, `customer_email`, `customer_password`,`customer_type`) VALUES (NULL, '$AdminsignupName', '$AdminsignupEmail', '$AdminsignupPassword',1)";
		$run_query = mysqli_query($con, $sql);
		if($run_query){
			echo "Successful";
		}
	}
	
}

?>
