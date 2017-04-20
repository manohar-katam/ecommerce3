<?php 
session_start();

if(!isset($_SESSION["c_id"])){
  header("location: ../index.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title> E- CART</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE = edge">
    <meta name="viewport" content="width = device-width, initial-scale = 1">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/styles.css">

    <script src="../js/jquery2.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/script.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Oxygen" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    

</head>
<body>
<!--Header Navbar goes here -->

<div id="flipkart-navbar">
    <div class="container">
        <div class="row row1">
        <a href="AdminProfile.php" style="text-decoration: none; color: #ffffff ">
                <h3 style="margin:0px; margin-top: 25px;"><span class="largenav">E-CART ADMIN</span></h3></a>
            <ul class="pull-right">
                
                <li class="upper-links"><a class="links" href="orders.php">Orders</a></li>
                <li class="upper-links"><a class="links" href="shipments.php">Shipments</a></li>
                <li class="upper-links"><a class="links" href="returns.php">Returns</a></li>
                <li class="upper-links"><a class="links" href="brands.php">Brands</a></li>
                <li class="upper-links"><a class="links" href="categories.php">Categories</a></li>
                <li class="upper-links"><a class="links" href="products.php">Products</a></li>
                <li class="upper-links"><a class="links" href="UserProfiles.php">Customers</a></li>
                <li class="upper-links"><a class="links" href="AdminRegister.php">Add an Admin</a></li>
                <li class="upper-links dropdown"><a class="links" ><?php echo "Hi, ".$_SESSION["c_name"]." &#8628"; ?></a>
                    <ul class="dropdown-menu">
                     
                        <li class="profile-li"><a class="profile-links" href="../logout.php"> Logout</a></li>
                
                    </ul>
                </li>
                
            </ul>
        </div>
    </div>
</div>
<!-- End of Header Navbar -->




<!-- Footer Goes here -->



</body>
</html>