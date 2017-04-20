<?php
include 'AdminProfile.php';
include '../includes/db.php';

$order_sql = $con->query("select * from orders where order_status = 'approved'");

?>

	<h2 class="text-center">Shipments</h2>

			<hr>
			<table class="table table-bordered table-condensed table-striped text-center">
				<thead><th class="text-center">Order ID</th><th class="text-center">Line Item ID</th><th class="text-center">Shipment Label</th><th class="text-center">Ship To Address</th><th class="text-center"> Change Status</th></thead>
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

		    			$line_sql = $con->query("SELECT * FROM orders_line WHERE order_lineitem_ord_id = '$order_id' AND canceled = 0");

		    			$ship_add_id = $order['order_ship_id'];
		    			$ship_address_sql = $con->query("SELECT * FROM customer_details WHERE cus_detail_id = '$ship_add_id' ");
		    			$cusdetails = mysqli_fetch_assoc($ship_address_sql);

				   ?>
				   <?php while($line_order = mysqli_fetch_assoc($line_sql)): ?>
					<tr>
						
						<td><?=$order_id?></td>
						<td><?=$line_order_id = $line_order['order_lineitem_id'];

						$ship_status_q = $con->query("SELECT * FROM shipments WHERE shipment_lineitem_id = '$line_order_id'");
						$ship_status_r = mysqli_fetch_assoc($ship_status_q);
						if($ship_status_r == ''){

						$con->query("INSERT INTO shipments (shipment_lineitem_id) VALUES ('$line_order_id') ");

						}


						$ship_status = $ship_status_r['shipment_status'];
						//echo "$ship_status";
						$shipment_id =  $ship_status_r['shipment_id'];
						//echo "$shipment_id";
						
						?>
					
						</td>
						<td><strong><?=$line_order['order_line_name']?> <br><i class="text-primary">quantity x price x tax: </i><?=$line_order['quantity']?> x <?=$line_order['price']?> x <?=$state_tax?> = <?=$line_order['extended_price']?><br></strong></td>

						<td><strong><?=$cusdetails['cus_fullname']?><br><?=$cusdetails['cus_address']?><br><?=$cusdetails['cus_city']?>, <?=$cusdetails['cus_state']?> - <?=$cusdetails['cus_zipcode']?><br><?=$cusdetails['cus_mobile']?></strong></td>
						
						<td><form name="post_status" method="POST" action="shipments.php?edit=<?=$shipment_id;?>"><div class="ui-select">
				              <select id="ship_status" name="ship_status" class="form-control" onchange="this.form.submit()" > 
				                <option><?php echo $ship_status?></option>
				                <option value="pick">pick</option>
				                <option value="pack">pack</option>
				                <option value="ship">ship</option>
				              </select>
            				</div></form>
            			</td>
						
					</tr>
					<?php endwhile; ?>
					<?php endwhile; ?>
				</tbody>
			</table>


<?php

	if(isset($_GET['edit'])){
		$shipment_id = $_GET['edit'];
	
	if(isset($_POST['ship_status'])){
		$new_ship_status = $_POST['ship_status'];
		//echo "$new_ship_status";
		$con->query("UPDATE shipments SET shipment_status = '$new_ship_status' WHERE shipment_id = '$shipment_id' ");
		

	} ?>
	<script type="text/javascript">
		location.href = "shipments.php";
	</script>
	<?php
	}
?>