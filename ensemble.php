<?php
require_once("database/database.php");

if(isset($_SESSION['iduser']) == false || $_SESSION['iduser'] == ''){ // Redirect to secured index page if user not logged in
	echo '<script type="text/javascript">window.location = "index.php"; </script>';
}
?>

﻿<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="icon" type="image/ico" href="photos/heartIcon.ico"/>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>Persemble-Ensemble</title>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script type="text/javascript" src="js/deleteAllEnsembles.js"></script>
<script type="text/javascript" src="js/addNewEnsemble.js"></script>
<script type="text/javascript" src="js/menuBarHighlight.js"></script>


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

<!--Navigation tabs-->
<div class="navBar">
	<ul>
	   <li><a href="main.php">Main</a></li>
		<li class="highlight"><a href="ensemble.php">Ensemble</a></li>
		<li><a href="items.php">Item</a></li>
		<li><a href="categories.php">Category</a></li>
		<li><a href="myAccount.php">my Account</a></li>
		<li><a href="logout.php">Logout</a></li>
	</ul>
</div>

<div id="wrapper">

<!--Content Location for Page-->
<div class="box2">
	<img src="photos/heart-plain.jpg" alt="Heart Icon" style="width:50px;height:50px;padding-top: 20px; padding-bottom: 20px; padding-right: 20px" ></img>
		<fieldset>
    	   <!-- create the pull down list form -->
    	  <form method="POST">
        
        <!-- make a selection pull down form named ensembleFilter 
             auto POST the result on any changes -->
             
        <select name="ensembleFilter"  onchange="this.form.submit();">
        
        <!-- print out "Please Select Option..." on the pull down menu -->
        
        <option selected="selected">Please Select Option...</option> 
         
        <-- dynamically create the pull down option items from the 
            categories from the database -->
            
        <?php
        		// get database result from get_categories function
        		
        		$t_iduser = $_SESSION['iduser'];
		  
    	 		$result = persembleDB::getInstance()->get_all_ensembles($t_iduser);

				// build the option pulldown menu			
   		   
     			foreach($result as $name) { 
      			 echo'<option value="'. $name['name'] .'">'. $name['name'] .'</option>'; 
    			} 
    			
    			// add the All Ensembles option to the option menu
    			
    			echo'<option value="All Ensembles">All Ensembles</option>';
        
        ?> 
              
        </select>   
        
        </form>
                
        <?php
            // set the $nameFilter variable from the selection above that was POSTED
                     
        		$nameFilter = $_POST['ensembleFilter'];
        		
        		// if $nameFilter is not set, check $_SESSION['ensembleFilter'] to see
        		// the value was saved off there
        		
        		if ($nameFilter == "" ) {
        			
        			// if session has value, then set the $nameFilter variable to it
        			
        		   if ($_SESSION['ensembleNameFilter']!="") {
        		      $nameFilter = $_SESSION['ensembleNameFilter'];
        		   }      		
        		} else {
        			// if $nameFilter variable is set, save it off session variable for future use
        			
				   $_SESSION['ensembleNameFilter'] = $nameFilter;
				}
				
				// print out the the pulldown menu selection
				echo "</br>";
				echo "<p>" . $nameFilter . "</p>";
				echo "</br>";
        ?>	  
    	  
        <table border="black">
        			 <th>id</th>
                <th>name</th>
                
            <?php
             if ($nameFilter == "All Ensembles" || $nameFilter == "") {            
               // if $nameFilter is "All Ensembles" or not set, then
               // get all ensembles
                  
           		$result = persembleDB::getInstance()->get_all_ensembles_with_duplicates($t_iduser);
           	 } else {
           	 	// else get the filtered by name results
           	 	
            	$result = persembleDB::getInstance()->get_ensembles_by_name($t_iduser, $nameFilter);
             }
            
             while ($row = $result->fetch(PDO::FETCH_ASSOC)):
                echo "<tr><td>" . htmlentities($row['idensembles']) . "</td>";
                echo "<td>" . htmlentities($row['name']) . "</td>";
                // set variable $id to the retrieved database id
                $idensembles = $row['idensembles'];
                ?>
                <td>
                    <form name="Add Item" action="items.php" method="POST">
                        <input type="hidden" name="idensembles" value="<?php echo $idensembles; ?>"/>
                        <input type="submit" name="addItem" value="Add Item" style="text-decoration: underline"/>
                    </form>
                </td>
                <td>
                    <form name="View Ensemble" action="viewEnsemble.php" method="POST">
                        <input type="hidden" name="idensembles" value="<?php echo $idensembles; ?>"/>
                        <input type="submit" name="viewEnsemble" value="View Ensemble" style="text-decoration: underline"/>
                    </form>
                </td>
                <td>
                    <form name="deleteEnsemble" action="deleteEnsemble.php" method="POST">
                        <input type="hidden" name="idensembles" value="<?php echo $idensembles; ?>"/>
                        <input type="submit" name="deleteEnsemble" value="Delete" style="text-decoration: underline"/>
                    </form>
                </td>
                <?php
                echo "</tr>\n";
            endwhile;
            ?>
        </table>
 		   <form action="" method="get">
 		   	<br/>
 		  		<label>Ensemble Name: </label>
 		  		<input type="text" name="e_name" id="e_name"/>
 		  		<br/>
 		  		<br/>
 				<input type="button" name="addNewEnsemble" id="addNewEnsemble" value="Add New Ensemble"/>
 		  </form>
			<br/>
 		   <form action="" method="get">
 				<input type="button" name="deleteAllEnsembles" id="deleteAllEnsembles" value="Delete All Ensembles" style="background: #1E222E"/>
 		  </form>
              
	</fieldset>	
	
</div>


<br />
<hr />

<!--footer section-->
<div class="footer">
	<p>The content of this web site is copyright © TBD 2015. All rights expressly reserved.</p> 
</div>

</div>
</body>
</html>
