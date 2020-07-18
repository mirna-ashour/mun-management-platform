<html>

  <head>
    <?php
        require 'connect.php';	
		require 'pageTemplate.php';
	?>
  </head>
  
  <style>
  
    .container-bg {
      background-color:white;
	  display: inline-block;
	  width: 100%;
	  min-length: 100%;
	}
	
	table {
	  width: 60%;
	  height: auto;
	  margin-left: 20%;
	  margin-top: 3%;
	  border-collapse: collapse;
	  border-radius: 10px;
	  background-color:
	}
	
	tr {
		border: 3px solid;
		border-color: #bbbd00;
		height: auto;
		width: auto;
	  }
	  
	  td {
		padding: 3%;
	  }
	
	  p {
		font: bold 130% 'Manjari', sans-serif;
	  }
	  
	  a {
		font: bold 130% "Manjari", sans-serif;
	    color: #1d4200;
	  }
	  
	  a:hover {
		color: #bbbd00;
	  }
	
  </style>
  
  <body>
     
    <div class="container-bg">
      <table>
	    <?php		
		  $a = $connect->query("SELECT * FROM councils");
		  
		  foreach($a as $result):			
		?>
		  <tr>
		   <td>
		      <a href="viewCouncil.php?councilID=<?php echo $result['councilID']; ?>"><p><?php echo $result['council']; ?></p></a><br>
			  <p style="font-size: 110%; color: #5e5e5e"><?php echo 'Number of positions: ' . $result['positions']; ?></p>
		    </td>
	      </tr>
		<?php endforeach; ?>
	  </table>
    <br><br><br><br><br><br>
    </div>	
  
  
  </body>
  
  
  
</html>