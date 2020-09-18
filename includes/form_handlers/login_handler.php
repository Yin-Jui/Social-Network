<?php 

if(isset($_POST['login_button'])){
	
	$email = filter_var($_POST['log_email'], FILTER_SANITIZE_EMAIL);

	$_SESSION['log_email'] = $email; //Store email into session variable
	$password = md5($_POST['log_password']); //Get password

	$check_database_query = mysqli_query($con, "SELECT * FROM Users WHERE email = '$email' AND password = '$password'");

	$check_login_query = mysqli_num_rows($check_database_query);


	if($check_login_query == 1){

		$row = mysqli_fetch_array($check_database_query);  // the result of the query is stored in $row
		$username = $row['username'];  //we want the username column

		$user_closed_query = mysqli_query($con, "SELECT * FROM Users WHERE email = '$email' AND user_closed = 'yes'");
		if(mysqli_num_rows($user_closed_query) == 1){

			$reopen_account = mysqli_query($con, "UPDATE Users SET user_closed = 'no' WHERE email = '$email'");
		}

		$_SESSION['username'] = $username;  // check if session variable is NULL or not to know if the user is logged in
		header("Location: index.php"); // head to index.php
		exit();
	}
	else{

		array_push($error_array, "<br>Email or password is incorrect<br>");
	}

}

 ?>