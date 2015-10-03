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
	    // echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
	    $pass = false;
	}
	else {
		// echo "Prepare succeeded" . "<br/>";
	}

	if(!$query->bind_param("s", $email)) {
	    // echo "Binding parameters failed: (" . $connection->errno . ") " . $connection->error;
	    $pass = false;
	}
	else {
		// echo "Binding succeeded" . "<br/>";
	}
	
	if(!$query->execute()) {
		// echo "Execute failed: (" . $connection->errno . ") " . $connection->error;
		$pass = false;
	}
	else {
		// echo "Execute succeeded. Select finished." . "<br/>";
		$res = $query->get_result();
		$row = $res->fetch_assoc();
		$options = [
		    'cost' => 12,
		    'salt' => $row['salt'],
		];
		if(password_hash($password, PASSWORD_BCRYPT, $options) == $row['password'] && $row['email'] != null) {
			// print_r($options);
			// cookies set	
			if (isset($_POST['rememberme'])) {
	            $_SESSION['email'] = $email; // hackingwithphp.com/10/1/3/choosing-the-appropriate-option -> store sessions in database?
				$_SESSION['password'] = password_hash($password, PASSWORD_BCRYPT, $options);
				$_SESSION['rememberme'] = 1; // this should be a cookie
				// go to site

				// add cookies that last one month. encrypt them. AES?
	        } 
	        else {
	        	//cookie not set
	            $_SESSION['email'] = $email;
				$_SESSION['password'] = password_hash($password, PASSWORD_BCRYPT, $options);
				$_SESSION['rememberme'] = 0; // this should also be a cookie
				// go to site
	        }
		}
		else {
			unset($_POST);
			$_SESSION["loginerror"] = 1;
			echo "<script>location.href='login.php';</script>";
		}
	}
	if($pass == false) {
		echo "<script>location.href='fail.php';</script>";
	}
?>
<?php else: ?>
    <form action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?> method="post" class = "forms">
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