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
    <form action="registerNext.php" method="post">		
	  <ul class="form"> 
	    <?php if(count($errors2) > 0 ): ?>
		  <br>
		  <ul style="list-style-type: disc; color: red; background: #ffc6c6; width: 75%; border-radius: 8px; margin-left: 8.5%;">
		    <br>
			<?php foreach($errors2 as $error): ?>
			  <li style="display: list-item; color: red; font: 14px arial; margin-left: 13%;" class="errors"><b><?php echo $error ?></b></li>
		    <?php endforeach; ?>
			<br>
		  </ul>
        <?php endif; ?>
		<br>
		
		<li><p>Position you wish to apply for:</p></li>
		<li>
	      <select class="select" name="position">
	        <option value="" selected disabled hidden>--Select--</option>
			<option value="Delegate">Delegate</option>
			<option value="Chair">Chair</option>
			<?php if($_SESSION["grade"] >= 10): ?>
			  <option value="Press">Press</option>
			<?php endif;?>
			<?php if($_SESSION["school"] == "1"): ?>
			  <option value="Runner">Runner</option>
			<?php endif; ?>
			<?php if($_SESSION["school"] == "1" && $_SESSION["grade"] == "12"): ?>
			  <option value="Security">Security</option>
			<?php endif; ?>
	      </select>
		</li><br>
		<li><p>Mention your MUN experiences below:<br>(Position and number of experiences)</p></li>
		<li><textarea rows="8" cols="38" name="exp"><?php echo $experiences; ?></textarea><br>
	    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
	    <li><input style="float: right;" type="submit" name="next2" value="Next"></input></li>
	    <br><br><br><br>
      </ul>
    </form>	
  </div>
  <br><br><br>

</body>

</html>