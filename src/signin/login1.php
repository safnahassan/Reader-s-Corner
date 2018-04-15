<?php include 'connect.php';?>
<?php
session_start();
if (isset($_POST['signin'])) {
	
	//require("../connect.php");
	$con = mysqli_connect("localhost","root","mysql1610","books");
	if (mysqli_connect_errno())
	  {
	  echo "Failed to connect to MySQL: " . mysqli_connect_error();
	  }
	
	$username = $_POST['username'];
	$password = $_POST['password'];
	$isValidated = true;



	if (empty($username))
	{
		echo ("Username should not be empty. Please provide valid input.<br/>");
		$isValidated = false;
	}
	else if (empty($password))
	{
		echo ("Password should not be empty. Please provide valid input.<br/>");
		$isValidated = false;
	}
	
	if ($isValidated)
	{
		
		$pass = md5($_POST['password']);
		$result = mysqli_query($con, "SELECT * FROM customer WHERE password = '$pass' AND customer_id = '$username' LIMIT 1");
		$rowcount = mysqli_num_rows($result);
		if ($rowcount == 0)
		{
			echo "<a id='welcomeText' href='signin.php'>Incorrect credentils. Try again?</a>";
		}
		else
		{
			echo "<label id='welcomeText'><a href='../home.php'> Welcome! Click here to shop!</a></label>";
			$_SESSION['username']=$username;
  			$_SESSION['success'] = true;
			
		}
	}
	
}

if (isset($_POST['admin_signin'])) {
	
	//require("../connect.php");
	$con = mysqli_connect("localhost","root","mysql1610","books");
	if (mysqli_connect_errno())
	  {
	  echo "Failed to connect to MySQL: " . mysqli_connect_error();
	  }
	
	$username = $_POST['username'];
	$password = $_POST['password'];
	$isValidated = true;
	


	if (empty($username))
	{
		echo ("Username should not be empty. Please provide valid input.<br/>");
		$isValidated = false;
	}
	else if (empty($password))
	{
		echo ("Password should not be empty. Please provide valid input.<br/>");
		$isValidated = false;
	}
	
	if ($isValidated)
	{
		$pass = md5($_POST['password']);
		$result = mysqli_query($con, "SELECT * FROM admin WHERE password = '$pass' AND admin_id = '$username' LIMIT 1");
		$rowcount = mysqli_num_rows($result);
		if ($rowcount == 0)
		{
			echo "<a id='welcomeText' href='signin.php'>Incorrect credentils. Try again?</a>";
		}
		else
		{
			echo "<label id='welcomeText'><a href='../admin_home.php'>Welcome! Click here to continue</a></label>";
			
			$_SESSION['admin_username']=$username;
  			$_SESSION['admin_success'] = true;
			
		}
	}
	
}	
?>
			
