<?php
include("../../Config/config.php");
include("../classes/User.php");
include("../classes/Notification.php");

$limit = 4;

$message = new Notification($con, $_REQUEST['userLoggedIn']);  // request comes from the ajax call at social.js
echo $message->getNotification($_REQUEST, $limit);

?>