<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once 'composer/vendor/autoload.php';

define('SMTP_HOST','relay-hosting.secureserver.net');
define('SMTP_PORT',25);
define('SMTP_AUTH',true);

$mail = new PHPMailer();

$mail->IsSMTP();
//$mail -> SMTPDebug = 1;

//test
$mail->Host = 'localhost';
$mail->SMTPAuth = false;
$mail->SMTPAutoTLS = false; 
$mail->Port = 25; 
//end of test

/*$mail->Host = 'smtpout.secureserver.net';
$mail->SMTPAuth = SMTP_AUTH;
$mail->Port = 80;
$mail->Username = 'admin@bayanmun.com';
*/
$mail->Password = 'Radia@2019';
$mail->setFrom('admin@bayanmun.com', 'BayMUN Admin Team');

function sendmail($mail, $subject, $message)
{
    $mail->Subject = $subject;
    $body = $message;
    $mail->AltBody = "To view the message, please use an HTML compatible email viewer!";
    $mail->MsgHTML($body);
    try{
      $mail->Send();
    } catch(Exception $e) 
    {          
     echo $e->errorMessage();          
    }
}


?>