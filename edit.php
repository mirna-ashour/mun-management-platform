<html>

  <head> 
    <?php 
	  require_once 'connect.php'; 
      require 'pageTemplate.php';
      require 'editController.php';
    ?> 
  </head>

  <style>

    .container-bg {
	  width: 100%;
	  min-height: 100%;
      display: inline-block;
	  position: relative;
	  background-color: white;
    }
    
    p#labels {
	  color: black;
      font: bold 110% 'Manjari', sans-serif;
      margin-left: 13%;
    }
    
    input[type=text]  {
	  background-color: #fffcbb; 
	  border: 2px solid #bbbd00;
	  height: 5%; 
	  width: 70%;
      border-style: inset;
      border-radius: 15px;
      margin-left: 13%;

	}
	
	input[type=password]  {
      background-color: #fffcbb; 
	  border: 2px solid #bbbd00;
      height: 5%; 
	  width: 70%;
      border-style: inset;
      border-radius: 15px;
      margin-left: 13%;
	}
	
	input[type=submit] {
      background: #1d4200;
      color: white;
	  border-style: outset;
	  border-color: #1d4200;
	  font: bold 90% 'Manjari', sans-serif;
	  text-shadow:none;
	  text-decoration: none;
	  padding: 2% 4%;
	  position: relative;
      border-radius: 15px;
      float: right;
      margin-right: 6%;
    }
    
    .select  {
	  background-color: #fffcbb; 
	  border: 2px solid #bbbd00; 
	  height: 5%; 
      width: 70%;
      border-radius: 15px;
      margin-left: 13%;
	}

  tr {
		border-bottom: 3px solid;
		border-color: #bbbd00;
		height: auto;
		width: auto;
	  }

    tr, td {
		padding: 3%;
	 }
	 

    table {
		width: 90%;
		height: auto;
		margin-left: 3%;
		margin-top: 3%;
		border-collapse: collapse;
		border-radius: 10px;
	  }

    /* Style the tab */
.tab {
    width: 41%;
    margin-left: 29%;
	margin-top: 3%;
	overflow: hidden;
    background-color: #1d4200;
}

/* Style the buttons inside the tab */
.tab button {
  width:33.3%;
  background-color: inherit;
  float: left;
  border: none;
  outline: none;
  cursor: pointer;
  padding: 4% 5%;
  transition: 0.3s;
  color: #bbbd00;
  font: bold 120% 'Manjari', sans-serif;
  
  border-right:2px #ddd;
}
.tab button:last-child{
    border-right:2px solid transparent;
}

/* Change background color of buttons on hover */
.tab button:hover {
  background-color: #ddd;
}

/* Create an active/current tablink class */
.tab button.active {
  background-color: #bbbd00;
  color: white;
}

/* Style the tab content */
.tabcontent {
  display: none;
  padding: 6px 0 6px 17px;
  border: 3px solid #bbbd00;
  width: 41%;
  margin-left: 29%;
  background-color: white;
}
.tabcontent.active {
  display: block;
}

  </style>

<div class ="container-bg">
  <div class="tab">
    <button class="tablinks active" data-tab="1">Add a director</button>
    <button class="tablinks" data-tab="2">Add a school</button>
    <button class="tablinks" data-tab="3">Payments</button>
  </div>

  <div id="tab1" class="tabcontent active">
  <form action="edit.php" method="post">
    <br>
    <?php if(count($errors) > 0 ): ?>
        <?php foreach($errors as $error): ?>
		  <p id="labels" style="display: list-item; color: red; font: 92% 'Manjari', sans-serif; margin-left: 15%;" ><b><?php echo $error; ?></b></p>
        <?php endforeach; ?><br>
    <?php endif; ?>

    <p id="labels">First name:</p>
    <input type="text" name="firstName"></input><br><br>
    <p id="labels">Last name:</p>
    <input type="text" name="lastName"></input><br><br>

    <p id="labels">School:</p>
    <select class="select" name="school">
      <option value="" selected disabled hidden>--Select--</option>
	    <?php
			  $schools = $connect->query("SELECT * FROM schools");
			  foreach($schools as $school):
      ?>
		  <option value="<?php echo $school['schoolID'];?>"><?php echo $school['school']; ?></option>
	  	<?php endforeach; ?>
    </select><br><br><br>

    <p id="labels">Email:</p>
    <input type="text" name="email"></input><br><br>
    <p id="labels">Password:</p>
    <input type="password" name="password"></input><br><br>
    <p id="labels">Confirm password:</p>
    <input type="password" name="conPassword"></input><br><br><br><br>
    <input type="submit" name="director" value="Save"></input><br><br><br>
   </form>
  </div>

  <div id="tab2" class="tabcontent">
  <form action="edit.php" method="post">
    <br>
    <?php if(!empty($error)):?>
      <p style="display: list-item; color: red; font: 92% 'Manjari', sans-serif; margin-left: 15%;" ><b><?php echo $error; ?></b></p>
      <?php endif; ?>
    <p id="labels">School name:</p><br>
    <input type="text" name="schoolName"></input><br><br><br>
    <input type="submit" name="school" value="Save"></input><br><br><br>
  </form>
  </div>

  <?php 
    if(isset($_POST["pay"]))
     {
       $userID = $_POST["userID"];
       $connect->query("UPDATE user_details SET paymentStatus = 1 WHERE userID = ".$userID."");
     }

  ?>

  <div id="tab3" class="tabcontent">
    <table>
      <?php $list = $connect->query("SELECT user_details.userID, user_details.firstName, user_details.lastName, user_details.schoolID, 
      user_details.paymentStatus, user_details.position, schools.school FROM user_details join schools on user_details.schoolID=schools.schoolID ORDER BY user_details.firstName"); ?>
        <?php 
           foreach($list as $user)
           {
              echo "<tr>";
              echo "<td>";
              if($user["paymentStatus"]=="1")
              {
                echo "<p style=\"font: bold 130% 'Manjari',sans-serif; margin-left: 10%;\">". $user["firstName"] . ' ' . $user["lastName"]. "</p>";
              }
              else{
                echo "<p style=\"font: bold 130% 'Manjari',sans-serif; margin-left: 10%; color: red;\">". $user["firstName"] . ' ' . $user["lastName"]. "</p>";
              }
                echo "<p style=\"font: bold 110% 'Manjari',sans-serif; margin-left: 10%; color: #5e5e5e;\">". $user["school"]. "</p>";
                echo "<p style=\"font: bold 110% 'Manjari',sans-serif; margin-left: 10%; color: #5e5e5e;\">". $user["position"]. "</p>";
              echo "</td>";
              echo "<form method=\"post\" action=\"edit.php\">";
                echo "<td>";
              if($user["paymentStatus"]=="1")
              {
                  echo "<input style=\"border-radius: 5%; background-color: #8cab7f; border-color: #8cab7f;\" type=\"submit\" name=\"pay\" value=\"Paid\" disabled></input>";
              }
              else {
                  echo "<input type=\"hidden\" name= \"userID\" value=\"" . $user["userID"] . '"'. "></input>";
                  echo "<input style=\"border-radius: 5%;\" type=\"submit\" name=\"pay\" value=\"Mark\"></input>";
              }
                echo "</td>";
              echo "</tr></form>";
           }
        ?>
    </table>
  </div>

  <br><br><br>
</div>









</html>