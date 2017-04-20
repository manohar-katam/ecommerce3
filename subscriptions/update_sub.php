<?php
session_start();
include '../includes/db.php';

$c_id = $_SESSION['c_id'];
$mode = $_POST['mode'];
$edit_id = $_POST['edit_id'];
$edit_sub_id = $_POST['edit_sub_id'];

$prepost = $_POST['prepost'];
$edit_sub = $_POST['edit_sub'];



$cart_query = $con->query("SELECT * FROM subscription_template WHERE sub_template_id = '$edit_sub_id' AND sub_prdct_id = '$edit_id' ");
$result = mysqli_fetch_assoc($cart_query);
$sub_quantity = $result['sub_quantity'];
if($mode == 'removeone'){
	$sub_quantity = $sub_quantity - 1;
	if($sub_quantity >= 0){
		$updated_items = $sub_quantity;
	}
}

if($mode == 'addone'){
	$sub_quantity = $sub_quantity + 1;
	if($sub_quantity >= 0){
		$updated_items = $sub_quantity;
	}
	
}

if(!empty($updated_items)){
	$con->query("UPDATE subscription_template SET sub_quantity = '$updated_items' WHERE sub_template_id = '$edit_sub_id' ");
}

if(empty($updated_items)){
	$con->query("DELETE FROM subscription_template WHERE sub_template_id = '$edit_sub_id' ");
}

$sub_query = $con->query("SELECT * FROM subscription WHERE subscription_id = '$edit_sub' ");
$sub_result = mysqli_fetch_assoc($sub_query);

$sub_next_due = $sub_result['sub_next_due'];

if($prepost == 'prepone'){
	$next_due = date('Y-m-d', strtotime("-1 days", strtotime($sub_next_due)));
	$con->query("UPDATE subscription SET sub_next_due = '$next_due' WHERE subscription_id = '$edit_sub' ");
}

if($prepost == 'postpone'){
	$next_due = date('Y-m-d', strtotime("+1 days", strtotime($sub_next_due)));
	$con->query("UPDATE subscription SET sub_next_due = '$next_due' WHERE subscription_id = '$edit_sub' ");
}

if(isset($_POST['skip_sub'])){
$skip_sub = $_POST['skip_sub'];
echo "$skip_sub";
$skip_query = $con->query("SELECT * FROM subscription WHERE subscription_id = '$skip_sub' ");
$skip_result = mysqli_fetch_assoc($skip_query);

$skip_next_due = $skip_result['sub_next_due'];
$frequency = $skip_result['sub_frequency'];
$skip_next_due = date('Y-m-d', strtotime("+$frequency months", strtotime($skip_next_due)));
$con->query("UPDATE subscription SET sub_next_due = '$skip_next_due' WHERE subscription_id = '$skip_sub' ");
}


?>