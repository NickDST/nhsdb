<?php
include "includes/dbhcal.inc.php";
session_start();

if (!isset($_SESSION['studentid'])) {
	header('Location: login.php');
  exit;
}

if (isset($_SESSION['group_subject'])){
	//$_SESSION['group_subject'];
}

if (isset($_SESSION['group_desc'])){
	//$_SESSION['group_subject'];
}

include "includes/dbh.inc.php";
$sql = "SELECT * FROM students WHERE studentid = ".$_SESSION['studentid'];
$result = mysqli_query($connection, $sql);
while ($student = $result->fetch_assoc()): 
$view_society =	$student['officer_log'];
//echo $view_society;
endwhile;



//insert.php

//$connect = new PDO('mysql:host=localhost;dbname=nhsdb', 'root', 'sql2019');

if(isset($_POST["title"]))
{
 $query = "
 INSERT INTO available_times
 (title, datetime_start, datetime_end, studentid, grouporone, affiliated, group_subject, group_desc)
 VALUES (:title, :start_event, :end_event, :studentid, :grouporone, :affiliated, :group_subject, :group_desc)
 ";
 $statement = $connect->prepare($query);
 $statement->execute(
  array(
   ':title'  => $_POST['title'],
   ':start_event' => $_POST['start'],
   ':end_event' => $_POST['end'],
   ':studentid' => "1111111",
   ':grouporone' => "group study",
   ':affiliated' => "$view_society",
   ':group_subject' => $_SESSION['group_subject'],
   ':group_desc' => $_SESSION['group_desc'],
   
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

