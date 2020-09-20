<?php

require 'Config/config.php';

if(isset($_SESSION['username'])){

	$userLoggedIn = $_SESSION['username'];
	$user_details_query = mysqli_query($con, "SELECT * FROM Users WHERE username = '$userLoggedIn'");
	$user = mysqli_fetch_array($user_details_query);

}else{

	header("Location: register.php");
}
?>


<!DOCTYPE html>
<html>
<head>
	<title>Welcome!</title>
	<!-- Javascript-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
	<script src="assets/js/bootstrap.js"></script>
	<script src="https://kit.fontawesome.com/8b5ecfaba5.js" crossorigin="anonymous"></script>

	<!-- CSS -->

	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
	<link rel="stylesheet" type="text/css" href="path/to/font-awesome/css/font-awesome.min.css">
</head>
<body>
 
 	<div class = "top_bar">
 		
 		<div class = "logo">
 			
 			<a href="index.php">JimBaz</a>

 			<nav>

 				<a href="#">
 					<?php 
 						echo $user['first_name'];
 					 ?>
 				</a>
 				
 				<a href="#">
 					<i class="fas fa-envelope"></i>
 				</a>
 				<a href="#">
 					<i class="fa fa-home" aria-hidden="true"></i>
 				</a>
 				<a href="#">
 					<i class="fa fa-bell-o" aria-hidden="true"></i>
 				</a>
 				<a href="#">
 					<i class="fa fa-users" aria-hidden="true"></i>
 				</a>
 				<a href="#">
 					<i class="fa fa-cog" aria-hidden="true"></i>
 				</a>

 			</nav>

 		</div>
 	</div>