<?php
session_start();

class persembleDB {

    // make this class a single instance to share
    
    private static $instance = null;

    // private database connection variables

    private $user = "root";
    private $pass = "mcclured";
    private $dbName = "mcclured-db";
    private $dbHost = "localhost";

    // make this class static 
    
    public static function getInstance() {
        if (!self::$instance instanceof self) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    //  make this class unclonable and deserializable
    
    public function __clone() {
        trigger_error('Cannot Clone!', E_USER_ERROR);
    }

    public function __wakeup() {
        trigger_error('Cannot Deserialize!', E_USER_ERROR);
    }

    //  private constructor for use internally
    
    public function __construct()
    {
        try 
        { 
        		$this->instance = new PDO("mysql:host=$this->dbHost;dbname=$this->dbName", $this->user, $this->pass);
            $this->instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
        }
        catch (PDOException $e) 
        {
            die($e->getMessage());
        }
    }
    
    // public functions for use by others
    
    // function to encrypt a string
    
    public function encrypt($string){
		 return base64_encode(base64_encode(base64_encode($string)));
	 }

    // function to decrypt a string
    
	 public function decrypt($string){
		 return base64_decode(base64_decode(base64_decode($string)));
	 }
    
    // get the user information based on $email and $password
    
    public function get_user($email, $encrypted_password) {
    	return $this->instance->query("SELECT iduser, first_name, last_name, email, password FROM user WHERE email='" . $email . "' AND password='" . $encrypted_password . "'");
    }
    
    // get the count of of users with $email and $password.  for use in check to see if user exists.
    
    public function get_user_count($email, $encrypted_password) {
    	return $this->instance->query("SELECT COUNT(*) FROM user WHERE email='" . $email . "' AND password='" . $encrypted_password . "'");
    }
    
    // delete user
    
    public function delete_user($iduser){
      $this->instance->query("DELETE FROM user WHERE iduser=" . $iduser);  
    }
    
    // insert all user information into database
    
    public function insert_user($last_name, $first_name, $email, $password) {
            try { 
		  		$data = array('last_name' => $last_name,
                       'first_name' => $first_name,
                       'email' => $email, 
                       'password' => $password);
    	
		  		$sqlString = 'INSERT INTO user (last_name, first_name, email, password) VALUES (:last_name, :first_name, :email, :password)';

		  		$sql = $this->instance->prepare($sqlString);
		  					
		  		$sql->execute($data);
		  		
		  		if($sql)
				{
					echo "You have Successfully Registered....";	
					
			  		return 1;
				}
				else
				{	
					echo "There was an error in the database Registration attempt.  Please try again.";	
				
			  		return 0;
				}
		  		
		  } 
		  catch(PDOException $e) {
  				echo $e->getMessage();
  				
  				return 0;
		  }
    
    }
    
    // update user
    
        public function update_user($iduser, $last_name, $first_name, $email, $password) {
            try { 
		  		$data = array('last_name' => $last_name,
                       'first_name' => $first_name,
                       'email' => $email, 
                       'password' => $password,
                       'iduser' => $iduser);
    	
		  		$sqlString = 'UPDATE user SET last_name=:last_name, first_name=:first_name, email=:email, password=:password WHERE iduser=:iduser';

		  		$sql = $this->instance->prepare($sqlString);
		  					
		  		$sql->execute($data);
		  		
		  		if($sql)
				{
			  		echo "You have Successfully Updated User....";
			  		
			  		return 1;
				}
				else
				{
			  		echo "Error!  User Update Database Error....";   
			  		
			  		return 0;
				}
		  		
		  } 
		  catch(PDOException $e) {
  				echo $e->getMessage();
  				
  				return 0;
		  }
    
    }
    
    // get all ensembles based on iduser, no duplicates
    
    public function get_all_ensembles($user_iduser) {
    	return $this->instance->query("SELECT idensembles, name FROM ensembles WHERE user_iduser=" . $user_iduser . " GROUP BY 2 ORDER BY name ASC");
    }
    
   // get all ensembles based on iduser with duplicates
    
    public function get_all_ensembles_with_duplicates($user_iduser) {
    	return $this->instance->query("SELECT idensembles, name FROM ensembles WHERE user_iduser=" . $user_iduser);
    }
   
    // get all ensembles based on iduser and name
    
    public function get_ensembles_by_name($user_iduser, $name) {
    	return $this->instance->query("SELECT idensembles, name FROM ensembles WHERE user_iduser=" . $user_iduser . " AND name='" . $name . "'");
    }
    
    // get ensemble name based on iduser and idensembles
    
    public function get_ensemble_name($iduser, $idensembles) {
    	return $this->instance->query("SELECT name FROM ensembles WHERE user_iduser=" . $iduser . " AND idensembles='" . $idensembles . "'");
    }
    
    // delete ensemble based on idensemble
    
    public function delete_ensemble($idensembles) {
    	$this->instance->query("DELETE FROM ensembles WHERE idensembles=" . $idensembles);  
    }
    
    // delete all ensembles based on iduser

    public function delete_all_ensembles($user_iduser) {
    	$this->instance->query("DELETE FROM ensembles WHERE user_iduser=" . $user_iduser);  
    }    
    
	 // get all items in an ensemble based on $idensembles
	 
	 public function get_all_items_in_an_ensemble($idensembles) {

		$s1 = "SELECT items.iditems, items.description, items.brand, items.color, items.quantity, items.season, items.material, ";
		$s2 ="p_category.category_name, p_category.comments, p_category.subcategory_type, p_category.subcategory_name ";      
      $f = "FROM p_category ";
      $ij1 = "INNER JOIN items ON p_category.idcategory = items.category_idcategory ";
      $ij2 = "INNER JOIN ensemble_items ON items.iditems = ensemble_items.items_iditems ";
      $w = "WHERE ensemble_items.ensembles_idensembles = " . $idensembles;  
      
      $query_string = $s1 . $s2 . $f . $ij1 . $ij2 . $w;   
                   
	 	return $this->instance->query($query_string);
 
	 }  
	 
	 public function  delete_item_from_ensemble($idensembles, $iditems) {
	 	return $this->instance->query("DELETE FROM ensemble_items WHERE ensembles_idensembles = " . $idensembles . " AND items_iditems = " . $iditems);
	 }
    
	 // add ensemble based on iduser and name
	 
	 public function add_ensemble($user_iduser, $name) {
	 try { 
		  		$data = array('user_iduser' => $user_iduser,
                          'name' => $name);
    	
		  		$sqlString = 'INSERT INTO ensembles (user_iduser, name) VALUES (:user_iduser, :name)';

		  		$sql = $this->instance->prepare($sqlString);
		  					
		  		$sql->execute($data);
		  		
		  		if($sql)
				{
			  		echo "You have Successfully Added in an Ensemble....";
			  		
			  		return 1;
				}
				else
				{
			  		echo "Error!  Ensemble Entry Database Error....";   
			  		
			  		return 0;
				}
		  		
		  } 
		  catch(PDOException $e) {
  				echo $e->getMessage();
  				
  				return 0;
		  }
	 }
	 
	 // update ensemble
	 
	 	 public function update_ensemble($iduser, $name) {
	 try { 
		  		$data = array('iduser' => $iduser,
                          'name' => $name);
    	
		  		$sqlString = 'UPDATE ensembles SET name=:name WHERE user_iduser=:iduser)';

		  		$sql = $this->instance->prepare($sqlString);
		  					
		  		$sql->execute($data);
		  		
		  		if($sql)
				{
			  		echo "You have Successfully Updated an Ensemble....";
			  		
			  		return 1;
				}
				else
				{
			  		echo "Error!  Ensemble Update Database Error....";   
			  		
			  		return 0;
				}
		  		
		  } 
		  catch(PDOException $e) {
  				echo $e->getMessage();
  				
  				return 0;
		  }
	 }		  
	 
	 // get all categories with duplicates

	 public function get_all_categories_with_duplicates($iduser) {
		$s = "SELECT idcategory, category_name, comments, subcategory_type, subcategory_name "; 
      $f = "FROM p_category ";
      $w = "WHERE user_iduser = " . $iduser;  
      
      $query_string = $s . $f  . $w;   
                   
	 	return $this->instance->query($query_string);
	 }
	 
	 // get idcategory based on iduser and category_name
	 
	 public function get_category_id($iduser, $category_name) {
	 	$s = "SELECT idcategory "; 
      $f = "FROM p_category ";
      $w = "WHERE user_iduser = " . $iduser . " AND category_name = '" . $category_name . "'";  
      
      $query_string = $s . $f . $w;   
                   
	 	return $this->instance->query($query_string);
	 }
	 
	 // get all category names based on iduser with no duplicates
	 
	 public function get_all_category_names($iduser) {
	 	$s = "SELECT category.category_name "; 
      $f = "FROM p_category ";
      $ij1 = "INNER JOIN items ON p_category.idcategory = items.category_idcategory ";
      $ij2 = "INNER JOIN user ON items.user_iduser = user.iduser ";
      $w = "WHERE user.iduser = " . $iduser . " "; 
      $g = "GROUP BY 1 ORDER BY p_category.category_name ASC";
      
      $query_string = $s . $f . $ij1 . $ij2 . $w . $g;   
                   
	 	
	 	return $this->instance->query($query_string);
	 	 
	 }
	 
	 // get all categories based on category name
	 
	 public function get_categories_by_name($iduser, $categoryname) {
	 	$s = "SELECT category.category_name "; 
      $f = "FROM p_category ";
      $ij1 = "INNER JOIN items ON p_category.idcategory = items.category_idcategory ";
      $ij2 = "INNER JOIN user ON items.user_iduser = user.iduser ";
      $w = "WHERE user.iduser = " . $iduser . " AND p_category.category_name = " . $categoryname; 
      
      $query_string = $s . $f . $ij1 . $ij2 . $w;   
                   
	 	
	 	return $this->instance->query($query_string);
	 	 
	 }
	 
	 // get category name based on iduser, idcategory
	 
	 public function get_category_name($iduser, $idcategory) {
	 	$s = "SELECT category_name "; 
      $f = "FROM p_category ";
      $w = "WHERE user_iduser = " . $iduser . " AND idcategory = " . $idcategory; 
      
      $query_string = $s . $f . $w;   
                   
	 	return $this->instance->query($query_string);
	 }
	 
	 // add category
    
    public function add_category($category_name, $comments, $subcategorytype, $subcategoryname, $iduser) {
            try { 
		  		$data = array('category_name' => $category_name,
                       'comments' => $comments,
                       'subcategory_type' => $subcategorytype, 
                       'subcategory_name' => $subcategoryname,
                       'user_iduser' => $iduser);
 
		  		$sqlString = 'INSERT INTO p_category (category_name, comments, subcategory_type, subcategory_name, user_iduser) VALUES (:category_name, :comments, :subcategory_type, :subcategory_name, :user_iduser)';
                                                
		  		$sql = $this->instance->prepare($sqlString);
		  					
		  		$sql->execute($data);
		  		
		  		if($sql)
				{
			  		echo "You have Successfully Added a Category....";
			  		
			  		return 1;
				}
				else
				{
			  		echo "Error! Category Database Error....";   
			  		
			  		return 0;
				}
		  		
		  } 
		  catch(PDOException $e) {
  				echo $e->getMessage();
  				
  				return 0;
		  }
    
    }
    
    // delete all categories based on iduser
    
    public function delete_all_categories($user_iduser) {
    	$this->instance->query("DELETE FROM p_category WHERE user_iduser=" . $user_iduser);  
    }
    
    // delete category based on iduser and idcategory
    
    public function delete_category($idcategory) {
    	$this->instance->query("DELETE FROM p_category WHERE idcategory=" . $idcategory);  
    }
	 
	 // get all items based on iduser
	 
	 public function get_items($iduser) {
	 	//  iditems, description, brand, color, quantity, season, material, category_idcategory
	  	return $this->instance->query("SELECT iditems, description, brand, color, quantity, season, material, category_idcategory FROM items WHERE user_iduser = " . $iduser);
	 }
	 
	 // get all items based on iduser and not in given ensemble already
	 
	 public function get_items_not_in_ensemble($iduser, $idensemble) {
	 	//  iditems, description, brand, color, quantity, season, material, category_idcategory
	 	
	 	$s = "SELECT items.iditems, items.description, items.brand, items.color, items.quantity, items.season, items.material, items.category_idcategory "; 
      $f = "FROM items ";
      $lj = "LEFT JOIN ensemble_items ON items.iditems = ensemble_items.items_iditems ";
      $w1 = "WHERE (ensemble_items.ensembles_idensembles!=" . $idensemble . " ";
      $w2 = "OR ensemble_items.ensembles_idensembles IS NULL) ";
      $w3 = "AND items.user_iduser = " . $iduser;    

      $query_string = $s . $f . $lj . $w1 . $w2 . $w3;  
      
	  	return $this->instance->query($query_string);
	 }
	 
	 // add item
	     
	 public function add_item($iduser, $iidcategory, $idescription, $ibrand, $icolor, $iquantity, $iseason, $imateral) {
	         try { 
		  		$data = array('iduser' => $iduser,
                       'idcategory' => $iidcategory,
                       'description' => $idescription, 
                       'brand' => $ibrand,
                       'color' => $icolor,
                       'quantity' => $iquantity,
                       'season' => $iseason,
                       'material' => $imateral);
 
 				$i = "INSERT INTO  items(category_idcategory, description, brand, color, quantity, season, material, user_iduser) ";
 				$v = "VALUES (:idcategory, :description, :brand, :color, :quantity, :season, :material, :iduser)";
		  		$sqlString = $i . $v;
                                                
		  		$sql = $this->instance->prepare($sqlString);
		  					
		  		$sql->execute($data);
		  		
		  		if($sql)
				{
			  		echo "You have Successfully Added a Item....";
			  		
			  		return 1;
				}
				else
				{
			  		echo "Error! Item Database Error....";   
			  		
			  		return 0;
				}
	  		
		  } 
		  catch(PDOException $e) {
  				echo $e->getMessage();
  				
  				return 0;
		  }
	 
	 }	   
	 
	 // delete all items based on iduser
    
    public function delete_all_items($user_iduser) {
    	$this->instance->query("DELETE FROM items WHERE user_iduser=" . $user_iduser);  
    }
    
    // delete item based on iditem
    
    public function delete_item($iditem) {
    	$this->instance->query("DELETE FROM items WHERE iditems=" . $iditem);  
    }  
    
    // add item to ensemble
    
    public function add_item_to_ensemble($idensembles, $iditems) {
 	         try { 
		  		$data = array('idensembles' => $idensembles,
                       'iditems' => $iditems);                   
 
 				$i = "INSERT INTO ensemble_items (ensembles_idensembles, items_iditems) ";
 				$v = "VALUES (:idensembles, :iditems)";
		  		$sqlString = $i . $v;
                                                
		  		$sql = $this->instance->prepare($sqlString);
		  					
		  		$sql->execute($data);
		  		
		  		if($sql)
				{
			  		echo "You have Successfully Added a Item to The Ensemble....";
			  		
			  		return 1;
				}
				else
				{
			  		echo "Error! Item Ensemble Database Error....";   
			  		
			  		return 0;
				}
	  		
		  } 
		  catch(PDOException $e) {
  				echo $e->getMessage();
  				
  				return 0;
		  }
	    	
    }
}
?>