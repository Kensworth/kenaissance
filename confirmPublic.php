<?php
	session_start();

	require('modules/connection.php');
	require('modules/errors.php');

	if(isset($_POST['email']) && isset($_POST['username']) && isset($_POST['password'])) {
		$pass = true;
		//set
		require('password.php');
		$options = [
		    'cost' => 12,
		    'salt' => mcrypt_create_iv(22, MCRYPT_DEV_URANDOM),
		];

		function genVString($length = 32) {
		    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		    $charactersLength = strlen($characters);
		    $randomString = '';
		    for ($i = 0; $i < $length; $i++) {
		        $randomString .= $characters[rand(0, $charactersLength - 1)];
		    }
		    return $randomString;
		}
		
		$email = $_POST['email'];
		$username = $_POST['username'];
		$password = password_hash(($_POST['password']), PASSWORD_BCRYPT, $options);
		$vpassword = password_hash(($_POST['vpassword']), PASSWORD_BCRYPT, $options);
		$salt = $options['salt'];
		$vString = genVString();

		// CHECK IF USERNAME OR PASSWORD HAS SPACES, OR REMOVE THEM FIRST

		if(strlen($_POST['password']) < 8 || strlen($_POST['password'] > 120)) {
			$pass = false;
		}
		elseif($_POST['password'] != $_POST['vpassword']) {
			$pass = false;
		}
		elseif((preg_match('/\s/',$email)) || (preg_match('/\s/',$username)) || (preg_match('/\s/',$password))) {
			$pass = false;
		}
		elseif(strlen($_POST['username']) < 3 || strlen($_POST['username']) > 60) {
			$pass = false;
		} 
		elseif(!preg_match("/^[[:alnum:]][a-z0-9_.-]*@[a-z0-9.-]+\.[a-z]{2,4}$/i", $email)){
			$pass = false;
		} 
		elseif(!($query = $connection->prepare("INSERT INTO users (email, username, password, salt, vhash) VALUES (?,?,?,?,?)"))) {
		    $pass = false;
		}
		elseif(!$query->bind_param("sssss", $email, $username, $password, $salt, $vString)) {
		    $pass = false;
		}
		elseif(!$query->execute()) {
			$pass = false;
		}
	}
	else {
		$pass = false;
	}	

	if($pass == true) {
		require('modules/PHPMailer-master/PHPMailerAutoload.php');
		$mail = new PHPMailer;
		$mail->isSMTP(); // Set mailer to use SMTP
		$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
		$mail->SMTPAuth = true; // Enable SMTP authentication
		$mail->Username = 'kenaissance.io@gmail.com'; // SMTP username
		$mail->Password = 'examplePassword'; 
		$mail->SMTPSecure = 'tls'; // Enable TLS encryption, `ssl` also accepted
		$mail->Port = 587; // TCP port to connect to

		$mail->SMTPOptions = array(
		    'ssl' => array(
		        'verify_peer' => false,
		        'verify_peer_name' => false,
		        'allow_self_signed' => true
		    )
		);

		$mail->From = 'kenaissance.io@gmail.com';
		$mail->FromName = 'ken';
		$mail->addAddress($email, $username); // Add a recipient
		//$mail->addReplyTo('info@example.com', 'Information');
		//$mail->addCC('cc@example.com');
		//$mail->addBCC('bcc@example.com');

		//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
		//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
		$mail->isHTML(true); // Set email format to HTML

		$mail->Subject = 'kenaissance';
		$mail->Body    = "<i> Hello, " . $username . ".</i> Thanks for signing up. Click the following link to continue. <br /> <a href = 'http://localhost/Sites/kennethzhangnet/verify.php?e=" . $email . "&h=" . $vString . "'>Authenticate!</a>";
		$mail->AltBody = "Hello, " . $username . ". Thanks for signing up. Click the following link to continue. \r\n http://localhost/Sites/kennethzhangnet/verify.php?e=" . $email . "&h=" . $vString;

		$mail->send();

		$query->close();
		$connection->close();
	}
	else {
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
		left: 35%;
    	top: 21%;
    	border-radius:5px;
    	background: rgba(0, 0, 0, 0.3);
    	padding: 10px;
	}	
</style>
</head>
<body>
		<div id = "testing">
			Please click the confirmation we sent to your email. <br/> It may take several minutes to arrive.
			<br/>
		</div>
</body>
</html>