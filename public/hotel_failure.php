<?php @session_start();
	@session_start();
	
	$payid = $_POST['mihpayid'];
	$txnid = $_POST["txnid"];
	
	$order_id = $_SESSION['order_id'];
	
	$status = $_POST["status"];
	$firstname = $_POST['firstname'];
	$lastname = $_POST['lastname'];
	$productinfo = $_POST['productinfo'];
	$amount = $_POST["amount"];
	
	 /*  DB Details */
	 $username = "root";
	$password = "root";
	$hostname = "localhost"; 
	$database = "tripindia";
	
	$conn = mysqli_connect($hostname, $username, $password, $database);
	
	// Check connection
	if (!$conn) {
	    die("Connection failed: " . mysqli_connect_error());
	}
	else {
		mysqli_query($conn, "UPDATE `orders` SET `payu_id` = '".$payid."', `status` = '".$status."' WHERE `order_id` = ".$order_id);	
	}
	$site = 'http://'.$_SERVER['HTTP_HOST'].'/';
	$url = $site.'/hotel-payment-failure/';
      
	header("Location:".$url); exit();
?>