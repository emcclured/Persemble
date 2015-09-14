<?php
require_once("database/database.php");

// check to see if user is logged in, if not redirect to index.php
if(isset($_SESSION['is_logged_on'])!=true || $_SESSION['is_logged_on'] != 1){ // Redirect to index.php if user not logged in
	header('Location: index.php');
}

		//Fetching Values from URL 
		$e_name=$_POST['e_name1'];
		
		if ($e_name != "") {
      	$iduser = $_SESSION['iduser'];
      
   		$query = persembleDB::getInstance()->add_ensemble($iduser, $e_name);
   	} else {
   		header('Location: index.php');
   	}
   	
   	
?>