<!DOCTYPE html>

<?php
include("includes/db.php");
?>

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
 <h2 style="margin:0px; text-align: center;"><span class="largenav">E- CART Registration Form</span></h2><br>
    <div class="container">
    	<div class="row" id="signupMsg">
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
							<label class="control-label" for="signupName">Your name</label>
							<input id="signupName" name="signupName" type="text" maxlength="50" class="form-control" >
						</div>
						<div class="form-group">
							<label class="control-label" for="signupEmail">Email</label>
							<input id="signupEmail" name="signupEmail" type="email" maxlength="50" class="form-control" >
						</div>
						<div class="form-group">
							<label class="control-label" for="signupPassword">Password</label>
							<input id="signupPassword" name="signupPassword" type="password" maxlength="25" class="form-control" placeholder="at least 6 characters" length="40" >
						</div>
						<div class="form-group">
							<label class="control-label" for="signupPasswordagain">Password again</label>
							<input id="signupPasswordagain" name="signupPasswordagain" type="password" maxlength="25" class="form-control" >
						</div>
						<div class="form-group">
							<button id="signupSubmit" name="signupSubmit" type="submit" class="btn btn-info btn-block">Create your account</button>
						</div>
						<p class="form-group">By creating an account, you agree to our <a href="#">Terms of Use</a> and our <a href="#">Privacy Policy</a>.</p>
						<hr>
						<p></p>Already have an account? <a href="login.php">Sign in</a></p>
					</form>
				</div>
			</div>
		</div>
	</div>

</body>
</html>
