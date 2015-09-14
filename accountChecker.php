<?php
require_once("database/database.php");

if(isset($_POST['action']) && $_POST['action'] == 'login'){ // Check the action `login`
	$email 			= htmlentities($_POST['emailusername']); // Get the emailusername
	$password 		= htmlentities($_POST['loginpassword']); // Get the loginpassword 
	$encrypted_password = persembleDB::getInstance()->encrypt($password); // and encrypt it and check database
		
	$query = persembleDB::getInstance()->get_user_count($email, $encrypted_password); // Check the table with posted credentials
	
	// Get the number of rows, if user doesn't exist, then it returns 0, if they exist, then it returns a 1
	
 	$num_rows = $query->fetchColumn(); 

	if($num_rows == 0) { // If no users exist with posted credentials print 0 like below.
		echo 0;
	} else {
		// Get the user information
		
	   $result = persembleDB::getInstance()->get_user($email, $encrypted_password);
	   
	   // Set the SESSION variables
		// NOTE : We have already started the session in the database.php
		
		$row = $result->fetch(PDO::FETCH_ASSOC);
		
		$_SESSION['iduser'] 		= $row['iduser'];
		$_SESSION['first_name'] 	= $row['first_name'];
		$_SESSION['last_name'] 	= $row['last_name'];
		$_SESSION['email'] 	= $row['email'];
		$_SESSION['password'] 	= $row['password'];
		
		$_SESSION['is_logged_on'] = 1;
		
		echo 1;
	}
} else {
	header('Location: index.php');	
}
?>