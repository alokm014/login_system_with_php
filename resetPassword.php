<?php
	require 'config.php';
	$msg="";
	if(isset($_GET['email']) && isset($_GET['token'])){
		$email=$_GET["email"];
		$token=$_GET['token'];

		$stmt=$conn->prepare("SELECT id FROM users WHERE email=? AND token=? AND token<>'' AND tokenExpire>NOW()");
		$stmt->bind_param('ss',$email,$token);
		$stmt->execute();
		$result=$stmt->get_result();

		if($result->num_rows>0){
			if(isset($_POST['submit'])){
				$newpass=sha1($_POST['newpass']);
				$cnewpass=sha1($_POST['cnewpass']);

				if($newpass==$cnewpass){
					$stmt_u=$conn->prepare("UPDATE users SET token='', pswd=? WHERE email=?");
					$stmt_u->bind_param('ss',$newpass,$email);
					$stmt_u->execute();

					$msg="Password changed successfully!<br><a href='index.php'>Login Here</a>";

				}
				else{
					$msg="Password did not match!";
				}
			}
		}
		else{
			header('location:index.php');
			exit();
		}

	}
	else{
	header('location:index.php');
	exit();
}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
	    <meta charset="utf-8">
	    <meta name="author" content="Alok Mishra">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <meta name="viewport" content="width=device-width, initial-scale=1">

	    <title>Reset Password</title>

        <!-- Bootstrap -->
	    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

		<link rel="stylesheet" href="css/style.css" />
	</head>
	<body>
		<div class="container">
			<div class="row justify-content-center">
				<div class='col-lg-5 mt-5'>
					<h3 class="text-center bd-dark text-center p-2 rounded">Reset your password here!</h3>
					<h4 class="text-success text-center"><?= $msg; ?></h4>
					<form action="" method="post">
						<div class="form-group">
							<label for="password">Enter New Password</label>
							<input type="password" name="newpass" class="form-control" placeholder="New password" required>
						</div>
						<div class="form-group">
							<label for="password">Confirm New Password</label>
							<input type="password" name="cnewpass" class="form-control" placeholder="Confirm password" required>
						</div>
						<div class="form-group">
							<input type="submit" name="submit" class="btn btn-success btn-block" value="Reset Pass">
						</div>
				</div>
			</div>
		</div>
	</body>