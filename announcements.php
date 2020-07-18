<html>

  <head>
    <?php 
		require 'pageTemplate.php';
		require_once 'mailController.php';
	?>
  </head>
  
  <style>
  
     .container-form {
		width: 100%;
		min-height: 100%;
		display: inline-block;
		position: relative;
		background-color: white;
	 }
	 
	 #msg  {
	  font: bold 210% 'Manjari', sans-serif; 
	  color: #bbbd00;
	  text-align: center;
	}
	
	p  {
	  font: bold 120% 'Manjari', sans-serif;
	}
	
	input[type=text]  {
	  background-color: #fffcbb; 
	  border: 2px solid #bbbd00;
	  height: 100%; 
	  width: 65%;
	  border-style: inset;
	  border-radius: 10px;
	}
	
	input[type=submit] {
      background: #1d4200;
      color: white;
	  border-style: outset;
	  border-color: #1d4200;
	  border-radius: 20px;
	  font: bold 100% 'Manjari', sans-serif;
	  text-shadow:none;
	  text-decoration: none;
	  padding: 1% 2%;
	  margin-left: 24%;
	  width: 16%;
	  position: relative;
	  cursor: pointer;
	}

	.select  {
	  background-color: #fffcbb; 
	  border: 2px solid #bbbd00; 
	  height: 100%; 
	  width: 65%;
	  border-radius: 10px;
	}
	
	textarea {
	  background-color: #fffcbb; 
	  border: 2px solid #bbbd00;
	  font: 92% arial;
	  width: 65%;
	  height: 30%;
	  resize: vertical;
	  border-style: inset;
	  border-radius: 15px;
	  
	}

	table {
	  width: 70%;
	  height: auto;
	  position: relative;
	  margin-left: 27%;
	}
	
  </style>
  
  <div class = "container-form">
    <form action="announcements.php" method="post">
	<br><br>
	<h1 id="msg"><u>Broadcast An Announcement</u></h1>
	<br>
    <?php if(count($errors) > 0 ): ?>
        <?php foreach($errors as $error): ?>
		  <p style="display: list-item; color: red; font: 92% arial; margin-left: 29%;" ><b><?php echo $error ?></b></p>
        <?php endforeach; ?><br>
    <?php endif; ?>
	<table>
	  <tr>
	    <td><p>Recipients:</p></td>
	  </tr>
	  <tr>
	    <td>
	      <select class="select" name="position">
	        <option value="" selected disabled hidden>--Select--</option>
	        <option value="Delegate">Delegates</option>
	        <option value="Chair">Chairs</option>
		    <option value="Runner">Runners</option>
		    <option value="Press">Press</option>
			<option value="Security">Security</option>
			<option value="Director">Directors</option>
		    <option value = "All">All</option>
		  </select>
        <br><br></td>
      </tr>
	  <tr>
	    <td><p>Subject:</p></td>
	  </tr>
	  <tr>
	    <td style="height: 50%;"><input type= "text" name="subject" value="<?php echo $subject; ?>"></input><br><br></td>
	  </tr>
	  <tr>
	    <td><p>Message:</p></td>
	  </tr>
	  <tr>
	    <td><textarea rows="18" cols="38" name="message" name="message" value="<?php echo $message; ?>"></textarea><br><br></td>
	  </tr>
	  <tr></tr>
	  <tr>
	    <td><input type="submit" value="Send" name="send"></input></td>
	  </tr>
	</form>
    </table>
	<br><br><br><br>
  </div>

</body>

</html>






