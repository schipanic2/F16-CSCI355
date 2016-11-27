<?php
    require 'db.php';
    $id = 0;
     
    if ( !empty($_GET['id'])) {
        $id = $_REQUEST['id'];
    }
     
    if ( !empty($_POST)) {
        // keep track post values
        $id = $_POST['id'];
         
        // delete data
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "DELETE FROM Student  WHERE id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        Database::disconnect();
        header("Location: index.php");
         
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
    	<h1>Delete Student <?php echo $id;?>?</h1>
    	<div>
	    	<form action="delete.php" method="post">
	    		<input type="hidden" name="id" value="<?php echo $id;?>"/>
	    		<p>Are you sure?</p>
	    		<button type="submit">Yes</button>
	    		<a href="index.php">No I don't wanna delete nobody</a>
	    	</form>
    	</div>
    </section>
 
 

 
 </body>
</html>