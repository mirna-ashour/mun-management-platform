<html>

  <head>
    <?php 
		require 'pageTemplate.php';
	    require_once 'contactController.php';
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
      width: 16%;
      margin-left: 24%;
      cursor: pointer;
	}

	.select  {
	  background-color: #fffcbb; 
	  border: 2px solid #bbbd00; 
	  height: 100%; 
	  width: 65%;
	}
	
	textarea {
	  background-color: #fffcbb; 
	  border: 2px solid #bbbd00;
	  font: 92% arial;
	  width: 65%;
	  height: 40%;
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
   <form action="contact.php" method="post">
	<br><br>
	<h1 id="msg"><u>Leave Us A Message</u></h1>
    <br>
    <?php if(count($errors) > 0 ): ?>
        <?php foreach($errors as $error): ?>
		  <p style="display: list-item; color: red; font: 92% arial; margin-left: 29%;" class="errors"><b><?php echo $error ?></b></p>
        <?php endforeach; ?><br>
    <?php endif; ?>
	<table>
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
	    <td><textarea rows="15" cols="38" name="message" name="message" value="<?php echo $message; ?>"></textarea><br><br></td>
      </tr>
      <tr>
	    <td><input type="submit" value="Send" name="send"></input></td>
      </tr>
     </form> 
    </div>

</html>
