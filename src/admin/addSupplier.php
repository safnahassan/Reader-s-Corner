<?php
session_start();	//user cannot access this page if he is not logged in
if (!isset($_SESSION['admin_success'])) { 
	header("location: ../signin/signin.php");
} 
?>
<?php include 'connect.php';?>
<?php
if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['admin_username']);
  	header("location: ../signin/signin.php");
}  	
 ?>
   
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    
    
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../favicon.ico">

    <title>Book Store</title>

    <!-- Bootstrap core CSS -->
    <link href="../../dist/css/bootstrap.min.css" rel="stylesheet">

    
    <link href="navbar-fixed-top.css" rel="stylesheet">
    
    <style>
	body {
		min-height: 2000px;
		padding-top: 70px;
		background-color: #333;
		text-align: center;
	}
	
	input[type=text], select {
	    font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
	    width: 100%;
	    padding: 12px 20px;
	    margin: 8px 0;
	    display: inline-block;
	    border: 1px solid #ccc;
	    border-radius: 4px;
	    box-sizing: border-box;
	}
	input[type=number], select {
	    font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
	    width: 30%;
	    padding: 12px 20px;
	    margin: 8px 0;
	    display: inline-block;
	    border: 1px solid #ccc;
	    border-radius: 4px;
	    box-sizing: border-box;
	}

	input[type=submit] {
	    width: 10%;
	    background-color: #4CAF50;
	    color: white;
	    padding: 14px 20px;
	    margin: 8px 0;
	    border: none;
	    border-radius: 4px;
	    cursor: pointer;
	}
	#manage_books {
	    
	    font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
	    font-size: 20px;
	    margin-top:10px;
	    
	}
	
    </style>
    <script language="javascript" type="text/javascript">
	function removeSpaces(string) {
	 return string.split(' ').join('+');
	}
    </script>
	    
  </head>

  <body>

    <!-- Fixed navbar -->
    
    <div class="container">

      <!-- Main component for a primary marketing message or call to action -->
      <div class="jumbotron">
        <h2>Reader's Corner - Administration</h2>
        
        <nav class="navbar navbar-default navbar-fixed-top">
	      <div class="container">
		<div class="navbar-header">
		  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
		    <span class="sr-only">Toggle navigation</span>
		    <span class="icon-bar"></span>
		    <span class="icon-bar"></span>
		    <span class="icon-bar"></span>x
		  </button>
		  <a class="navbar-brand">Reader's Corner</a>
		</div>
		<div id="navbar" class="navbar-collapse collapse">
		  <ul class="nav navbar-nav">
		    <li ><a href="../admin_home.php">Home</a></li>
		    <li ><a href="manage_books.php">Manage Books</a></li>
		    <li class="active"><a href="manage_supplies.php">Manage Suppliers</a></li>
		    <li ><a href="manage_publishers.php">Manage Publishers</a></li>
		    
		  </ul>
		  
		  <ul class="nav navbar-nav navbar-right">
	<?php
	if (isset($_SESSION['admin_success']) && $_SESSION['admin_success'] == true) {  
		echo "<li><a href=\"../admin_home.php?logout='1'\">Sign out</a></li>";         //user is logged in     
	} 
	else {
		echo "<li><a href=\"../signin/signin.php\">Sign in</a></li>";	//user is logged out
	}
	?>           
		    <!--<li><a href="../navbar-static-top/">Admin</a></li>-->

		  </ul>
		</div><!--/.nav-collapse -->
	      
    </nav>
    <div id="navbar" style="margin-top:10px">
		  <ul class="nav navbar-nav" id="manage_books">
		    <li ><a href="addSupplier.php">Add Suppliers</a></li>
		  </ul>
		  
    </div>
    </div> 
    <br>
	<form action="addSupplier.php" method="post">
	 	Add Supplier ID: <input type="text" name="sup_id"><br>
		Add Supplier Name: <input type="text" name="name"><br>
		Add Rating(/10): <input type="number" name="rating"><br>
		
	<input type="submit" value="Add Supplier" name = "submit">
	</form>
        <?php


		if(isset($_POST['submit'])){
			$sql_b=" INSERT INTO `supplier`(sup_id,name,rating) VALUES ('".$_POST['sup_id']."', '".$_POST['name']."', ".$_POST['rating'].")";
			$q_b=mysqli_query($con,$sql_b);
			
			if ($q_b == false) {
				die("MySql-Query failed.");
			}	
			else{
				echo "<label id='welcomeText'>Added!<br />";
			}
		}
	?>
    <script src="../dist/js/bootstrap.min.js"></script>
   
  </body>
</html>
