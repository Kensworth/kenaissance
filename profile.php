<?php
	session_start();
	require('modules/connection.php');
	require('modules/errors.php');
?>

<!DOCTYPE html
PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!-- 2015 kenneth zhang -->
<html>
<head>
<title>Profile</title>
<link href='https://fonts.googleapis.com/css?family=Arvo' rel='stylesheet' type='text/css'>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js" type="text/javascript"></script>
<style>
	* {
		font-family: 'Arvo', sans-serif;
		margin: 0;
		text-decoration: none;
	}
	#profile {
		position: absolute;
		text-align: center;
		z-index: 100;
		color: white;
		font-size: 15px;
		left: 50%;
    	top: 20%;
    	border-radius:5px;
    	background: rgba(0, 0, 0, 0.3);
    	padding: 10px;
	}	
</style>
</head>
<body>
		<div id = "profile">
			Test
		</div>
</body>
</html>