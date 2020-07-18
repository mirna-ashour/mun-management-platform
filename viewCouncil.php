<html>

  <head>
    <link href="https://fonts.googleapis.com/css?family=Manjari&display=swap" rel="stylesheet">
	<?php 
		$_SESSION["page"] = 'councils.php';
		require_once 'pageTemplate.php';
		require_once 'connect.php';
		require_once 'councilController.php';
	?>
  </head>

   <style>
    
	.container-app {
	  background-color: white;
	  min-height: 100%;
	  width: 100%;
	  z-index: 3;
	  display: inline-block;
	}

    table {
	  width: 50%;
	  height: auto;
	  margin-left: 25%;
	  margin-top: 3%;
	  border-collapse: collapse;
	  border: none;
	}
	
	input[type=submit] {
      background: #1d4200;
      color: white;
	  border-style: outset;
	  border-color: #1d4200;
	  font: bold 90% 'Manjari', sans-serif;
	  text-shadow:none;
	  text-decoration: none;
	  padding: 2% 2%;
	  width: 20%;
	  float: right;
	  cursor: pointer;
	  border-radius: 10px;
	  }
	  
	tr {
		border: 3px solid #bbbd00;
		height: auto;
		width: auto;
		padding: 3%;
	  }
	  
    th {
		font: bold 170% 'Manjari', sans-serif;
		padding: 3.5%;
		text-align: center;
		border-color: #1d4200;
		background-color: #1d4200; 
		color: #bbbd00;
	  }
	  
	  td {
		padding: 3.5%;
	  }

	  p {
		font: bold 140% 'Manjari', sans-serif;
	  }

	
	</style>

    <body>
	
	  <div class="container-app">
		<?php 
			if(isset($_GET['councilID']))
			{
				$councilID=$_GET['councilID'];
			}
			else
			{
				$councilID = $_POST['councilID'];
			}

		  
		function printRow($councilData, $cc, $connect, $councilID)
		{
			echo "<tr>";
			echo "<td>";
			echo "<p>".$councilData['delegateLabel'] . ' ' .$cc['labelNum']."</p>";
			$u=$connect->query("SELECT user_details.*, schools.school FROM `user_details` 
			join schools on user_details.schoolID=schools.schoolID
			WHERE userID=". $cc['userID']);
			$users=$u->fetch_assoc();
			echo "<p style=\"font-size: 110%; color: #5e5e5e;\">".$users['firstName']. ' '. $users['lastName'];"</p>";
			echo "<p style=\"font-size: 110%; color: #5e5e5e;\">".$users['school']."</p>";
			echo "</td>";
			printMenu($connect,null,$cc['labelNum'], $councilID);
			echo "</tr>";
			
		}
		
		function printMenu($connect,$countryID=null,$labelNum=null, $councilID)
		{
			if($_SESSION["position"]=="Admin") 
			{
				echo "<td align=\"right\">";
				echo "<form action=\"viewCouncil.php?councilID=".$councilID."\" method=\"POST\">";
				echo "<select style=\"width: 90%;\" name=\"selUser\" class=\"userselect\">";
				$a = $connect->query("SELECT userID, firstName,lastName,school FROM user_details as ud 
				join schools as s on ud.schoolId = s.schoolid WHERE ud.positionStatus= 0 AND ud.position= 'Delegate'");
				echo "<option value=\"\">--Select User--</option>";

				 foreach($a as $delegate)
				 {
					echo "<option value=\"".$delegate['userID']."\">" . $delegate['firstName']. ' '. $delegate['lastName'] . ' - ' . $delegate['school']. "</option>";
				}

				echo "</select><br><br>"; 
				echo "<input type=\"hidden\" value=\"".$councilID."\" name=\"councilID\"></input>";
				echo "<input type=\"hidden\" value=\"".$countryID."\" name=\"countryID\"></input>";
				echo "<input type=\"hidden\" value=\"".$labelNum."\" name=\"labelNum\"></input>";
				
				echo "<input type=\"submit\" name=\"btnSave\" value=\"Save\"></input>";
				echo "<input style=\"background-color: #d60000; border-color: #d60000; width: 35%;\" type=\"submit\" name=\"btnUnallocate\" value=\"Remove\"></input>";
				echo "</form>";
				echo "</td>";
			 }			
		}
	    	$council= $connect->query("SELECT * from councils where councils.councilID=".$councilID);
			$councilData=$council->fetch_assoc();

			echo "<table>";
				  if($_SESSION["position"] == "Admin")
				  {
					echo "<th colspan=\"2\">" .$councilData['council']. "</th>";
				  }
				  else{
					echo "<th>" .$councilData['council']. "</th>";
				  }
		if($councilData['category']!= "normal")
		{
			
			$s=$connect->query("Select * from enrollments where councilID=".$councilID." order by labelNum asc");
			$count=1;
			foreach($s as $cc)
			{
					$u=$connect->query("SELECT user_details.*, schools.school FROM `user_details` 
					join schools on user_details.schoolID=schools.schoolID
					WHERE userID=".$cc['userID']);
					$users=$u->fetch_assoc();
				if($count == $cc['labelNum'])
				{
					
					printRow($councilData, $cc, $connect, $councilID);
				} 
				else
				{ 
					for($i=$count; $i<$cc['labelNum'];$i++)
					{
						echo "<tr>";
						echo "<td>";
						
						echo "<p style=\"color: red;\">".$councilData['delegateLabel'] . ' ' .($i)."</p>";
						echo "<p style=\"font-size: 110%; color: #5e5e5e;\">Vacant</p>";
						echo "</td>";
						printMenu($connect,null,$i, $councilID);
						echo "</tr>";
						$count++;
					}
					printRow($councilData, $cc, $connect, $councilID);
				}
			$count = $count + 1;
			}
			for($i=$count; $i<=$councilData['positions'];$i++)
					{
						echo "<tr>";
						echo "<td>";
						echo "<p style=\"color: red;\">".$councilData['delegateLabel'] . ' ' .($i)."</p>";
						echo "<p style=\"font-size: 110%; color: #5e5e5e;\">Vacant</p>";
						echo "</td>";
						printMenu($connect,null,$i,$councilID);
						echo "</tr>";
						$count++;
					}
			
		}
		else
		{
		  $x= $connect->query("SELECT councils.council, councils.category, councils.delegateLabel, c2c.*, countries.* 
		  from c2c join countries on c2c.countryID=countries.countryID join councils on councils.councilID=c2c.councilID
		  where c2c.councilID=".$councilID);
		  $results = $x->fetch_assoc();
		  
	  		foreach($x as $result)
		   {
			    echo "<tr>";
				  echo "<td>";
			
					$enrol=$connect->query("select * from enrollments inner join councils ON
					enrollments.councilID=councils.councilID
					where enrollments.councilID=".$councilID." and enrollments.countryID=".$result['countryID']);
					$ee = $enrol->fetch_assoc();
							if($enrol->num_rows>0)
							{ 
								$c=$connect->query("Select * from countries where countryID=".$result['countryID']);
								$cc=$c->fetch_assoc();
								echo "<p>".$cc['country']."</p>";
								$u=$connect->query("SELECT user_details.*, schools.school FROM `user_details` 
								join schools on user_details.schoolID=schools.schoolID
								WHERE userID=".$ee['userID']);
								$users=$u->fetch_assoc();
								echo "<p style=\"font-size: 110%; color: #5e5e5e;\">".$users['firstName']. ' '. $users['lastName'];"</p>";
								echo "<p style=\"font-size: 110%; color: #5e5e5e;\">".$users['school']."</p>";
					

							}
							else
							{								
								$c=$connect->query("Select * from countries where countryID=".$result['countryID']);
								$cc=$c->fetch_assoc();
								echo "<p style=\"color: red;\">".$cc['country']."</p>";
								echo "<p style=\"font-size: 110%; color: #5e5e5e;\">Vacant</p>";
							}
				  	
					
				  echo "</td>";	
				  printMenu($connect,$result['countryID'],null, $councilID);
				echo "</tr>";
			}
		
		  
		   }
		  echo "</table>";
		  echo "<br><br><br><br>";
        ?>	  
	  </div>
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	


   </body>

</html>













