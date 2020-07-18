<?php 

require_once 'connect.php';
require_once 'sendMail.php';

$subject = "";
$message = "";
$errors= array();


if(isset($_POST['send']))
{
	$subject = $_POST['subject'];
	$message = $_POST['message'];
	if(isset($_POST['position']))
	{
		$receiver = $_POST['position'];
	}
	$recipients = array();

	if(empty($subject))
	{
		$errors['subject']= 'Subject required.';
	}
    if(empty($message))
	{
		$errors['message']= 'Message required.';
	}
	if(empty($receiver))
	{
		$errors['receiver']= 'Recipients required.';
	}
	
	if(count($errors)==0)
	{
	    if($receiver == "All")
		{
			$emails = $connect->query("SELECT email FROM accounts");
			foreach( $emails as $email)
			{
				array_push($recipients, $email);
			}
		}
		else
		{
			$userIDs = $connect->query("SELECT userID FROM user_details WHERE position= '".$receiver."'");
			foreach($userIDs as $userID)
			{
				$temp = $connect->query("SELECT email FROM accounts WHERE userID = ".$userID['userID']."");
				$email = $temp->fetch_assoc();
				array_push($recipients, $email['email']);
			}
		}

	if(count($recipients)%30 > 0)
	{
		$batch= (int) (count($recipients)/30);
	  $remainder = count($recipients)%30;

		$count=0;
		
	  for($i=0;$i<$batch;$i++)
	  {
		$toSend=array();
		for($j=0;$j<30;$j++)
		{
			array_push($toSend, $recipients[$count]);
			$count++;
		}
		foreach($toSend as $recipient)
		{
			$mail-> AddBCC($recipient['email']);
		}
		sendmail($mail, $subject, $message);
		sleep(20);
	  }

	  $toSend=array();
	  for($i=0;$i<$remainder;$i++)
	  {
		array_push($toSend, $recipients[$count]);
		$count++;
	  }
	  foreach($toSend as $recipient)
	  {
		$mail-> AddBCC($recipient['email']);
	  }
	  sendmail($mail, $subject, $message);
	}
	else{

		foreach($recipients as $recipient)
	  {
		$mail-> AddBCC($recipient['email']);
	  }
	  sendmail($mail, $subject, $message);
	}
	

	
}
}









?>