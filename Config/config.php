<?php
ob_start(); // Turns on output buffereing
session_start();

$timezone = date_default_timezone_set("America/Los_Angeles");

$con = mysqli_connect("localhost", "root", "", "social");

if(mysqli_connect_errno()){

	echo " Failed to connext: " . mysqli_connect_errno();
}
?>