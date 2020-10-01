<?php
include("../../Config/config.php");
include("../classes/User.php");
include("../classes/Message.php");


$limit = 4;

$message = new Message($con, $_REQUEST['userLoggedIn']);  // request comes from the ajax call at social.js
echo $message->getConvosDropdown($_REQUEST, $limit);


?>