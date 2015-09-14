$(document).ready(function(){

$("#register").click(function(){

	var lname = $("#lname").val();
	var fname = $("#fname").val();
	var email = $("#email").val();
	var password = $("#password").val();
	var cpassword = $("#cpassword").val();
	
	if( lname =='' || fname == '' || email =='' || password =='' || cpassword =='')
		{
		  alert("Please fill all fields....");
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
	     $.post("registerChecker.php",{lname1: lname, fname1: fname, email1: email, password1:password, registrationAttempt:1},
		  function(data) {
		   	alert(data);
		   	window.location.href = 'index.php';
		   });
	   }
	
	});

});
