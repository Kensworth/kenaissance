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
		//successful mysql connection
	}

	require('password.php');
?>
<?php if (!empty($_POST)): ?>
				<?php
					$email = isset($_POST['email']) ? $_POST['username'] : false;
					$password = isset($_POST['password']) ? $_POST['password'] : false;

					if(!($query = $connection->prepare("SELECT * FROM users WHERE email = ?"))) {
					     echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
					}
					else {
						echo "Prepare succeeded" . "<br/>";
					}

					if(!$query->bind_param("s", $email)) {
					    echo "Binding parameters failed: (" . $connection->errno . ") " . $connection->error;
					}
					else {
						echo "Binding succeeded" . "<br/>";
					}
					
					if(!$query->execute()) {
						echo "Execute failed: (" . $connection->errno . ") " . $connection->error;
					}
					else {
						echo "Execute succeeded. Select finished." . "<br/>";
					}

					if($result = mysqli_query($connection, $query)) {
						//success
						if($row = mysqli_fetch_assoc($result)) {
							$options = [
								// SWITCH COST TO 12+ WHEN INFRASTRUCTURE IS COMPLETE
							    'cost' => 8,
							    'salt' => $row['salt'],
							];
							if(password_hash($password, PASSWORD_BCRYPT, $options) == $row['password']) {
								//success
								// LOAD SESSION DATA FOR THAT USER 	
								if (isset($_POST['rememberme'])) {
									//set cookie to last one week
						            $_SESSION['username'] = $username;
									$_SESSION['password'] = password_hash($password, PASSWORD_BCRYPT, $options);
									$_SESSION['rememberme'] = 'set';
						            echo "<script>location.href='rss.php';</script>";
						        } 
						        else {
						        	//cookie not set
						            $_SESSION['username'] = $username;
									$_SESSION['password'] = password_hash($password, PASSWORD_BCRYPT, $options);
									$_SESSION['rememberme'] = 'unset';
						            echo "<script>location.href='rss.php';</script>";
						        }
							}
							else {
								//failure
								unset($_POST);
								$_SESSION["loginerror"] = 1;
								echo "<script>location.href='login.php';</script>";
							}
				    	}
				    	else {
				    		unset($_POST);
							$_SESSION["loginerror"] = 1;
							echo "<script>location.href='login.php';</script>";
				    	}
					} 
					else {
						//failure
						die("Database query failed.");
					}
				?>
				<?php else: ?>
				    <form action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?> method="post" class = "forms" onsubmit = "return validateForm()">
				        Username: <input type="text" name="username"><br/>
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