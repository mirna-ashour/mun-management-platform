<html>

<head>
  <?php 
	session_start(); 
	require_once 'connect.php';
	require 'headerTemplate.php';
  ?>
</head>
  
  <style>
	.bar {
      height: auto;
      width: 40.3%;
      background-color: #035100;
	  position: absolute;
	  z-index: 3;
	  top: 26%;
	  left: 29.7%;
	  display: inline-block;
	  border-top-right-radius: 30px;
	  border-top-left-radius: 30px;
    }

      .container-login {
      height: auto;
      width: 40.3%;
      background-color: white;
      position: absolute;
      z-index: 2;
	  top: 34%;
	  left: 29.7%;
	  display: inline-block;
	  border-radius: 30px;
	
    }
	
	h3 {
	  font-family: 'Manjari', sans-serif;
	  font-size: 150%;
	  color: #bbbd00;
	  text-align: center;
	  position: relative;
	}
	
	ul  {
	 list-style-type: none;
     margin: 0;
     padding: 0;
     overflow: hidden;
	}
	
	li {
	  display: block;
	  text-decoration: none;
	  position: relative;
	  left: 22.5%;
	  margin-left: 2%;
	}
	
	p {
	  color: black;
	  font: bold 110% 'Manjari', sans-serif;
	}
	
	input[type=submit] {
      background: #1d4200;
      color: white;
	  border-color: #1d4200;
	  font: bold 95% 'Manjari', sans-serif;
	  text-shadow:none;
	  text-decoration: none;
	  padding: 2%;
	  position: relative;
	  border-radius: 20px;
	  cursor: pointer;
	  width: 52.5%;
	}
	  
	.text {
	  background-color: #fffcbb;
	  border: 2px solid #bbbd00; 
	  height: 30%;
	  width: 52.5%;
	  border-style: inset; 
	  border-radius: 20px;
    }
	
	.msg {
	 font-size: 100%;
	 font-family: 'Manjari', sans-serif;
	 color: red;
	 position: relative; 
	 margin-left: 8.7%;
	 top: 2%;
	}
  </style>
  
<?php
  
  $var=" ";
  if ( isset( $_POST['submit'] ) ) 
  {
	$email = $_POST["email"];
	$password = $_POST["password"];
	$result = $connect->query("SELECT * FROM accounts where email='".$email."'");

  if($result->num_rows > 0)
    {
	   $user = $result->fetch_assoc();
		if(password_verify($password, $user['password']))
	    {
		  $result = $connect->query("SELECT userID FROM accounts where email='".$email."'");
		  $user = $result->fetch_assoc();
		  $_SESSION["userID"] = $user['userID'];
		  $result = $connect->query("SELECT position FROM user_details where userID=".$_SESSION["userID"]."");
		  $user = $result->fetch_assoc();
		  $_SESSION["position"] = $user['position'];
		  header('location: home.php');
		  exit;
		 
	    }
	    else
	    {
		  $var='Invalid email or password.';
	    }
	   
	  
    }
    else
    {
	   $var='Invalid email or password.'; 
	}
	//<center><small style="color: #9c9c9c; float:bottom;">Developed by Mirna Ashour.</small></center>
 	//<center><small style="color: #9c9c9c; float:bottom;">&copy; Copyright 2019, BayanMUN.</small></center>
 }
 
?>

  <br><br><br><br><br>
  <div class="bar">
    <h3>Log-in<h3>
  </div>
  <div class="container-login">
      <form action="index.php" method="post">
	    <ul>
		  <br> 
		  <li><p class="msg" name="msg"><b><?php echo $var;?></b></p></li><br>
	      <li><p><b>Email:</b></p></li>
	      <li><input class="text" type="text" name="email"></input></li><br>
	      <li><p style="top: 5%"><b>Password:</b></p></li>
		  <li><input class="text" type="password" name="password"></input></li>
		  <li><a style="font: 85% 'Manjari', sans-serif; color: #9c9c9c; position: relative; margin-top: 1%;" href="forgot.php"><b>Forgot your password?</b></a></li>
	      <br> <br> 
	      <li><input type="submit" name="submit" value="Sign-in"></input></li>
		  <br> <br> <br>  
		  <li><a style="font: bold 110% 'Manjari', sans-serif; color: #bbbd00; position: relative; left: 16%" href="register.php"><b>Register here</b></a></li>
	     
	    </ul>
	  </form>
	  <br>
  </div><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
 

</body>

</html>




