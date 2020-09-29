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

		public function getProfilePic(){


			$username = $this->user['username'];
			$query = mysqli_query($this->con, "SELECT profile_pic FROM Users WHERE username = '$username'");
			$row = mysqli_fetch_array($query);
			return $row['profile_pic'];
		}

		public function getUsername(){

			return $this->user['username'];
		}

		public function isClosed(){

			$username = $this->user['username'];
			$query = mysqli_query($this->con, "SELECT user_closed FROM Users WHERE username = '$username'");
			$row = mysqli_fetch_array($query);
			if($row['user_closed'] == 'yes') return true;
			else return false;
		}

		public function isFriend($username_to_check){

			$usernameComma = "," . $username_to_check . ",";

			if(strStr($this->user['friend_array'], $usernameComma) || $username_to_check == $this->user['username']){
				return true;
			}//check if a string is inside another string

			else return false;
		}
	}
	
 ?>