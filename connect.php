<?php

  define('MYSQL_USER', 'wypxao8x9ahv');
  define('MYSQL_PASSWORD', 'Radia@2019');
  define('MYSQL_HOST', 'baymun.com');
  define('MYSQL_DATABASE', 'baymun');
  
  $connect = new mysqli(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DATABASE);
  
  if($connect->connect_error)
  {
	  die("Connection failed: " . $connect->connect_error);  
  }
  
?>