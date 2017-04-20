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
	<style type="text/css">
	body{margin-top: 10px}
     form { margin: 10px 10px; }

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
 <h2 style="margin:0px; text-align: center;"><span class="largenav">E- CART Admin Registration Form</span></h2><br>
    <div class="container">
    	<div class="row" id="AdminsignupMsg">
    	   <!-- Alert from signup form -->
    	</div>
		<div class="row">
			<div class="panel panel-primary">
				<div class="panel-body">

				<!-- form begin -->
					<form method="POST" action="#" role="form">
						<div class="form-group">
							<h2>Create account</h2>
						</div>
						<div class="form-group">
							<label class="control-label" for="AdminsignupName">Admin Name</label>
							<input id="AdminsignupName" name="AdminsignupName" type="text" maxlength="50" class="form-control" >
						</div>
						<div class="form-group">
							<label class="control-label" for="AdminsignupEmail">Email</label>
							<input id="AdminsignupEmail" name="AdminsignupEmail" type="email" maxlength="50" class="form-control" >
						</div>
						<div class="form-group">
							<label class="control-label" for="AdminsecurityPassword">Security/Company Password</label>
							<input id="AdminsecurityPassword" name="AdminsecurityPassword" type="password" maxlength="25" class="form-control" length="40" >
						</div>
						<div class="form-group">
							<label class="control-label" for="AdminsignupPassword">Password</label>
							<input id="AdminsignupPassword" name="AdminsignupPassword" type="password" maxlength="25" class="form-control" placeholder="at least 6 characters" length="40" >
						</div>
						
						<div class="form-group">
							<label class="control-label" for="AdminsignupPasswordagain">Password again</label>
							<input id="AdminsignupPasswordagain" name="AdminsignupPasswordagain" type="password" maxlength="25" class="form-control" >
						</div>
						<div class="form-group">
							<button id="AdminsignupSubmit" name="AdminsignupSubmit" type="submit" class="btn btn-info btn-block">Create your account</button>
						</div>
						<p class="form-group">By creating an admin account, you agree to our <a href="#">Terms of Use</a> and our <a href="#">Privacy Policy</a>.</p>
					</form>
				</div>
			</div>
		</div>
	</div>

</body>
</html>
