<?php
session_start();
include '../includes/db.php';

$c_id = $_SESSION['c_id'];
$mode = $_POST['mode'];
$edit_id = $_POST['edit_id'];
$edit_size = $_POST['edit_size'];

$cart_query = $con->query("SELECT * FROM cart WHERE cus_cart_id = '$c_id' ");
$result = mysqli_fetch_assoc($cart_query);
$items = json_decode($result['items'],true);
$updated_items = array();

if($mode == 'removeone'){
	foreach ($items as $item) {
		if($item['product_id'] == $edit_id && $item['size'] == $edit_size){
			$item['quantity'] = $item['quantity'] - 1;
		}
		if($item['quantity'] > 0){
			$updated_items[] = $item;
		}
	}
}

if($mode == 'addone'){
	foreach ($items as $item) {
		if($item['product_id'] == $edit_id && $item['size'] == $edit_size){
			$item['quantity'] = $item['quantity'] + 1;
		}
		$updated_items[] = $item;
	}
}

if(!empty($updated_items)){
	$json_updated = json_encode($updated_items);
	$con->query("UPDATE cart SET items = '{$json_updated}' WHERE cus_cart_id = '{$c_id}' ");
	$_SESSION['success_flash'] = "Your Cart has been UPDATED";
}

if(empty($updated_items)){
	$con->query("DELETE FROM cart WHERE cus_cart_id = '{$c_id}' ");
}

?>