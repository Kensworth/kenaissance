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
		left:30px;
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
	.email_valid_result{
		display:block;
		width:180px;
		font-size: 12px;
	}
	.username_avail_result{
		display:block;
		width:180px;
		font-size: 12px;
	}
	.password_strength {
		display:block;
		width:180px;
		padding:3px;
		text-align:center;
		color:#333;
		font-size:12px;
		backface-visibility:#FFF;
		font-weight:bold;
	}
	.password_strength.weak{
		background:#e84c3d;
	}
	.password_strength.normal{
		background:#f1c40f;
	}
	.password_strength.strong{
		background:#27ae61;
	}
	.password_strength.verystrong{
		background:#2dcc70;
		color:#FFF;
	}
	.verifypassword{
		display:block;
		width:180px;
		padding:3px;
		text-align:center;
		color:#333;
		font-size:12px;
		backface-visibility:#FFF;
		font-weight:bold;
	}
	.verifypassword.weak{
		background:#e84c3d;
	}
	.verifypassword.normal{
		background:#f1c40f;
	}
	.verifypassword.strong{
		background:#27ae61;
	}
	.verifypassword.verystrong{
		background:#2dcc70;
		color:#FFF;
	}
</style>

<script type="text/javascript">

function isValidEmailAddress(email) {
    var pattern = new RegExp(/^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i);
    return pattern.test(email);
};

