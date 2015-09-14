<?php
require_once("database/database.php");

if(isset($_SESSION['iduser']) == false || $_SESSION['iduser'] == ''){ // Redirect to secured index page if user not logged in
	echo '<script type="text/javascript">window.location = "index.php"; </script>';
}

		//Fetching Values from URL 
		$idensembles=$_POST['idensembles'];
	   $iditems=$_POST['iditems'];
      
      if ($idensembles!="" && $iditems!="") {
   		$query = persembleDB::getInstance()->delete_item_from_ensemble($idensembles, $iditems);
   	
   		// set the session variable so that the viewEnsemble.php can reload properly
   		
   		$_SESSION['viewEnsembleId'] = $idensembles;	
   	} else {
   		header('Location: index.php');
   	}
   	
   	// reload the ensemble.php page  
   	header('Location: viewEnsemble.php');
?>