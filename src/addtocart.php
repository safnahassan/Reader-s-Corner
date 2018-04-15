<?php include 'connect.php';?>
<?php
session_start();
if (isset($_SESSION['success']) && $_SESSION['success'] == true) {
	if(isset($_SESSION['cart']) & !empty($_SESSION['cart'])){
		$items = $_SESSION['cart'];
		$cartitems = explode(",", $items);
		if(in_array($_GET['ISBN'], $cartitems)){
			header('location: home.php?status=incart');
		}else{
			$items .= "," . $_GET['ISBN'];
			$_SESSION['cart'] = $items;
			header('location: home.php?status=success');
	
		}
	}
	else{
		$items = $_GET['ISBN'];
		$_SESSION['cart'] = $items;
		header('location: home.php?status=success');
	}
}
else {	
		
		$_SESSION['msg'] = "You must sign in first";
	  	header('location: signin/signin.php');
}

?>
