<?php 
session_start();
//$c_id = $_SESSION['c_id'];
include '../includes/db.php';
if(!isset($_SESSION["c_id"])){
  header("location: index.php");
}

$c_id= $_SESSION['c_id'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title> E- CART</title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE = edge">
  <meta name="viewport" content="width = device-width, initial-scale = 1">
  <link rel="stylesheet" href="../css/bootstrap.min.css">
  <link rel="stylesheet" href="../css/font-awesome.css">

  <link rel="stylesheet" href="../css/styles.css">
<style type="text/css">
/* font Awesome http://fontawesome.io*/
@import url(//maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css);
/* Animation.css*/
@import url(https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css);

.col-item {
  border: 1px solid #E1E1E1;
  background: #FFF;
  margin-bottom:12px;
}
.col-item .options {
  position:absolute;
  top:6px;
  right:22px;
}
.col-item .photo {
  overflow: hidden;
}
.col-item .photo .options {
  display:none;
}
.col-item .photo img {
  margin: 0 auto;
  width: 100%;
}

.col-item .options-cart {
  position:absolute;
  left:22px;
  top:6px;
  display:none;
}

.col-item .options-cart-round {
  position:absolute;
  left:42%;
  top:22%;
  display:none;
}
.col-item .options-cart-round button {
  border-radius: 50%;
  padding:14px 16px;
  
}
.col-item .options-cart-round button .fa {
  font-size:22px;
}

.col-item .info {
  padding: 10px;
  margin-top: 1px;
}
.col-item .price-details {
  width: 100%;
  margin-top: 5px;
}
.col-item .price-details h1 {
  font-size: 14px;
  line-height: 20px;
  margin: 0;
  float:left;
}
.col-item .price-details .details {
  margin-bottom: 0px;
  font-size:12px;
}
.col-item .price-details span {
  float:right;
}
.col-item .price-details .price-new {
  font-size:16px;
}
.col-item .price-details .price-old {
  font-size:18px;
  text-decoration:line-through;
}
.col-item .separator {
  border-top: 1px solid #E1E1E1;
}

.col-item .clear-left {
  clear: left;
}
.col-item .separator a {
  text-decoration:none;
}
.col-item .separator p {
  margin-bottom: 0;
  margin-top: 6px;
  text-align: center;
}

.col-item .separator p i {
  margin-right: 5px;
}
.col-item .btn-add {
  width: 60%;
  float: left;
}
.col-item .btn-add a {
  display:inline-block !important;
}
.col-item .btn-add {
  border-right: 1px solid #E1E1E1;
}
.col-item .btn-details {
  width: 40%;
  float: left;
  padding-left: 10px;
}
.col-item .btn-details a {
  display:inline-block !important;
}
.col-item .btn-details a:first-child {
  margin-right:12px;
}


footer {background-color:#0c1a1e; margin-top: 10px; min-height:200px; font-family: 'Open Sans', sans-serif; }
.footerleft { margin-top:20px; padding:0 36px; }
.logofooter { margin-bottom:10px; font-size:25px; color:#fff; font-weight:700;}

.footerleft p { color:#fff; font-size:12px !important; font-family: 'Open Sans', sans-serif; margin-bottom:15px;}
.footerleft p i { width:20px; color:#999;}


.paddingtop-bottom {  margin-top:20px;}
.footer-ul { list-style-type:none;  padding-left:0px; margin-left:2px;}
.footer-ul li { line-height:29px; font-size:12px;}
.footer-ul li a { color:#a0a3a4; transition: color 0.2s linear 0s, background 0.2s linear 0s; }
.footer-ul i { margin-right:10px;}
.footer-ul li a:hover {transition: color 0.2s linear 0s, background 0.2s linear 0s; color:#ff670f; }

.social:hover {
     -webkit-transform: scale(1.1);
     -moz-transform: scale(1.1);
     -o-transform: scale(1.1);
 }
 
 

 
 .icon-ul { list-style-type:none !important; margin:0px; padding:0px;}
 .icon-ul li { line-height:75px; width:100%; float:left;}
 .icon { float:left; margin-right:5px;}
 
 
 .copyright { min-height:40px; background-color:#000000;}
 .copyright p { text-align:left; color:#FFF; padding:10px 0; margin-bottom:0px;}
 .heading7 { font-size:21px; font-weight:700; color:#d9d6d6; margin-bottom:22px;}
 .post p { font-size:12px; color:#FFF; line-height:20px;}
 .post p span { display:block; color:#8f8f8f;}
 .bottom_ul { list-style-type:none; float:right; margin-bottom:0px;}
 .bottom_ul li { float:left; line-height:40px;}
 .bottom_ul li:after { content:"/"; color:#FFF; margin-right:8px; margin-left:8px;}
 .bottom_ul li a { color:#FFF;  font-size:12px;}

/* Check out style */
.stepwizard-step p {
    margin-top: 10px;
}
.stepwizard-row {
    display: table-row;
}
.stepwizard {
    display: table;
    width: 50%;
    position: relative;
}
.stepwizard-step button[disabled] {
    opacity: 1 !important;
    filter: alpha(opacity=100) !important;
}
.stepwizard-row:before {
    top: 14px;
    bottom: 0;
    position: absolute;
    content: " ";
    width: 100%;
    height: 1px;
    background-color: #ccc;
    z-order: 0;
}
.stepwizard-step {
    display: table-cell;
    text-align: center;
    position: relative;
}
.btn-circle {
    width: 30px;
    height: 30px;
    text-align: center;
    padding: 6px 0;
    font-size: 12px;
    line-height: 1.428571429;
    border-radius: 15px;
}

</style>
  
  <script src="../js/jquery2.js"></script>
  <script src="../js/bootstrap.min.js"></script>
  <script src="../js/script.js"></script>
    <script type="text/javascript">
        /*Tooltip*/
    $(function () {
      $('[data-toggle="tooltip"]').tooltip();
    });

    
    </script>

  <link href="https://fonts.googleapis.com/css?family=Oxygen" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
</head>
<body>
<!--Header Navbar goes here -->

<div id="flipkart-navbar" class="navbar-fixed-top">
    <div class="container">
        <div class="row row1">
            <ul class="largenav pull-right">
                <li class="upper-links"><a class="links" href="">24x7 Customer Care</a></li>
                <li class="upper-links"><a class="links" href="">Delivery Guaranteed</a></li>
                <li class="upper-links"><a class="links" href="">Easy Returns</a></li>
                <li class="upper-links"><a class="links" href="">Our policies</a></li>
                <li class="upper-links"><a class="links" href="">Terms &amp Conditions</a></li>
                <li class="upper-links"><a class="links" href="">Contact Us</a></li>
                
                <li class="upper-links dropdown"><a class="links" href="../profile.php"><?php echo "Hi, ".$_SESSION["c_name"]; ?> <span class="caret"></a>
                    <ul class="dropdown-menu">
                        <li class="profile-li"><a class="profile-links" href="../account.php"> Your Account</a></li>
                        <li class="profile-li"><a class="profile-links" href=""> Your Orders</a></li>
                        <li class="profile-li"><a class="profile-links" href=""> Subscriptions</a></li>
                        <li class="profile-li"><a class="profile-links" href="../changepassword.php"> Change Email/Password </a></li>
                     
                        <li class="profile-li"><a class="profile-links" href="../logout.php"> Logout</a></li>
                
                    </ul>
                </li>
            </ul>
        </div>
        <div class="row row2">
            <div class="col-sm-2">
            <a href="../profile.php" style="text-decoration: none; color: #ffffff ">
                <h1 style="margin:0px;"><span class="largenav">E- CART</span></h1></a>
            </div>
           <div class="flipkart-navbar-search smallsearch col-sm-8 col-xs-11">
                <div class="row">
                  <form method="POST" action="search.php" role="form">
                    <input class="flipkart-navbar-input col-xs-11" type="text" placeholder="Enter keywords to searh for an item" name="search" id="search">
                    <button class="flipkart-navbar-button col-xs-1" id="search_btn" >
                    <!-- Graphics svg code for search button taken from http://bootsnipp.com/ -->
                        <svg width="15px" height="15px">
                            <path d="M11.618 9.897l4.224 4.212c.092.09.1.23.02.312l-1.464 1.46c-.08.08-.222.072-.314-.02L9.868 11.66M6.486 10.9c-2.42 0-4.38-1.955-4.38-4.367 0-2.413 1.96-4.37 4.38-4.37s4.38 1.957 4.38 4.37c0 2.412-1.96 4.368-4.38 4.368m0-10.834C2.904.066 0 2.96 0 6.533 0 10.105 2.904 13 6.486 13s6.487-2.895 6.487-6.467c0-3.572-2.905-6.467-6.487-6.467 "></path>
                        </svg>
                    </button>
                    </form>
                </div>
            </div>
             <div class="cart largenav col-sm-2">
                <a class="cart-button" href="cart.php">
                <!-- Graphics svg code for cart button http://bootsnipp.com/ -->
                    <svg class="cart-svg " width="16 " height="16 " viewBox="0 0 16 16 ">
                        <path d="M15.32 2.405H4.887C3 2.405 2.46.805 2.46.805L2.257.21C2.208.085 2.083 0 1.946 0H.336C.1 0-.064.24.024.46l.644 1.945L3.11 9.767c.047.137.175.23.32.23h8.418l-.493 1.958H3.768l.002.003c-.017 0-.033-.003-.05-.003-1.06 0-1.92.86-1.92 1.92s.86 1.92 1.92 1.92c.99 0 1.805-.75 1.91-1.712l5.55.076c.12.922.91 1.636 1.867 1.636 1.04 0 1.885-.844 1.885-1.885 0-.866-.584-1.593-1.38-1.814l2.423-8.832c.12-.433-.206-.86-.655-.86 " fill="#fff "></path>
                    </svg> Your Cart
                </a>
            </div>
        </div>
       </div>
       </div>




<!-- thank you page -->
<div class="container" style="margin-top: 120px;">
<div class="btn-warning">
<h2 class="text-center"> Your order has been placed successfully !!! <br> <br>Thank you for your order <br><br> You can track your order at <strong>Your Orders</strong> Page</h2>
</div>

<?php
  $pay_id = $_POST['pay_id'];
  $bill_id = $_POST['bill_id'];
  
  $check_sql = "SELECT * FROM cart WHERE cus_cart_id = '$c_id' ";
  $check_run_query = mysqli_query($con, $check_sql);
  $cart = mysqli_fetch_assoc($check_run_query);
  if ($cart != '') {
    $con->query("UPDATE cart SET paid = 1, cart_pay_id = '$pay_id', cart_bill_id = '$bill_id' WHERE cus_cart_id = '$c_id' ");
    $items = json_decode($cart['items'],true);
    $i = 1;
    $grand_total = 0;
    $item_count = 0;
    $extended_price = 0;
    $cus_ship_tax = $cart['cart_ship_id'];
  }
  
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

              $order_line_name = $product['title'];
              $quantity = $item['quantity'];
              $size = $item['size'];
              $price = $product['price'];

              $cus_state_query = $con->query("SELECT * FROM customer_details WHERE cus_detail_id = '$cus_ship_tax' ");
              $cus_state_fetch = mysqli_fetch_assoc($cus_state_query);
              $cus_state = $cus_state_fetch['cus_state'];

              $tax_query = $con->query("SELECT * FROM tax WHERE state_id = '$cus_state' ");
              $tax_fetch = mysqli_fetch_assoc($tax_query);
              $state_tax = $tax_fetch['state_tax'];

              $extended_tax = number_format(($state_tax * $quantity * $price)/100,2);
             // echo "$extended_tax";
              $products_price = $quantity*$price;
             // echo "$products_price";
              $extended_price = $products_price + $extended_tax;

              //$grand_total = $extended_price;
              //echo "$grand_total";
             // echo "$extended_price";
            //$con->query("INSERT INTO orders_line (order_line_name, quantity, price, size, extended_price, order_lineitem_prdct_id, order_ship_id, order_pay_id, order_bill_id) VALUES ('$order_line_name', '$quantity', '$price', '$size', '$extended_price', '$product_id', '$cus_ship_tax', '$pay_id', '$bill_id' )");
           
              $i++;
          
              $grand_total += $extended_price;

              //echo "$grand_total";
        }
        
        $order_date = date("Y-m-d");
        $order_status = "pending";
       $con->query("INSERT INTO orders (order_cust_id, total_price, order_date, order_ship_id, order_pay_id, order_bill_id, order_status) VALUES ('$c_id', '$grand_total', '$order_date', '$cus_ship_tax', '$pay_id', '$bill_id', '$order_status' )");

        $order_sql = "SELECT * FROM orders WHERE order_cust_id = '$c_id' ORDER BY order_id DESC LIMIT 1 ";
        $order_run_query = mysqli_query($con, $order_sql);
        $order = mysqli_fetch_assoc($order_run_query);

        $order_lineitem_ord_id = $order['order_id'];
        //echo "$order_lineitem_ord_id";



         $check_sql = "SELECT * FROM cart WHERE cus_cart_id = '$c_id' ";
          $check_run_query = mysqli_query($con, $check_sql);
          $cart = mysqli_fetch_assoc($check_run_query);
          if ($cart != '') {
           // $con->query("UPDATE cart SET paid = 1, cart_pay_id = '$pay_id', cart_bill_id = '$bill_id' WHERE cus_cart_id = '$c_id' ");
            $items = json_decode($cart['items'],true);
            $i = 1;
            $grand_total = 0;
            $item_count = 0;
            $extended_price = 0;
            $cus_ship_tax = $cart['cart_ship_id'];
          }

           $quantity = $item['quantity'];
           $update_sizes = '';
         foreach ($items as $item) {
                $product_id = $item['product_id'];
                $product_query = $con->query("SELECT * FROM products WHERE product_id ='{$product_id}'");
                $product = mysqli_fetch_assoc($product_query);
                $sArray = explode(',', $product['sizes']);
                foreach($sArray as $sizeString){
                  $s = explode(':', $sizeString);
                  if($s[0] == $item['size']){
                  $available = $s[1];
                  $size_of = $s[0];
                  $available = $available - $quantity;
                  //echo "$available";
                 $update_sizes = $update_sizes.$size_of.':'.$available;
                  //echo "$update_sizes";
                }else{
                  $available = $s[1];
                  $size_of = $s[0];
                  //echo "$available";
                  $update_sizes = $update_sizes.$size_of.':'.$available;
                  //echo "$update_sizes";
                }
                $update_sizes = $update_sizes.',';
                
              }

              $new_updated_sizes = rtrim($update_sizes,", ");
               $update_sizes = '';
              //echo "$new_updated_sizes";
              $con->query("UPDATE products SET sizes = '$new_updated_sizes' WHERE product_id ='$product_id' ");

              $order_line_name = $product['title'];
             


              //$con->query("UPDATE products SET ");

              $size = $item['size'];
              $price = $product['price'];

              $cus_state_query = $con->query("SELECT * FROM customer_details WHERE cus_detail_id = '$cus_ship_tax' ");
              $cus_state_fetch = mysqli_fetch_assoc($cus_state_query);
              $cus_state = $cus_state_fetch['cus_state'];

              $tax_query = $con->query("SELECT * FROM tax WHERE state_id = '$cus_state' ");
              $tax_fetch = mysqli_fetch_assoc($tax_query);
              $state_tax = $tax_fetch['state_tax'];

              $extended_tax = number_format(($state_tax * $quantity * $price)/100,2);
             // echo "$extended_tax";
              $products_price = $quantity*$price;
             // echo "$products_price";
              $extended_price = $products_price + $extended_tax;

              //$grand_total = $extended_price;
              //echo "$grand_total";
             // echo "$extended_price";
       $con->query("INSERT INTO orders_line (order_line_name, quantity, price, extended_price, order_lineitem_ord_id, order_lineitem_prdct_id) VALUES ('$order_line_name', '$quantity', '$price', '$extended_price', '$order_lineitem_ord_id' ,'$product_id')");
           
              $i++;
          
              $grand_total += $extended_price;

              //echo "$grand_total";
        }


        // finally delete cart items after order is placed

       $con->query("DELETE FROM cart WHERE cus_cart_id = '$c_id' ");



 ?>

</div>



<!-- End of thank you page -->



<!--footer start from here-->
<footer>
  <div class="container">
    <div class="row">
      <div class="col-md-4 col-sm-6 footerleft ">
        <div class="logofooter"> E-CART</div>
        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. </p>
        <p><i class="fa fa-map-pin"></i> 7575 FRANKFORD ROAD, DALLAS, TX -75252</p>
        <p><i class="fa fa-phone"></i> Phone (USA) : +1 682 256 9202</p>
        <p><i class="fa fa-envelope"></i> E-mail : info@e-cart.com</p>
        
      </div>
      <div class="col-md-2 col-sm-6 paddingtop-bottom">
        <h6 class="heading7">LINKS</h6>
        <ul class="footer-ul">
          <li><a href="#"> Careers</a></li>
          <li><a href="#"> Privacy Policy</a></li>
          <li><a href="#"> Terms & Conditions</a></li>
          <li><a href="#"> Customer Care</a></li>
          <li><a href="#"> Frequently Ask Questions</a></li>
        </ul>
      </div>
      <div class="col-md-3 col-sm-6 paddingtop-bottom">
        <h6 class="heading7">WE ACCEPT</h6>
        <div class="post">
          <p> MASTER CARD</p>
          <p> DISCOVER CARD</p>
          <p> VISA CARD</p>
          <p> AMERICAN EXPRESS CARD</p>
          <p> CAPITAL ONE CARD</p>
        </div>
      </div>
      <div class="col-md-3 col-sm-6 paddingtop-bottom">
      <h6 class="heading7"> Connect Us On</h6>
        <div class="fb-page" data-href="https://www.facebook.com/facebook" data-tabs="timeline" data-height="300" data-small-header="false" style="margin-bottom:15px;" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true">
          <div class="fb-xfbml-parse-ignore">
            <blockquote cite="https://www.facebook.com/facebook"><a href="https://www.facebook.com/facebook">Facebook</a></blockquote>
          </div>
        </div>
         <div class="fb-page" data-href="https://www.facebook.com/facebook" data-tabs="timeline" data-height="300" data-small-header="false" style="margin-bottom:15px;" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true">
          <div class="fb-xfbml-parse-ignore">
            <blockquote cite="https://www.facebook.com/facebook"><a href="https://www.facebook.com/facebook">Twitter</a></blockquote>
          </div>
        </div>
      </div>
    </div>
  </div>
</footer>
<!--footer start from here-->

<div class="copyright">
  <div class="container">
    <div class="col-md-6">
      <p>© 2017 - All Copy Rights Reserved | E-CART</p>
    </div>
    <div class="col-md-6">
      <ul class="bottom_ul">
        <li><a href="#">e-cart.com</a></li>
        <li><a href="#">About us</a></li>
        <li><a href="#">Blog</a></li>
        <li><a href="#">Faq's</a></li>
        <li><a href="#">Contact us</a></li>
        <li><a href="#">Site Map</a></li>
      </ul>
    </div>
  </div>
</div>

</body>
</html>