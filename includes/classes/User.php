<?php 
	class User{

		private $user;
		private $con;

		public function __construct($con, $user){  // $user = username

			$this->con = $con;
			$user_details_query = mysqli_query($con, "SELECT * FROM Users WHERE username = '$user'");
			$this->user = mysqli_fetch_array($user_details_query);  //user = the result of the above query as a array.

		}

		public function getNumPosts(){
			$username = $this->user['username'];
			$query = mysqli_query($this->con,"SELECT num_posts FROM Users WHERE username='$username'");
			$row = mysqli_fetch_array($query);
			return $row['num_posts'];
		}
		
		public function getFirstAndLastName(){


			$username = $this->user['username'];
			$query = mysqli_query($this->con, "SELECT first_name, last_name FROM Users WHERE username = '$username'");
			$row = mysqli_fetch_array($query);
			return $row['first_name'] . " " . $row['last_name'];
		}

		public function getUsername(){

			return $this->user['username'];
		}
	}
	
 ?>