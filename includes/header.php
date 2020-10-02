<?php

require 'Config/config.php';
include("includes/classes/User.php");
include("includes/classes/Post.php");
include("includes/classes/Message.php");
include("includes/classes/Notification.php");


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
	<script src="assets/js/bootbox.min.js"></script>
	<script src="assets/js/Social.js"></script>
	<script src="https://kit.fontawesome.com/8b5ecfaba5.js" crossorigin="anonymous"></script>
	<script src="assets/js/jquery.Jcrop.js"></script>
	<script src="assets/js/jcrop_bits.js"></script>


	<!-- CSS -->
	<link rel="stylesheet" href="assets/css/jquery.Jcrop.css" type="text/css" />
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
</head>
<body>
 
 	<div class = "top_bar">
 		
 		<div class = "logo">
 			
 			<a href="index.php">JimBaz</a>
 		</div>

 			<nav>

 				<?php
 					//Unread messages
 					$messages = new Message($con, $userLoggedIn);
 					$num_messages = $messages->getUnreadNumber();
 					//Unread notifications
 					$notifications = new Notification($con, $userLoggedIn);
 					$num_notifications = $notifications->getUnreadNumber();
 				?>

 				<a href="<?php echo $userLoggedIn; ?>">
 					<?php 
 						echo $user['first_name'];
 					 ?>
 				</a>
 				
 				<a href="javascript:void(0);" onclick="getDropdownData('<?php echo $userLoggedIn; ?>', 'message')">
				<i class="fa fa-envelope fa-lg"></i>
				<?php
				if($num_messages > 0)
				echo "<span class = 'notification_badge' id='unread_message'>" . $num_messages . "</span>";
				?>
			</a>
 				<a href="#">
 					<i class="fa fa-home" aria-hidden="true"></i>
 				</a>
 				<a href="javascript:void(0);" onclick="getDropdownData('<?php echo $userLoggedIn; ?>', 'notification')">
 					<i class="fa fa-bell-o" aria-hidden="true"></i>
 					<?php
						if($num_notifications > 0)
						echo "<span class = 'notification_badge' id='unread_notification'>" . $num_notifications . "</span>";
					?>
 				</a>
 				<a href="request.php">
 					<i class="fa fa-users" aria-hidden="true"></i>
 				</a>
 				<a href="#">
 					<i class="fa fa-cog" aria-hidden="true"></i>
 				</a>
 				<a href="includes/handlers/logout.php">
 					<i class="fa fa-sign-out" aria-hidden="true"></i>
 				</a>
 			</nav>

 			<div class = "dropdown_data_window"style="height:0px;"></div>
 			<input type = "hidden" id = "dropdown_data_type" value="">

 	</div>

 	<script>
	var userLoggedIn = '<?php echo $userLoggedIn; ?>';

	$(document).ready(function() {

		$('.dropdown_data_window').scroll(function() {
			var inner_height = $('.dropdown_data_window').innerheight(); //Div containing posts
			var scroll_top = $('.dropdown_data_window').scrollTop();
			var page = $('.dropdown_data_window').find('.nextPageDropdowmData').val();
			var noMoreData = $('.dropdown_data_window').find('.noMoreDropdownData').val();

			if ((scroll_top + inner_height >= $('.dropdown_data_window')[0].scrollHeight) && noMorePosts == 'false') {
				
				var pageName;////Holds name of page to send ajax request to
				var type = $('#dropdown_data_type').val();

				if(type == 'notification')
					pageName = "ajax_load_notifications.php";
				else if(type = 'message')
					pageName = "ajax_load_messages.php"

				var ajaxReq = $.ajax({
					url: "includes/handlers/" + pageName,
					type: "POST",
					data: "page=" + page + "&userLoggedIn=" + userLoggedIn,
					cache:false,

					success: function(response) {
						$('.dropdown_data_window').find('.nextPageDropdownData').remove(); //Removes current .nextpage 
						$('.dropdown_data_window').find('.noMoreDropdownData').remove(); //Removes current .nextpage 

						$('.dropdown_data_window').append(response);
					}
				});

			} //End if 

			return false;

		}); //End (window).scroll(function())


	});

	</script>

 	<div class = "wrapper">  <!-- close the div in index.php-->