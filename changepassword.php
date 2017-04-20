 <?php 
session_start();

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
  <link rel="stylesheet" href="css/styles.css">
  
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
                
                <li class="upper-links dropdown"><a class="links" href="profile.php"><?php echo "Hi, ".$_SESSION["c_name"]." &#8628"; ?></a>
                    <ul class="dropdown-menu">
                        <li class="profile-li"><a class="profile-links" href="account.php"> Your Account</a></li>
                        <li class="profile-li"><a class="profile-links" href=""> Your Orders</a></li>
                        <li class="profile-li"><a class="profile-links" href=""> Subscriptions</a></li>
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

<!-- account details go here -->
<div class="container">
<div class="row" id="changeEmailMsg">
         <!-- Successfully updated your profile alert -->
      </div>
  <h1 class="page-header">Change Email / Password</h1>
  <div class="row">

    <div class="col-md-8 col-sm-6 col-xs-12 personal-info">
      <h3>Change my Email</h3>
      <form class="form-horizontal" role="form" method="POST">
        <div class="form-group">
          <label class="col-lg-3 control-label">Current Email:</label>
          <div class="col-lg-8">
            <input class="form-control" type="Email" id="oldemail" name="oldemail">
          </div>
        </div>
        <div class="form-group">
          <label class="col-lg-3 control-label"> New Email:</label>
          <div class="col-lg-8">
            <input class="form-control" type="Email" id="newemail" name="newemail">
          </div>
        </div>
        <div class="col-md-8" style="margin-left: 350px">
            <input class="btn btn-primary" value="Update My Email" id="updateEmail" name="updateEmail" type="submit">
        </div>
        </form>
    </div>
  </div>
</div> 
        <hr>
<div class="container">
<div class="row" id="changePasswordMsg">
         <!-- Successfully updated your profile alert -->
</div>
  <div class="row">

    <div class="col-md-8 col-sm-6 col-xs-12 personal-info">
        <h3>Change my Password</h3>
      <form class="form-horizontal" role="form" method="POST">
        <div class="form-group">
          <label class="col-lg-3 control-label"> Current Password:</label>
          <div class="col-lg-8">
            <input class="form-control" type="Password" id="oldpassword" name="oldpassword">
          </div>
        </div>
        <div class="form-group">
          <label class="col-lg-3 control-label"> New Password:</label>
          <div class="col-lg-8">
            <input class="form-control" type="Password" id="newpassword" name="newpassword">
          </div>
        </div>  
        <div class="form-group">
          <label class="col-lg-3 control-label">Re-enter New Password:</label>
          <div class="col-lg-8">
            <input class="form-control" type="Password" id="newpasswordagain" name="newpasswordagain">
          </div>
        </div>
        <div class="col-md-8" style="margin-left: 350px">
            <input class="btn btn-primary" value="Update My Password" id="updatePassword" name="updatePassword" type="submit">
        </div>    
      </form>
    </div>
  </div>
</div>
  


<!-- Footer Goes here -->



</body>
</html>