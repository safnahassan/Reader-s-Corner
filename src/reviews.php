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
    <script language="javascript" type="text/javascript">
	function removeSpaces(string) {
	 return string.split(' ').join('+');
	}
    </script>
	    
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
            <li ><a href="home.php">Home</a></li>
            <li class="active"><a href="reviews.php">Reviews</a></li>
           
          </ul>
          
          <ul class="nav navbar-nav navbar-right">
<?php
if (isset($_SESSION['success']) && $_SESSION['success'] == true) {  
	echo "<li><a href=\"addReview.php\">Add a Review</a></li>"; 
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
        <p>Check out reviews of your favourite books!</p>
<!--         <p>
          <a class="btn btn-lg btn-primary" href="browse.php" role="button">Browse all categories &raquo;</a>
        </p> -->
<br>
        <form class="input-group input-group-lg" method="POST">
          <input type="text" class="form-control" placeholder="Search" aria-describedby="sizing-addon1" name = "reviewbook">
          <input type = "submit"  id="sizing-addon1" name = "submit" value = "Search!">
        </form>
<?php


if(isset($_POST['submit'])){
    $query=$_POST['reviewbook'];
    
    $sql=" SELECT * FROM books WHERE name like '%".$query."%'";
    $q=mysqli_query($con,$sql);
}

?>
	<table id = "result_table">
		<tr>
		<td>Date</td>
		<td>Books</td>
		<td>Review</td>
		<td>Rating</td>
		</tr>
		<?php
		
		while($res=mysqli_fetch_array($q)){
		?>
			<?php
			$ISBN = $res['ISBN'];
			$rev_sql = "SELECT books.name, review.review_date, review.review_text, review.rating FROM books,review WHERE books.ISBN = '".$ISBN."' and books.ISBN = review.ISBN";
			$rev_q = mysqli_query($con, $rev_sql);
			?>
			<?php
		
			while($rev_res=mysqli_fetch_array($rev_q)){
			?>
				<tr>
				<td><?php echo $rev_res['review_date'];?></td>
				<td><?php echo $rev_res['name'];?></td>
				<td><?php echo $rev_res['review_text'];?></td>
				<td><?php echo $rev_res['rating'];?></td>
				</tr>
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
