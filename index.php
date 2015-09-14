<?php
require_once("database/database.php");

if(isset($_SESSION['iduser']) && $_SESSION['iduser'] != ''){ // Redirect to secured user page if user logged in
	echo '<script type="text/javascript">window.location = "main.php"; </script>';
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="icon" type="image/ico" href="photos/heartIcon.ico"/>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Persemble-Sign In using AJAX, jQuery, PHP, and MySql</title>

<script type="text/javascript" src="js/jquery-1.9.1.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$('#emailusername').focus(); // Focus to the emailusername field on body loads
	$('#login').click(function(){ // Create `click` event function for login
		var emailusername = $('#emailusername'); // Get the emailusername field
		var loginpassword = $('#loginpassword'); // Get the password field
		var login_result = $('.login_result'); // Get the login result div
		login_result.html('loading..'); // Set the pre-loader
		
		// Check the emailusername values is empty or not
		if(emailusername.val() == ''){ 
			emailusername.focus(); // set focus to the field
			login_result.html('<span class="error">Enter the Email that will be used as the Username</span>');
			return false;
		}
		
		// Check the password values is empty or not
		if(loginpassword.val() == ''){ 
			loginpassword.focus();
			login_result.html('<span class="error">Enter the password</span>');
			return false;
		}
		
		// Check the emailusername and password values is not empty and make the ajax request
		if(emailusername.val() != '' && loginpassword.val() != ''){ 
			
			var UrlToPass = 'action=login&emailusername='+emailusername.val()+'&loginpassword='+loginpassword.val();
			
			$.ajax({ // Send the credential values to accountChecker.php using Ajax 
			type : 'POST',
			data : UrlToPass,
			url  : 'accountChecker.php',
			success: function(responseText){ // Get the result and assign to each cases
				if(responseText == 0){
					login_result.html('<span class="error">Email Username or Password Incorrect!</span>');
				}
				else if(responseText == 1){
					window.location = 'main.php';
				}
				else{
					alert('Problem with sql query');
				}
			}
			});
		}
		return false;
	});
});
</script>

<link href="css/styles.css" rel="stylesheet" type="text/css" />
<style type="text/css">
	
</style>
</head>

<body>

<!--Title area at top-->
<div class="box1">
<h1>Persemble</h1>
<h6>{personal ensemble organizer}</h6>
</div>

<div id="wrapper">
	<br/>
   <br/>
	<h3>Please sign in</h3>
<!--login-->
<div class="box2">
	<div id="loginbox">
		<form>	
			<fieldset>
				<table class="logintable">
				<tr>
				<td colspan="2"><div class="login_result" id="login_result"></div></td>
				</tr>
				<tr>
    			<td><input type="text" required value="Email" name="emailusername" id="emailusername" /></td>
				</tr>
				<tr>
    			<td><input type="password" required value="Password" name="loginpassword" id="loginpassword"  /></td>
				</tr>
				<tr>
				<td><input type="submit" name="login" id="login" value="Login" /></td>
				</tr>
				</table>
			</fieldset>  					
		</form>	
			<p><span class="btn-round">or</span></p>	
	</div>	

	<!--New User Login-->
	<div id="loginbox2">
		<h3><strong>New User?</strong></h3>
		<form name="Register" ACTION="register.php" method="POST">
			<fieldset>
				<input type="hidden" name="registerFromIndex" value="1"/>
				<input type="submit" name="submitRegister" value="Register" /></a>
			</fieldset>
		</form>
	</div>
	
</div>

<br />
<hr />

<!--footer section-->
<div class="footer">
<p>The content of this web site is copyright © TBD 2015. All rights expressly reserved.</p> 
</div>
<br />

</div>
</body>
</html>
