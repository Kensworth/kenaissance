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
				else {
					header('Location: /home.php');
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
		header('Location: /fail.php');
	}
?>