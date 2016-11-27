<?php
    require 'db.php';
    $id = null;
    if ( !empty($_GET['id'])) {
        $id = $_REQUEST['id'];
    }
     
    if ( null==$id ) {
        header("Location: index.php");
    } else {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM Student where id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
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
    	<h1>Student Information View on <?php echo $data['name']; ?></h1>
    	<div>
    		<h2>Name:</h2>
    		<p>
    			<?php echo $data['name']; ?>
    		</p>
    	</div>
    	<div>
    		<h2>Database id:</h2>
    		<p>
    			<?php echo $data['id']; ?>
    		</p>
    	</div>
    	<div>
    		<h2>Department id:</h2>
    		<p>
    			<?php echo $data['did']; ?>
    		</p>
    	</div>
    	<p><a href="index.php">Back</a></p>
    </section>
 
 

 
 </body>
</html>