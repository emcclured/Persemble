<?php
require_once("database/database.php");

// check to see if user is logged in, if not redirect to index.php
if(isset($_SESSION['is_logged_on'])!=true || $_SESSION['is_logged_on'] != 1){ // Redirect to index.php if user not logged in
	header('Location: index.php');
}

		//Fetching Values from URL 
	   $iidcategory=$_POST['iidcategory1'];
	   $iiditem=$_POST['iiditem1'];
	   $iidescription=$_POST['idescription1'];
	   $ibrand=$_POST['ibrand1'];
	   $icolor=$_POST['icolor1'];
	   $iquantity=$_POST['iquantity1'];
	   $iseason=$_POST['iseason1'];
	   $imaterial=$_POST['imaterial1'];
		
		if ($iidcategory!="") {
      	$iduser = $_SESSION['iduser'];
      
   		$query = persembleDB::getInstance()->add_item($iduser, $iidcategory, $iidescription, $ibrand, $icolor, $iquantity, $iseason, $imaterial);
   	} else {
   		header('Location: index.php');
   	}
   	
?>