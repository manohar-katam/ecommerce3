<?php 
session_start();

if(!isset($_SESSION["c_id"])){
  header("location: index.php");
}elseif (isset($_SESSION['c_type']) && $_SESSION['c_type']==1 ) {
  # code...
  header('location:Admin/AdminProfile.php');
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
       

   <!--    <div class="row row3" id="loadCategories" style="text-align: left">
           <li class="upper-links dropdown"><a class="links" href="">MEN<span class="caret"></a>
                    <ul class="dropdown-menu">
                        <li class="profile-li"><a class="profile-links" href=""> Shirts</a></li>
                        <li class="profile-li"><a class="profile-links" href=""> Trousers</a></li>
                        <li class="profile-li"><a class="profile-links" href=""> Shoes</a></li>
                        <li class="profile-li"><a class="profile-links" href=""> Acessories </a></li>
                
                    </ul>
                </li>
          </div>  -->

          <?php
          include("products/load_categories.php"); 
          ?>

    </div>
</div>
<!-- End of Header Navbar -->

<!-- Here goes the slider images -->
<div class="container" style="margin-top: 125px;">
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
    
      <!-- Wrapper for slides -->
      <div class="carousel-inner">
      
        <div class="item active">
          <img src="./images/banner2.JPG">
           <div class="carousel-caption">
            <h3></h3>
            <p><a href="#" target="_blank" class="label label-danger">Our New Collection</a></p>
          </div>
        </div><!-- End Item -->
 
         <div class="item">
          <img src="./images/banner5.JPG">
           <div class="carousel-caption">
            <h3></h3>
            <p> <a href="#" target="_blank" class="label label-danger">Collection</a></p>
          </div>
        </div><!-- End Item -->
        
        <div class="item">
           <img src="./images/banner6.JPG">
           <div class="carousel-caption">
            <h3></h3>
            <p> <a href="#" target="_blank" class="label label-danger">Collection</a></p>
          </div>
        </div><!-- End Item -->
        
        <div class="item">
          <img src="./images/banner4.JPG">
           <div class="carousel-caption">
            <h3></h3>
            <p> <a href="#" target="_blank" class="label label-danger">Collection</a></p>
          </div>
        </div><!-- End Item -->
                
      </div><!-- End Carousel Inner -->

    	<ul class="nav nav-pills nav-justified">
          <li data-target="#myCarousel" data-slide-to="0" class="active"><a href="#">Offers on Laptops<small>Lorem ipsum dolor sit</small></a></li>
          <li data-target="#myCarousel" data-slide-to="1"><a href="#">Amazing Deals<small>Lorem ipsum dolor sit</small></a></li>
          <li data-target="#myCarousel" data-slide-to="2"><a href="#">Apple Products<small>Lorem ipsum dolor sit</small></a></li>
          <li data-target="#myCarousel" data-slide-to="3"><a href="#">Clothing<small>Lorem ipsum dolor sit</small></a></li>
        </ul>


    </div><!-- End Carousel -->
</div>
<!-- slider images end here -->


<!-- Products starts here -->

<div class="container" id="LoadProducts" style="margin-top: 10px">
 
     <?php
         include("products/load_products.php"); 
     ?>
 
</div>


<!-- Details toggle -->




<!-- Footer Goes here -->

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