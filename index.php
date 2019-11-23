<?php
  session_start();
  if(isset($_SESSION['username'])){
    header('location:dashboard/index.php');
  }
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="author" content="Alok Mishra">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>RPI</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

	<link rel="stylesheet" href="css/style.css" />
 
  </head>
  <body class="bg-dark">
  	<div class="container mt-4">
  		<div class="row">
  			<div class="col-lg-4 offset-lg-4" id="alert">
  				<div class="alert alert-success">
  					<strong id="result"></strong>
  			   </div>
  			</div>
      </div>

      <!-- preloader -->
      <div class="text-center">
        <img src="images/preloader.gif" width="40px" height="40px" class="m-2" id="loader">
      </div>

  		<!--Login Form-->
  		<div class="row">
  			<div class="col-lg-4 offset-lg-4 bg-light rounded" id="login-box">
  				<h2 class="text-center mt-2">login</h2>
  				<form action="" method="post" role="form" class="p-2" id="login-form">
  					<!--username-->
  					<div class="form-group">
  						<input type="text" name="username" class="form-control" placeholder="username" required minlength="4" value="<?php if(isset($_COOKIE['username'])) { echo $_COOKIE['username'];}?>">
  					</div>

					<!--password-->
  					<div class="form-group">
  						<input type="password" name="password" class="form-control" placeholder="password" required minlength="6" value="<?php if(isset($_COOKIE['password'])) { echo $_COOKIE['password'];}?>">
  					</div>

  					<!--check box-->
  					<div class="custom-control custom-checkbox">
  						<input type="checkbox" name="rem" class="custom-control-input" id="customCheck" <?php if(isset($_COOKIE['username'])) {?> checked <?php } ?>>
  						<label for="customCheck" class="custom-control-label">remember me</label>
  						<a href="#" id="forgot-btn" class="float-right">forgot Password?</a>
  					</div>

  					<!--submit button-->
  					<div>
						<div class="form-group">
							<input type="submit" name="login" id="login" value="login" class="btn btn-primary btn-block">
						</div>
  					</div>

  					<!--create new user-->
  					<div>
						<div class="form-group">
							<p class="text-center">new user? <a href="#" id="register-btn">create new account</a></p>
						</div>
  					</div>

  				</form>
  			</div>
  		</div>

  		<!--Registration Form-->
  		<div class="row">
  			<!--<div class="col-lg-4 offset-lg-4 bg-light rounded" id="register-box">-->
  			<div class="col-lg-4 offset-lg-4 bg-light rounded" id="register-box">
  				<h2 class="text-center mt-2">register</h2>
  				<form action="" method="post" role="form" class="p-2" id="register-form">

  					<!--full name-->
  					<div class="form-group">
  						<input type="text" name="name" class="form-control" placeholder="full name" required minlength="4">
  					</div>

  					<!--user name-->
  					<div class="form-group">
  						<input type="text" name="uname" class="form-control" placeholder="username" required minlength="4">
  					</div>

  					<!--e-mail-->
  					<div class="form-group">
  						<input type="email" name="email" class="form-control" placeholder="e-mail" required>
  					</div>

					<!--password-->
  					<div class="form-group">
  						<input type="password" name="pswd" id="pswd" class="form-control" placeholder="password" required minlength="6">
  					</div>

 					<!--confirm password-->
  					<div class="form-group">
  						<input type="password" name="cpswd" id="cpswd" class="form-control" placeholder="confirm password" required>
  					</div>

  					<!--check box-->
  					<div class="custom-control custom-checkbox">
  						<input type="checkbox" name="rem" class="custom-control-input" id="customCheck2">
  						<label for="customCheck2" class="custom-control-label">I agree to the <a href="#">terms & conditions.</a></label>
  					</div>
  					
  					<div>
						<div class="form-group">
							<input type="submit" name="register" id="register" value="register" class="btn btn-primary btn-block">
						</div>
  					</div>

  					<div>
						<div class="form-group">
							<p class="text-center">already have an account? <a href="#" id="login-btn">login here</a></p>
						</div>
  					</div>

  				</form>
  			</div>
  		</div>

  		 <!--Forget Form-->
  		<div class="row">
  			<div class="col-lg-4 offset-lg-4 bg-light rounded" id="forgot-box">
  				<h2 class="text-center mt-2">reset password</h2>
  				<form action="" method="post" role="form" class="p-2" id="forgot-form">
  					<div class="form-group">
  						<small class="text-muted">
  							To reset your password, enter the email address and we will send reset password instructions on your email.
  						</small>
  					</div>

  					<div class="form-group">
  						<input type="email" name="femail" class="form-control" placeholder="e-mail" required>
  					</div>

  					<div>
						<div class="form-group">
							<input type="submit" name="login" id="forgot" value="reset" class="btn btn-primary btn-block">
						</div>
  					</div>

  					<div>
						<div class="form-group text-center">
							<a href="#" id="back-btn">back</a></p>
						</div>
  					</div>
  				</form>
  			</div>
  		</div>

  	</div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>

	<script src="js/index.js"></script>

  </body>
</html>