<html>

  <head>
    <link href="https://fonts.googleapis.com/css?family=Manjari&display=swap" rel="stylesheet">
    <?php 
		$_SESSION["page"] = 'councils.php';
		require_once 'pageTemplate.php';
		require_once 'connect.php';
	?>
  </head>
  
  <style>
    
	.container-app {
	  background-color: white;
	  min-height: 150%;
	  width: 100%;
	  z-index: 3;
	  display: inline-block;
	}
	
	.box {
	  background-color: #F5F5DC;
	  width: 50%;
	  margin-left: 25%;
	  border-radius: 8px;
	  z-index: 4;
	  margin-top: 3%;
	}
	
	.name {
	  font-size: 220%;
	  font-weight: bold;
	  font-family: 'Manjari' , sans-serif;
	  color:#bbbd00;
	  top: 4%;
    }
	
	p {
	  font-size: 120%;
	  font-family: 'Manjari' , sans-serif;
	  color: black;
	  margin-left: 9%;
	}
	
  </style>
  
  <div class="container-app">
    <div class="box">
    <?php 
		$userID = $_GET['userID'];
		$temp = $connect->query("SELECT email FROM accounts WHERE userID ='".$userID."'");
		$email = $temp-> fetch_assoc();
		$check = $connect->query("SELECT * FROM user_details WHERE userID ='".$userID."'");
		$results = $check->fetch_assoc();
		$details = $connect->query("SELECT * FROM user_questions WHERE userID = ".$userID."");
		$questions = $details->fetch_assoc();
		$temp = $connect->query("SELECT school FROM schools WHERE schoolID= '".$results['schoolID']."'");
		$school = $temp->fetch_assoc();
		
		echo "<br>";
		echo "<p class=\"name\"><u> ".$results['firstName']. ' ' . $results['lastName']."</u></h4>";
		echo "<p style= \"color: #9c0000\"><b>" .$school['school']."</b></p>";
		echo "<p style= \"color: #9c0000\"><b>". 'Grade '.$results['grade']."</b></p>";
		echo "<p style= \"color: #9c0000\"><b>".$results['position']. "</b></p>";
		echo "<p style= \"color: #9c0000\"><b>". 'Email: ' .$email['email']. "</b></p>";
		echo "<br>";
		
		echo "<p style=\"display: list-item;\"><b>" . 'Experiences:' . "</b></p>";
	    echo "<p>" . $results['experiences'] . "</p>";
		switch($results['position'])
		{
			case "Delegate":
			  echo "<p style=\"display: list-item;\"><b>".'Delegate training:'."</b></p>";
			  if($questions['delegateTraining'] == 1)
			  { 
				echo "<p>".'Yes'."</p>";
				echo "<p style=\"display: list-item;\"><b>".'Training date:'."</b></p>";
			    echo "<p>".$questions['trainingDate']."</p>";
			  }
			  else {
				echo "<p>".'No'."</p>";
			  }
			  echo "<p style=\"display: list-item;\"><b>".'Council preference:'."</b></p>";
			  echo "<p>".$questions['councilPref']."</p>";
			  break;
			
			case "Chair":
			  echo "<p style=\"display: list-item;\"><b>".'Arabic council:'."</b></p>";
			  if($questions['arabicCouncil'] == 1) {
				echo "<p>" . 'Yes' ."</p>";
			  }
			  else {
				echo "<p>" .'No' . "</p>";
			  }
			  break;
			
			case "Press":
			  echo "<p style=\"display: list-item;\"><b>".'Camera:'."</b></p>";
			  if($questions['camera'] == 1)
			  {
				echo "<p>" . 'Yes' ."</p>";
			  }
			  else
			  {
				echo "<p>" .'No' . "</p>";
			  }
			  echo "<p style=\"display: list-item;\"><b>".'Instagram account:'."</b></p>";
			  echo "<p>".$questions['insta']."</p>";
			  echo "<p style=\"display: list-item;\"><b>".'How is photography significant in your life?'."</b></p>";
			  echo "<p>".$questions['sigPress']."</p>";
			  echo "<p style=\"display: list-item;\"><b>".'What unique qualities would you bring if you are accepted into the press team?'."</b></p>";
			  echo "<p>".$questions['qualPress']."</p>";
			  break;
			
			case "Runner":
			  echo "<p style=\"display: list-item;\"><b>".'How are runners of significance to an MUN?'."</b></p>";
			  echo "<p>".$questions['sigRunner']."</p>";
			  echo "<p style=\"display: list-item;\"><b>".'What qualities should a runner have?'."</b></p>";
			  echo "<p>".$questions['qualRunner']."</p>";
			  echo "<p style=\"display: list-item;\"><b>".'What differentiates you from other applicants?'."</b></p>";
			  echo "<p>".$questions['diff']."</p>";
			  echo "<p style=\"display: list-item;\"><b>".'Are you considered to be approachable? Why?'."</b></p>";
			  echo "<p>".$questions['approach']."</p>";
			  break;
			 
			case "Security":
			  break;
		}
		
		echo "<br><br><br>";
	
	?> 
	</div>
  </div>
  
</body>

</html>



