<?php include('login1.php') ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    
    <link rel="icon" href="../../favicon.ico">

    <title>Signin</title>


    <!-- Custom styles for this template -->
    

    <script src="../../assets/js/ie-emulation-modes-warning.js"></script>
    <style>
    
    body {
		min-height: 2000px;
		padding-top: 70px;
		background-color: #333;
		text-align: center;
		color:white;
		font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
	}
    
    #mybox {
	border-style: solid;
	margin-bottom: 100px;
	margin-right: 150px;
	margin-left: 80px;
	padding-top: 50px;
	padding-right: 30px;
	padding-bottom: 50px;
	text-align: center;
	

    }
    
    #welcomeText {
        border-style: groove;
        color: black;
	padding-top: 10px;
	padding-right: 10px;
	padding-left: 10px;
	padding-bottom: 10px;
	background-color: #e7e7e7; 
	text-align: center;
    	
    }
    
    .button {
    background-color: #e7e7e7; 
    color: black;
    border: none;
    padding: 15px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    cursor: pointer;
}

a {
text-decoration: none;
}

    </style>
  </head>

  <body>
<?php include 'connect.php';?>

    <h1>Reader's Corner</h1>
    <h2 class="form-signin-heading">Sign in</h2>
    <div class="container" id="mybox">
    	
      <form method="POST" action="signin.php">
		<h3 style="text-decoration:underline;">Enter details</h3>
		
		<label>Username: </label>
		<input class="roundcorners" type="text" name="username" placeholder="Enter Username"/><br /><br />
		<label>Password: </label>&nbsp;
		<input class="roundcorners" type="password" name="password" placeholder="Enter Password"/><br /><br />
		
	
		<input class="button" type="submit" name="signin" value="Sign in"/>
		<input class="button" type="submit" name="admin_signin" value="Sign in as Admin"/>
		
      </form>
	<a href="../register/register.php"><input class="button" type="submit" name="register" value="First time? Register!"/></a><br /><br />
    </div> <!-- /container -->


    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
