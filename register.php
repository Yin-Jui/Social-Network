<?php

require 'Config/config.php';
require 'includes/form_handlers/register_handler.php';
require 'includes/form_handlers/login_handler.php';

?>
	
<html>
<head>
	<title> Welcome</title>
	<link rel="stylesheet" type="text/css" href="assets/css/register_style.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
	<script src="assets/js/register.js"></script>
</head>
<body>

	<?php 
		if(isset($_POST['register_button'])){

			echo'
				<script>

				$(document).ready(function(){
						$("#first").hide();
						$("#second").show();
					});
				</script>
			';
		}

	 ?>

	<div class = "wrapper">

		<div class = "login_box">

			<div class = "login_header">
				
				<h1>Jimmy's Scocial Website</h1>
				<h2>Log in or sign up below!<h2>
			</div>

			<div id = "first">
				<form action = "register.php" method="POST">
				<input type="email" name="log_email" placeholder="Email Address" value="<?php 
				if(isset($_SESSION['log_email'])){

					echo $_SESSION['log_email'];
				} 
				?>" required>

				<br>
				<input type="password" name="log_password" placeholder="Password">
				<br>
				<input type="submit" name="login_button" value="Login">
				<br>
				<a href="#" id="signup" class = "signup">Haven't registered yet? Register here!</a> <!-- # means go to the current page-->

				<?php 
					if(in_array("<br>Email or password is incorrect<br>", $error_array)) echo "<br>Email or password is incorrect<br>";
				 ?>

				</form>
			</div>


			<div id = "second">

				<form action="register.php" method="POST">  <!-- action: where the data below is going to be sent to -->
			
				<input type="text" name="reg_fname" placeholder="First name" value="<?php 
				if(isset($_SESSION['reg_fname'])){

					echo $_SESSION['reg_fname'];
				} 
				?>"required>
				<br>
				<?php if(in_array("Your first name must between 2 and 25 characers<br>", $error_array)) echo "Your first name must between 2 and 25 characers<br>"; ?>

				<input type="text" name="reg_lname" placeholder="Last name" value="<?php 
				if(isset($_SESSION['reg_lname'])){

					echo $_SESSION['reg_lname'];
				} 
				?>"required>
				<br>
				<?php if(in_array("Your last name must between 2 and 25 characers<br>", $error_array)) echo "Your last name must between 2 and 25 characers<br>"; ?>

				<input type="email" name="reg_email" placeholder="Email"  value="<?php 
				if(isset($_SESSION['reg_email'])){

					echo $_SESSION['reg_email'];
				} 
				?>"required>
				<br>
				<input type="email" name="reg_email2" placeholder="Confirm Email"  value="<?php 
				if(isset($_SESSION['reg_email2'])){

					echo $_SESSION['reg_email2'];
				} 
				?>"required>
				<br>

				<?php 	if(in_array("Email address is used<br>", $error_array)) echo "Email address is used<br>"; 
				 		if(in_array("invalid email format<br>", $error_array)) echo "invalid email format<br>"; 
				 		if(in_array("Emails don't match<br>", $error_array)) echo "Emails don't match<br>"; ?>

				<input type = "password" name = "reg_password" placeholder="Password" required>
				<br>
				<input type = "password" name = "reg_password2" placeholder="Confirm Password" required>
				<br>

				<?php 	if(in_array("your passwords don't match<br>", $error_array)) echo "your passwords don't match<br>"; 
				 		if(in_array("Your password must contains only english characters and numbers only<br>", $error_array)) echo "Your password must contains only english characters and numbers only<br>"; 
				 		if(in_array("Your password must between 5 and 30 characers<br>", $error_array)) echo "Your password must between 5 and 30 characers<br>"; ?>
				<input type = "submit" name = "register_button" value="Register">
				<br>

				<?php 
				if(in_array("<span style = 'color: #14C800;'> All set!</span><br>", $error_array)) echo "<span style = 'color: #14C800;'> All set!</span><br>";

				?>

				<a href="#" id="signin" class = "signin">Already have an account? Sign in here!</a> <!-- # means go to the current page-->
				</form>

			</div>
		</div>
	</div>
</body>
</html>