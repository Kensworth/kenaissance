<?php
	session_start();

	require('modules/connection.php');
	require('modules/errors.php');

	if (mysqli_connect_errno()) {
	    printf("Connect failed: %s\n", mysqli_connect_error());
	    exit();
	}

	if(isset($_GET['e']) && !empty($_GET['e']) AND isset($_GET['h']) && !empty($_GET['h'])){
		$pass = true;

		$email = $_GET['e'];
		$vString = $_GET['h'];

		if(!($query = $connection->prepare("SELECT * FROM users WHERE email = ?"))) {
			$pass = false;
		}
		elseif(!$query->bind_param("s", $email)) {
			$pass = false;
		}
		elseif(!$query->execute()) {
			$pass = false;
		}
		else {
			$res = $query->get_result();
			$row = $res->fetch_assoc();
			if($vString == $row['vhash']) {
				if(!($setActive = $connection->prepare("UPDATE users SET active = 1 WHERE email = ?"))) {
					$pass = false;
				}
				elseif(!$setActive->bind_param("s", $email)) {
					$pass = false;
				}
				elseif(!$setActive->execute()) {
					$pass = false;
				}
			}
			else {
				$pass = false;
			}
		}
	}
	else {
		$pass = false;
	}
	if($pass == false) {
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
		left: 48%;
    	top: 21%;
    	border-radius:5px;
    	background: rgba(0, 0, 0, 0.3);
    	padding: 10px;
	}	
</style>
</head>
<body>
		<div id = "testing">
			Verifed.
			<br/>
		</div>
</body>
</html>