<?php
session_start();	//user cannot access this page if he is not logged in
if (!isset($_SESSION['success'])) { 
	header("location: signin/signin.php");
} 
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
        <p>Read one of our books? Drop a review.</p>
<!--         <p>
          <a class="btn btn-lg btn-primary" href="browse.php" role="button">Browse all categories &raquo;</a>
        </p> -->
<br>
	<form action="addReview.php" method="post">
	 	
		<?php
		$sql=" SELECT * FROM books";
		$q=mysqli_query($con,$sql);
		$b_option = '';
		while($res=mysqli_fetch_array($q, MYSQLI_ASSOC)){
			$b_option .= '<option value = "'.$res['ISBN'].'">'.$res['name'].'</option>';
		}
		?>
		Choose a book:<br>
		<select name="ISBN"> 
		<?php echo $b_option; ?>
		</select>
		<br>
		Add review: <br><input type="text" name="review_text"><br>
		Add Rating(/10): <br><input type="number" name="rating"><br>
		
		
	<input type="submit" value="Add Review" name = "submit">
	</form>
        <?php


		if(isset($_POST['submit'])){
			$sql_b=" INSERT INTO `review`(ISBN, review_date, review_text,rating) VALUES('".$_POST['ISBN']."',CURDATE(),'".$_POST['review_text']."',".$_POST['rating'].")";
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
