<?php
	session_start();
	require('modules/connection.php');
	require('modules/errors.php');
	require('password.php');
?>
<?php if (!empty($_POST)): ?>
<?php
	$pass = true;
	$email = isset($_POST['email']) ? $_POST['email'] : false;
	$password = isset($_POST['password']) ? $_POST['password'] : false;

	if(!($query = $connection->prepare("SELECT * FROM users WHERE email = ?"))) {
	     echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
	     $pass = false;
	}
	else {
		echo "Prepare succeeded" . "<br/>";
	}

	if(!$query->bind_param("s", $email)) {
	    echo "Binding parameters failed: (" . $connection->errno . ") " . $connection->error;
	    $pass = false;
	}
	else {
		echo "Binding succeeded" . "<br/>";
	}
	
	if(!$query->execute()) {
		echo "Execute failed: (" . $connection->errno . ") " . $connection->error;
		$pass = false;
	}
	else {
		echo "Execute succeeded. Select finished." . "<br/>";
		$res = $query->get_result();
		$row = $res->fetch_assoc();
		$options = [
		    'cost' => 12,
		    'salt' => $row['salt'],
		    // this is not outputting anything
		];
		if(password_hash($password, PASSWORD_BCRYPT, $options) == $row['password']) {
			print_r($options);
			// LOAD SESSION DATA FOR THAT USER 	
			if (isset($_POST['rememberme']) && isset($_SESSION['email']) && isset($_SESSION['password'])) {
				//set cookie to last one week
	            $_SESSION['email'] = $email;
				$_SESSION['password'] = password_hash($password, PASSWORD_BCRYPT, $options);
				$_SESSION['rememberme'] = 'set';
				//echo "<script>location.href='rss.php';</script>";
				echo "passed and cookie";
				// somehow going here because the two are both null??
	        } 
	        else {
	        	//cookie not set
	            /*$_SESSION['username'] = $username;
				$_SESSION['password'] = password_hash($password, PASSWORD_BCRYPT, $options);*/
				$_SESSION['rememberme'] = 'unset';
				//echo "<script>location.href='rss.php';</script>";
				echo "<br /> passed and no cookie <br />";
	        }
		}
		else {
			unset($_POST);
			$_SESSION["loginerror"] = 1;
			$pass = false;
			echo "no pass";
		}
	}
	if($pass == false) {
		//echo "<script>location.href='fail.php';</script>";
	}
?>
<?php else: ?>
    <form action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?> method="post" class = "forms" onsubmit = "return validateForm()">
        Email: <input type="text" name="email"><br/>
        Password:&nbsp <input type="password" name="password"><br/>
        <input type = "submit" value = "Connect" id="connectButton">
        	<?php 
				if(isset($_SESSION["loginerror"])) {
					if($_SESSION["loginerror"] == 1) {
						echo "<span> Invalid username or password </span>";
						session_destroy();
					}
				}
			?>
		<div id = "remember">
			Remember Me: <input type="checkbox" name="rememberme" value="1"><br/>
			<a href = "create.php">Create an account</a>
		</div>
    </form>
<?php endif; ?>
<?php
	mysqli_close($connection);
?>