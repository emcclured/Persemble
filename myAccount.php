<?php
require_once("database/database.php");

if(isset($_SESSION['iduser']) == false || $_SESSION['iduser'] == ''){ // Redirect to secured index page if user not logged in
	echo '<script type="text/javascript">window.location = "index.php"; </script>';
}
?>

﻿<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="icon" type="image/ico" href="photos/heartIcon.ico"/>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Persemble-my Account</title>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script type="text/javascript" src="js/deleteAccount.js"></script>
<script type="text/javascript" src="js/updateAccount.js"></script>

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

<!--Navigation Link for Site-->
<div class="navBar"> 
	<ul>
		<li><a href="main.php">Main</a></li>
		<li><a href="ensemble.php">Ensemble</a></li>
		<li><a href="items.php">Item</a></li>
		<li><a href="categories.php">Category</a></li>
		<li class="highlight"><a href="myAccount.php">my Account</a></li>
		<li><a href="logout.php">Logout</a></li>
	</ul>
</div>

<div id="wrapper">

<!--Content Location for Page-->
<div class="box2">
	<img src="photos/old-key.png" alt="Key Icon" style="width:75px;height:25px;padding-top: 20px; padding-bottom: 20px; padding-right: 20px"/>


<form action="" method="get">
	<fieldset>
	 
	 <div class="container">
		<div class="main">
		   <?php
	      echo "<form class=\"form\"  method=\"post\" action=\"#\">";
			echo "<label>Modify Last Name: </label>";
			echo "<input type=\"text\" required value=\" " . $_SESSION["last_name"] . " \" name=\"ac_lname\" id=\"ac_lname\">";
			echo "<br/>";
			echo "<br/>";
			echo "<label>Modify First Name: </label>";
			echo "<input type=\"text\" required value=\" " . $_SESSION["first_name"] . " \" name=\"ac_fname\" id=\"ac_fname\">";
			echo "<br/>";
			echo "<br/>";			
			echo "<label>Modify Email: </label>";
			echo "<input type=\"text\" required value=\" " . $_SESSION["email"] . " \" name=\"ac_email\" id=\"ac_email\">";
			echo "<br/>";
			echo "<br/>";		
			?>	
			
			<label>Modify Password: </label>
			<input type="password" name="ac_password" id="ac_password">
			<br/>
			<br/>			
			<label>Confirm Modify Password: </label>
			<input type="password" name="ac_cpassword" id="ac_cpassword">
			<br/>
			<br/>	
		
			<input type="button" name="updateAccount" id="updateAccount" value="Update Account">
		  </form>	
		  	<input type="button" name="deleteAccount" id="deleteAccount" value="Delete Account" style="background: #1E222E">
		  </form>	
		</div>

   </fieldset>

</form>
</div>

<br />
<hr />

<!--footer section-->
<div class="footer">
	<p>The content of this web site is copyright © TBD 2015. All rights expressly reserved.</p> 
</div>

</div>
</body>
</html>

