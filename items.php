<?php
require_once("database/database.php");

if(isset($_SESSION['iduser']) == false || $_SESSION['iduser'] == ''){ // Redirect to secured index page if user not logged in
	echo '<script type="text/javascript">window.location = "index.php"; </script>';
}

//Fetching Values from URL to see if this page was called by ensemble.php or directly.  note: used later
$idensembles=$_POST['idensembles'];
?>

﻿<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="icon" type="image/ico" href="photos/heartIcon.ico"/>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Persemble-Items</title>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script type="text/javascript" src="js/deleteAllItems.js"></script>
<script type="text/javascript" src="js/addNewItem.js"></script>

<link href="css/styles.css" rel="stylesheet" type="text/css" />
<style type="text/css">
	
</style>
</head>

<body>

<!--Title area at top-->
<div class="box1">
	<h1>Persemble</h1>
	<h6>{personal ensemble organizer}</h6>
</div>

<!--Navigation Link for Site-->
<div class="navBar"> 
	<ul>
		<li><a href="main.php">Main</a></li>
		<li><a href="ensemble.php">Ensemble</a></li>
		<li class="highlight"><a href="items.php">Item</a></li>
		<li><a href="categories.php">Category</a></li>
		<li><a href="myAccount.php">my Account</a></li>
		<li><a href="logout.php">Logout</a></li>
	</ul>
</div>

<div id="wrapper">

