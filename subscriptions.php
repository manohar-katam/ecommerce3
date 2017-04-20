<?php 
session_start();
include 'includes/db.php';
if(!isset($_SESSION["c_id"])){
  header("location: index.php");
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
	<link rel="stylesheet" href="css/font-awesome.css">

  <link rel="stylesheet" href="css/styles.css">
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
</style>
	
	<script src="js/jquery2.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/script.js"></script>
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
                
                <li class="upper-links dropdown"><a class="links" href="profile.php"><?php echo "Hi, ".$_SESSION["c_name"]; ?> <span class="caret"></a>
                    <ul class="dropdown-menu">
                        <li class="profile-li"><a class="profile-links" href="account.php"> Your Account</a></li>
                        <li class="profile-li"><a class="profile-links" href="viewOrders.php"> Your Orders</a></li>
                        <li class="profile-li"><a class="profile-links" href="subscriptions.php"> Subscriptions</a></li>
                        <li class="profile-li"><a class="profile-links" href="changepassword.php"> Change Email/Password </a></li>
                      
                        <li class="profile-li"><a class="profile-links" href="logout.php"> Logout</a></li>
                
                    </ul>
                </li>
            </ul>
        </div>
        <div class="row row2">
            <div class="col-sm-2">
            <a href="profile.php" style="text-decoration: none; color: #ffffff ">
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
                <a class="cart-button" href="cart/cart.php">
                <!-- Graphics svg code for cart button http://bootsnipp.com/ -->
                    <svg class="cart-svg " width="16 " height="16 " viewBox="0 0 16 16 ">
                        <path d="M15.32 2.405H4.887C3 2.405 2.46.805 2.46.805L2.257.21C2.208.085 2.083 0 1.946 0H.336C.1 0-.064.24.024.46l.644 1.945L3.11 9.767c.047.137.175.23.32.23h8.418l-.493 1.958H3.768l.002.003c-.017 0-.033-.003-.05-.003-1.06 0-1.92.86-1.92 1.92s.86 1.92 1.92 1.92c.99 0 1.805-.75 1.91-1.712l5.55.076c.12.922.91 1.636 1.867 1.636 1.04 0 1.885-.844 1.885-1.885 0-.866-.584-1.593-1.38-1.814l2.423-8.832c.12-.433-.206-.86-.655-.86 " fill="#fff "></path>
                    </svg> Your Cart
                </a>
            </div>
        </div>
       


</div>
</div>


<!-- Subscriptions starts here -->
<?php
  if(isset($_GET['sub_edit_id']) && !empty($_GET['sub_edit_id'])){
    $subscription_id = $_GET['sub_edit_id'];
    $con->query("DELETE FROM subscription WHERE subscription_id = '$subscription_id' ");
    $con->query("DELETE FROM subscription_template WHERE sub_id = '$subscription_id' ");

    header('location:subscriptions.php');   
  }
?>


<h2 class="text-center" style="margin-top: 110px"> Your Subscriptions</h2>
<p class="text-center"><strong>Add products to subscription which will have same frequency of delivery to one subscription</strong></p>
 <?php $c_id = $_SESSION['c_id'];
   $checksub_sql = "SELECT * FROM subscription WHERE sub_cust_id = '$c_id' ORDER BY subscription_id DESC LIMIT 25 ";
            $checksub_run_query = mysqli_query($con, $checksub_sql);
            while ($sub_cart = mysqli_fetch_assoc($checksub_run_query)): 
              //var_dump($sub_cart); ?>
<div class="container">
  <div class="row">
 

     <table class="table table-bordered table-condensed table-striped">
          <thead><th>Item Name</th><th>Size</th><th>Price</th><th>Quantity</th><th>Sub Total with Tax</th></thead>
          <tbody>
          <?php
          $subscription_id = $sub_cart['subscription_id']; 
          $grand_total = '';
          $check_sql = "SELECT * FROM subscription_template WHERE sub_id = '$subscription_id' ";
            $check_run_query = mysqli_query($con, $check_sql);
            while ($cart = mysqli_fetch_assoc($check_run_query)):
              $sub_template_id = $cart['sub_template_id'];
          $product_id = $cart['sub_prdct_id'];
         
          //echo "$next_due";
          $product_query = $con->query("SELECT * FROM products WHERE product_id ='$product_id'");
                $product = mysqli_fetch_assoc($product_query);
                $product_name = $product['title'];
                $product_price = $product['price'];
               
                 if(isset($_POST['tax_id'])){
              
                    $cust_ship_id = $_POST['tax_id'];
                   $cust_pay_id = $_POST['pay_id'];
                   $cust_bill_id = $_POST['bill_id'];
                   $subscription_add_id = $_GET['subscription_add_id'];
                   

                   $con->query("UPDATE subscription SET sub_ship_id = '$cust_ship_id', sub_pay_id = '$cust_pay_id', sub_bill_id = '$cust_bill_id' WHERE subscription_id = '$subscription_add_id' ");
                 }

                 
                 
                ?>
          <tr>
            <td><?=$product_name?></td>
            <td><?=substr($product['sizes'], 0, strpos($product['sizes'].":",":"))?></td>
            <td><?=$price=$product['price']?></td>
            <td>
            <?php $size = substr($product['sizes'], 0, strpos($product['sizes'].":",":"));
            $available = substr($product['sizes'], strrpos($product['sizes'], ':') + 1); ?>
            <button class="btn btn-xs btn-default" onclick="update_sub('removeone','<?=$product['product_id'];?>','<?=$sub_template_id;?>');">-</button>
              <?=$quantity=$cart['sub_quantity'];?>
              <?php if($cart['sub_quantity'] < $available): ?>
                <button class="btn btn-xs btn-default" onclick="update_sub('addone','<?=$product['product_id'];?>','<?=$sub_template_id;?>');">+</button>
              <?php else: ?>
                <span class="text-danger">Max</span>
              <?php endif; ?>
              </td>

            <td><?php
                   $cust_ship_id = $sub_cart['sub_ship_id'];
                   $cust_pay_id = $sub_cart['sub_pay_id'];
                   $cust_bill_id = $sub_cart['sub_bill_id'];
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
              echo "$extended_price";

              $grand_total += $extended_price;

            //  echo "$grand_total";

                ?></td>
          </tr>
          <?php endwhile; ?>
          </tbody>
          </table>
         <?php if($sub_cart['subscribed'] == 1){ ?>
           <table class="table table-bordered table-condensed table-striped">
          <thead class="text-primary"><strong><th>Subscription ID: <font color="black"><?=$subscription_id?></font></th><th>Your Subscription Next Due Date: <button class="btn btn-xs btn-warning" onclick="update_date('prepone', '<?=$subscription_id;?>');">Prepone</button><font color="black"> <?=$sub_cart['sub_next_due'];?></font> <button class="btn btn-xs btn-warning" onclick="update_date('postpone','<?=$subscription_id;?>');"> Postpone</button> <button class="btn btn-xs btn-danger" onclick="update_skip('<?=$subscription_id;?>');"> Skip Next Due Date</button></th><th>Total Subscription Price with Tax: <font color="black"><?=$grand_total?></font></th></strong></thead></table>

          <?php $ship_sql = $con->query("SELECT * FROM customer_details WHERE cus_detail_id = '$cust_ship_id' ");
          $cusdetails = mysqli_fetch_assoc($ship_sql);
          ?>
           <table class="table table-bordered table-condensed table-striped">
          <thead><strong><th>SHIP TO ADDRESS: <br> <?=$cusdetails['cus_fullname']?><br><?=$cusdetails['cus_address']?><br><?=$cusdetails['cus_city']?>, <?=$cusdetails['cus_state']?> - <?=$cusdetails['cus_zipcode']?><br><?=$cusdetails['cus_mobile']?></th>
          <?php  $pay_sql = $con->query("SELECT * FROM customer_pay WHERE c_pay_id = '$cust_pay_id' ");
          $cusdetails = mysqli_fetch_assoc($pay_sql); ?>

          <th> PAYMENT DETAILS: <br> <?=$cusdetails['c_nameOnCard'];?><br>Card No: <?=substr($cusdetails['c_card'], 0, -12)."-XXXX-XXXX-".substr($cusdetails['c_card'], -4);?><br>Card Expiry: <?=$cusdetails['c_expiryMonth'];?>/<?=$cusdetails['c_expiryYear'];?></th>
          <?php  $pay_sql = $con->query("SELECT * FROM customer_pay WHERE c_pay_id = '$cust_pay_id' ");
          $cusdetails = mysqli_fetch_assoc($pay_sql); ?>
          <?php  $bill_sql = $con->query("SELECT * FROM customer_bill WHERE cust_bill_id = '$cust_bill_id' ");
          $cusdetails = mysqli_fetch_assoc($bill_sql); ?>

          <th>BILL TO ADDRESS: <br> <?=$cusdetails['cust_billname']?><br><?=$cusdetails['cust_billadd']?><br><?=$cusdetails['cust_billcity']?>, <?=$cusdetails['cust_billstate']?> - <?=$cusdetails['cust_billzipcode']?><br><?=$cusdetails['cust_billmobile']?></th></strong></thead></table>
          <?php } ?>

           <?php if($sub_cart['subscribed'] == 0){ ?>
          <h4 class="text-center"> SELECT OR ENTER YOUR SHIP TO ADDRESS, CARD DETAILS, BILL TO ADDRESS </h4>
             <?php include 'subscriptions/parsers/pay_bill_address.php'; ?>
        <button class="btn btn-success btn-lg pull-center" type="submit">UPDATE ADDRESS</button>

            </form>
             <?php } ?>
            <div class="pull-right">
           <!--  <?php //$add_sql_q = $con->query("SELECT * FROM subscription WHERE subscription_id = '$subscription_id' ");;
             //$add_sql_r = mysqli_fetch_assoc($add_sql_q);
             //$sub_ship_id = $add_sql_r['sub_ship_id'];
             //$sub_pay_id = $add_sql_r['sub_pay_id'];
             //$sub_bill_id = $add_sql_r['sub_bill_id']; ?>-->
           <a href="subscriptions.php?update_details"><button class="btn btn-success" type="submit" name="update_details" id="update_details"><span class="glyphicon glyphicon-check"></span> UPDATE DETAILS</button></a> 
            <?php if(isset($_GET['update_details'])){ ?>
               <h4 class="text-center"> SELECT OR ENTER YOUR SHIP TO ADDRESS, CARD DETAILS, BILL TO ADDRESS </h4>
             <?php include 'subscriptions/parsers/pay_bill_address.php'; ?>
        <button class="btn btn-success btn-lg pull-center" type="submit">UPDATE ADDRESS</button>

            </form>
             <?php } ?> 
            <a href="subscriptions.php?sub_edit_id=<?=$subscription_id?>"> <button type="button" class="btn btn-danger" id="cancel_sub" name="cancel_sub" ><span class="glyphicon glyphicon-trash"></span> CANCEL MY SUBSCRIPTION</button></a>
            <?php if($sub_cart['subscribed'] == 0){ ?>
         <a href="profile.php"> <button type="button" class="btn btn-warning"><< ADD MORE PRODUCTS</button></a> 
         <a href="subscriptions/thankyou.php?subs_id=<?=$subscription_id?>"> <button type="button" class="btn btn-primary"><span class="glyphicon glyphicon-shopping-cart"></span> PLACE MY SUBSCRIPTION>></button></a>
         <?php } ?>
         </div>
  </div>
</div>
<hr><hr><br>
 <?php endwhile; ?>

<!-- Details toggle -->




<!-- Footer Goes here -->
<script type="text/javascript">

  function update_sub(mode,edit_id,edit_sub_id){
    var data = {"mode" : mode, "edit_id" : edit_id, "edit_sub_id" : edit_sub_id};
    jQuery.ajax({
      url     : "/ecommerce3/subscriptions/update_sub.php",
      method  : "post",
      data    : data,
      success : function(){
        location.reload();
      },
      error   : function(){
        alert("Something Wrong");
      }
    });
  }

   function update_date(prepost,edit_sub){
    var data = {"prepost" : prepost, "edit_sub" : edit_sub};
    jQuery.ajax({
      url     : "/ecommerce3/subscriptions/update_sub.php",
      method  : "post",
      data    : data,
      success : function(){
        location.reload();
      },
      error   : function(){
        alert("Something Wrong");
      }
    });
  }

  function update_skip(skip_sub){
    var data = {"skip_sub" : skip_sub};
    jQuery.ajax({
      url     : "/ecommerce3/subscriptions/update_sub.php",
      method  : "post",
      data    : data,
      success : function(){
        location.reload();
      },
      error   : function(){
        alert("Something Wrong");
      }
    });
  }


</script>


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