<!DOCTYPE html>
<html>

  <head>
    <?php 
		require 'connect.php';
		require_once 'appController.php';
		require 'pageTemplate.php';
	?>
  </head>
  
  <style>
  
      .container-bg {
		background-color: white;
		width: 100%;
		min-height: 100%;
		display: inline-block;
		z-index: 10;
	  }
  
      .tab {
	    
		width: auto;
		margin-left: 21%;
		margin-top: 3%;
		overflow: hidden;
	  }
	  
	  .tab button {
        background-color: #1d4200;
		border: 3px #1d4200;
		outline: none;
		cursor: pointer;
	    padding: 2% 4.25%;
		transition: 0.3s;
	    font: bold 110% 'Manjari', sans-serif;
		color: #bbbd00;
		display: inline-block;
		margin-left:-5px;
	  }
	  
	  .tab button:hover {
		background-color: #333;
	  }

	  .tab button.active {
		background-color: #bbbd00 ;
		color: white;
	  }
	  
	 tr, td {
		padding: 3%;
	 }
		
	 tr {
		border: 3px solid;
		border-color: #bbbd00;
		height: auto;
		width: auto;
	  }
	  
	  table {
		width: 56.3%;
		height: auto;
		margin-left: 21%;
		border-collapse: collapse;
	  }
	  
	  input[type=submit] {
      background: #1d4200;
      color: white;
	  border-radius: 3px;
	  border-style: outset;
	  border-color: #1d4200;
	  font: bold 100% 'Manjari', sans-serif;
	  text-shadow: none;
	  text-decoration: none;
	  height: 100%;
	  width: 55%;
	  cursor: pointer;
	  float:right;
	  padding: 3%;
	}
	
	a {
	  color: #1d4200;
	  font: bold 140% 'Manjari', sans-serif;
	}

	a:hover {
	  color: #bbbd00;
	}

  </style>
  
  <div class="container-bg">
    <div class="tab">
	  <form action="applicants.php" method="post">
        <button class="tablinks" name="Delegate">Delegates</button>
        <button class="tablinks" name="Chair" >Chairs</button>
        <button class="tablinks" name="Runner" >Runners</button>
	    <button class="tablinks" name="Press" >Press</button>
        <button class="tablinks" name="Security" >Security</button>
	  </form>
    </div>
  
   <?php 
		
		$position="Delegate";
		if(isset($_POST['Delegate']))
		{
			$position="Delegate";
		}
		elseif(isset($_POST['Chair']))
		{
			$position="Chair";
		}
		elseif(isset($_POST['Runner']))
		{
			$position="Runner";
		}
		elseif(isset($_POST['Press']))
		{
			$position="Press";
		}
		elseif(isset($_POST['Security']))
		{
			$position="Security";
		}

		
		if($position != "Delegate")
		{
			$results = $connect->query("SELECT user_details.*, accounts.status FROM `user_details` 
			join accounts on user_details.userID=accounts.userID 
			WHERE position = '".$position."' AND status=1 AND positionStatus= 0 ORDER BY firstName");
			$num = $results->num_rows;
		}
		else{
			$results = $connect->query("SELECT * FROM user_details WHERE position='".$position."' ORDER BY firstName");
			$num = $results->num_rows;
		}
		
		
	?>

<script>
		var position = <?php echo "'" . $position . "'" ; ?>;
</script>
  
	<?php 
   
		function printTable($num, $results, $connect, $position) 
		{ 
			echo "<table>";
			if($num == 0)
			{
				echo "<tr>";
				echo "<td style = \"text-align: center; font: bold 100% 'Manjari', sans-serif; color: red;\" colspan = 5>";
				echo "<br>";
				echo "There are currently no pending applications.";
				echo "<br><br><br>";
				echo "</td>";
				echo "<tr>";
			}
			else
			{
				foreach($results as $result)
			  {
				echo "<tr>";
				 if($position=="Delegate")
				 {
					echo "<td colspan=\"2\">";
				 }
				 else
				 {
					echo "<td>";
				 }
					 $t = $connect->query("SELECT status FROM accounts WHERE userID = '".$result['userID']."'");
					 $status = $t->fetch_assoc();

					 if($position== "Delegate" && $status['status'] == 0)
					 {
						echo "<a style=\"color: red;\" href=\"viewApp.php?userID=". $result['userID']. '">' . "<p>" . $result['firstName'] . ' ' .$result['lastName'] . "</p></a>";
					 }
					 else{
						echo "<a href=\"viewApp.php?userID=". $result['userID']. '">' . "<p>" . $result['firstName'] . ' ' .$result['lastName'] . "</p></a>";
					 }
				
					$temp = $connect->query("SELECT school FROM schools WHERE schoolID='".$result['schoolID']."'");
					$school = $temp->fetch_assoc();
					echo "<p style = \"font: bold 110% 'Manjari', sans-serif; color: #5e5e5e;\" >". $school['school'] ."</p>";
				  echo "</td>";

				  if($_SESSION["position"] == "Admin" && $position != "Delegate")
				  {
					echo "<td>";
							
					echo "<form action=\"applicants.php\" method=\"post\">";
					echo "<input type = \"submit\" value = \"Accept\" name =\"accept\"></input><br><br>";
					echo "<input style = \"background-color: #9c0000; border-color:#9c0000;\" type = \"submit\" value = \"Decline\" name = \"decline\"></input>";
					echo "<input name=\"userID\" type=\"hidden\" value=\"" . $result['userID'] . '"' . "</input>";
					echo "</form>";
							
					echo "</td>";
					
				  }
				echo "</tr>";
			  }

			}
			
			echo "</table>";
		}

		 
      ?>
  
    <div>
		<?php printTable($num, $results, $connect, $position); ?>
    </div>

  <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> 
  </div> 
  
  <script>
  
</html>






