<?php
	require('modules/connection.php');

	if(isset($_POST['action']) && $_POST['action'] == 'username_availability'){ // Check for the username posted
		$username = htmlentities($_POST['username']); // Get the username values
		$check_query = mysqli_query($connection, 'SELECT username FROM users WHERE username = "'.$username.'" '); // Check the database
		echo mysqli_num_rows($check_query); // echo the num or rows 0 or greater than 0
	}
?>