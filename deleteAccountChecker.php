<?php
require_once("database/database.php");

//Fetching Values from URL 
$lname=$_POST['lname1'];
$fname=$_POST['fname1'];
$email=$_POST['email1'];
$password= $_POST['password1'];  
$encrypted_password = persembleDB::getInstance()->encrypt($password); // and encrypt it and check database

// if $deleteAccountAttempt not set, return back to index.php	   
if($email=="") {
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
      $iduser = $_SESSION['iduser'];
      
   	persembleDB::getInstance()->delete_user($iduser);
		
		// now reset session variable values
		
		$_SESSION['iduser'] 		= "";
		$_SESSION['first_name'] 	= "";
		$_SESSION['last_name'] 	= "";
		$_SESSION['email'] 	= "";
		$_SESSION['password'] 	= "";
		
		echo "You have Successfully Deleted the Account....";
}
?>