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
		font: bold 135% 'Manjari', sans-serif;
	  }
	  
	  th {
		font: bold 165% 'Manjari', sans-serif;
		padding: 3.5%;
		text-align: left;
		background-color: #1d4200; 
		color: #bbbd00;
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
	  <form action="allUsers.php" method="post">
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

   $results = $connect->query("SELECT * FROM user_details WHERE position='".$position."' ORDER BY firstName");
   $num = $results->num_rows;
 
 if(isset($_POST['approve']))
   {
       $userID = $_POST['userID'];
       $connect->query("UPDATE accounts SET status = 1 WHERE userID = ".$userID."");
   }
 
 ?>

 
<script>
		var position = <?php echo "'" . $position . "'" ; ?>;
</script>

     <?php 
   
   function printTable($num, $results, $connect, $position) 
   { 
     echo "<table>";
       foreach($results as $result)
       {
       echo "<tr>";
         echo "<td>";

          $t = $connect->query("SELECT status FROM accounts WHERE userID = '".$result['userID']."'");
          $status = $t->fetch_assoc();

          if($status['status'] == 0)
          {
			echo "<p style =\"color: red;\">" . $result['firstName'] . ' ' . $result['lastName'] . "</p>";
          }
          else{
			echo "<p style=\"color: #1d4200\">" . $result['firstName'] . ' ' . $result['lastName'] . "</p>";
          }
       
         $temp = $connect->query("SELECT school FROM schools WHERE schoolID='".$result['schoolID']."'");
         $school = $temp->fetch_assoc();
         echo "<p style = \"font: bold 110% 'Manjari', sans-serif; color: #5e5e5e;\" >". $school['school'] ."</p>";
         echo "</td>";

		 echo "<td>";

		 echo "<form action=\"allUsers.php\" method=\"post\">";
		 echo "<input type=\"hidden\" value=\"" . $result['userID']. "\"" . "name=\"userID\"></input>";
         if($status['status'] == 0)
         {
            echo "<input type=\"submit\" value=\"Approve\" name=\"approve\"></input>";
       
         }
         else{
           echo "<input style=\"background-color: #8cab7f; border-color: #8cab7f;\" type=\"submit\" value=\"Approved\" name=\"approve\" disabled ></input>";
         }
           echo "</td>";
		echo "</form>";
         
         }
       echo "</tr>";
       }
     
     echo "</table>";

    
     ?>
 
   <div>
   <?php printTable($num, $results, $connect, $position); ?>
   </div>
