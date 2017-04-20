<?php
include 'AdminProfile.php';
include '../includes/db.php';
		
$sql="SELECT * FROM tasks_returns";
$result=$con->query($sql);



					

?>
<h2 class="text-center">Returns</h2>
<hr>
			<table class="table table-bordered table-condensed table-striped">
				<thead><th class="text-center">Order Id</th><th class="text-center">Lineitem Id</th><th class="text-center">Return Policy</th><th class="text-center">Change Return Status</th></thead>
				<tbody>
					
					<?php while($result1=mysqli_fetch_assoc($result)):
						$order_id=$result1['ret_order_id'];
						$lineitem_id=$result1['ret_order_line_id'];
						$o_d_q = $con->query("SELECT * FROM orders WHERE order_id = '$order_id'");
						$o_d_r = mysqli_fetch_assoc($o_d_q);
						$order_date=$o_d_r['order_date'];
						$return_date=$result1['ret_date'];
						$return_status=$result1['return_status'];
						?>
						<?php 
						$date1=date_create($return_date);
						$date2=date_create($order_date);
						$diff=date_diff($date2,$date1);
						$string=$diff->format("%a days");
						$string1=explode(' ', $string);
						$string2=$string1[0];
						$string3=intval($string1);
						?>
						<tr>
						<td class="text-center"><?=$order_id;?></td>
						<td class="text-center"><?=$lineitem_id;?></td>
						<td class="text-center"><strong>Order Date/Return Date: </strong><?=$order_date;?>/<?=$return_date;?><br><strong>Difference: <?=$string3 ?> days</strong> </td>
						
						<td><form name="post_status" method="POST" action="returns.php?edit=<?=$result1['return_id']?>"><div class="ui-select">
				              <select id="return_status" name="return_status" class="form-control" onchange="this.form.submit()" > 
				                <option><?php echo $return_status?></option>
				                <option value="RETURN INITIATED">RETURN INITIATED</option>
				                <option value="RETURN ACCEPTED">RETURN ACCEPTED</option>
				                <option value="RETURN DECLINED">RETURN DECLINED</option>
				                <option value="RETURN RECEIVED">RETURN RECEIVED</option>
				              </select>
            				</div></form>
            			</td>
						
						

					</tr>	
					<?php endwhile;?>

					<?php
					
					if(isset($_GET['edit'])){
							$return_id = $_GET['edit'];

	
						if(isset($_POST['return_status'])){
							$new_ret_status = $_POST['return_status'];
							$sql1="UPDATE tasks_returns SET return_status = '$new_ret_status' WHERE return_id = '$return_id'";
						    $con->query($sql1);
						    //echo "$new_ret_status";

						    if($new_ret_status == 'RETURN ACCEPTED'){
						    	$sql="SELECT * FROM tasks_returns WHERE return_id = '$return_id'";
								$result=$con->query($sql);
								$result_r = mysqli_fetch_assoc($result);
								$ret_order_line_id = $result_r['ret_order_line_id'];
								$ret_order_id = $result_r['ret_order_id'];


								$sql="SELECT * FROM orders_line WHERE order_lineitem_id = '$ret_order_line_id' ";
								$result=$con->query($sql);
								$result_r = mysqli_fetch_assoc($result);
								$price = $result_r['extended_price'];


								$sql="SELECT * FROM orders WHERE order_id = '$ret_order_id' ";
								$result=$con->query($sql);
								$result_r = mysqli_fetch_assoc($result);
								$totalprice = $result_r['total_price'];

								$updatedprice = $totalprice - $price;
								//echo "$updatedprice";



						    	$con->query("update orders set total_price = '$updatedprice' where order_id = '$ret_order_id' ");
						    }

			    if($new_ret_status == 'RETURN RECEIVED'){
			    $update_sizes = '';
    			
    			$sql="SELECT * FROM tasks_returns WHERE return_id = '$return_id'";
								$result=$con->query($sql);
								$result_r = mysqli_fetch_assoc($result);
								$ret_order_line_id = $result_r['ret_order_line_id'];


								$sql="SELECT * FROM orders_line WHERE order_lineitem_id = '$ret_order_line_id' ";
								$result=$con->query($sql);
								$result_r = mysqli_fetch_assoc($result);
								$pid = $result_r['order_lineitem_prdct_id'];
								$quantity = $result_r['quantity'];
               
                $product_query = $con->query("SELECT * FROM products WHERE product_id ='$pid'");

                $product = mysqli_fetch_assoc($product_query);
                $sArray = explode(',', $product['sizes']);
                foreach($sArray as $sizeString){
                  $s = explode(':', $sizeString);
                 
                  $available =$s[1];
                  $size_of = $s[0];
                  $available = $available + $quantity;

                 $update_sizes = $update_sizes.$size_of.':'.$available;
                 // echo "$update_sizes";
                 
                  //echo "$update_sizes";
              
                $update_sizes = $update_sizes.',';
                
                }

                $new_updated_sizes = rtrim($update_sizes,", ");
                 
                //echo "$new_updated_sizes";
               $sql="UPDATE products SET sizes = '$new_updated_sizes' WHERE product_id ='$pid'";
              $con->query($sql) ;

						    }
						} ?>
							<script type="text/javascript">
								location.href = "returns.php";
							</script>
						<?php
							}