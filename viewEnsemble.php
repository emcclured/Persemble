<?php
require_once("database/database.php");

if(isset($_SESSION['iduser']) == false || $_SESSION['iduser'] == ''){ // Redirect to secured index page if user not logged in
	echo '<script type="text/javascript">window.location = "index.php"; </script>';
}

//Fetching Values from URL to see if this page was called by ensemble.php or directly.  note: used later
$idensembles=$_POST['idensembles'];

//if posted idensembles is "" then check the session variable

if ($idensembles=="") {
	if ($_SESSION['viewEnsembleId']!="") {
		$idensembles=$_SESSION['viewEnsembleId'];
	}
}
?>

﻿<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="icon" type="image/ico" href="photos/heartIcon.ico"/>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>Persemble-View Ensemble</title>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script type="text/javascript" src="js/deleteAllEnsembles.js"></script>
<script type="text/javascript" src="js/addNewEnsemble.js"></script>

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
		<li class="first"><a href="main.php">Main</a></li>
		<li><a href="ensemble.php">Ensemble</a></li>
		<li><a href="items.php">Item</a></li>
		<li><a href="categories.php">Category</a></li>
		<li><a href="myAccount.php">my Account</a></li>
		<li><a href="logout.php">Logout</a></li>
	</ul>
</div>

<div id="wrapper">

<!--Content Location for Page-->
<div class="box4">
	<img src="photos/heart-plain.jpg" alt="Heart Icon" style="width:50px;height:50px;padding-top: 20px; padding-bottom: 20px; padding-left: 200px" ></img>

            <?php
            
            $t_iduser = $_SESSION['iduser'];
				$result = persembleDB::getInstance()->get_ensemble_name($t_iduser, $idensembles);
				$row = $result->fetch(PDO::FETCH_ASSOC);
				$ensembleName = $row['name'];
				
				echo "</br>";
				echo "<h4 style=\"padding-left: 200px\"> $ensembleName Ensemble </h4>";
				echo "</br>";
				?>

	<fieldset>
	
        <table border="black">
               <th>description</th>
					<th>brand</th>
					<th>color</th>
					<th>Quantity</th>
					<th>season</th>
					<th>material</th>
					<th>category</th>
					<th>comments</th>
					<th>subcat type</th>
					<th>subcat name</th>
                
            <?php
            
            $t_iduser = $_SESSION['iduser'];
 
             // get all ensembles
                  
           	 $result = persembleDB::getInstance()->get_all_items_in_an_ensemble($idensembles);
           	 
             while ($row = $result->fetch(PDO::FETCH_ASSOC)):
                echo "<tr><td>" . htmlentities($row['description']) . "</td>";
                echo "<td>" . htmlentities($row['brand']) . "</td>";
                echo "<td>" . htmlentities($row['color']) . "</td>";
                echo "<td>" . htmlentities($row['quantity']) . "</td>";
                echo "<td>" . htmlentities($row['season']) . "</td>";
                echo "<td>" . htmlentities($row['material']) . "</td>";
                echo "<td>" . htmlentities($row['category_name']) . "</td>";
                echo "<td>" . htmlentities($row['comments']) . "</td>";
                echo "<td>" . htmlentities($row['subcategory_type']) . "</td>";
                echo "<td>" . htmlentities($row['subcategory_name']) . "</td>";
 
                // set variable $id to the retrieved database id
                $iditems = $row['iditems'];
                ?>  
                <td>
                    <form name="deleteItemFromEnsemble" action="deleteItemFromEnsemble.php" method="POST">
                    		<input type="hidden" name="idensembles" value="<?php echo $idensembles; ?>"/>
                        <input type="hidden" name="iditems" value="<?php echo $iditems; ?>"/>
                        <input type="submit" name="deleteItemFromEnsemble" value="Delete" style="text-decoration: underline"/>
                    </form>
                </td> 
                <?php
                echo "</tr>\n";
            endwhile;
            ?>             
        </table>
              
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
