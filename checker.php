<?php
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
		//successful mysql connection
	}

	if(isset($_POST['action']) && $_POST['action'] == 'username_availability'){ // Check for the username posted
		$username = htmlentities($_POST['username']); // Get the username values
		$check_query = mysqli_query($connection, 'SELECT username FROM users WHERE username = "'.$username.'" '); // Check the database
		echo mysqli_num_rows($check_query); // echo the num or rows 0 or greater than 0
	}
?>