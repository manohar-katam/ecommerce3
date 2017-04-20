<?php
include 'AdminProfile.php';
include '../includes/db.php';
?>

<h2 class="text-center
"> Refresh the Page to Process Subscription Orders</h2>

<?php

  $check_sql = "SELECT * FROM subscription WHERE subscribed = '1' ";
            $check_run_query = mysqli_query($con, $check_sql);
              while($cart = mysqli_fetch_assoc($check_run_query)):
              
              $date_now = date("Y-m-d");
              $due = $cart['sub_next_due'];
              $today_time = strtotime($date_now);
			  $expire_time = strtotime($due);

			  $c_id = $cart['sub_cust_id'];
              
			  //echo "$expire_time";
			 //  $next_due = date('Y-m-d', strtotime("+25 days", strtotime($date_now)));
			 //  echo "   $next_due";
			 //   $next_due = strtotime($next_due);
			 // // echo "   $next_due";
			 //  $t = $expire_time - $next_due;
			 //  echo "    $t";
			 if ($expire_time - $today_time == 432000) {
			 	//do something
        $grand_total = '';
         $frequency = $cart['sub_frequency'];
          $next_due = date('Y-m-d', strtotime("+$frequency months", strtotime($due)));
         // echo "$next_due";
              $sub_id = $cart['subscription_id'];
             // echo "$sub_id";
             
			 	      $cust_ship_id = $cart['sub_ship_id'];
              $cust_pay_id = $cart['sub_pay_id'];
              $cust_bill_id = $cart['sub_bill_id'];
            $check_sql = "SELECT * FROM subscription_template WHERE sub_id = '$sub_id' ";
            $check_run_query = mysqli_query($con, $check_sql);
            while ($sub_cart = mysqli_fetch_assoc($check_run_query)):
              $product_id = $sub_cart['sub_prdct_id'];
              
              $quantity = $sub_cart['sub_quantity'];
               $product_query = $con->query("SELECT * FROM products WHERE product_id ='$product_id'");
                $product = mysqli_fetch_assoc($product_query);
                $product_name = $product['title'];
                $price = $product['price'];

                $cus_state_query = $con->query("SELECT * FROM customer_details WHERE cus_detail_id = '$cust_ship_id' ");
              $cus_state_fetch = mysqli_fetch_assoc($cus_state_query);
              $cus_state = $cus_state_fetch['cus_state'];

              $tax_query = $con->query("SELECT * FROM tax WHERE state_id = '$cus_state' ");
              $tax_fetch = mysqli_fetch_assoc($tax_query);
              $state_tax = $tax_fetch['state_tax'];
              $extended_tax = number_format(($state_tax * $quantity * $price)/100,2);
             // echo "$extended_tax";
              $products_price = $quantity*$price;
             //echo "$products_price";
              $extended_price = $products_price + $extended_tax;
             // echo "$extended_price";

              $grand_total += $extended_price;

              endwhile;
               $order_status = "pending";
         $con->query("INSERT INTO orders (order_cust_id, total_price, order_date, order_ship_id, order_pay_id, order_bill_id, order_status) VALUES ('$c_id', '$grand_total', '$date_now', '$cust_ship_id', '$cust_pay_id', '$cust_bill_id', '$order_status' )");

              $order_sql = "SELECT * FROM orders WHERE order_cust_id = '$c_id' ORDER BY order_id DESC LIMIT 1 ";
              $order_run_query = mysqli_query($con, $order_sql);
              $order = mysqli_fetch_assoc($order_run_query);

              $order_lineitem_ord_id = $order['order_id'];

              $grand_total = '';
        
            
            $con->query("UPDATE subscription SET sub_next_due = '$next_due' WHERE subscription_id = '$sub_id' ");
              
              $cust_ship_id = $cart['sub_ship_id'];
              $cust_pay_id = $cart['sub_pay_id'];
              $cust_bill_id = $cart['sub_bill_id'];
            $check_sql = "SELECT * FROM subscription_template WHERE sub_id = '$sub_id' ";
            $check_run_query = mysqli_query($con, $check_sql);
            while ($sub_cart = mysqli_fetch_assoc($check_run_query)):
              $product_id = $sub_cart['sub_prdct_id'];
              
              $quantity = $sub_cart['sub_quantity'];
               $product_query = $con->query("SELECT * FROM products WHERE product_id ='$product_id'");
                $product = mysqli_fetch_assoc($product_query);
                $product_name = $product['title'];
                $price = $product['price'];
                  $update_sizes = '';
                $sArray = explode(',', $product['sizes']);
                foreach($sArray as $sizeString){
                  $s = explode(':', $sizeString);
                 
                  $available =$s[1];
                  $size_of = $s[0];
                  $available = $available - $sub_cart['sub_quantity'];
                 
                 $update_sizes = $update_sizes.$size_of.':'.$available;
                 // echo "$update_sizes";
                 
                  //echo "$update_sizes";
              
                $update_sizes = $update_sizes.',';
                
                }

                $new_updated_sizes = rtrim($update_sizes,", ");
               
                //echo "$new_updated_sizes";
               $sql="UPDATE products SET sizes = '$new_updated_sizes' WHERE product_id ='$product_id'";
              $con->query($sql) ;
                $update_sizes = ''; 

                $cus_state_query = $con->query("SELECT * FROM customer_details WHERE cus_detail_id = '$cust_ship_id' ");
              $cus_state_fetch = mysqli_fetch_assoc($cus_state_query);
              $cus_state = $cus_state_fetch['cus_state'];

              $tax_query = $con->query("SELECT * FROM tax WHERE state_id = '$cus_state' ");
              $tax_fetch = mysqli_fetch_assoc($tax_query);
              $state_tax = $tax_fetch['state_tax'];
              $extended_tax = number_format(($state_tax * $quantity * $price)/100,2);
             // echo "$extended_tax";
              $products_price = $quantity*$price;
             //echo "$products_price";
              $extended_price = $products_price + $extended_tax;
             // echo "$extended_price";

              $grand_total += $extended_price;

            $con->query("INSERT INTO orders_line (order_line_name, quantity, price, extended_price, order_lineitem_ord_id, order_lineitem_prdct_id) VALUES ('$product_name', '$quantity', '$price', '$extended_price', '$order_lineitem_ord_id' ,'$product_id')");
              endwhile;

			 }



              endwhile;

?>