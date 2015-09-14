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
<title>Persemble-Main</title>

<link href="css/styles.css" rel="stylesheet" type="text/css" />
<style type="text/css">
	
</style>
</head>

<body>

<!--Title area at top-->
<div class="box1">
	<h1>Persemble</h1>
	<h6>{personal ensemble organizer}</h6>
	<?php
   $firstName = $_SESSION['first_name'];
	echo "<h1 style=\"font-size:30px; padding-left:20px; padding-right:20px;\">Welcome, $firstName</h1>";
   ?>
</div>

<!--Navigation Link for Site (hidden on Main.php)-->
<!--<div class="navBar"> 
	<ul>
		<li class="first"><a href="main.php">Main</a></li>
		<li><a href="ensemble.php">Ensemble</a></li>
		<li><a href="items.php">Item</a></li>
		<li><a href="categories.php">Category</a></li>
		<li><a href="myAccount.php">my Account</a></li>
		<li><a href="logout.php">Logout</a></li>
	</ul>
</div>-->

<div id="wrapper">


<div class="box2">
<img src="photos/heart-plain.jpg" alt="Heart Icon" style="width:50px;height:50px;padding-top: 40px; padding-bottom: 10px"></img>
<a href="ensemble.php"><h2 style="text-decoration: underline">Ensemble</h2></a>
<p>{create ensembles from your wardrobe and beauty items}</p>
<br></br>
<img src="photos/remigho-hanger-1.png" alt="Hanger Icon" style="width:75px;height:45px;padding-top: 20px; padding-bottom: 10px"></img>
<a href="items.php"><h2 style="text-decoration: underline">Item</h2></a>
<p>{access all your items in inventory}</p>
<br></br>
<img src="photos/ryanlerch-white-t-shirt.png" alt="Shirt Icon" style="width:75px;height:45px;padding-top: 20px; padding-bottom: 10px"></img>
<a href="categories.php"><h2 style="text-decoration: underline">Category</h2></a>
<p>{access all your categories}</p>
<br></br>
<img src="photos/old-key.png" alt="Key Icon" style="width:100px;height:35px;padding-top: 20px; padding-bottom: 10px"></img>
<a href="myAccount.php"><h2 style="text-decoration: underline">my Account</h2></a>
<p>{view your account details}</p>
<br />
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
