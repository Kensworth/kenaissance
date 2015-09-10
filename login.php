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
<!DOCTYPE html
PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!-- 2015 kenneth zhang -->
<html>
<head>
<title>PHP/MySQL/Apache Testing</title>
<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
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
	#connectButton {
		z-index: 100;
		background-color: #ccc;
	    border-radius:2px;
	    color: #fff;
	    font-size: 13pt;
	    text-decoration: none;
	    cursor: pointer;
	    border:none;
	}
	#connectButton:hover {
	    border: none;
	    background: gray;
	    box-shadow: 0px 0px 1px #777;
	}
	* {
		font-family: 'Open Sans', sans-serif;
		margin: 0;
		text-decoration: none;
	}

	a {
		color:white;
	}

	a:hover {
		color:gray;
	}

	#testing{
		position: absolute;
		text-align: left;
		z-index: 100;
		color: white;
		font-size: 24px;
		left: 40%;
    	top: 20%;
	}
	.forms {
		font-size: 15pt;
	}
	span {
		color: red;
		font-size: 12px;
		text-align: left;
	}
	#remember {
		font-size: 12px;
	}	
</style>
<script>
	window.onload=function() {
		document.forms[0][0].focus();
	}
	function validateForm() {
	    var x = document.forms["logins"]["username"].value;
	    var y = document.forms["logins"]["password"].value;
	    if ((x == null || x == "") && (y == null || y == "")) {
	        alert("Please enter your username and password");
	        return false;
    	}
    	else if (x == null || x == "") {
	        alert("Please enter your username");
	        return false;
    	}
    	else if (y == null || y == "") {
	        alert("Please enter your password");
	        return false;
    	}
	}
</script>
</head>
<body>
	<img src = "../images/redSunrise.jpg" height = "100%" width = "100%" id = "redSunrise" />
		<div id = "testing">
			Login
			<br/>
			<?php if (!empty($_POST)): ?>
				<?php
					$username = isset($_POST['username']) ? hash('sha256', mysqli_real_escape_string($connection, $_POST['username'])) : false;
					$password = isset($_POST['password']) ? mysqli_real_escape_string($connection, $_POST['password']) : false;
					// CHANGE TO MYSQLI AND MAKE SURE ARROW NOTATION DOESN'T BREAK ANYTHING
					if(!($query = $connection->prepare("SELECT * FROM users where email = '" . VALUES (?) . "'"))) {
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
						echo "Execute succeeded. New records created successfully" . "<br/>";
					}

					if($result = mysqli_query($connection, $query)) {
						//success
						if($row = mysqli_fetch_assoc($result)) {
							$options = [
							    'cost' => 8,
							    'salt' => $row['salt'],
							];
							if(password_hash($password, PASSWORD_BCRYPT, $options) == $row['password']) {
								//success
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

					$query->close();
					$connection->close();
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
		</div>
</body>
</html>