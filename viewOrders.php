<?php
session_start();
include 'includes/db.php';
//include 'includes/UserPane.php';
//$c_id = $_SESSION['c_id'];
$c_id= (isset($_SESSION["edit_id"]) && !empty($_SESSION["edit_id"]))?$_SESSION["edit_id"]:$_SESSION['c_id'];


$query= "select DISTINCT(o.order_id) from orders o join orders_line l on o.order_id= l.order_lineitem_ord_id where o.order_cust_id=".$c_id."  order by o.order_id desc;";
$run_query = mysqli_query($con,$query);

$return_date = date("Y-m-d");
// return orderlines
if(isset($_GET['returnOrderLine']) && !empty($_GET['returnOrderLine']) && isset($_GET['returnOrder']) && !empty($_GET['returnOrder']) && isset($_GET['returnButton']) && !empty($_GET['returnButton']) ){
   $updateQuery= "update orders_line set returned=1 where order_lineitem_id=".$_GET['returnOrderLine'];
   $run_updateQuery = mysqli_query($con,$updateQuery);
   $count = mysqli_num_rows($run_updateQuery);
   
   $insertQuery =
   "insert into tasks_returns(`ret_order_id`,`ret_order_line_id`,`ret_date`) VALUES (".$_GET['returnOrder'].",".$_GET['returnOrderLine'].",'$return_date'); ";
   $run_insertQuery= mysqli_query($con,$insertQuery);
   
   header('location:viewOrders.php');   
}
//cancel Orderline
if(isset($_GET['returnOrderLine']) && !empty($_GET['returnOrderLine']) && isset($_GET['returnOrder']) && !empty($_GET['returnOrder']) && isset($_GET['cancelButton']) && !empty($_GET['cancelButton']) ){
   $updateLineQuery= "update orders_line set canceled=1 where order_lineitem_id=".$_GET['returnOrderLine'];
   $run_updateLineQuery = mysqli_query($con,$updateLineQuery);
   $count = mysqli_num_rows($run_updateLineQuery);
   
   //updating the order price
   $updateOrderQuery= "update orders set total_price=".$_GET['adjustedPrice']." where order_id=".$_GET['returnOrder'];


   $run_updateOrderQuery = mysqli_query($con,$updateOrderQuery);
   $count1 = mysqli_num_rows($run_updateOrderQuery);
   //updating products 
   $update_sizes = '';
    
    $pid= $_GET['productId'];
                $product_query = $con->query("SELECT * FROM products WHERE product_id ='$pid'");

                $product = mysqli_fetch_assoc($product_query);
                $sArray = explode(',', $product['sizes']);
                foreach($sArray as $sizeString){
                  $s = explode(':', $sizeString);
                 
                  $available =$s[1];
                  $size_of = $s[0];
                  $available = $available + $_GET['quantity'];
                 
                 $update_sizes = $update_sizes.$size_of.':'.$available;
                 // echo "$update_sizes";
                 
                  //echo "$update_sizes";
              
                $update_sizes = $update_sizes.',';
                
                }

                $new_updated_sizes = rtrim($update_sizes,", ");
                 
                //echo "$new_updated_sizes";
               $sql="UPDATE products SET sizes = '$new_updated_sizes' WHERE product_id ='$pid'";
              $con->query($sql) ;
            header('location:viewOrders.php');   
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title> E- CART</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE = edge">
    <meta name="viewport" content="width = device-width, initial-scale = 1">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/styles.css">

    <script src="js/jquery2.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/script.js"></script>

    <link href="https://fonts.googleapis.com/css?family=Oxygen" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
</head>
<?php ($_SESSION[ "c_type"]==0)?include 'includes/UserPane.php': include 'includes/AdminPane.php'; ?>


 
<body>
  <div class="container">
  <h2 class="text-center"> Your Orders</h2>
   <div>

      <?php while($ListOrder = mysqli_fetch_array($run_query)): 
      // fetches the orders 
     $query1= "select * from orders o join orders_line l on o.order_id= l.order_lineitem_ord_id 
        left join shipments s on l.order_lineitem_id=s.shipment_lineitem_id  left join tasks_returns tr on tr.ret_order_line_id= l.order_lineitem_id where o.order_id=".$ListOrder['order_id']."  order by o.order_id desc;";
     $run_lineItemsQuery = mysqli_query($con,$query1);
     ?>

     <table class="table table-bordered table-condensed table-striped">
      <thead><th class="text-center">Order Id</th><th class="text-center">Order Description</th><th class="text-center">Quantity</th><th class="text-center">Price</th><th class="text-center">Total Order Price</th><th class="text-center">Status of the Order</th><th class="text-center">Return</th><th class="text-center">Cancel</th></thead>
      <?php while($Orders= mysqli_fetch_array($run_lineItemsQuery)):  
        // fetches the line items of specific order
      ?>
        <tr>

          <td class="text-center"><?=$Orders["order_id"]?></td>
          <td class="text-center"><?=$Orders["order_line_name"]?></td>
          <td class="text-center"><?=$Orders["quantity"]?></td>
          <td class="text-center"><?=$Orders["extended_price"]?></td>
          <td class="text-center"><?=$Orders["total_price"] ?></td>
          <?php if($Orders['canceled']== 1): ?>
          <td class="text-center"><strong>Cancelled</strong></td>
          
          <?php elseif($Orders["shipment_status"] == ''):?>
          <td class="text-center"><strong><?=$Orders["order_status"]?></strong></td>
          
          <?php elseif($Orders["returned"]== 0): ?>
          <td class="text-center"><strong><?=$Orders["shipment_status"]?></strong></td>
          <?php else: ?>
           <?php $o_l_id = $Orders['order_lineitem_id'];
           $ret_status_q = $con->query("SELECT * FROM tasks_returns WHERE ret_order_line_id = '$o_l_id'");
           $ret_status_r = mysqli_fetch_assoc($ret_status_q); ?>
          <td class="text-center"><strong><?=$ret_status_r['return_status'] ?></strong></td> 
          <?php endif; ?>
          <?php if(($Orders["returned"]== 0)&&($Orders["shipment_status"]=='ship')): ?> 
          <td class="text-center"> <a href="viewOrders.php?status=<?=$Orders['order_status']?>&returnOrderLine=<?=$Orders['order_lineitem_id']?>&returnOrder=<?=$Orders['order_id']?>&returnButton=<?=1?>" class="btn btn-default btn-xs"><span class="btn btn-danger btn-xs">Return</span></td>
          <?php else: ?>
          <td class="text-center"><a href="viewOrders.php?status=<?=$Orders['order_status']?>&returnOrderLine=<?=$Orders['order_lineitem_id']?>" class="btn btn-default btn-xs disabled"><span class="btn btn-danger btn-xs ">Return</span></td>
          <?php endif; ?>
            <?php if(($Orders["canceled"]== 0)&&($Orders["order_status"] =='pending') &&($Orders['return_status'] == '')): ?> 
          <td class="text-center"><a href="viewOrders.php?returnOrderLine=<?=$Orders['order_lineitem_id']?>&productId=<?=$Orders['order_lineitem_prdct_id']?>&quantity=<?=$Orders['quantity']?>&returnOrder=<?=$Orders['order_id']?>&size=<?=$Orders['size']?>&cancelButton=<?=1?>&adjustedPrice=<?=(($Orders['total_price'])-($Orders['extended_price']))?>"  class="btn btn-default btn-xs"><span class="btn btn-danger btn-xs">Cancel</span></td>
           <?php else: ?>
          <td class="text-center"><a href="#" class="btn btn-default btn-xs disabled"><span class="btn btn-danger btn-xs">Cancel</span></td>
          <?php endif; ?>
           
        </tr>
      <?php endwhile; ?>
    </table>
    <br>

  <?php  endwhile; ?>
 

  </div>
</div>
</body>