<!--Content Location for Page-->
<div class="box2">
	<img src="photos/remigho-hanger-1.png" alt="Hanger Icon" style="width:75px;height:45px;padding-top: 20px; padding-bottom: 20px; padding-right: 20px"/>

            <?php
            
            $t_iduser = $_SESSION['iduser'];
				$result1 = persembleDB::getInstance()->get_ensemble_name($t_iduser, $idensembles);
				$row1 = $result1->fetch(PDO::FETCH_ASSOC);
				$ensembleName = $row1['name'];
				
				echo "</br>";
				echo "<h4> Add Items to $ensembleName Ensemble </h4>";
				echo "</br>";
				
				?>

	<fieldset>   	            
        <table border="black">
        			 <th>id</th>
                <th>description</th>
                <th>brand</th>
                <th>color</th>
                <th>quantity</th>
                <th>season</th>
                <th>material</th>
                <th>category</h>
                
            <?php
             

				 $t_iduser = $_SESSION['iduser'];
				 
				 // if $idensembles called directly from ensemble.php, get the name of the ensemble
				 if ($idensembles!="") {		  
						$result2 = persembleDB::getInstance()->get_ensemble_name($t_iduser, $idensembles);
    	 		
    	 				$row2 = $result2->fetch(PDO::FETCH_ASSOC);
 
    	 				$ensemble_name = $row2['name'];
				 }

				 if ($idensembles!="" || $_SESSION['ensembleId']!="") {
				 	// check to see if $idensembles is "", if it is, set it
				 	// to the session variable
				 	
				 	if ($idensembles=="") {
				 		$idensembles=$_SESSION['ensembleId'];
				 	}
				 	
				    // filter out all items already in the ensemble
				    $result = persembleDB::getInstance()->get_items_not_in_ensemble($t_iduser, $idensembles);	
				 } else {
				 	 // get all items
                $result = persembleDB::getInstance()->get_items($t_iduser);
             }
             
             
             while ($row = $result->fetch(PDO::FETCH_ASSOC)):
                echo "<tr><td>" . htmlentities($row['iditems']) . "</td>";
                echo "<td>" . htmlentities($row['description']) . "</td>";
                echo "<td>" . htmlentities($row['brand']) . "</td>";
                echo "<td>" . htmlentities($row['color']) . "</td>";
                echo "<td>" . htmlentities($row['quantity']) . "</td>";
                echo "<td>" . htmlentities($row['season']) . "</td>";
                echo "<td>" . htmlentities($row['material']) . "</td>";
                
                // get the category name for this item
                
                $category_idcategory = $row['category_idcategory'];
                
                $result3 = persembleDB::getInstance()->get_category_name($t_iduser, $category_idcategory);
                
                $row3 = $result3->fetch(PDO::FETCH_ASSOC);
                
                $result_category_name = $row3['category_name'];
                
                echo "<td>" . htmlentities($result_category_name) . "</td>";
                
                // set variable $id to the retrieved database id
                $iditem = $row['iditems'];
                
                // check if posted idesembles or session variable ensembleId is set
                // if so, display the add item to ensemble option
                
                if ($idensembles!="" || $_SESSION['ensembleId']!="") {
                ?>
                <td>
                    <form name="Add Item to Ensemble" action="addItemToEnsemble.php" method="POST">
                    		<input type="hidden" name="idensembles" value="<?php echo $idensembles; ?>"/>
                        <input type="hidden" name="iditems" value="<?php echo $iditem; ?>"/>
                        <input type="submit" name="addItem" value="Add Item to Ensemble" style="text-decoration: underline"/>
                    </form>
                </td>
                <?php
                }
                ?>
                <td>
                    <form name="deleteItem" action="deleteItem.php" method="POST">
                        <input type="hidden" name="iditem" value="<?php echo $iditem; ?>"/>
                        <input type="submit" name="deleteItem" value="Delete" style="text-decoration: underline"/>
                    </form>
                </td>
                <?php
                echo "</tr>\n";
            endwhile;
            ?>
        </table>
        
	    <br/>

         <!-- description, brand, color, quantity, season, material  -->
        
	    	   <!-- create the pull down list form -->
    	  <form method="POST">
        
        <!-- make a selection pull down form named categoryFilter 
             auto POST the result on any changes -->
             
        <select name="categoryFilter"  onchange="this.form.submit();">
        
        <!-- print out "Please Select Option..." on the pull down menu -->
        
        <option selected="selected">Please Select Category...</option> 
         
        <-- dynamically create the pull down option items from the 
            categories from the database -->
            
        <?php
        		// get database result from get_categories function
        		
        		$t_iduser = $_SESSION['iduser'];
		  
    	 		$result4 = persembleDB::getInstance()->get_all_categories_with_duplicates($t_iduser);

				// build the option pulldown menu			
   		   
     			foreach($result4 as $name) { 
      			 echo'<option value="'. $name['category_name'] .'">'. $name['category_name'] .'</option>'; 
      			 
    			}     
        ?> 
         
        </select>   
        
        </form>
                
        <?php
            // set the $nameFilter variable from the selection above that was POSTED
                     
        		$nameFilter = $_POST['categoryFilter'];
        		
        		// if $nameFilter is not set, check $_SESSION['categoryFilter'] to see
        		// the value was saved off there
        		
        		if ($nameFilter == "" ) {
        			
        			// if session has value, then set the $nameFilter variable to it
        			
        		   if ($_SESSION['categoryNameFilter']!="") {
        		      $nameFilter = $_SESSION['categoryNameFilter'];
        		   }      		
        		} else {
        			// if $nameFilter variable is set, save it off session variable for future use
        			
				   $_SESSION['categoryNameFilter'] = $nameFilter;
				}
				
				// print out the the pulldown menu selection
				echo "</br>";
				echo "<p>" . $nameFilter . "</p>";
				echo "</br>";
        ?>        
        
        <?php
        		// get the category id from the nameFilter and iduser
        		
        		$t_iduser = $_SESSION['iduser'];
		  
				$result5 = persembleDB::getInstance()->get_category_id($t_iduser, $nameFilter);
    	 		
    	 		$row5 = $result5->fetch(PDO::FETCH_ASSOC);
 
    	 		$id_category = $row5['idcategory'];
        ?>
        
 		   <form action="" method="get">
 		   	<br/>
		      <input type="hidden" name="id_category" id="id_category" value="<?php echo $id_category; ?>"/> 
 		  		<label>Description: </label>
 		  		<input type="text" name="i_description" id="i_description">
 		  		<br/>
 		  		<br/>
 		  		<label>Brand: </label>
 		  		<input type="text" name="i_brand" id="i_brand">
 		  		<br/>
 		  		<br/>
 		  		<label>Color: </label>
 		  		<input type="text" name="i_color" id="i_color">
 		  		<br/>
 		  		<br/>
 		  		<label>Quantity: </label>
 		  		<input type="text" name="i_quantity" id="i_quantity">
 		  		<br/>
 		  		<br/>
 		  		<label>Season: </label>
 		  		<input type="text" name="i_season" id="i_season">
 		  		<br/>
 		  		<br/>
 		  		<label>Material: </label>
 		  		<input type="text" name="i_material" id="i_material">
 		  		<br/>
 		  		<br/>
 				<input type="button" name="addNewItem" id="addNewItem" value="Add New Item">
 		  </form>
			
			<br/>
			<br/>
 		   <form action="" method="get">
 				<input type="button" name="deleteAllItems" id="deleteAllItems" value="Delete All Items" style="background: #1E222E">
 		  </form>
              
	</fieldset>	

</div>

<?php               
  // now clear the session variable ensembleId so that people see the add item to ensembles
  // without coming to this site thru the ensemble.php or from the addItemToEnsemble.php pages              
  $_SESSION['ensembleId']="";
?>

<br />
<br />
<br />
<br />
<hr />

<!--footer section-->
<div class="footer">
	<p>The content of this web site is copyright © TBD 2015. All rights expressly reserved.</p> 
</div>

</div>
</body>
</html>


