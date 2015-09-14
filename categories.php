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
<title>Persemble-Categories</title>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script type="text/javascript" src="js/deleteAllCategories.js"></script>
<script type="text/javascript" src="js/addNewCategory.js"></script>

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
		<li class="highlight"><a href="categories.php">Category</a></li>
		<li><a href="myAccount.php">my Account</a></li>
		<li><a href="logout.php">Logout</a></li>
	</ul>
</div>

<div id="wrapper">

<!--Content Location for Page-->
<div class="box2">
	<img src="photos/ryanlerch-white-t-shirt.png" alt="Shirt Icon" style="width:75px;height:45px;padding-top: 20px; padding-bottom: 20px; padding-right: 20px"/>

	<fieldset>
  
        <table border="black">
        			 <th>id</th>
                <th>name</th>
                <th>comments</th>
                <th>subcategory type</th>
                <th>subcategory name</th>
                
            <?php
            
             $t_iduser = $_SESSION['iduser'];
                  
           	 $result = persembleDB::getInstance()->get_all_categories_with_duplicates($t_iduser);
            
             while ($row = $result->fetch(PDO::FETCH_ASSOC)):
                echo "<tr><td>" . htmlentities($row['idcategory']) . "</td>";
                echo "<td>" . htmlentities($row['category_name']) . "</td>";
                echo "<td>" . htmlentities($row['comments']) . "</td>";
                echo "<td>" . htmlentities($row['subcategory_type']) . "</td>";
                echo "<td>" . htmlentities($row['subcategory_name']) . "</td>";
                
                // set variable $id to the retrieved database id
                $idcategory = $row['idcategory'];
                ?>
                <td>
                    <form name="deleteCategory" action="deleteCategory.php" method="POST">
                        <input type="hidden" name="idcategory" value="<?php echo $idcategory; ?>"/>
                        <input type="submit" name="deleteCategory" value="Delete" style="text-decoration: underline"/>
                    </form>
                </td>
                <?php
                echo "</tr>\n";
            endwhile;
            ?>
        </table>
        		</br>
 		  		</br>
 		   <form action="" method="get">
 		  		<label>Category Name: </label>
 		  		<input type="text" name="c_categoryname" id="c_categoryname"/>
 		  		</br>
 		  		</br>
 		  		<label>Comment: </label>
 		  		<input type="text" name="c_comments" id="c_comments"/>
 		  		</br>
 		  		</br>
 		  		<label>Subcategory Type: </label>
 		  		<input type="text" name="c_subcategorytype" id="c_subcategorytype"/>
 		  		</br>
 		  		</br>
 		  		<label>Subcategory Name: </label>
 		  		<input type="text" name="c_subcategoryname" id="c_subcategoryname"/>
 		  		</br>
 		  		</br>
 				<input type="button" name="addNewCategory" id="addNewCategory" value="Add New Category"/>
 		  </form>
			
			<br/>
			<br/>
 		   <form action="" method="get">
 				<input type="button" name="deleteAllCategories" id="deleteAllCategories" value="Delete All Categories" style="background: #1E222E">
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
