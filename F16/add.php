<?php
     
    require 'db.php';
	
	// $nameError = null;
    // $didError = null;
 
    if ( !empty($_POST)) {
        // keep track validation errors
        $nameError = null;
        $didError = null;
         
        // keep track post values
        $name = $_POST['name'];
        $did = $_POST['did'];
		$name = filter_var($name, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
		$did = filter_var($did, FILTER_SANITIZE_NUMBER_INT);
		
		$name = preg_replace('/[^a-z0-9]/i', '', $name);
		$did = preg_replace('/[^a-z0-9]/i', '', $did);
         
        // validate input
        $valid = true;
        if (empty($name)) {
            $nameError = 'Please enter Name';
            $valid = false;
        }
         
        if (empty($did)) {
            $didError = 'Please enter a valid Department Id Number';
            $valid = false;
        }
		

        // insert data
        if ($valid) {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO Student (name,did) values(?, ?)";
            $q = $pdo->prepare($sql);
			//Sanitize checks
			// I do a double filter to ensure the input is sanitized, and then also sanitize the input into the database.
			$q->bindParam(':name', $name, PDO::PARAM_STR);
			$q->bindParam(':did', $did, PDO::PARAM_INT);
            $q->execute(array($name,$did));
            Database::disconnect();
            header("Location: index.php");
        }
    }
?>


<!DOCTYPE html>
<html>
  <head>
  	<meta charset="utf-8">
    <title>DB</title>
    <link rel="stylesheet" type="text/css"
      href="http://yegor256.github.io/tacit/tacit.min.css"/>
  </head>
  <body>
    <section>
    	<h1>Add A Student</h1>
    	
    	<form action="add.php" method="post">
    		<div>
    			<label>Name</label>
    			<input name="name" type="text" placeholder="Name" value="<?php echo !empty($name)?$name:'';?>">
    			<!-- <p><?php if($nameError != null){ echo $nameError; }?></p> -->
    			<p><?php if (!empty($nameError)):
                   echo $nameError;
                endif; ?></p>
    		</div>
    		<div>
    			<label>Department ID</label>
    			<input name="did" type="text" placeholder="Valid Integer" value="<?php echo !empty($did)?$did:'';?>">
    			<p><?php if (!empty($didError)):
                   echo $didError;
                endif; ?></p>
    		</div>
    		<div>
              <button type="submit">Add</button>
              <a href="index.php">Back</a>
            </div>
    	</form>
    	
    </section>
 
 

 
 </body>
</html>