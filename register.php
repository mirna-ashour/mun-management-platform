<html>

<header>
  <link href="registerTemplate.css" rel="stylesheet" type="text/css" media="all">
  <?php 
  	session_start(); 
	require_once 'authController.php';
	require_once 'connect.php';
  ?>
</header>

<body bgcolor= "e1ffe0">

  <title>BayMUN XII</title> 
  <div class="container">
    <center><h1><b>Register</b></h1></center>
  </div>
  <div class="regis-box">
    <form action="register.php" method="post">		
	  <ul class="form"> 
	    <?php if(count($errors) > 0 ): ?>
		  <br>
		  <ul style="list-style-type: disc; color: red; background: #ffc6c6; width: 75%; border-radius: 8px; margin-left: 8.5%;">
		    <br>
			<?php foreach($errors as $error): ?>
			  <li style="display: list-item; color: red; font: 92% arial; margin-left: 13%;" class="errors"><b><?php echo $error ?></b></li>
		    <?php endforeach; ?>
			<br>
		  </ul>
        <?php endif; ?>
		<br>
		<li><p>First name:</p></li>
	    <li><input type="text" name="firstName" value="<?php echo $firstName; ?>"></input></li><br>
	    <li><p>Last name:</p><li>
	    <li><input type="text" name="lastName" value="<?php echo $lastName; ?>"></input></li><br>
	    <li><p>Email:</p></li>
	    <li><input type="text" name="email" value="<?php echo $email; ?>"></input></li><br>
	    <li><p>Password:</p></li>
	    <li><input type="password" name="password"></input></li><br>
	    <li><p>Confirm password:</p><li>
	    <li><input type="password" name="conPassword"></input></li><br>
		<li><p>CPR/ID number:</p></li>
		<li><input type="text" name="cpr" value="<?php echo $cpr; ?>"></input></li><br>
		<li><p>Phone number:</p></li>
		<li><input type="text" name="phoneNumber" value="<?php echo $phoneNumber; ?>"></input></li></br>
	    <li><p>School:</p></li>
	    <li>
		<select class="select" name="school">
		    <option value="" selected disabled hidden>--Select--</option>
			<?php
				$schools = $connect->query("SELECT * FROM schools");

				foreach($schools as $school):
            ?>
				<option value="<?php echo $school['schoolID'];?>"><?php echo $school['school']; ?></option>
			<?php endforeach; ?>
		  </select></li><br>
	    <li><p>Grade:</p></li>
	    <li>
	      <select class="select" name="grade">
  		    <option value="" selected disabled hidden>--Select--</option>
			<option value="8">Grade 8</option>
		    <option value="9">Grade 9</option>
		    <option value="10">Grade 10</option>
		    <option value="11">Grade 11</option>
		    <option value="12">Grade 12</option>
		  </select>
        </li>
	    <br><br>
	    <li><input style="float: right;" type="submit" name="next" value="Next"></input></li>
	    <br><br><br><br>
      </ul>
    </form>	
  </div>
  <br><br><br>

</body>

</html>






