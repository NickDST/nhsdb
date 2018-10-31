<?php
include "includes/dbhcal.inc.php";
session_start();

if (!isset($_SESSION['studentid'])) {
	header('Location: login.php');
  exit;
}



//insert.php

//$connect = new PDO('mysql:host=localhost;dbname=nhsdb', 'root', 'sql2019');

if(isset($_POST["title"]))
{
 $query = "
 INSERT INTO available_times
 (title, datetime_start, datetime_end, studentid, grouporone)
 VALUES (:title, :start_event, :end_event, :studentid, :grouporone)
 ";
 $statement = $connect->prepare($query);
 $statement->execute(
  array(
   ':title'  => $_POST['title'],
   ':start_event' => $_POST['start'],
   ':end_event' => $_POST['end'],
   ':studentid' => $_SESSION['studentid'],
   ':grouporone' => "one on one tutoring",
   
  )
 );
}


?>

<?php

/*
if(isset($_POST["title"]))
{
  $title = $_POST['title'];
  $start = $_POST['start'];
  $end = $_POST['end'];
	
  $sql = "INSERT INTO available_times title, datetime_start, datetime_end, studentid 
  VALUES $title, $start, $end,".$_SESSION['studentid'];

	
  $statement = $connect->prepare($sql);

  $statement->execute();	
	*/
	/*
 $query = "
 INSERT INTO available_times
 (title, datetime_start, datetime_end)
 VALUES (:title, :start_event, :end_event)
 ";
 $statement = $connect->prepare($query);
 $statement->execute(
  array(
   ':title'  => $_POST['title'],
   ':start_event' => $_POST['start'],
   ':end_event' => $_POST['end']
  )
 ); }*/
	


?>

