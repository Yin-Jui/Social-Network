<?php 

include("../../Config/config.php");  // ajax can male database call without reload the page
include("../classes/User.php");
include("../classes/Post.php");
include("../classes/Notification.php");

$limit = 5; // number of post to be loaded
$posts = new Post($con, $_REQUEST['userLoggedIn']);
$posts->loadProfilePosts($_REQUEST, $limit);
 ?>