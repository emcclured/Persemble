<?php
require_once("database/database.php");

//Fetching Values from URL to see if this page was called by index.php or directly.  
$registerFromIndex=$_POST['registerFromIndex'];

//if this page called directly, go back to index.php

if ($registerFromIndex=="") {
	header('Location: index.php');
}
?>

﻿<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="icon" type="image/ico" href="photos/heartIcon.ico"/>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script type="text/javascript" src="js/registration.js"></script>
	
<title>Persemble-Register</title>

<link href="css/styles.css" rel="stylesheet" type="text/css" />
<style type="text/css">
	
</style>
</head>

<!--Black area at top-->
<body>
<div class="box3" style="width:auto;  height:20px;"></div>

<div id="wrapper">

<!--Pink area at top-->
<div class="box1" style="width:900px;  height:60px;">
<h1 style="font-size:30px; padding-left:20px; padding-right:20px;">Persemble</h1>
</div>

<!--Navigation Link for Site-->
<div class="linkBar"> 
<!--<ul>
<li class="first"><a href="ensemble.html">Ensemble</a></li>
<li><a href="items.html">Items</a></li>
<li><a href="myAccount.html">my Account</a></li>
</ul>-->
</div>

<div class="box2" style="width:900px; height:auto;" align="left;">

<form action="" method="get">
	<fieldset>
	 <legend>
	 	<img src="photos/old-key.png" alt="Key Icon" style="width:75px;height:25px;padding-top: 10px; padding-bottom: 2px">
	 </legend>
	 
	 <div class="container">
		<div class="main">
	      <form class="form"  method="post" action="#">
			<label>Last Name: </label>
			<input type="text" name="lname" id="lname">
			<br/>
			<br/>
			<label>First Name: </label>
			<input type="text" name="fname" id="fname">
			<br/>
			<br/>			
			<label>Email: </label>
			<input type="text" name="email" id="email">
			<br/>
			<br/>			
			<label>Password: </label>
			<input type="password" name="password" id="password">
			<br/>
			<br/>			
			<label>Confirm Password: </label>
			<input type="password" name="cpassword" id="cpassword">
			<br/>
			<br/>			
			<input type="button" name="register" id="register" value="Register">
		  </form>	
		</div>

   </fieldset>

</form>
</div>

<br />
&nbsp;

<div class="footer"> 
<!--<hr size="0">-->
<p>The content (content being images, text, sound and video files, programs and scripts) of this web site is copyright © TBD 2015. All rights expressly reserved.</p> </div>



</div>
</body>
</html>
