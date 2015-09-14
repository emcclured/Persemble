<?php
require_once("database/database.php");

if(isset($_SESSION['iduser']) == false || $_SESSION['iduser'] == ''){ // Redirect to secured index page if user not logged in
	echo '<script type="text/javascript">window.location = "index.php"; </script>';
}

	// reset session variable values
   	
	$_SESSION['iduser'] = "";
	$_SESSION['first_name'] = "";
	$_SESSION['last_name'] 	= "";
	$_SESSION['email'] = "";
	$_SESSION['password'] = "";

	// use javascript to goback to index after logging out
 
	echo '<script type="text/javascript">window.location = "index.php";</script>';

?>