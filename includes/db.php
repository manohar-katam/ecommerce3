<?php

$servername = "localhost";
$username = "root";
$password = "";
$db = "ecommerce";

// Create connection
$con = mysqli_connect($servername, $username, $password, $db);

// Check Connection
if(!$con){
	die("Connection failed: ". mysqli_connect_error());
}

// include 'config.php';

// $cart_id ='';
// if (isset($_COOKIE[CART_COOKIE])) {
// 	$cart_id = $_COOKIE[CART_COOKIE];
// }

//define('BASEURL', '/ecommerce/');

?>