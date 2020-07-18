<?php

require_once 'connect.php';

$userID = "";

if(isset($_POST['view']))
{
	$userID = $_POST['userID'];
	header ('location: viewApp.php?userID='.$userID);
	
}

if(isset($_POST['accept']))
{
	$userID = $_POST['userID'];
	$connect->query("UPDATE user_details SET positionStatus = 1 WHERE userID = ".$userID."");
}


if(isset($_POST['decline']))
{
	$userID = $_POST['userID'];
	$connect->query("DELETE FROM user_details WHERE userID = ".$userID."");
	$connect->query("DELETE FROM  accounts WHERE userID = ".$userID."");
	$connect->query("DELETE FROM  user_questions WHERE userID = ".$userID."");
	
	
}











?>