<?php
require_once("database/database.php");

// check to see if user is logged in, if not redirect to index.php
if(isset($_SESSION['is_logged_on'])!=true || $_SESSION['is_logged_on'] != 1){ // Redirect to index.php if user not logged in
	header('Location: index.php');
}

		// Fetching Values from URL 
	   $idensembles=$_POST['idensembles'];
	   $iditems=$_POST['iditems'];
	   
// check idensembles to see if this page opened by the proper webpage, if not return to index.php
if ($idensembles=="") {
	header('Location: index.php');
}
	
		if ($idensembles!="") {
      	$iduser = $_SESSION['iduser'];
      
   		$query = persembleDB::getInstance()->add_item_to_ensemble($idensembles, $iditems);
   		
   		// Set the session variable so that items.php can show add to ensembles
   		   		
   		$_SESSION['ensembleId'] = $idensembles;	
   		
   	} else {
			// reset the session variable
			
			$_SESSION['ensembleId'] = "";   	
   	}
   	
   	// reload the items.php page  
   	header('Location: items.php');
?>