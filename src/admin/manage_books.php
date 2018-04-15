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
	
	#result_table {
	    font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
	    border-collapse: collapse;
	    width: 100%;
	}

	#result_table td, #result_table th {
	    border: 1px solid #ddd;
	    padding: 8px;
	}

	#result_table tr:nth-child(even){background-color: #f2f2f2;}

	#result_table tr:hover {background-color: #ddd;}

	#result_table th {
	    padding-top: 12px;
	    padding-bottom: 12px;
	    text-align: left;
	    background-color: #4CAF50;
	    color: white;
	}
	
	#manage_books {
	    
	    font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
	    font-size: 20px;
	    border: 10px solid #ddd;
	    
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
		    <li class="active"><a href="manage_books.php">Manage Books</a></li>
		    <li ><a href="manage_supplies.php">Manage Suppliers</a></li>
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
	      </div>
    </nav>
    <div id="navbar" style="margin-top:10px">
		  <ul class="nav navbar-nav" id="manage_books">
		    <li ><a href="addBook.php">Add Books</a></li>
		    <li ><a href="addAuthor.php">Add Authors</a></li>
		 
		    
		  </ul>
		  
    </div>
<table id = "result_table">

		<tr>
	  		<th>ISBN</th>
	  		<th>Book Name</th>
	  		<th>Language</th>
	  		<th>Price</th>
	  		<th>Author</th>
	  		<th>Publisher</th>
	  		<th>Supplier</th>
	  		
	  	</tr>
	  	
	  	<?php
			$sql="SELECT books.ISBN,books.name,books.language,books.price,publisher.name AS publisher, supplier.name AS supplier, author.name AS author FROM books,authored_by,published_by, supply, author,publisher,supplier WHERE books.ISBN=authored_by.ISBN AND books.ISBN=published_by.ISBN AND books.ISBN=supply.ISBN AND supply.sup_id=supplier.sup_id AND published_by.pub_id=publisher.pub_id AND author.author_id=authored_by.author_id";

			$q=mysqli_query($con,$sql);
		
			while($res=mysqli_fetch_array($q, MYSQLI_ASSOC)){
				?>
					<tr>
					<td><?php echo $res['ISBN'];?></td>
					<td><?php echo $res['name'];?></td>
					<td><?php echo $res['language'];?></td>
					<td><?php echo $res['price'];?></td>
					<td><?php echo $res['author'];?></td>
					<td><?php echo $res['publisher'];?></td>
					<td><?php echo $res['supplier'];?></td>
					
					
					</tr>		
			<?php }?>    
        



    
    <script src="../dist/js/bootstrap.min.js"></script>
    
  </body>
</html>
