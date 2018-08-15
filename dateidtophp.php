<?php


if(isset($_POST["id"]))
{
 session_start();

 $uid = $_POST["id"];	
 $title = $_POST["title"];		
 $studentid = $_POST["studentid"];	
 $_SESSION['tutortime']=$uid;
	
 
}

?>
