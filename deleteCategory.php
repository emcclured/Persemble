<?php
require_once("database/database.php");

// check to see if user is logged in, if not redirect to index.php
if(isset($_SESSION['is_logged_on'])!=true || $_SESSION['is_logged_on'] != 1){ // Redirect to index.php if user not logged in
	echo '<script type="text/javascript">window.location = "index.php"; </script>';
}

		//Fetching Values from URL 
	   $idcategory=$_POST['idcategory'];
	   
// if idcategory not set, return back to categories.php	   
if($idcategory=="") {
	header('Location: categories.php');
}
      
   	$query = persembleDB::getInstance()->delete_category($idcategory);
   	
   	// reload the categories.php page  
   	header('Location: categories.php');
?>