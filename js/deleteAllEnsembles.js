$(document).ready(function(){

$("#deleteAllEnsembles").click(function(){

		  // ask user to confirm delete
		  
		  var response = confirm("Do you really want to delete all the Ensembles?");
		
		  // only delete if response is true
		  
		  if (response == true) {
						window.location.href = 'deleteAllEnsembles.php';
		  }  	   	   	
	
	});

});
