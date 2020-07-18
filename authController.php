<?php

require 'connect.php';

$firstName = "";
$lastName = "";
$email = ""; 
$school = "";
$grade = ""; 
$cpr = "";
$phoneNumber = "";
$errors = array();

if(isset($_POST['next']))
{
	$firstName = ucfirst($_POST['firstName']);
	$lastName = ucfirst($_POST['lastName']);
	$email = $_POST['email'];
	$temp = $_POST['password'];
	$conPassword = $_POST['conPassword'];
	
	if(isset($_POST['school'])) 
	{
		$school = $_POST['school'];
	}
	if(isset($_POST['grade']))
	{
		$grade = $_POST['grade'];	
	}
	$cpr = $_POST['cpr'];
	$phoneNumber = $_POST['phoneNumber'];
	
	if($temp == $conPassword)
	{
		$password = password_hash($temp, PASSWORD_DEFAULT);
	}
	else {
		$password = password_hash($temp, PASSWORD_DEFAULT);
		$errors['password'] = "The passwords you entered do not match.";
	}
	
	$_SESSION["firstName"] = $firstName;
	$_SESSION["lastName"] = $lastName;
	$_SESSION["email"] = $email;
	$_SESSION["password"] = $password;
	$_SESSION["school"] = $school;
	$_SESSION["grade"] = $grade;
	$_SESSION["cpr"] = $cpr;
	$_SESSION["phoneNumber"] = $phoneNumber; 

	if(empty($firstName))
	{
		$errors['firstName'] = "First name required.";
	}
	//if(!preg_match('/^[a-zA-Z]*/', $firstName))
	//{
	//	$errors['firstName'] = "First name is invalid.";
	//}
	if(empty($lastName))
	{
		$errors['lastName'] = "Last name required.";
	}
	//if(!preg_match('/^[A-Z]+$/i', $lastName))
	//{
		//$errors['lastName'] = "Last name is invalid.";
	//}
	if(!filter_var($email, FILTER_VALIDATE_EMAIL))
	{
		$errors['email'] = "Email address is invalid.";
	}
	if(empty($email))
	{
		$errors['email'] = "Email address required."; 
	}
	if(empty($password))
	{
		$errors['password'] = "Password required.";
	}
	if(empty($conPassword))
	{
		$errors['conPassword'] = "Password confirmation required.";
	}
	//if(!preg_match('/^[\d]+$/', $cpr))
	//{
	//	$errors['cpr'] = "CPR/ID is invalid.";
	//}
	if(empty($cpr))
	{
		$errors['cpr'] = "CPR/ID number required.";
	}
	//if(!preg_match('/^[\d]+$/', $phoneNumber))
	//{
	//	$errors['phoneNumber'] = "Phone number is invalid.";
	//}
	if(empty($phoneNumber))
	{
		$errors['phoneNumber'] = "Phone number required.";
	}
	if(empty($school))
	{
		$errors['school'] = "School required.";
	}
	if(empty($grade))
	{
		$errors['grade'] = "Grade required.";
	}

	$result = $connect->query("SELECT * FROM accounts WHERE email='".$email."'");
	if($result->num_rows > 0)
	{
		$errors['email'] = "This email address is already registered.";
	}


	if(count($errors) == 0)
	{
		header('location: registerNext.php');
	}	
}

$position = "";
$experiences = "";
$errors2 = array();

if(isset($_POST['next2']))
{
	if(isset($_POST['position']))
	{
		$position = $_POST['position'];
	}
	if(isset($_POST['exp']))
	{
		$experiences = $_POST['exp'];
	}
	
	$_SESSION["position"] = $position;
	$_SESSION["experiences"] = $experiences;
	
	if(empty($position))
	{
		$errors2['position'] = "Position required.";
	}
	if(empty($experiences))
	{
		$errors2['exp'] = "Experiences required.";
	}
	
	if(count($errors2) == 0)
	{
		header('location: registerFinal.php');
	}
	
}

$delTrain = "";
$delTrainDate = "";
$delCouncil = "";
$chairPref = "";
$camera = "";
$sigPress = "";
$qualPress = "";
$insta = "";
$sigRunner = "";
$qualRunner = "";
$diff = "";
$approach ="";

if(isset($_POST['submit']))
{
	if($_SESSION["position"] == "Delegate")
	{
		$delTrain = $_POST['training'];
		$delTrainDate = $_POST['trainingDate'];
		$delCouncil = $_POST['council'];
	}
	
	if($_SESSION["position"] == "Chair")
	{
		$chairPref = $_POST['chairPref'];
	}
	
	if($_SESSION["position"] == "Press")
	{
		$camera = $_POST['pressCamera'];
		$sigPress = $_POST['sigPress'];
		$qualPress = $_POST['qualPress'];
		$insta = $_POST['insta'];
	}
	
	if($_SESSION["position"] == "Runner")
	{
		$sigRunner = $_POST['sigRunner'];
		$qualRunner = $_POST['qualRunner'];
		$diff = $_POST['diff'];
		$approach = $_POST['approach'];
	}
	
	$connect-> query("INSERT INTO accounts (email, password) VALUES ('".$_SESSION["email"]."', 
	'".$_SESSION["password"]."')");
	$result = $connect->query("SELECT userID FROM accounts WHERE email='".$_SESSION["email"]."'"); 
	$userID = $result->fetch_assoc();

	$connect->query("INSERT INTO user_details (userID, firstName, lastName, schoolID, grade, position) 
	VALUES (".$userID['userID'].",'".$_SESSION["firstName"]."','".$_SESSION["lastName"]."', 
	'".$_SESSION["school"]."', '".$_SESSION["grade"]."', 
	'".$_SESSION["position"]."')");

	$connect->query("UPDATE user_details SET CPR = '".$_SESSION["cpr"]."', 
	phoneNumber = '".$_SESSION["phoneNumber"]."' WHERE userID = '".$userID['userID']."'");

    $connect->query("UPDATE user_details SET experiences = '".$_SESSION["experiences"]."' 
	WHERE userID = '".$userID['userID']."'");	

	if($_SESSION["position"] != "Security")
	{
		$connect-> query("INSERT INTO user_questions (userID, delegateTraining, trainingDate, councilPref, arabicCouncil, camera, sigPress, qualPress, 
		insta, sigRunner, qualRunner, diff, approach) 
		VALUES (".$userID['userID'].",'".$delTrain."','".$delTrainDate."','".$delCouncil."','".$chairPref."','".$camera."','".$sigPress."',
		'".$qualPress."','".$insta."', '".$sigRunner."', '".$qualRunner."', '".$diff."', '".$approach."')");
	}
	
	session_destroy();
	header('location: index.php');
}



?>


















