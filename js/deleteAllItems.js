$(document).ready(function(){

$("#deleteAllItems").click(function(){

		  // ask user to confirm delete
		  
		  var response = confirm("Do you really want to delete all Items?");
		
		  // only delete if response is true
		  
		  if (response == true) {
						window.location.href = 'deleteAllItems.php';
		  }  	   	   	
	
	});

});
