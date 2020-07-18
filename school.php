<html>

  <head>
    <?php 
	  require_once 'connect.php'; 
	  require 'pageTemplate.php';
    ?> 
  </head>

  <style>

    .container-bg {
	  background-color: white;
	  width: 100%;
	  min-height: 100%;
	  display: inline-block;
	  position: relative;
	  z-index: 3;
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
	  
	  p {
		font: bold 130% 'Manjari', sans-serif;
	  }
	  
	  th {
		font: bold 165% 'Manjari', sans-serif;
		padding: 3.5%;
		text-align: left;
		background-color: #1d4200; 
		color: #bbbd00;
	  }
	  
	  table {
		width: 40%;
		height: auto;
		margin-left: 30%;
		margin-top: 3%;
		border-collapse: collapse;
		border-radius: 10px;
	  }
	  
	  input[type=submit] {
      background: #1d4200;
      color: white;
	  border-style: outset;
	  border-color: #1d4200;
	  font: bold 105% 'Manjari', sans-serif;
	  text-shadow:none;
	  text-decoration: none;
	  padding: 4% 8%;
	  width: 120%;
	  height: 100%;
	  float: right;
	  margin-right: 15%;
	  cursor: pointer;
	  }
	  
  </style>

 <?php
  
	if(isset($_POST['approve']))
	{
		$userID = $_POST['userID'];
		$connect->query("UPDATE accounts SET status = 1 WHERE userID = ".$userID."");
	}
  
  ?>

  <div class = "container-bg">
    <table>
	  <tr style = "border-color: #1d4200;">
		<?php 
		$temp = $connect->query("SELECT * FROM user_details WHERE userID ='".$_SESSION["userID"]."'"); 
		$temp2 = $temp->fetch_assoc();
		$temp = $connect->query("SELECT school FROM schools WHERE schoolID ='".$temp2['schoolID']."'"); 
		$school = $temp->fetch_assoc(); 
		$results = $connect->query("SELECT * FROM user_details WHERE schoolID='".$temp2['schoolID']."'"); 
	    $num = $results->num_rows; 
		?>
	    <th colspan=2><?php echo $school['school'] . " (" . "$num" . ")"; ?></th>
	  </tr>
	 
	  <?php foreach($results as $result): ?>
	    <tr>
		<form action="school.php" method="post">
		  <td>
		    <?php
				$check = $connect->query("SELECT * FROM accounts WHERE userID= ".$result['userID']."");
				$status = $check->fetch_assoc();

				if($_SESSION["position"]=="Director" && $status['status']==0)
				{
					echo "<p style =\"color: red;\">" . $result['firstName'] . ' ' . $result['lastName'] . "</p>";
				}
				elseif($result['position'] != "Delegate" && $result['positionStatus'] == 0)
				{
					if($_SESSION["position"]== "Director")
					{
						echo "<p style=\"color: #1d4200\">" . $result['firstName'] . ' ' . $result['lastName'] . "</p>";
					}
					else
					{
						echo "<p style =\"color: red;\">" . $result['firstName'] . ' ' . $result['lastName'] . "</p>";

					}
				}
				else
				{
					echo "<p style=\"color: #1d4200\">" . $result['firstName'] . ' ' . $result['lastName'] . "</p>";
				}
				if($_SESSION["position"]=="Director")
				{
					echo "<p style=\"font-size: 110%; color: #5e5e5e;\">" . $status['email'] . "</p>";
				}
			
			?>
			<p style = "font: bold 110% 'Manjari', sans-serif; color: #5e5e5e;" ><?php echo $result['position']; ?></p>
		  </td>
		  
		    <?php if($_SESSION["position"] === "Director" && $status['status'] == 0):?>
			  <td>
			    <input style=" width: 1%; height: 1%;" type="hidden" value="<?php echo $result['userID'];?>" name="userID"></input>
			    <input type="submit" value="Approve" name="approve"></input>
			  </td>
		
			<?php elseif($_SESSION["position"] === "Director" && $status['status'] == 1):?>
			  <td><input style="background-color: #8cab7f; border-color: #8cab7f;" type="submit" value="Approved" name="approve" disabled ></input></td>
			  
			<?php else: ?>
			  <td></td>
			<?php endif; ?>
		</tr>
		</form>
      <?php endforeach; ?>
	</table>
	<br><br><br><br><br><br><br><br><br><br>
  </div>

  </body>
  
</html>









