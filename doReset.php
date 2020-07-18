<html>

  <?php require 'connect.php'; ?>
  <?php require 'headerTemplate.php'; ?>
 
  <head>
    <link href="https://fonts.googleapis.com/css?family=Manjari&display=swap" rel="stylesheet">
  </head>
  
  <body bgcolor= "e1ffe0">

  <style>

    .container-bg {
        width: 40%;
        height: 70%;
        margin-left: 30%;
        margin-top: 7%;
        background-color: white;
        border-radius: 20px;
    }

    p#labels {
	  color: black;
      font: bold 110% 'Manjari', sans-serif;
      margin-left: 13%;
    }
    
    input[type=text]  {
	  background-color: #fffcbb; 
	  border: 2px solid #bbbd00;
	  height: 5%; 
	  width: 70%;
      border-style: inset;
      border-radius: 15px;
      margin-left: 13%;

	}
	
	input[type=password]  {
      background-color: #fffcbb; 
	  border: 2px solid #bbbd00;
      height: 5%; 
	  width: 70%;
      border-style: inset;
      border-radius: 15px;
      margin-left: 13%;
	}
	
	input[type=submit] {
      background: #1d4200;
      color: white;
	  border-style: outset;
	  border-color: #1d4200;
	  font: bold 90% 'Manjari', sans-serif;
	  text-shadow:none;
	  text-decoration: none;
	  padding: 2% 4%;
	  position: relative;
      border-radius: 15px;
      float: right;
      margin-right: 6%;
    }

  </style>
  
    
 
  <?php
   

    
    $email="";
    $pass="";
    $conPass="";
    $errors = array();

    if(isset($_POST['submit']))
    {
        $email= $_POST['email'];
        $conPass= $_POST['conPass'];
        $pass = $_POST['pass'];
        
        
        if(empty($pass))
        {
            $errors['pass']='Password required';
        }
        if($_POST['pass'] === $_POST['conPass'])
        {
            $pass= password_hash($_POST['pass'], PASSWORD_DEFAULT);
        }
        else{
            $pass = "";
            $errors['pass']="The passwords you entered do not match.";
        }

        if(empty($email))
        {
            $errors['email']='Email required';
        }
        if(empty($conPass))
        {
            $errors['conPass']='Password confirmation required';
        }
	    $result = $connect->query("SELECT * FROM accounts WHERE email='".$email."'");
	    if($result->num_rows == 0)
	    {
		    $errors['email'] = "This email address is not registered.";
        }
        
        if(count($errors)==0)
        {
            $connect->query("UPDATE accounts SET password = '".$pass."' WHERE email = '".$email."'");
            $fetch=$result->fetch_assoc();
            $connect->query("DELETE FROM `user_password_reset_requests` WHERE userID = ".$fetch['userID']);
            header('location:index.php');
        }
    }

  ?>





</body>


</html>