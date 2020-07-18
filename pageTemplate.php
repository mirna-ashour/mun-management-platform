<?php
session_start();
if(!isset($_SESSION["position"])) {
  header("Location: index.php");
}else if ($_SERVER['PHP_SELF']=='/index.php'){
  header("Location: home.php");
}

header("Content-Type: text/html; charset=utf-8");
?>

<html>

<head>
  <link href="mainMenu.css" rel="stylesheet" type="text/css" media="all">
  <?php require 'headerTemplate.php'; ?>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="bootstrap-4.3.1-dist/css/bootstrap.css" rel="stylesheet">
  <script src="bootstrap-4.3.1-dist/js/bootstrap.js"></script>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>
  
  <div class = "container-menu">
  <?php $link = trim($_SERVER['SCRIPT_NAME'], '/'); ?>
  
    <ul id='navbar'>
      <li><a href="home.php"><b>Home</b></a></li>
      <li><a href="councils.php"><b>Councils</b></a></li>
	  <li><a href="school.php"><b>Your school</b></a></li>
	  <?php if($_SESSION["position"] == "Admin"): ?>
	    <li><a href="applicants.php"><b>Applicants</b></a></li>
      <li><a href="announcements.php"><b>Announcements</b></a></li>
      <li><a href="edit.php"><b>Edit</b></a></li>
	  <?php endif;?>
	    <li style="float: right"><a href="contact.php"><b>Contact Us</b></a></li>
    </ul>
  </div>

  <script src='js/jquery-3.4.1.min.js' ></script>
  <script src='js/select2.min.js' type='text/javascript'></script>
  <link href='css/select2.min.css' rel='stylesheet' type='text/css'>
  
  <script>
  
$( document ).ready(function() {
    console.log( "ready!" );
	 setNavigation();
   setApplicants();


  $('.tablinks').click(function () {
    $('.tabcontent').removeClass('active');
    $('.tablinks').removeClass('active');
    $(this).addClass('active');
    $('#tab'+$(this).data("tab")).addClass('active');
  });

  $(".userselect").select2();


});

function setNavigation() {
  <?php $page=(isset($_SESSION["page"]))?$_SESSION["page"]:0; ?>
  var temp='<?php echo $page; ?>';
  var path;
  if(temp!=0)
  {
    path=temp;
  }
  else
  {
    path = window.location.pathname;
    path = path.replace('/baymun.com/', "");
  }

$("#navbar a").each(function () {
        var href = $(this).attr('href');
        if (path === href) {
            $(this).closest('li').addClass('active');
        }
    });
}

function setApplicants(){
  if(typeof position !== 'undefined'){
  $('button[name="' + position + '"]').addClass('active');
  }
}



  
  </script>
  
</body>

</html>