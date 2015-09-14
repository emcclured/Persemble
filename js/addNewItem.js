$(document).ready(function(){

$("#addNewItem").click(function(){

	var iidcategory = $("#id_category").val();
	var idescription = $("#i_description").val();
	var ibrand = $("#i_brand").val();
	var icolor = $("#i_color").val();
	var iquantity = $("#i_quantity").val();
	var iseason = $("#i_season").val();
	var imaterial = $("#i_material").val();
	
	if (iidcategory == '' || idescription == '' || ibrand == '' || icolor == '' || iquantity == '' || iseason == '' || imaterial == '') 
		{
			if (iidcategory == '' ) {
				alert("Please Choose a Category from the Pulldown Menu....");
			} else {
		   	alert("Please fill in All Item fields....");
		   }
		}	
	else 
	   {
	   	
	     $.post("addNewItem.php"
	     ,{iidcategory1: iidcategory, idescription1: idescription, ibrand1: ibrand, icolor1: icolor, iquantity1: iquantity, iseason1: iseason, imaterial1: imaterial},
		  function(data) {
		   	location.reload(); 
		   });
		   
	   } 

	});

});
