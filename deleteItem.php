<?php
require_once("database/database.php");

// check to see if user is logged in, if not redirect to index.php
if(isset($_SESSION['is_logged_on'])!=true || $_SESSION['is_logged_on'] != 1){ // Redirect to index.php if user not logged in
	header('Location: index.php');
}

		//Fetching Values from URL 
	   $iditem=$_POST['iditem'];
 
// if iditem not set, return back to index.php	   
if($iditem=="") {
	header('Location: index.php');
}	
      
   	$query = persembleDB::getInstance()->delete_item($iditem);
   	
   	// reload the ensemble.php page  
   	header('Location: items.php');
?>