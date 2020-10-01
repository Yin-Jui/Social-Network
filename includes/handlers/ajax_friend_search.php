<?php 
include("../../Config/config.php");
include("../classes/User.php");

$query = $_POST['query'];
$userLoggedIn = $_POST['userLoggedIn'];

$names = explode(" ", $query); //$query: people you are searching for. explode make the search string split by space.

if(strpos($query,"_") !== false){ // !== means the type of variables should also be the same, not only the vcalue.
	//if query contains_ means user want to search for username
	$userReturned = mysqli_query($con, "SELECT * FROM Users WHERE username LIKE'$query%' AND user_closed = 'no' LIMIT 8");//LIKE $query%, will return every string starts with $query.
}
else if(count($names) == 2){//assume searching for first and last name

	$userReturned = mysqli_query($con, "SELECT * FROM Users WHERE (first_name LIKE '%$names[0]%' AND last_name LIKE '%$names[1]%')AND user_closed = 'no' LIMIT 8");
}
else{

	$userReturned = mysqli_query($con, "SELECT * FROM Users WHERE (first_name LIKE '%$names[0]%' OR last_name LIKE '%$names[0]%') AND user_closed='no' LIMIT 8");
}

if($query != "") {
	while($row = mysqli_fetch_array($userReturned)) {

		$user = new User($con, $userLoggedIn);

		if($row['username'] != $userLoggedIn) {
			$mutual_friends = $user->getMutualFriend($row['username']) . " friends in common";
		}
		else {
			$mutual_friends = "";
		}
		if($user->isFriend($row['username'])) {
			
			echo "<div class='resultDisplay'>
					<a href='messages.php?u=" . $row['username'] . "' style='color: #000'>
						<div class='liveSearchProfilePic'>
							<img src='". $row['profile_pic'] . "'>
						</div>

						<div class='liveSearchText'>
							".$row['first_name'] . " " . $row['last_name']. "
							<p style='margin: 0;'>". $row['username'] . "</p>
							<p id='grey'>".$mutual_friends . "</p>
						</div>
					</a>
				</div>";


		}


	}
}

 ?>