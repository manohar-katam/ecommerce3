<?php
session_start();
include '../includes/db.php';

$sub_cust_id = $_SESSION["c_id"];
$product_id = $_POST['product_id'];
$size = $_POST['size'];
$available = $_POST['available'];
$quantity = $_POST['quantity'];
$frequency = $_POST['frequency'];

$product_query = $con->query("SELECT * FROM products WHERE product_id ='$product_id'");
$product = mysqli_fetch_assoc($product_query);
$product_price = $product['price'];

$result_query = $con->query("SELECT * FROM subscription WHERE sub_cust_id = '$sub_cust_id' ORDER BY subscribed ASC LIMIT 1 ");
$result = mysqli_fetch_assoc($result_query);
if($result != ''){
	$subscribed = $result['subscribed'];
	if($subscribed == 1){
		$con->query("INSERT INTO subscription (sub_frequency, sub_cust_id) VALUES ('$frequency', '$sub_cust_id') ");
	}
}else{
	$con->query("INSERT INTO subscription (sub_frequency, sub_cust_id) VALUES ('$frequency', '$sub_cust_id') ");
}

$result_query = $con->query("SELECT * FROM subscription WHERE sub_cust_id = '$sub_cust_id' ORDER BY subscribed ASC LIMIT 1 ");
$result = mysqli_fetch_assoc($result_query);
$subscription_id = $result['subscription_id'];

$con->query("INSERT INTO subscription_template (sub_prdct_id, sub_quantity, sub_id) VALUES ('$product_id', '$quantity', '$subscription_id')");

	

?>