$(document).ready(function(){
	$('#email').keyup(function(){ // Keyup function for check the user action in input
		var email = $(this).val(); // Get the username textbox using $(this) or you can use directly $('#username')
		var emailValidResult = $('#email_valid_result'); // Get the ID of the result where we display the results
		if(email.length > 6) { // check if greater than 2 (minimum 3)
			emailValidResult.html('Loading..'); // Preloader, use can use loading animation here
			if(isValidEmailAddress(email) == 1){
				emailValidResult.html('<span class="success">valid email</span>');
			}
			else {
				emailValidResult.html('<span class="error">invalid email</span>');
			}
		}
		if(email.length == 0) {
			emailValidResult.html('');
		}
	});

	$('#email').blur(function(){ // Keyup function for check the user action in input
		var email = $(this).val(); // Get the username textbox using $(this) or you can use directly $('#username')
		var emailValidResult = $('#email_valid_result'); // Get the ID of the result where we display the results
		if(email.length > 6) { // check if greater than 2 (minimum 3)
			emailValidResult.html('Loading..'); // Preloader, use can use loading animation here
			if(isValidEmailAddress(email) == 1){
				emailValidResult.html('<span class="success">valid email</span>');
			}
			else {
				emailValidResult.html('<span class="error">invalid email</span>');
			}
		}
		if(email.length == 0) {
			emailValidResult.html('');
		}
	});

	$('#username').keyup(function(){ // Keyup function for check the user action in input
		var username = $(this).val(); // Get the username textbox using $(this) or you can use directly $('#username')
		var usernameAvailResult = $('#username_avail_result'); // Get the ID of the result where we're going to display the results
		if(username.length > 2) { // check if greater than 2 (minimum 3)
			usernameAvailResult.html('Loading..'); // Preloader, use can use loading animation here
			var urlToPass = 'action=username_availability&username='+username;
			$.ajax({ // Send the username val to another checker.php using Ajax in POST menthod
				type : 'POST',
				data : urlToPass,
				url  : 'checker.php',
				complete: function(responseText){
		           console.log(responseText);
		        },
				success: function(responseText){ // Get the result and asign to each cases
					if(responseText == 0){
						usernameAvailResult.html('<span class="success">username name available</span>');
					}
					else if(responseText > 0){
						usernameAvailResult.html('<span class="error">username already taken</span>');
					}
					else{
						alert('Problem with SQL query');
					}
				}
			});
		}else{
			usernameAvailResult.html('Enter at least 3 characters');
		}
		if(username.length == 0) {
			usernameAvailResult.html('');
		}
	});

	$('#username').blur(function(){ // Keyup function for check the user action in input
		var username = $(this).val(); // Get the username textbox using $(this) or you can use directly $('#username')
		var usernameAvailResult = $('#username_avail_result'); // Get the ID of the result where we're going to display the results
		if(username.length > 2) { // check if greater than 2 (minimum 3)
			usernameAvailResult.html('Loading..'); // Preloader, use can use loading animation here
			var urlToPass = 'action=username_availability&username='+username;
			$.ajax({ // Send the username val to another checker.php using Ajax in POST menthod
				type : 'POST',
				data : urlToPass,
				url  : 'checker.php',
				complete: function(responseText){
		           console.log(responseText);
		        },
				success: function(responseText){ // Get the result and asign to each cases
					if(responseText == 0){
						usernameAvailResult.html('<span class="success">username name available</span>');
					}
					else if(responseText > 0){
						usernameAvailResult.html('<span class="error">username already taken</span>');
					}
					else{
						alert('Problem with SQL query');
					}
				}
			});
		}else{
			usernameAvailResult.html('Enter at least 3 characters');
		}
		if(username.length == 0) {
			usernameAvailResult.html('');
		}
	});
	
	$('#password, #username, #email, #vpassword').keydown(function(e) { // Dont allow users to enter spaces for their username and passwords
		if (e.which == 32) {
			return false;
  		}
	});
	$('#password').keyup(function() { // As same using keyup function for get user action in input
		var passwordLength = $(this).val().length; // Get the password input using $(this)
		var passwordStrength = $('#password_strength'); // Get the id of the password indicator display area
		
		if(passwordLength <= 0) { // Check is less than 0
			passwordStrength.html(''); // Empty the HTML
			passwordStrength.removeClass('normal weak strong verystrong'); //Remove all the indicator classes
		}
		if(passwordLength > 0 && passwordLength < 8) { // If string length less than 8 add 'weak' class
			passwordStrength.html('password too short');
			passwordStrength.removeClass('normal strong verystrong').addClass('weak');
		}
		if(passwordLength >= 8 && passwordLength < 10) { // If string length greater than 8 and less than 10 add 'normal' class
			passwordStrength.html('weak');
			passwordStrength.removeClass('weak strong verystrong').addClass('normal');			
		}	
		if(passwordLength >= 10 && passwordLength < 14) { // If string length greater than 10 and less than 14 add 'strong' class
			passwordStrength.html('decent');
			passwordStrength.removeClass('weak normal verystrong').addClass('strong');
		}
		if(passwordLength >= 14) { // If string length greater than 14 add 'verystrong' class
			passwordStrength.html('strong');
			passwordStrength.removeClass('weak normal strong').addClass('verystrong');
		}
	});

	// USE JQUERY ON BOTH V PASSWORD AND PASSWORD AT THE SAME TIME
	
	$('#vpassword').keyup(function() { // As same using keyup function for get user action in input
		var password = document.forms['logins'].elements['password'].value;
		var password2 = $(this).val(); // Get the password input using $(this)
		var verify = $('#verifypassword'); // Get the id of the password indicator display area
		
		if(password2.length >= 8) {
			if(password2 == password) {
				verify.html('match');
				verify.removeClass('weak normal strong').addClass('verystrong');
			}
			else { 
				verify.html('no match');
				verify.removeClass('normal strong verystrong').addClass('weak');
			}
		}
		else {
			verify.html('');
			verify.removeClass('normal weak strong verystrong');
		}
	});

	$('#vpassword').blur(function() { // As same using keyup function for get user action in input
		var password = document.forms['logins'].elements['password'].value;
		var password2 = $(this).val(); // Get the password input using $(this)
		var verify = $('#verifypassword'); // Get the id of the password indicator display area
		
		if(password2.length >= 8) {
			if(password2 == password) {
				verify.html('match');
				verify.removeClass('weak normal strong').addClass('verystrong');
			}
			else { 
				verify.html('no match');
				verify.removeClass('normal strong verystrong').addClass('weak');
			}
		}
		else {
			verify.html('');
			verify.removeClass('normal weak strong verystrong');
		}
	});
});

	window.onload=function() {
		document.forms[0][0].focus();
	}
</script>

</head>
<body>
	<div class="as_wrapper">
		<form name = "logins" action = "confirm.php" method = "post">
			<div id="account">
				Create an Account
			</div>
			<table class="mytable">
			<tr>
		    	<td class="talign_right">Email</td>
		        <td><input type="text" name="email" id="email" /></td>
		        <td><div class="email_valid_result" id="email_valid_result"></div></td>
		    </tr>	
		    <tr>
		    	<td class="talign_right">Username</td>
		        <td><input type="text" name="username" id="username" /></td>
		        <td><div class="username_avail_result" id="username_avail_result"></div></td>
		    </tr>
		    <tr>
		    	<td class="talign_right">Password</td>
		        <td><input type="password" name="password" id="password" /></td>
		        <td><div class="password_strength" id="password_strength"></div></td>
		    </tr>
		    <tr>
		    	<td class="talign_right">Verify Password</td>
		        <td><input type="password" name="vpassword" id="vpassword" /></td>
		        <td><div class="verifypassword" id="verifypassword"></div></td>
		    </tr>
		    </table>
		    <div id="create">
				<input type = "submit" value = "Create" id="connectButton">
			</div>
		</form>
	</div>	
</body>
</html>