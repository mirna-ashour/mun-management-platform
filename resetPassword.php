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

    $showForm=false;
    $email="";
    $result = $connect->query("Select userID, dateAndTime from user_password_reset_requests where token='".$_GET['token']."'");
    
    if(mysqli_num_rows($result)<1)
    {
        $errors['token']="Invalid session token";
    }
    else
    {
        $request=$result->fetch_assoc();
        $requestDT=$request['dateAndTime']; 
        $userID=$request['userID'];
        
        $result= $connect->query("Select NOW() as 'Time'");
        $fetch=$result->fetch_assoc();
        $currentDT=$fetch['Time'];
        
        $result = $connect->query("SELECT * FROM accounts WHERE userID=".$userID);
       
        if(mysqli_num_rows($result)<1)
        {
            $errors['account']="Invalid account info";
        }
        else
        {
            $fetch=$result->fetch_assoc();
            $email=$fetch['email'];
        }
        
        if(((strtotime($currentDT)-strtotime($requestDT))<=3600) && (count($errors) > 0) )
        {
            echo "Request timed out, make a 
            new request";
        }
        else
        {
            $showForm=true;
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
    <form action="doReset.php?do=rest" method="post">
    <?php if($showForm==true) : ?>
        
        <p id="labels">Your account email:</p>
        <input type="text" name="email" value=<?php echo $email; ?> placeholder=<?php echo $email; ?> readonly><br>
        <p id="labels">Enter your new password:</p>
        <input type="password" name="pass"></input>
        <p id="labels">Confirm your new password:</p>
        <input type="password" name="conPass"></input>
        <br><br><br><br><br><br><br><br>
        <input style="float: right;" type="submit" name="submit" value="Submit"></input>
       
    <?php endif; ?> 
    </form>
  </div>
  



</body>


</html>