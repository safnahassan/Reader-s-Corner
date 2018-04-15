<?php include 'connect.php';?>
<?php
session_start();	//user cannot access this page if he is not logged in
if (!isset($_SESSION['success'])) { 
	header("location: signin/signin.php");
} 
?>

<?php
if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['username']);
  	header("location: signin/signin.php");
}  	
 ?>
<?php 

if(isset($_SESSION['cart']) & !empty($_SESSION['cart'])){
	$items = $_SESSION['cart'];
	$cartitems = explode(",", $items);
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
    <link href="../dist/css/bootstrap.min.css" rel="stylesheet">

    
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

	
    </style>
	    
  </head>

  <body>

    <!-- Fixed navbar -->
    <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Reader's Corner</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="home.php">Home</a></li>
            <li ><a href="reviews.php">Reviews</a></li>
            
          </ul>
          
          <ul class="nav navbar-nav navbar-right">
<?php
if (isset($_SESSION['success']) && $_SESSION['success'] == true) {  
	echo "<li><a href=\"home.php?logout='1'\">Sign out</a></li>";         //user is logged in     
} 
else {
	echo "<li><a href=\"signin/signin.php\">Sign in</a></li>";	//user is logged out
}
?>           
            <!--<li><a href="../navbar-static-top/">Admin</a></li>-->
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <div class="container">

      <!-- Main component for a primary marketing message or call to action -->
      <div class="jumbotron">
        <h1>Reader's Corner</h1>
<!--         <p>
          <a class="btn btn-lg btn-primary" href="browse.php" role="button">Browse all categories &raquo;</a>
        </p> -->
<br>
	<?php
		$total = '';
		$i=1;

		foreach ($cartitems as $key=>$ISBN) {
		 	
		 	$username = $_SESSION['username'];
			$sql = "INSERT INTO `buys`(customer_id,ISBN,purchase_date,purchase_count) VALUES ('".$username."','".$ISBN."',CURDATE(),1);";
			$q=mysqli_query($con, $sql);
			$r = mysqli_fetch_assoc($q);	  	
			
			 
		} 
		
		echo('Thank you for choosing our services!');
		?>
		
	
      </div>
    <div id="content"></div>
    </div> <!-- /container -->


    
    <script src="../dist/js/bootstrap.min.js"></script>
    
  </body>
</html>
