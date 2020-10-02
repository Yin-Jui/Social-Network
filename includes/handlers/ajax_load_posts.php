<?php 

include("../../Config/config.php");  // ajax can make database call without reload the page
include("../classes/User.php");
include("../classes/Post.php");
include("../classes/Notification.php");

$limit = 5; // number of post to be loaded
$posts = new Post($con, $_REQUEST['userLoggedIn']);
$posts->loadPostsFriends($_REQUEST, $limit);
 ?>