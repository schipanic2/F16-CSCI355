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
    	<h1>Student Table</h1>
    	
    	<p>
            <a href="add.php">Add Student</a>
        </p>
    	
    	<table>
	    	<thead>
		        <tr>
		          <th>Name</th>
		          <th>id</th>
		          <th>Department id</th>
		        </tr>
		      </thead>
		      <tbody>
				<?php
				   require 'db.php';
				   $pdo = Database::connect();
				   $sql = 'SELECT * FROM Student ORDER BY id DESC';
				   foreach ($pdo->query($sql) as $row) {
				            echo '<tr>';
				            echo '<td>'. $row['name'] . '</td>';
				            echo '<td>'. $row['id'] . '</td>';
				            echo '<td>'. $row['did'] . '</td>';
							echo '<td>';
                            echo '<a  href="read.php?id='.$row['id'].'">Read</a>';
                            echo ' ';
                            echo '<a  href="update.php?id='.$row['id'].'">Update</a>';
                            echo ' ';
                            echo '<a  href="delete.php?id='.$row['id'].'">Delete</a>';
                            echo '</td>';
				            echo '</tr>';
				   }
				   Database::disconnect();
				?>			
 			</tbody>
 		</table>
    </section>
    
    <section>
    	<h1>Department Table Reference</h1>
    	<table>
	    	<thead>
		        <tr>
		          <th>Department Name</th>
		          <th>id</th>
		        </tr>
		      </thead>
		      <tbody>
				<?php
				   $pdo = Database::connect();
				   $sql = 'SELECT * FROM Department ORDER BY id DESC';
				   foreach ($pdo->query($sql) as $row) {
				            echo '<tr>';
				            echo '<td>'. $row['Dname'] . '</td>';
				            echo '<td>'. $row['id'] . '</td>';
				            echo '</tr>';
				   }
				   Database::disconnect();
				?>			
 			</tbody>
 		</table>
    </section>
 
 

 
 </body>
</html>