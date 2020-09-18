<?php

// Declaring variables to prevent errors
$fname = "";
$lname = "";
$em = "";
$em2 = "";
$password = "";
$password2 = "";
$date = "";
$error_array = array();

if(isset($_POST['register_button'])){   // if the submit button is clicked


	$fname = strip_tags($_POST['reg_fname']);   // store in fname variable, strip_tage means taking away html tag
	$fname = str_replace(' ', '', $fname); // replace' ' in fname with '';
	$fname = ucfirst(strtolower($fname));  // Uppercast the first letter
	$_SESSION['reg_fname'] = $fname; // store first name into session variable

	$lname = strip_tags($_POST['reg_lname']);   
	$lname = str_replace(' ', '', $lname); 
	$lname = ucfirst(strtolower($lname));
	$_SESSION['reg_lname'] = $lname; // store first name into session variable

	$em = strip_tags($_POST['reg_email']);   
	$em = str_replace(' ', '', $em); 
	$em = strtolower($em);
	$_SESSION['reg_email'] = $em; // store first name into session variable

	$em2 = strip_tags($_POST['reg_email2']);   
	$em2 = str_replace(' ', '', $em2); 
	$em2 = strtolower($em2);
	$_SESSION['reg_email2'] = $em2; // store first name into session variable

	$password = str_replace(' ', '', $_POST['reg_password']);
	$password2 = str_replace(' ', '', $_POST['reg_password2']); 

	$date = date("Y-m-d");

	

	if($em == $em2){ 

			if(filter_var($em, FILTER_VALIDATE_EMAIL)){

				$em = filter_var($em, FILTER_VALIDATE_EMAIL);

				//check if the email already exist.

				$e_check = mysqli_query($con, "SELECT email FROM Users WHERE email='$em'");  // con is the connextion we make at the beginning

				//count the number of rows returned

				$num_rows = mysqli_num_rows($e_check);

				if($num_rows > 0){
					array_push($error_array, "Email address is used<br>") ;
				}

			}
			else{

				array_push($error_array, "invalid email format<br>") ;
			}
			

	}else{

		array_push($error_array, "Emails don't match<br>") ;
	}

	if(strlen($fname) > 25 || strlen($fname) < 2){

		array_push($error_array, "Your first name must between 2 and 25 characers<br>") ;
	}

	if(strlen($lname) > 25 || strlen($lname) < 2){

		array_push($error_array, "Your last name must between 2 and 25 characers<br>");
	}

	if($password != $password2) array_push($error_array, "your passwords don't match<br>");
	else{

		if(preg_match('/[^A-Za-z0-9]/', $password)){
			array_push($error_array, "Your password must contains only english characters and numbers only<br>");
		}
	}
	if(strlen($password) > 30 || strlen($password) < 5){

		array_push($error_array, "Your password must between 5 and 30 characers<br>");
	}

	if(empty($error_array)){

		//insert value into database
		
		$password = md5($password); // encrypt the password before sending it to database

		//generate username by concatenating first name and last name

		$username = strtolower($fname . "_" . $lname);
		$check_username_query = mysqli_query($con, "SELECT username FROM Users WHERE username = '$username'");
		$i = 0;
		//if username exist, add number to username

		while(mysqli_num_rows($check_username_query) != 0){

			$i++;
			$username = $username . "_" . $i;
			$check_username_query = mysqli_query($con, "SELECT username FROM Users WHERE username = '$username'");
		}

		//Profile pic assignment
		$rand = rand(1, 2); //Random number between 1 and 2

		if($rand == 1)
			$profile_pic = "assets/images/profile_pics/defaults/default_pic.png";
		else if($rand == 2)
			$profile_pic = "assets/images/profile_pics/defaults/default_pic2.png";

		
		$query = mysqli_query($con, "INSERT INTO Users VALUES(NULL, '$fname', '$lname', '$username', '$em', '$password', '$date', '$profile_pic', '0', '0', 'no', ',')");



		array_push($error_array, "<span style = 'color: #14C800;'> All set!</span><br>");

		//Clear session variables

		$_SESSION['reg_fname'] = "";
		$_SESSION['reg_lname'] = "";
		$_SESSION['reg_email'] = "";
		$_SESSION['reg_email2'] = "";

	}

}
?>