<?php 
	class Post{

		private $user_obj;
		private $con;

		public function __construct($con, $user){  // $user = username

			$this->con = $con;
			$this->user_obj = new User($con, $user); 

		}

		public function submitPost($body, $user_to){

			$body = strip_tags($body); // remove html tags
			$body = mysqli_real_escape_string($this->con, $body);  //escape special character to  prevent from misunderstandinf of SQL code

			$body = str_replace('\r\n', '\n', $body);  //anytime we find space(\r) and new line(\n) together, we replace it by \n
			$body = nl2br($body); // replace \n with <br>

			$check_empty = preg_replace('/\s+/', '', $body);  // replace spaces with nothing // replace a regular expression

			if($check_empty != ""){

				//Current date and time

				$date_added = date("Y-m-d H:i:s"); // date and time format
				$added_by = $this->user_obj->getUsername();
				//If user is on own profile, user_to is 'none'

				if($user_to == $added_by){

					$user_to = 'none';
				}

				$query = mysqli_query($this->con, "INSERT INTO posts VALUES(NULL, '$body', '$added_by', '$user_to', '$date_added','no', 'no', '0')");
				$returned_id = mysqli_insert_id($this->con); // return the id of the post just submitted.

				//Insert notification 

				//Update post count for users

				$num_posts = $this->user_obj->getNumPosts();
				$num_posts++;
				$update_query = mysqli_query($this->con, "UPDATE Users SET num_posts = '$num_posts' WHERE username = '$added_by'");

			}
			
		}
	}
	
 ?>