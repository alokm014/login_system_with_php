<?php
	require 'config.php';
	if(isset($_POST['action']) && $_POST['action'] == 'register'){
		$name=check_input($_POST['name']);
		$uname=check_input($_POST['uname']);
		$email=check_input($_POST['email']);
		$pswd=check_input($_POST['pswd']);
		$cpswd=check_input($_POST['cpswd']);
		$pswd=sha1($pswd);
		$cpswd=sha1($cpswd);
		$created=date("y-m-d");

		if($pswd!=$cpswd){
			echo "password did not matched";
			exit();
		}

		else{

			$sql=$conn->prepare("SELECT username, email FROM users WHERE username=? OR email=?");
			$sql->bind_param("ss",$uname,$email);
			$sql->execute();
			$result=$sql->get_result();
			$row=$result->fetch_array(MYSQLI_ASSOC);

			/*if any username and email is already preset*/
			if($row['username']==$uname){
				echo "username not available try different!";
			}
			elseif($row['email']==$email){
				echo "E-mail is already registered!";
			}
			/*else save data into database*/
			else{

				$stmt = $conn -> prepare("INSERT INTO users (name,username,email,pswd,created) VALUES (?,?,?,?,?)");
				$stmt -> bind_param('sssss',$name,$uname,$email,$pswd,$created);

				if($stmt -> execute()){
					echo "Registered Sucessfully. Login Now!";

				}

				else{
					echo "Something went wrong. Please try again!";
				}
			}
		}

	}
	/*Remember Password*/
	if(isset($_POST['action']) && $_POST['action'] == 'login'){
		session_start();

		$username=$_POST['username'];
		$password=sha1($_POST['password']);
		
		/* user can login from both by using email or username*/
		$stmt_l=$conn->prepare("SELECT * FROM users WHERE (username=? OR email=?) AND pswd=?");
		$stmt_l->bind_param('sss',$username,$username,$password);
		$stmt_l->execute();
		$user=$stmt_l->fetch();

		if($user!=null){
			$_SESSION['username']=$username;
			echo 'ok';

			if(!empty($_POST['rem'])){
				setcookie('username',$_POST['username'],time()+(10*365*24*68*60));
				setcookie('password',$_POST['password'],time()+(10*365*24*68*60));
			}
			else{

				if(isset($_COOKIE['username'])){
					setcookie('username','');
				}
				if(isset($_COOKIE['password'])){
					setcookie('password','');
				}
			}
		}
		else{
			echo "Login Failed! Check your username and password";
		}
	}

	/*Forgot password send email*/
	if(isset($_POST['action']) && $_POST['action'] == 'forgot'){
		$femail=$_POST['femail'];
		$stmt_p=$conn->prepare('SELECT id FROM users WHERE email=?');
		$stmt_p->bind_param('s',$femail);
		$stmt_p->execute();
		$res=$stmt_p->get_result();

		if($res->num_rows>0){
			$token="afujhwdvwqyuvlkjgbpopnhjmnnkjzqwiunmbczxzxpioqwe12332435689";
			$token=str_shuffle($token);
			$token=substr($token,0,10);

			$stmt_i=$conn->prepare("UPDATE users SET token=?, tokenExpire=DATE_ADD(NOW(), INTERVAL 5 MINUTE) WHERE email=?");
			$stmt_i->bind_param("ss",$token,$femail);
			$stmt_i->execute();

			require "PHPMailer/PHPMailerAutoload.php";
			$mail= new PHPMailer;

			$mail->Host = "smtp.gmail.com"; // Enter your host here

			$mail->Port = 587;
			$mail->isSMTP();
			$mail->SMTPAuth = true; // authentication enabled
			$mail->SMTPSecure = 'tls'; // secure transfer enabled REQUIRED for Gmail

			$mail->Username = ""; // Enter your email here
			$mail->Password = ""; //Enter your passwrod here
			$mail->addAddress($femail);		
			
			$mail->setFrom('',"");
			$mail->Subject = "Reset Password";
			$mail->isHTML(true);
			$mail->Body = "<h3>click below to reset password.</h3><br><a href='http://localhost/RPI/resetPassword.php?email=$femail&token=$token'>http://localhost/RPI/resetPassword.php?email=$femail&token=$token</a><br><h3>Regards<br>alok</h3>";
			
			if($mail->send()){
				echo "We have send you the reset link in your email ID, please check your E-mail.";
			}
			else{
				echo "Something went wrong please try again later";
			}

		}
		else{
			echo "Something went wrong please try again later";
		}

	}
	function check_input($data){
		$data=trim($data);
		$data=stripslashes($data);
		$data=htmlspecialchars($data);
		return $data;
 	}
?>