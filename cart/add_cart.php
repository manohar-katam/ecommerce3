<?php
session_start();
include '../includes/db.php';

$cus_cart_id = $_SESSION["c_id"];
$product_id = $_POST['product_id'];
$size = $_POST['size'];
$available = $_POST['available'];
$quantity = $_POST['quantity'];

$item = array();
$item[] = array(
	'product_id' => $product_id,
	'size'       => $size,
	'quantity'   => $quantity,
	);

//$domain = ($_SERVER['HTTP_HOST'] != 'localhost')?'.'$_SERVER['HTTP_HOST']:false;
$query = $con->query("SELECT * FROM products WHERE product_id = '{$product_id}'");
$product = mysqli_fetch_assoc($query);
$_SESSION['success_flash'] = $product['title'].'was added to your cart successfully.';

//check to see if cart_id exists
$check_sql = "SELECT * FROM cart WHERE cus_cart_id = '$cus_cart_id' ";
	$check_run_query = mysqli_query($con, $check_sql);
	$cart = mysqli_fetch_assoc($check_run_query);
	if ($cart != '') {
		$previous_items = json_decode($cart['items'],true);
		$item_match = 0;
		$new_items = array();
		if (is_array($previous_items) || is_object($previous_items)){
		foreach ($previous_items as $pitem) {
			if($item[0]['product_id'] == $pitem['product_id'] && $item[0]['size'] == $pitem['size']){
				$pitem['quantity'] = $pitem['quantity'] + $item[0]['quantity'];
				if($pitem['quantity'] > $available){
					$pitem['quantity'] = $available;
				}
				$item_match = 1;
			}
			$new_items[] = $pitem;
		}
	    }
		if($item_match != 1){
			if(is_array($previous_items))
      			$new_items = array_merge($item, $previous_items);
    		else 
      			$new_items = array_merge($item, (array)$previous_items);
			//$new_items = array_merge($item, $previous_items);
		}
		$items_json = json_encode($new_items);
		$cart_expire = date("Y-m-d H:i:s",strtotime("+10 days"));
		$con->query("UPDATE cart SET items = '{$items_json}', expire_date = '{$cart_expire}' WHERE cus_cart_id = '{$cus_cart_id}' ");

}else{
	$items_json = json_encode($item);
	$cart_expire = date("Y-m-d H:i:s",strtotime("+10 days"));
	$con->query("INSERT INTO cart (cus_cart_id,items,expire_date) VALUES ('$cus_cart_id', '$items_json', '$cart_expire')");
}


?>