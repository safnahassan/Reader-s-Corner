<?php include('registered1.php') ?>
<?php include 'connect.php';?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Registration Form</title>


<script type="text/javascript" language="javascript" src="validate.js"></script>


    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Signin</title>

    <!-- Bootstrap core CSS -->
    

    <!-- Custom styles for this template -->
 

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <script src="../../assets/js/ie-emulation-modes-warning.js"></script>
<style >
body {
		min-height: 2000px;
		padding-top: 20px;
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
	padding-top: 20px;
	padding-bottom: 20px;
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
    
a {
text-decoration: none;
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
.form-signin {
  max-width: 330px;
  padding: 15px;
  margin: 0 auto;
}
.form-signin .form-signin-heading,
.form-signin .checkbox {
  margin-bottom: 10px;
}
.form-signin .checkbox {
  font-weight: normal;
}
.form-signin .form-control {
  position: relative;
  height: auto;
  -webkit-box-sizing: border-box;
     -moz-box-sizing: border-box;
          box-sizing: border-box;
  padding: 10px;
  font-size: 16px;
}
.form-signin .form-control:focus {
  z-index: 2;
}
.form-signin input[type="email"] {
  margin-bottom: -1px;
  border-bottom-right-radius: 0;
  border-bottom-left-radius: 0;
}
.form-signin input[type="password"] {
  margin-bottom: 10px;
  border-top-left-radius: 0;
  border-top-right-radius: 0;
}

</style>
</head>
<body>


 <h1>Reader's Corner</h1>
 <div class="container">

      
        <h2 class="form-signin-heading">Register</h2>

        <div class="input-group" id="mybox">
  <form method="POST" action="register.php">
					<h3 style="text-decoration:underline;">User Information</h3>
					<label>Full Name: </label>
					<input class="roundcorners" type="text" name="fullname" placeholder="Enter Name" value="<?php echo $fullname; ?>"/><br /><br />
					<label>Username: </label>
					<input class="roundcorners" type="text" name="username" placeholder="Enter Username" value="<?php echo $username; ?>"/><br /><br />
					<label>Email: </label>
					<input class="roundcorners" type="email" name="emailid" placeholder="abc@b-kart.com" value="<?php echo $emailid; ?>"/><br /><br />
					<label>Password: </label>&nbsp;
					<input class="roundcorners" type="password" name="password" placeholder="Enter Password" /><br /><br />
					<label>Confirm Password: </label>&nbsp;
					<input class="roundcorners" type="password" name="confpassword" placeholder="Enter Password Again" /><br /><br />
					<label>Phone Number: </label>&nbsp;&nbsp;&nbsp;&nbsp;
					<input class="roundcorners" type="text" name="phonenumber" placeholder="Enter Phone Number" value="<?php echo $phonenumber; ?>"/><br /><br />
					
					<input class="button" type="reset" name="reset" value="Reset Form"/>
					<input class="button" type="submit" name="register" value="Register"/><br /><br />
					<?php echo "<a class=\"form-signin-heading\" style = \"padding-left:30px;color:white;\" href='../signin/signin.php'>Already a member? Sign in!</a>";?>
      </form>

    </div> <!-- /container -->
    


	
</body>
</html>

