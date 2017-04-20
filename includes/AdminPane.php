<div id="flipkart-navbar">
    <div class="container">
        <div class="row row1">
         <a href="index.php" style="text-decoration: none; color: #ffffff ">
                <h3 style="margin:0px; margin-top: 25px;"><span class="largenav">E-CART ADMIN</span></h3></a>
            <ul class="pull-right">
    
                <li class="upper-links"><a class="links" href="brands.php">Brands</a></li>
                <li class="upper-links"><a class="links" href="categories.php">Categories</a></li>
                <li class="upper-links"><a class="links" href="products.php">Products</a></li>
                <li class="upper-links"><a class="links" href="Admin/UserProfiles.php">Customers</a></li>
                 <li class="upper-links"><a class="links" href="Admin/AdminRegister.php">Add an Admin</a></li>
                <li class="upper-links dropdown"><a class="links" ><?php echo "Hi, ".$_SESSION["c_name"]." &#8628"; ?></a>
                    <ul class="dropdown-menu">
                     
                        <li class="profile-li"><a class="profile-links" href="logout.php"> Logout</a></li>
                
                    </ul>
                </li>
                
            </ul>
        </div>
    </div>
</div>

</body>