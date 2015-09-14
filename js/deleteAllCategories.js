$(document).ready(function(){

$("#deleteAllCategories").click(function(){

		  // ask user to confirm delete
		  
		  var response = confirm("Do you really want to delete all the Categories?");
		
		  // only delete if response is true
		  
		  if (response == true) {
						window.location.href = 'deleteAllCategories.php';
		  }  	   	   	
	
	});

});
