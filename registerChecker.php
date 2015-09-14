<?php
require_once("database/database.php");

//Fetching Values from URL  
$lname=$_POST['lname1'];
$fname=$_POST['fname1'];
$email=$_POST['email1'];
$password= $_POST['password1'];  
$registrationAttempt=$_POST['registrationAttempt'];
$encrypted_password = persembleDB::getInstance()->encrypt($password); // and encrypt it and check database

// if $registrationAttempt not set, return back to index.php	   
if($registrationAttempt!=1) {
	header('Location: index.php');
}

// check if e-mail address syntax is valid or not
$email = filter_var($email, FILTER_SANITIZE_EMAIL); // sanitizing email(Remove unexpected symbol like <,>,?,#,!, etc.)

if (!filter_var($email, FILTER_VALIDATE_EMAIL))
{
    echo "Invalid Email....";
}
else
{    
   $result = persembleDB::getInstance()->get_user_count($email, $encrypted_password); // Check the table with posted credentials

	// Get the number of rows, if user doesn't exist, then it returns 0, if they exist, then it returns a 1
	
	$num_rows = $result->fetchColumn(); 
	        
	if($num_rows == 0)
   {
		// Insert query 
		
	   $query = persembleDB::getInstance()->insert_user($lname, $fname, $email, $encrypted_password);
	   
		// Now get the user information to get unique iduser number
		
	   $result = persembleDB::getInstance()->get_user($email, $encrypted_password);
	   
	   // Set the SESSION variables
		// NOTE : We have already started the session in the database.php
		
		$row = $result->fetch(PDO::FETCH_ASSOC);
		
		$_SESSION['iduser'] 		= $row['iduser'];
		$_SESSION['first_name'] 	= $row['first_name'];
		$_SESSION['last_name'] 	= $row['last_name'];
		$_SESSION['email'] 	= $row['email'];
		$_SESSION['password'] 	= $row['password'];
	}
	else
	{
		echo "This email is already registered, Please try another email...";
	}  
}
?>