<?php
include'connection.php';
session_start();
if(empty($_SESSION['id'])){
	header('location: index.php');
}
else{
	$a= $_SESSION['user_type'];
	switch ($a) {
  case "customer":
    	header('location:route.php?param=customerdashboard');
    break;
  case "service_provide":
  	header('location:route.php?param=servicedashboard');
    break;
}
}


?>
