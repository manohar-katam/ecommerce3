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

<?php ($_SESSION["c_type"]==0)?include 'includes/UserPane.php': include 'includes/AdminPane.php'; ?>

<!-- End of Header Navbar -->

<!-- delete account script -->
<div class="container" style="text-align: right;">
<div class="row" id="deletemsg">
         <!-- Successfully updated your profile alert -->
      </div>
  <h1 class="page-header" style="text-align: center;"> Please confirm customer's <strong>DELETION</strong> of account one more time! </h1>
  <div class="row"> <br><br>
    <!-- left column -->
    <div class="col-md-8 col-sm-6 col-xs-12 personal-info">
      <form class="form-horizontal" role="form" method="POST">
        <div class="form-group">
          <label class="col-md-3 control-label"></label>
          <div class="col-md-8">
            <input class="btn btn-danger" value="Yes, Delete My Account" id="delete" name="delete" type="submit">
            <span></span>
            <input class="btn btn-primary" value="No, Keep My Account" id="cancelBtn" name="cancelBtn" type="submit">
          </div>
        </div>
      </form>
    </div>
  </div>
</div>



<!-- Footer Goes here -->



</body>
</html>