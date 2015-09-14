$(document).ready(function(){

$("#addNewCategory").click(function(){

	var tc_categoryname = $("#c_categoryname").val();
	var tc_comments = $("#c_comments").val();
	var tc_subcategorytype = $("#c_subcategorytype").val();
	var tc_subcategoryname = $("#c_subcategoryname").val();

	if (tc_categoryname == '' || tc_comments == '' || tc_subcategorytype == '' || tc_subcategoryname == '' )
		{
		   alert("Please fill in All the Fields....");
		}	
	else 
	   {
	     
	     $.post("addNewCategory.php",{tc_categoryname1: tc_categoryname, tc_comments1: tc_comments, tc_subcategorytype1: tc_subcategorytype, tc_subcategoryname1: tc_subcategoryname},
		  function(data) {
		   	location.reload(); 
		   });

	   }
	
	});

});
