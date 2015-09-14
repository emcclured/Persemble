$(document).ready(function(){

$("#addNewEnsemble").click(function(){

	var e_name = $("#e_name").val();
	
	if (e_name == '')
		{
		   alert("Please fill in New Ensemble Name....");
		}	
	else 
	   {
	     $.post("addNewEnsemble.php",{e_name1: e_name},
		  function(data) {
		   	location.reload(); 
		   });
	   }
	
	});

});
