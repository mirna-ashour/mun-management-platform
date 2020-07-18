<html>

<head>
  <?php 
  	require 'pageTemplate.php'; 
  	require_once 'connect.php';  
  ?>
 
</head>
  
  <style>
  
    .container-message {
	  background-color: white;
	  width: 100%;
	  min-height: 50%;
	}
	
	p#wel {
	  font: bold 265% 'Manjari', sans-serif;
	  color: black;
	  float: left;
	 // margin-left: 4%;
	 // margin-top: 3%;
	 // position: relative;
	 // display: inline-block;
	}
	
	p {
	  font: bold 130% 'Manjari', sans-serif;
	  color: #1d4200;
	  //text-align: left;
	}

	table {
	  width: 80%;
	  display: block;
	  margin-left: 4%;
	  margin-top: 4%;
	}

	input[type=submit] {
      background: #1d4200;
      color: #bbbd00;
	  border-style: outset;
	  border-color: #1d4200;
	  font: bold 110% "Manjari", sans-serif;
	  text-shadow:none;
	  text-decoration: none;
	  padding: 1% 1%;
	  position: relative;
	  margin-left: 4%;
	  border-radius: 10px;
	}
  </style>

	<?php
	if(isset($_POST['logout']))
	{
		session_destroy();
		header('location:index.php');
	}

	if(isset($_POST['deleteAcc']))
	{
		$connect->query("DELETE FROM user_details WHERE userID=".$_SESSION["userID"]."");
		$connect->query("DELETE FROM accounts WHERE userID=".$_SESSION["userID"]."");
		$connect->query("DELETE FROM user_questions WHERE userID=".$_SESSION["userID"]."");
		$connect->query("DELETE FROM enrollments WHERE userID=".$_SESSION["userID"]."");
		header('location:index.php');
	}
	?>

  <div class = "container-message">

	<?php 
		$result = $connect->query("SELECT * FROM user_details WHERE userID =".$_SESSION["userID"]."");
		$name = $result->fetch_assoc();
		$result = $connect->query("SELECT status FROM accounts WHERE userID = ".$_SESSION["userID"]."");
		$status = $result->fetch_assoc();
		if($_SESSION["position"] != "Admin")
		{
			if($_SESSION["position"] != "Director")
			{
				$c = $connect->query("SELECT councilID FROM enrollments WHERE userID= ".$_SESSION["userID"]."");
				if($c->num_rows > 0)
				{
					$councilID = $c->fetch_assoc();
					$a= $connect->query("SELECT council FROM councils WHERE councilID= ".$councilID['councilID']."");
					$council = $a->fetch_assoc();
				}
				else
				{
					$councilID=null;
				}

			}
			else
			{
				$councilID = null;
			}
		}
	?>
	
	<table>
	<th colspan="2">
		<p id="wel">Welcome,<?php echo ' ' . $name['firstName']; ?></p>
	</th>

	<?php if($_SESSION["position"] != "Admin" && $_SESSION["position"] != "Director"):?>
	  <tr>
	    <td><p style="color: #c10000; font-size: 160%;">Your acccount details</p></td>
	  </tr>
	  <tr><td></td></tr>
	   <tr>
	    <td><p style="display: list-item; margin-left:10%;">Account:<?php if($status['status'] == 1) { echo ' ' . "confirmed";} else { echo ' ' . "pending"; }?></p></td>
	   </tr>
	   <tr>
	     <td><p style="display: list-item; margin-left:10%;">Position:<?php if($name['positionStatus'] == 1) { echo ' ' . "confirmed";} else { echo ' ' . "pending"; } ?></p></td>
       </tr>
	   <tr>
	    <td><p style="display: list-item; margin-left:10%;">Council:<?php if($council['council'] == null) { echo ' ' . "pending";} else { echo ' ' . $council['council']; }?></p></td>
	   </tr>
	<?php endif; ?>
	 
	<?php if($_SESSION["position"]=="Admin"): ?>

	<?php 
	$q = $connect->query("SELECT userID FROM user_details");
	$totalCount = $q->num_rows;
	$p = $connect->query("SELECT userID FROM user_details WHERE position = 'Director'");
	$direcCount = $p->num_rows;
	$studentCount = ($totalCount - $direcCount);
	$w = $connect->query("SELECT userID FROM user_details WHERE position = 'Delegate'");
	$delCount = $w->num_rows;
	$r = $connect->query("SELECT userID FROM user_details WHERE position = 'Runner'");
	$runCount = $r->num_rows;
	$t = $connect->query("SELECT userID FROM user_details WHERE position = 'Press'");
	$pressCount = $t->num_rows;
	$y = $connect->query("SELECT userID FROM user_details WHERE position = 'Security'");
	$secCount = $y->num_rows;
	$i = $connect->query("SELECT userID FROM user_details WHERE position = 'Chair'");
	$chairCount = $i->num_rows;
    ?>
	  <tr>
	    <td><br><p style="color: #c10000; font-size: 160%;">Conference Information</p></td>
	  </tr>
	  <tr><td><br></td></tr>
	   
	   <tr>
	     <td><p style="display: list-item; margin-left:10%;">Delegate count:<?php  echo ' ' . $delCount; ?></p></td>
       </tr>
	   <tr>
	   <tr>
	    <td><p style="display: list-item; margin-left:10%;">Chair count:<?php  echo ' ' . $chairCount; ?></p></td>
	   </tr>
	    <td><p style="display: list-item; margin-left:10%;">Runner count:<?php  echo ' ' . $runCount; ?></p></td>
	   </tr>
	   <tr>
	    <td><p style="display: list-item; margin-left:10%;">Press count:<?php  echo ' ' . $pressCount; ?></p></td>
	   </tr>
	   <tr>
	    <td><p style="display: list-item; margin-left:10%;">Security count:<?php  echo ' ' . $secCount; ?></p></td>
	   </tr>
	   <tr>
	    <td><br><p style="display: list-item; margin-left:10%; color: black;">Total student count:<?php echo ' ' . $studentCount; ?></p></td>
	   </tr>
	   <tr>
	    <td><p style="display: list-item; margin-left:10%; color: black; ">Total user count:<?php echo ' ' . $totalCount; ?></p></td>
	   </tr>

	<?php endif;?>

	<?php if($_SESSION["position"]=="Director"): ?>

	<?php 
	$q = $connect->query("SELECT userID FROM user_details");
	$totalCount = $q->num_rows;
	?>
	
	  <tr>
	    <td><br><p style="color: #c10000; font-size: 170%;"><u>Information</u></p></td>
	  </tr>
	  <tr><td><br></td></tr>
	   <tr>
		<td><p style="">All applicants must be approved through the school tab.</p><br></td>
	   </tr>
	   <tr>
		<td><p style="color: #c10000;">Registration/payment deadlines:</p></td>
	   </tr>
	   <tr>
		<td><p style="display: list-item; margin-left:10%;">Delegates: 11/11/2019</p></td>
	   </tr>
	   <tr>
		<td><p style="display: list-item; margin-left:10%;">Press: 03/11/2019</p></td>
	   </tr>
	   <tr>
		<td><p style="display: list-item; margin-left:10%;">Chairs: 23/10/2019</p></td>
	   </tr>
	<?php endif;?>
	</table>

	<br><br>


	<form action="home.php" method="post">
	<input type="submit" name="logout" value="Log-out"></input> 
	<input style="background-color: #c30000; border-color: #c30000;" type="submit" name="deleteAcc" value="Delete account"></input>
	</form>
  </div>
  
</body>

</html>












