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
	else {
		// successful mysql connection
	}

	if(isset($_POST['email']) && isset($_POST['username']) && isset($_POST['password'])) {
		//set
		require('password.php');
		$options = [
		    'cost' => 15,
		    'salt' => mcrypt_create_iv(22, MCRYPT_DEV_URANDOM),
		];
		
		$email = $_POST['email'];
		$username = $_POST['username'];
		$password = password_hash(($_POST['password']), PASSWORD_BCRYPT, $options);
		$salt = $options['salt'];

		if(strlen($_POST['password']) < 8 || strlen($_POST['password'] > 120)) {
			echo "<script>location.href='fail.php';</script>";
		}

		if(strlen($_POST['username']) < 3 || strlen($_POST['username']) > 60) {
			echo "<script>location.href='fail.php';</script>";
		}

		if(!eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $email)){
			echo "<script>location.href='fail.php';</script>";
		}

		if(!($query = $connection->prepare("INSERT INTO users (email, username, password, salt) VALUES (?,?,?,?)"))) {
		     echo "<script>location.href='fail.php';</script>";
		}
	
		if(!$query->bind_param("ssss", $email, $username, $password, $salt)) {
		    echo "<script>location.href='fail.php';</script>";
		}
		
		if(!$query->execute()) {
			echo "<script>location.href='fail.php';</script>";
		}

		$email_to = $email;
		$email_subject = "Confirmation Email";
		$email_message="Hello, " . $username . ". Thanks for signing up. Click the following link to continue. \r\n http://www.kennethzhang.net";
		$headers = "From: kennethzhang.net\r\n".
		"Reply-To: kennethzhang@yahoo.com\r\n'" .
		"X-Mailer: PHP/" . phpversion();
		mail($email_to, $email_subject, $email_message, $headers); 


		// mysql field called "active" or "verified" etc
		// to verify, randomize a string and put it into the DB, send it through the get parameter in email. if matched, set to "active" to 1
		// create session based on the login credentials!!!

		$query->close();
		$connection->close();
	}
	else {
		//unset
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