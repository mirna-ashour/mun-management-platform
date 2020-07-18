<?php 

    $errors = array();
    $firstName = "";
    $lastName = "";
    $email = "";
    $schoolID ="";

    if(isset($_POST['director']))
    {
        $email= $_POST['email'];
        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        if(isset( $_POST['school']))
        {
            $schoolID = $_POST['school'];
        }
        
        if($_POST['password']==$_POST['conPassword'])
        {
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        }
        else
        {
            $errors['password'] = 'Passwords entered do not match.';
        }

        if(empty($email))
        {
            $errors['email']='Email required.';
        }
        if(empty($firstName))
        {
            $errors['firstName']='First name required.';
        }
        if(empty($lastName))
        {
            $errors['lastName']='Last name required.';
        }
        if(empty($password))
        {
            $errors['password']='Password required.';
        }
        if(empty($schoolID))
        {
            $errors['school']='School required.';
        }

        if($errors > 0)
        {
            $connect->query("INSERT INTO accounts (email, password, status) VALUES ('".$email."', '".$password."', '1') ");
            $temp = $connect->query("SELECT max(userID) as userID FROM accounts");
            $userID = $temp->fetch_assoc();
               // echo $userID['userID'];
            $connect->query("INSERT INTO user_details (userID, firstName, lastName, schoolID, position, positionStatus, paymentStatus) 
            VALUES (".$userID['userID'].", '".$firstName."', '".$lastName."', '".$schoolID."', 'Director', '1', '1')");

            $firstName = "";
            $lastName = "";
            $email = "";
            $schoolID ="";
        }


    }

    $school = "";
    $error ="";

    if(isset($_POST['school']))
    {
        $school = "";

        $school = $_POST['schoolName'];
        if(empty($school))
        {
            $error = 'School required.';
        }

        if(empty($error))
        {
            $connect->query("INSERT INTO schools (school) VALUES ('".$school."')");

            $school = "";
        }
    }


















?>