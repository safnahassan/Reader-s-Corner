<?php include 'connect.php';?>
<?php
session_start();
if (isset($_POST['register'])) {
	
	$fullname = $_POST['fullname'];
	$username = $_POST['username'];
	$emailid = $_POST['emailid'];
	$password = $_POST['password'];
	$confpassword = $_POST['confpassword'];
	$phonenumber = $_POST['phonenumber'];
	$isValidated = true;



	if (empty($fullname))
	{
		echo "<p  class=\"form-signin-heading\" style = \"padding-left:30px\">Name should not be empty. Please provide valid input.<br/></p>";
		$isValidated = false;
	}
	else if (strlen($password) < 6)
	{
		echo "<p  class=\"form-signin-heading\" style = \"padding-left:30px\">Keep a password of more than 6 characters!</p>";
		$isValidated = false;
	}
	else if (strcmp($password, $confpassword) != 0)
	{
		echo "<p  class=\"form-signin-heading\" style = \"padding-left:30px\">Password and Confirm Password doesn't matched</p>";
			$isValidated = false;
	}
	
	else if (strlen($phonenumber) != 10 )
	{
		echo "<p  class=\"form-signin-heading\" style = \"padding-left:30px\">Phone number is not correct</p>";
		$isValidated = false;
	}
	if ($isValidated)
	{
		$result = mysqli_query($con, "SELECT * FROM customer WHERE e_mail = '$emailid' OR customer_id = '$username' LIMIT 1");
		$rowcount = mysqli_num_rows($result);
		//var_dump($rowcount);
		//return;
		if ($rowcount == 0)
		{
			$pass = md5($_POST['password']);
			$query = "INSERT INTO `customer`(customer_id,name,e_mail,phone_number,password) VALUES ('$username','$fullname','$emailid',$phonenumber,'$pass')";
			//echo $insert_sql;
			$result = mysqli_query($con, $query);
	
			if($result === false)  {
				die("Query $query returned false");
			}
			else
			{
				echo "<label id='welcomeText'><a href='../home.php'> Welcome! Click here to shop!</a></label><br />";
				echo "<a href='../home.php'>Click here to shop!</a></label><br />";
				$_SESSION['username']=$username;
  				$_SESSION['success'] = true;
				//require("cart.php");
			}
		}
		else
		{
			echo "Email ID: " . $_POST['emailid'] . " or User Name: " . $_POST['username'] . " is already registered.<br /><br />";
			echo "<label id='welcomeText'><a href='register.php'>Click here to login.</a></label><br />";
		}
	}
	
}	
?>
			
