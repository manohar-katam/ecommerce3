<!DOCTYPE html>

<?php
session_start();
include("../includes/db.php");
$_SESSION["c_type"]=1;
?>

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
	<style type="text/css">
		body{margin-top: 50px}
		form { margin: 0px 10px; }

		h2 {
		  margin-top: 2px;
		  margin-bottom: 2px;
		}

		.container { max-width: 360px; }

		.divider {
		  text-align: center;
		  margin-top: 20px;
		  margin-bottom: 5px;
		}

		.divider hr {
		  margin: 7px 0px;
		  width: 35%;
		}

		.left { float: left; }

		.right { float: right; }

	</style>

</head>
<body>
 <h2 style="margin:0px; text-align: center;"><span class="largenav">Log In into your E-CART Admin Account</span></h2><br><br>
     <div class="container">
     <div class="row" id="AdminsigninMsg">
    	   <!-- Alert from signin form --> 
    	</div>
		<div class="row">
			<div class="panel panel-primary">
				<div class="panel-body">

				<!-- login form starts here -->
					<form method="POST" action="#" role="form">
						<div class="form-group">
							<h2>Log in</h2>
						</div>
						<div class="form-group">
							<strong>Email </strong>
							<input id="adminsigninEmail" name="adminsigninEmail" type="email" maxlength="50" class="form-control">
						</div>
						<div class="form-group">
							<strong>Password</strong>
							<input id="adminsigninPassword" name="adminsigninPassword" type="password" maxlength="25" class="form-control">
							<span class="right"><a href="#">Forgot your password?</a></span>
						</div>
						<div class="form-group" style="padding-top: 12px;">
							<button id="AdminsigninSubmit" name="AdminsigninSubmit" type="submit" class="btn btn-success btn-block">Sign in</button>
						</div>
						<p class="form-group">By signing in you are agreeing to our <a href="#">Terms of Use</a> and our <a href="#">Privacy Policy</a>.</p>
					</form>
				</div>
			</div>
		</div>
	</div>

</body>
</html>