<?php
	session_start();

	$hostname = "localhost";
	$dbusername = "ken";
	$dbpassword = "Correcthorse1!";
	$dbname = "kennethzhangnet";
	
	$connection = new mysqli($hostname, $dbusername, $dbpassword, $dbname);
	if($connection->connect_errno) {
		die("Database connection failed: " . 
	 		mysqli_connect_error() . " (" . mysqli_connect_errno() . ")"
	 	);
	}

	if(isset($_GET['e']) && !empty($_GET['e']) AND isset($_GET['h']) && !empty($_GET['h'])){
		require('password.php');
		$options = [
		    'cost' => 15,
		    'salt' => mcrypt_create_iv(22, MCRYPT_DEV_URANDOM),
		];
		$email = $_GET['e'];
		$password = password_hash(($_GET['h']), PASSWORD_BCRYPT, $options);

		if(!($query = $connection->prepare("SELECT * FROM users WHERE email = ?"))) {
		     echo "<script>location.href='fail.php';</script>";
		}
		elseif(!$query->bind_param("ss", $email, $password)) {
		    echo "<script>location.href='fail.php';</script>";
		}
		elseif(!$query->execute()) {
			echo "<script>location.href='fail.php';</script>";
		}
		// compare get values with DB values, redirect to fail if wrong, direct to main page if correct, create session cookie, etc.
	}
	else {
		echo "<script>location.href='fail.php';</script>";
	}
	
?>

<!DOCTYPE html
PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!-- 2015 kenneth zhang -->
<html>
<head>
<title>Confirm</title>
<link href='https://fonts.googleapis.com/css?family=Arvo' rel='stylesheet' type='text/css'>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js" type="text/javascript"></script>
<style>
	#redSunrise {
		position: absolute;
		z-index: 0;
		min-height: 100%;
		min-width: 1024px;
			
		/* set up proportionate scaling */
		width: 100%;
		height: auto;
			
		/* set up positioning */
		position: fixed;
		top: 0;
		left: 0;
	}
	* {
		font-family: 'Arvo', sans-serif;
		margin: 0;
		text-decoration: none;
	}
	#testing {
		position: absolute;
		text-align: center;
		z-index: 100;
		color: white;
		font-size: 15px;
		left: 35%;
    	top: 21%;
    	border-radius:5px;
    	background: rgba(0, 0, 0, 0.3);
    	padding: 10px;
	}	
</style>
</head>
<body>
		<div id = "testing">
			Please click the confirmation we sent to your email. <br/> It may take several minutes to arrive.
			<br/>
		</div>
</body>
</html>