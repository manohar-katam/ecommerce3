<?php

session_start();
if (isset($_SESSION["c_id"])) {
  header("location: profile.php");
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


</style>

  <script src="js/jquery2.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/script.js"></script>

	<link href="https://fonts.googleapis.com/css?family=Oxygen" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
</head>
<body>
<!--Header Navbar goes here -->

<div id="flipkart-navbar">
    <div class="container">
        <div class="row row1">
            <ul class="largenav pull-right">

                <li class="upper-links"><a class="links" href="">24x7 Customer Care</a></li>
                <li class="upper-links"><a class="links" href="">Delivery Guaranteed</a></li>
                <li class="upper-links"><a class="links" href="">Easy Returns</a></li>
                <li class="upper-links"><a class="links" href="">Our policies</a></li>
                <li class="upper-links"><a class="links" href="">Terms &amp Conditions</a></li>
                <li class="upper-links"><a class="links" href="">Contact Us</a></li>
                <li class="upper-links"><a class="links" href="Admin/AdminLogIn.php">Admin Panel</a></li>
                <li class="upper-links"><a class="links" href="register.php">Register</a></li>
                <li class="upper-links"><a class="links" href="login.php">Log In</a></li>
               
                
             <!--   <li class="upper-links dropdown"><a class="links" href="">My Account</a>
                    <ul class="dropdown-menu">
                        <li class="profile-li"><a class="profile-links" href=""> My Orders</a></li>
                        <li class="profile-li"><a class="profile-links" href=""> Edit My Account</a></li>
                        <li class="profile-li"><a class="profile-links" href=""> Change Password </a></li>
                        <li class="profile-li"><a class="profile-links" href=""> Delete My Account </a></li>
                        <li class="profile-li"><a class="profile-links" href=""> Logout</a></li>
                
                    </ul>
                </li> -->
            </ul>
        </div>
        <div class="row row2">
            <div class="col-sm-2">
            <a href="index.php" style="text-decoration: none; color: #ffffff ">
                <h1 style="margin:0px;"><span class="largenav">E- CART</span></h1></a>
            </div>
            <div class="flipkart-navbar-search smallsearch col-sm-8 col-xs-11">
                <div class="row">
                    <input class="flipkart-navbar-input col-xs-11" type="" placeholder="Enter keywords to searh for an item" name="">
                    <button class="flipkart-navbar-button col-xs-1">
                    <!-- Graphics svg code for search button taken from http://bootsnipp.com/ -->
                        <svg width="15px" height="15px">
                            <path d="M11.618 9.897l4.224 4.212c.092.09.1.23.02.312l-1.464 1.46c-.08.08-.222.072-.314-.02L9.868 11.66M6.486 10.9c-2.42 0-4.38-1.955-4.38-4.367 0-2.413 1.96-4.37 4.38-4.37s4.38 1.957 4.38 4.37c0 2.412-1.96 4.368-4.38 4.368m0-10.834C2.904.066 0 2.96 0 6.533 0 10.105 2.904 13 6.486 13s6.487-2.895 6.487-6.467c0-3.572-2.905-6.467-6.487-6.467 "></path>
                        </svg>
                    </button>
                </div>
            </div>
            <div class="cart largenav col-sm-2">
                <a class="cart-button">
                <!-- Graphics svg code for search button http://bootsnipp.com/ -->
                    <svg class="cart-svg " width="16 " height="16 " viewBox="0 0 16 16 ">
                        <path d="M15.32 2.405H4.887C3 2.405 2.46.805 2.46.805L2.257.21C2.208.085 2.083 0 1.946 0H.336C.1 0-.064.24.024.46l.644 1.945L3.11 9.767c.047.137.175.23.32.23h8.418l-.493 1.958H3.768l.002.003c-.017 0-.033-.003-.05-.003-1.06 0-1.92.86-1.92 1.92s.86 1.92 1.92 1.92c.99 0 1.805-.75 1.91-1.712l5.55.076c.12.922.91 1.636 1.867 1.636 1.04 0 1.885-.844 1.885-1.885 0-.866-.584-1.593-1.38-1.814l2.423-8.832c.12-.433-.206-.86-.655-.86 " fill="#fff "></path>
                    </svg> Cart
                    <span class="item-number ">0</span>
                </a>
            </div>
        </div>
    </div>
</div>
<!-- End of Header Navbar -->

<!-- Here goes the slider images -->
<div class="container">
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


<!-- Products Images slider starts here -->




<!-- Footer Goes here -->



</body>
</html>