$(document).ready(function(){

$("#deleteAccount").click(function(){

	var lname = $("#ac_lname").val();
	var fname = $("#ac_fname").val();
	var email = $("#ac_email").val();
	var password = $("#ac_password").val();
	var cpassword = $("#ac_cpassword").val();
	

	
	if( lname =='' || fname == '' || email =='' || password =='' || cpassword =='')
		{	  
		  if (cpassword == '') {
		     alert("Please fill in the Password and Confirm Password");
		  } else {
		  	  alert("Please fill all fields....");
		  }
		}	
	else if((password.length)<8)
		{
			alert("Password should at least 8 character in length....");
		}
		
	else if(!(password).match(cpassword))
		{
			alert("Your passwords don't match. Try again.");
		} 
	
	else 
	   {    
		  // ask user to confirm delete
		  
		  var response = confirm("Do you really want to delete this account?");
		
		  // only delete if response is true
		  
		  if (response == true) {
    			$.post("deleteAccountChecker.php",{lname1: lname, fname1: fname, email1: email, password1:password},
		  		function(data) {
		   			alert(data);
						window.location.href = 'index.php';
 				   });
			}  	   	   	

	   }
	
	});

});
