<?php
include 'AdminProfile.php';
include '../includes/db.php';

$order_sql = $con->query("select * from orders");

?>

	<h2 class="text-center">Orders</h2>

			<hr>
			<table class="table table-bordered table-condensed table-striped text-center">
				<thead><th class="text-center">Customer ID</th><th class="text-center">Order ID</th><th class="text-center">Ordered Items</th><th class="text-center"> Change Status</th></thead>
				<tbody>
				   <?php while($order = mysqli_fetch_assoc($order_sql)):
				   		$order_id = $order['order_id'];
				   		//echo "$order_id";
				   		$status = $order['order_status'];

				   		$cus_ship_tax = $order['order_ship_id'];
				   		$cus_state_query = $con->query("SELECT * FROM customer_details WHERE cus_detail_id = '$cus_ship_tax' ");
		    			$cus_state_fetch = mysqli_fetch_assoc($cus_state_query);
		    			$cus_state = $cus_state_fetch['cus_state'];

					    $tax_query = $con->query("SELECT * FROM tax WHERE state_id = '$cus_state' ");
		    			$tax_fetch = mysqli_fetch_assoc($tax_query);
		    			$state_tax = $tax_fetch['state_tax'];

		    			$line_sql = $con->query("SELECT * FROM orders_line WHERE order_lineitem_ord_id = '$order_id' AND canceled = '0'");

				   ?>
					<tr>
						<td><?=$order['order_cust_id'];?></td>
						<td><?=$order_id?></td>
						<td> <?php while($line_order = mysqli_fetch_assoc($line_sql)):
						
						 ?> <strong><?=$line_order['order_line_name']?><br><i class="text-primary">quantity x price x tax: </i><?=$line_order['quantity']?> x <?=$line_order['price']?> x <?=$state_tax?> = <?=$line_order['extended_price']?><br><br></strong><?php endwhile; ?></td>
						
						<td><form name="post_status" method="POST" action="orders.php?edit=<?=$order['order_id'];?>"><div class="ui-select">
				              <select id="order_status" name="order_status" class="form-control" onchange="this.form.submit()" > 
				                <option><?php echo $status?></option>
				                <option value="pending">pending</option>
				                <option value="approved">approved</option>
		
				              </select>
            				</div></form>
            			</td>
						
					</tr>
					<?php endwhile; ?>
				</tbody>
			</table>


<?php

	if(isset($_GET['edit'])){
		$order_id = $_GET['edit'];
	
	if(isset($_POST['order_status'])){
		$new_order_status = $_POST['order_status'];
		//echo "$order_status";

		$con->query("UPDATE orders SET order_status = '$new_order_status' WHERE order_id = '$order_id' ");

	} ?>
	<script type="text/javascript">
		location.href = "orders.php";
	</script>
	<?php
	}
?>