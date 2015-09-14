<?php
require_once("database/database.php");

if(isset($_SESSION['iduser']) == false || $_SESSION['iduser'] == ''){ // Redirect to secured index page if user not logged in
	echo '<script type="text/javascript">window.location = "index.php"; </script>';
}

//Fetching Values from URL  
$lname=$_POST['lname1'];
$fname=$_POST['fname1'];
$email=$_POST['email1'];
$password= $_POST['password1'];  
$encrypted_password = persembleDB::getInstance()->encrypt($password); // and encrypt it and check database

// if email not set, return back to myAccount.php	   
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
   // get the session iduser
   
   $iduser = $_SESSION['iduser'];

	// Insert query 
		
	$query = persembleDB::getInstance()->update_user($iduser, $lname, $fname, $email, $encrypted_password);
	   

	if ($query==1) {	
		// now update all the session variables except iduser

		$_SESSION['first_name'] 	= $fname;
		$_SESSION['last_name'] 	= $lname;
		$_SESSION['email'] 	= $email;
		$_SESSION['password'] 	= $encrypted_password;
	} 
}
?>