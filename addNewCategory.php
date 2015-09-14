<?php
require_once("database/database.php");

// check to see if user is logged in, if not redirect to index.php
if(isset($_SESSION['is_logged_on'])!=true || $_SESSION['is_logged_on'] != 1){ // Redirect to index.php if user not logged in
	header('Location: index.php');
}

		//Fetching Values from URL 
		$tc_name=$_POST['tc_categoryname1'];
		$tc_comments=$_POST['tc_comments1'];
		$tc_subcategorytype=$_POST['tc_subcategorytype1'];
		$tc_subcategoryname=$_POST['tc_subcategoryname1'];	
		
		if ($tc_name != "") {
      	$iduser = $_SESSION['iduser'];
      
   		$query = persembleDB::getInstance()->add_category($tc_name, $tc_comments, $tc_subcategorytype, $tc_subcategoryname, $iduser);
   		
   		echo $query;
   	} else {
   		header('Location: index.php');
   	}
   	
?>