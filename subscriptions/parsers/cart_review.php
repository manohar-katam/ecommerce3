<?php
  $cus_ship_tax = $_POST['tax_id'];
  $check_sql = "SELECT * FROM cart WHERE cus_cart_id = '$c_id' ";
  $check_run_query = mysqli_query($con, $check_sql);
  $cart = mysqli_fetch_assoc($check_run_query);
  if ($cart != '') {
     $con->query("UPDATE cart SET cart_ship_id = '$cus_ship_tax' WHERE cus_cart_id = '$c_id' ");
    $items = json_decode($cart['items'],true);
    $i = 1;
    $sub_total = 0;
    $item_count = 0;
  }
  
  

      
?>

<div class="container">
  <div class="row">
   <div class="col-xs-6 col-md-offset-3">
      <?php if($cart == ''): ?>
        <div class="bg-danger">
          <h3 class="text-center"> Your Cart Is Empty</h3>
        </div>
      <?php else: ?>
        <table class="table table-bordered table-condensed table-striped">
          <thead><th>Sl.No</th><th>Item</th><th>Price</th><th>Quantity</th><th>Size</th><th>Sub Total</th></thead>
          <tbody>
            <?php
              foreach ($items as $item) {
                $product_id = $item['product_id'];
                $product_query = $con->query("SELECT * FROM products WHERE product_id ='{$product_id}'");
                $product = mysqli_fetch_assoc($product_query);
                $sArray = explode(',', $product['sizes']);
                foreach($sArray as $sizeString){
                  $s = explode(':', $sizeString);
                  if($s[0] == $item['size']){
                  $available = $s[1];
                }
              }
            ?>
            <tr>
              <td><?=$i;?></td>
              <td><?=$product['title'];?></td>
              <td><?='$ '.($product['price']);?></td>
              <td>
              <?=$item['quantity'];?>
              </td>
              <td><?=$item['size'];?></td>
              <td><?='$ '.number_format(($item['quantity'] * $product['price']),2);?></td>
            </tr>
            <?php
              $i++;
              $item_count += $item['quantity'];
              $sub_total += ($product['price'] * $item['quantity']);
             }
               // Tax goes here
           //if($_POST['tax_id']){

          
           //}
           // echo "$cus_detail_id"." gsg";
				  //$cus_detail_id = $_SESSION['tax_id'];
    			$cus_state_query = $con->query("SELECT * FROM customer_details WHERE cus_detail_id = '$cus_ship_tax' ");
    			$cus_state_fetch = mysqli_fetch_assoc($cus_state_query);
    			$cus_state = $cus_state_fetch['cus_state'];

			    $tax_query = $con->query("SELECT * FROM tax WHERE state_id = '$cus_state' ");
    			$tax_fetch = mysqli_fetch_assoc($tax_query);
    			$state_tax = $tax_fetch['state_tax'];
            	
            	$total_tax = ($state_tax/100) * $sub_total;
              	$total_tax = number_format($total_tax,2);
              	$grand_tot_after_tax = $total_tax + $sub_total;
              //}
              ?>
          </tbody>
        </table>
        <table class="table table-bordered table-condensed text-center">
          <thead class="totals-table-header" ><th class="text-center bg-primary">Total Items</th><th class="text-center bg-primary">Total before State Tax</th><th class="text-center bg-primary"> Total Tax</th><th class="text-center bg-primary">Grand Total</th></thead>
          <tbody>
          <tr>
            <td class="bg-success"><strong><?=$item_count;?></strong></td>
            <td class="bg-success"><strong><?='$ '.$grandtot_before_tax = $sub_total?></strong></td>
            <td class="bg-success"><strong><?='$ '.$total_tax;?></strong></td>
            <td class="bg-success"><strong><?='$ '.$grand_tot_after_tax?></strong></td>
          </tr>
          </tbody>
          </table>
      <?php endif; ?>
    </div>
  </div>
</div>
</div>



<!-- End of cart page -->
