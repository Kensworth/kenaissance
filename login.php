<?php
	session_start();
	require('modules/connection.php');
	require('modules/errors.php');
	require('password.php');
?>
<!DOCTYPE html
PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!-- 2015 kenneth zhang -->
<html>
<head>
<title>Create</title>
<link href='https://fonts.googleapis.com/css?family=Arvo' rel='stylesheet' type='text/css'>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js" type="text/javascript"></script>
<style>
	#connectButton {
		background-color: #ccc;
	    border-radius:2px;
	    color: #fff;
	    font-size: 13pt;
	    text-decoration: none;
	    cursor: pointer;
	    border: none;
	    padding-right: 38px;
	    padding-left: 38px;
	}
	#connectButton:hover {
	    border: none;
	    background: gray;
	    box-shadow: 0px 0px 1px #777;
	}
	* {
		font-family: 'Arvo', sans-serif;
		margin: 0;
		text-decoration: none;
	}
	a {
		color: white;
	}
	a:hover {
		color: gray;
	}
	#create {
		color: white;
		font-size: 16px;
		text-align: center;	
	}
	#account {
		color: black;
		font-size: 20px;
		text-align: center;	
	}
	h1 a{
	color:#2C2C2C;
	text-decoration:none;
	}
	h1 a:hover{
		text-decoration:underline;
	}
	.as_wrapper{
		position:absolute;
		top:20%;
		margin: 0 auto;
		width: 100%;
	}
	.mytable{
		padding: 20px;
		margin: 0 auto;
		position:relative;
		left: -36px;
	}
	.success{
		color:#009900;
	}
	.error{
		color:#F33C21;
	}
	.talign_right{
		text-align:right;
	}
	span {
		color: red;
		font-size: 14px;
	}
	#rememberme {
		text-align: center;
		font-size: 14px;
	}
</style>

<script type="text/javascript">
$(document).ready(function(){
	$('#password, #email').keydown(function(e) { // Dont allow users to enter spaces for their username and passwords
		if (e.which == 32) {
			return false;
  		}
	});
});

	window.onload=function() {
		document.forms[0][0].focus();
	}
</script>

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
		if($row['email'] != null) {
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
					$_SESSION['rememberme'] = 1;
					// go to site
					// on front-end add cookies that last one month. encrypt them. AES?
		        } 
		        else {
		        	//cookie not set
		            $_SESSION['email'] = $email;
					$_SESSION['password'] = password_hash($password, PASSWORD_BCRYPT, $options);
					$_SESSION['rememberme'] = 0;
					// go to site
		        }
			}
			else {
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
	if($pass == false) {
		echo "<script>location.href='fail.php';</script>";
	}
?>
<?php else: ?>
</head>
	<body>
		<div class="as_wrapper">
			<form action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?> method="post" name = "logins">
				<div id="account">
					Login
				</div>
				<table class="mytable">
				<tr>
			    	<td class="talign_right">Email</td>
			        <td><input type="text" name="email" id="email" /></td>
			        <td><div class="email_valid_result" id="email_valid_result"></div></td>
			    </tr>	
			    <tr>
			    	<td class="talign_right">Password</td>
			        <td><input type="password" name="password" id="password" /></td>
			        <td><div class="password_strength" id="password_strength"></div></td>
			    </tr>
			    </table>
			    <div id="create">
					<input type = "submit" value = "Create" id="connectButton">
				</div>
				<div id = "rememberme">
					<br /> Remember me: &nbsp;<input type="checkbox" name="rememberme" value="1"><br/>
					<?php 
						if(isset($_SESSION["loginerror"])) {
							if($_SESSION["loginerror"] == 1) {
								echo "<span> <br /> Invalid username or password </span>";
								session_destroy();
							}
						}
					?>
				</div>
			</form>
		</div>	
	</body>
</html>
<?php endif; ?>
<?php
	mysqli_close($connection);
?>

