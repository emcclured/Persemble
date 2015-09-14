<?php
require_once("database/database.php");

// check to see if user is logged in, if not redirect to index.php
if(isset($_SESSION['is_logged_on'])!=true || $_SESSION['is_logged_on'] != 1){ // Redirect to index.php if user not logged in
	echo '<script type="text/javascript">window.location = "index.php"; </script>';
}

		//Fetching Values from URL 
	   $idensembles=$_POST['idensembles'];
	   
// if idensembles not set, return back to index.php	   
if($idensembles=="") {
	header('Location: index.php');
}	   
      
   	$query = persembleDB::getInstance()->delete_ensemble($idensembles);
   	
   	// reload the ensemble.php page  
   	header('Location: ensemble.php');
?>