<html>

<header>
  <link href="registerTemplate.css" rel="stylesheet" type="text/css" media="all">
  <?php session_start(); require_once 'authController.php'; ?>
</header>

<body bgcolor= "e1ffe0">

  <title>BayMUN XII</title>  
  <div class="container">
    <center><h1><b>Register</b></h1></center>
  </div>
  <div class="regis-box">
    <form action="registerFinal.php" method="post">		
	  <ul class="form"> 
	    <br>
	    <?php if(count($errors2) > 0 ): ?>
		  <br>
		  <ul style="list-style-type: disc; color: red; background: #ffc6c6; width: 75%; border-radius: 8px; margin-left: 8.5%;">
		    <br>
			<?php foreach($errors2 as $error): ?>
			  <li style="display: list-item; color: red; font: 92% arial; margin-left: 13%;" class="errors"><b><?php echo $error ?></b></li>
		    <?php endforeach; ?>
			<br>
		  </ul>
        <?php endif; ?>
		<br>
		
		<?php if($_SESSION["position"] == "Delegate"): ?>
		  <li><p>Do you want delegate training?</p></li>
		  <li><input type="radio" name="training" value="1">Yes</input></li>
		  <li><input type="radio" name="training" value="0">No</input></li><br>
		  <li><p>If so, select your preferred date:</p></li>
		  <li><input type="radio" name="trainingDate" value="06/11/2019">06/11/2019</input></li>
		  <li><input type="radio" name="trainingDate" value="10/11/2019">13/11/2019</input></li>
		  <li><p>Select your council preference:</p></li>
		  <li><input type="radio" name="council" value="General Assembly">General Assembly</input></li>
		  <li><input type="radio" name="council" value="Specialized">Specialized Council</input></li>
		  <li><input type="radio" name="council" value="Arabic Council">Arabic council</input></li><br>
		<?php endif; ?>
		
		<?php if($_SESSION["position"] == "Chair"): ?>
		  <li><p>Would you like to chair an arabic council?</p></li>
		  <li><input type="radio" name="chairPref" value="1">Yes</input></li>
		  <li><input type="radio" name="chairPref" value="0">No</input></li><br>
		<?php endif; ?>
		
		<?php if($_SESSION["position"] == "Press"): ?>
		  <li><p>Do you own a camera?</p></li>
		  <li><input type="radio" name="pressCamera" value="1">Yes</input></li>
		  <li><input type="radio" name="pressCamera" value="0">No</input></li><br><br>
		  <li><p>Your instagram account:</p></li>
		  <li><input type="text" name="insta"</input></li><br><br>
		  <li><p>How is photography significant in your life?</p></li>
		  <li><textarea rows="12" cols="38" name="sigPress"></textarea><br><br>
		  <li><p>What unique qualities would you bring if you<br/>are accepted into the press team?</p></li>
		  <li><textarea rows="12" cols="38" name="qualPress"></textarea><br><br><br>
		  <li><p style="margin-left: -12%;">Email us (baymun.bh@gmail.com) a portfolio consisting<br/>of 5-7 pictures- could be of past conferences or personal<br/>work- that demonstrate your style and skill in photography.</p></li><br><br>
		  <li><p style = "color: red; text-align:center; margin-left: -28%;">Disclaimer: You should be aware that a journal<br/>following the conference will be expected of you.</p></li>
		<?php endif; ?>
		
		<?php if($_SESSION["position"] == "Runner"): ?>
		  <li><p>How are runners of significance to an MUN?</p></li>
		  <li><textarea rows="12" cols="38" name="sigRunner"></textarea><br><br>
		  <li><p>What qualities should a runner have?</p></li>
		  <li><textarea rows="12" cols="38" name="qualRunner"></textarea><br><br>
		  <li><p>What differentiates you from other applicants?</p></li>
		  <li><textarea rows="12" cols="38" name="diff"></textarea><br><br>
		  <li><p>Are you considered to be approachable? Why?</p></li>
		  <li><textarea rows="12" cols="38" name="approach"></textarea>
		<?php endif; ?>
		
		
		<?php 
			if($_SESSION["position"] == "Security")
			{
				echo "<li><p style=\"margin-left: 6%;\">Thank you for applying as security.</p></li>";
			}
		?>
		
	    <br><br><br><br><br><br><br><br>
		
	    <li><input style="float: right;" type="submit" name="submit" value="Submit"></input></li>
	    <br><br><br><br>
      </ul>
    </form>	
  </div>
  <br><br><br>

</body>

</html>















