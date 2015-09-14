<?php
require_once("database/database.php");

// check to see if user is logged in, if not redirect to index.php
if(isset($_SESSION['is_logged_on'])!=true || $_SESSION['is_logged_on'] != 1){ // Redirect to index.php if user not logged in
	header('Location: index.php');
}

		//Fetching Values from URL 
	   $user_iduser= $_SESSION['iduser'];
 
// if user_iduser not set, return back to index.php	   
if($user_iduser=="") {
	header('Location: index.php');
}	
      
   	$query = persembleDB::getInstance()->delete_all_ensembles($user_iduser);
   	
   	// reload the ensemble.php page  
   	header('Location: ensemble.php');
?>