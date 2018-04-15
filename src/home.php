<?php
session_start();
?>
<?php include 'connect.php';?>
<?php
if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['username']);
  	header("location: signin/signin.php");
}  	
 ?>
 <?php
if(isset($_POST["ISBNnum"])) {
	  	
  	if (isset($_SESSION['success']) && $_SESSION['success'] == true) {
		$ISBN = $_POST["ISBNnum"];
		$username = $_SESSION['username'];
		$sql2="INSERT INTO `buys`(customer_id,ISBN,purchase_date,purchase_count) VALUES ('".$username."','".$ISBN."',CURDATE(),1); ";
		$q2=mysqli_query($con,$sql2);
		header("Content-Type: application/JSON: charset=UTF-8");
		$message = "Added to cart!";
		echo "<script type='text/javascript'>alert('$message');</script>";
	}
	
	else {	
		//$message = "Log in!";
		//echo "<script type='text/javascript'>alert('$message');</script>";
		$_SESSION['msg'] = "You must sign in first";
	  	header('location: signin/signin.php');
  	}
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
            <li class="active"><a href="#">Home</a></li>
            <li ><a href="reviews.php">Reviews</a></li>
            
        
          </ul>
          
          <ul class="nav navbar-nav navbar-right">
<?php
if (isset($_SESSION['success']) && $_SESSION['success'] == true) { 
	echo "<li><a href=\"cart.php\">View Cart</a></li>"; 
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
        <p>Find any and every book you want here.</p>
<!--         <p>
          <a class="btn btn-lg btn-primary" href="browse.php" role="button">Browse all categories &raquo;</a>
        </p> -->
<br>
        <form class="input-group input-group-lg" method="POST">
          <input type="text" class="form-control" placeholder="Search for a book..." aria-describedby="sizing-addon1" name = "query">
          <input style = "margin-top:10px;margin-left:10px;margin-bottom:10px;" class="btn btn-primary" role="button" type = "submit"  id="sizing-addon1" name = "submit" value = "Search!">
        </form>
<table id = "result_table">
		<tr>
		<td>Books</td>
		<td>Language</td>
		<td>Price (INR)</td>
		</tr>
		<?php


		if(isset($_POST['submit']) and ($_POST['query'] != null)){
			$query=$_POST['query'];

			$sql=" SELECT * FROM books WHERE name like '%".$query."%'";

			$q=mysqli_query($con,$sql);
			$in = array();
		
			while($res=mysqli_fetch_array($q, MYSQLI_ASSOC)){
				if(!(in_array($res['ISBN'], $in))) {
					array_push($in,$res['ISBN']);
				?>
					<tr>
					<td><?php echo $res['name'];?></td>
					<td><?php echo $res['language'];?></td>
					<td><?php echo $res['price'];?></td>
					<td><?php echo "<a href=\"addtocart.php?ISBN=". $res['ISBN']."\" class=\"btn btn-primary\" role=\"button\">Add to Cart</a>";?></td>
					</tr>
					<?php
				
					$sql_sim = "SELECT * FROM books, similar WHERE (books.ISBN = similar.ISBN_1 or books.ISBN = similar.ISBN_2) and (similar.ISBN_1 = '".$res['ISBN']."' OR similar.ISBN_2 = '".$res['ISBN']."')";
				
					$q_sim=mysqli_query($con,$sql_sim);
					while($res_sim=mysqli_fetch_array($q_sim, MYSQLI_ASSOC)){
						if(!(in_array($res_sim['ISBN'], $in))) {
							array_push($in,$res_sim['ISBN']);
					?>
							<tr>
							<td><?php echo $res_sim['name'];?></td>
							<td><?php echo $res_sim['language'];?></td>
							<td><?php echo $res_sim['price'];?></td>
							<td><?php echo "<a href=\"addtocart.php?ISBN=". $res_sim['ISBN']."\" class=\"btn btn-primary\" role=\"button\">Add to Cart</a>";?></td>
							</tr>
					
					
					
						<?php }?>
					<?php }?>
							
				<?php }?>
			<?php }?>
			<?php
			$sql=" SELECT * FROM author WHERE name like '%".$query."%'";
			$q=mysqli_query($con,$sql);
			while($res=mysqli_fetch_array($q, MYSQLI_ASSOC)){
				$sql_b = " SELECT books.ISBN, books.name,books.language, books.price FROM authored_by,books WHERE authored_by.ISBN = books.ISBN and authored_by.author_id ='".$res['author_id']."'";
				$q_b=mysqli_query($con,$sql_b);
				while($res_b=mysqli_fetch_array($q_b, MYSQLI_ASSOC)){
				
					if(!(in_array($res_b['ISBN'], $in))) {
						array_push($in,$res_b['ISBN']);
					?>
						<tr>
						<td><?php echo $res_b['name'];?></td>
						<td><?php echo $res_b['language'];?></td>
						<td><?php echo $res_b['price'];?></td>
						<td><?php echo "<a href=\"addtocart.php?ISBN=". $res_b['ISBN']."\" class=\"btn btn-primary\" role=\"button\">Add to Cart</a>";?></td>
						</tr>
					<?php }?>	
				<?php }?>	
			<?php }?>		
		<?php }?>
				
  
	</table>
	
      </div>
    <div id="content"></div>
    </div> <!-- /container -->


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="../dist/js/bootstrap.min.js"></script>
    
    <script src="../assets/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
