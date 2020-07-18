<?php
    require_once 'connect.php';
    require_once 'sendMail.php';
    
    $subject = "";
    $message = "";
    $errors = array();
    
    if(isset($_POST['send']))
    {
        $subject = $_POST['subject'];
        $message = $_POST['message'];
        
        if(empty($subject))
        {
            $errors['subject']= 'Subject required.';
        }
        if(empty($message))
        {
            $errors['message']= 'Message required.';
        }

        if(count($errors) == 0)
        {
            $temp = $connect->query("SELECT * FROM user_details WHERE userID = ".$_SESSION["userID"]."");
            $result = $temp->fetch_assoc();
            $temp = $connect->query("SELECT email FROM accounts WHERE userID= ".$_SESSION["userID"]."");
            $email = $temp->fetch_assoc();

            $subjectS = 'INQUIRY: ' . $subject;
            $messageS= '<b>Name:</b> ' . $result['firstName'] . ' '. $result['lastName'] . '<br>' 
            .'<b>Email:</b> ' . $email['email']. '<br><br>' .$message;
            $mail->AddAddress('admin@bayanmun.com');
            $mail->addReplyTo($email['email']);
            

             sendmail($mail, $subjectS, $messageS);
             $subject = "";
             $message = "";
        }
    }






















?>