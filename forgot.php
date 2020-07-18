<html>

  <?php require 'connect.php'; ?>
  <?php require 'sendMail.php'; ?>
  <?php require 'headerTemplate.php'; ?>
  

  <head>
    <link href="https://fonts.googleapis.com/css?family=Manjari&display=swap" rel="stylesheet">
  </head>
  
  <body bgcolor= "e1ffe0">

  <style>

    .container-bg {
        width: 40%;
        height: 35%;
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
	  height: 15%; 
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

    function uniqidReal($length = 13)
    {
        if (function_exists("random_bytes")) 
        {
            $bytes = random_bytes(ceil($length / 2));
            } elseif (function_exists("openssl_random_pseudo_bytes")) {
                $bytes = openssl_random_pseudo_bytes(ceil($length / 2));
            } else {
                throw new Exception("no cryptographically secure random function available");
        }
        return substr(bin2hex($bytes), 0, $length);
    }
    $email="";

    $errors = array();

        if(isset($_POST['submit']))
        {
            $email= $_POST['email'];
           
            if(empty($email))
            {
                $errors['email']='Email required.';
            }
          
    	    $result = $connect->query("SELECT * FROM accounts WHERE email='".$email."'");
    	    if($result->num_rows == 0)
    	    {
    		    $errors['email'] = "This email address is not registered.";
          }
            else
            {
                
                $resetID = uniqidReal();
                $resetUser = $result->fetch_assoc();
                $connect->query("INSERT INTO user_password_reset_requests (userID, token) VALUES (".$resetUser['userID'].",'".$resetID."')");
                $message = "<a href='http://bayanmun.com/baymun.com/resetPassword.php?token=".$resetID."'>Click here to reset your password.</a>";
                $mail->AddAddress($resetUser['email']);
                $mail->addReplyTo("admin@bayanmun.com");
                
                sendmail($mail, "BayMUN password reset", $message);
                $errors['emailSent']='A message has been sent to your email with instructions in how to reset your password';
            }
            
            
          }
  ?>
  
  <div class="container-bg">
    <br><br>
    <?php if(count($errors) > 0 ): ?>
      <?php foreach($errors as $error): ?>
        <p style="display: list-item; color: red; font: 92% 'Manjari', sans-serif; margin-left: 16%;"><b><?php echo $error ?></b></p>
      <?php endforeach; ?><br>
    <?php endif; ?>

   <form action="forgot.php" method="post">
    <p id="labels">Enter your account email:</p>
    <input type="text" name="email"></input>
    <br><br><br>
    <input style="float: right;" type="submit" name="submit" value="Submit"></input>
   </form>
  </div>




</body>


</html>