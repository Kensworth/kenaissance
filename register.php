<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$('#username').keyup(function(){ // Keyup function for check the user action in input
		var username = $(this).val(); // Get the username textbox using $(this) or you can use directly $('#username')
		var usernameAvailResult = $('#username_avail_result'); // Get the ID of the result where we gonna display the results
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
			usernameAvailResult.html('Enter atleast 3 characters');
		}
		if(username.length == 0) {
			usernameAvailResult.html('');
		}
	});
	
	$('#password, #username').keydown(function(e) { // Dont allow users to enter spaces for their username and passwords
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
		if(passwordLength > 0 && passwordLength < 6) { // If string length less than 4 add 'weak' class
			passwordStrength.html('password too short');
			passwordStrength.removeClass('normal strong verystrong').addClass('weak');
		}
		if(passwordLength > 6 && passwordLength < 10) { // If string length greater than 4 and less than 8 add 'normal' class
			passwordStrength.html('Normal');
			passwordStrength.removeClass('weak strong verystrong').addClass('normal');			
		}	
		if(passwordLength >= 10 && passwordLength < 14) { // If string length greater than 8 and less than 12 add 'strong' class
			passwordStrength.html('Strong');
			passwordStrength.removeClass('weak normal verystrong').addClass('strong');
		}
		if(passwordLength >= 14) { // If string length greater than 12 add 'verystrong' class
			passwordStrength.html('Very Strong');
			passwordStrength.removeClass('weak normal strong').addClass('verystrong');
		}
	});
});
</script>
<style type="text/css">
body{
	margin: 0;
	padding: 0;
	font-family: arial;
	color: #2C2C2C;
	font-size: 14px;
}
h1 a{
	color:#2C2C2C;
	text-decoration:none;
}
h1 a:hover{
	text-decoration:underline;
}
.as_wrapper{
	margin: 0 auto;
	width: 10000px;
}
.mytable{
	margin: 0 auto;
	padding: 20px;
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
.username_avail_result{
	display:block;
	width:180px;
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
/* password strength indicator classes weak, normal, strong, verystrong*/
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
</style>

</head>

<body>
<div class="as_wrapper">
	<br/>
	<table class="mytable">
	<tr>
    	<td class="talign_right">Email</td>
        <td><input type="text" name="email" id="email" /></td>
        <td><div class="email_avail_result" id="email_avail_result"></div></td>
    </tr>	
    <tr>
    	<td class="talign_right">Username</td>
        <td><input type="text" name="username" id="username" /></td>
        <td><div class="username_avail_result" id="username_avail_result"></div></td>
    </tr>
    <tr>
    	<td class="talign_right">Password</td>
        <td><input type="text" name="password" id="password" /></td>
        <td><div class="password_strength" id="password_strength"></div></td>
    </tr>
    </table>
</div>
</body>
</html>