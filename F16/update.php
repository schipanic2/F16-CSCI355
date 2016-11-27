<?php
    require 'db.php';
 
    $id = null;
    if ( !empty($_GET['id'])) {
        $id = $_REQUEST['id'];
    }
     
    if ( null==$id ) {
        header("Location: index.php");
    }
     
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
         
        // update data
        if ($valid) {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE Student  set name = ?, did = ? WHERE id = ?";
            $q = $pdo->prepare($sql);
            $q->execute(array($name,$did,$id));
            Database::disconnect();
            header("Location: index.php");
        }
	    } else {
	        $pdo = Database::connect();
	        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	        $sql = "SELECT * FROM Student where id = ?";
	        $q = $pdo->prepare($sql);
			$q->bindParam(':name', $name, PDO::PARAM_STR);
			$q->bindParam(':did', $did, PDO::PARAM_INT);
	        $q->execute(array($id));
	        $data = $q->fetch(PDO::FETCH_ASSOC);
	        $name = $data['name'];
	        $did = $data['did'];
	        Database::disconnect();
    }
?>

<!DOCTYPE html>
<html>
  <head>
  	<meta charset="utf-8">
    <title>Subscribe</title>
    <link rel="stylesheet" type="text/css"
      href="http://yegor256.github.io/tacit/tacit.min.css"/>
  </head>
  <body>
    <section>
    	<h1>Add A Student</h1>
    	
    	<form action="update.php?id=<?php echo $id?>" method="post">
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
              <button type="submit">Update</button>
              <a href="index.php">Back</a>
            </div>
    	</form>
    	
    </section>
 
 

 
 </body>
</html>