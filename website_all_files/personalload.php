<?php

include "includes/dbhcal.inc.php";
session_start();

if (!isset($_SESSION['studentid'])) {
	header('Location: login.php');
  exit;
}

if (isset($_SESSION['settype'])) {
	$type = $_SESSION['settype'];
	
	?> 	 <?php	 
} else {
	//echo "nothing yet";
}

//load.php
//$connect = new PDO('mysql:host=localhost;dbname=nhsdb', 'root', 'sql2019');


if ($type == "projects") {
$data = array();

$query = "SELECT project_list.*, students_in_projects.*, students.* FROM project_list, students_in_projects, students WHERE students.studentid = students_in_projects.studentid AND students_in_projects.projectid = project_list.projectid AND students.studentid = ".$_SESSION['studentid'];

$statement = $connect->prepare($query);

$statement->execute();

$result = $statement->fetchAll();

foreach($result as $row)
{
 $data[] = array(
  'id'   => $row["projectid"],
  'title'   => $row["project_name"],
  'start'   => $row["datetime_start"],
  'end'   => $row["datetime_end"]
 );
}

	
echo json_encode($data);
}

if ($type == "personal") {
$data = array();

$query = "SELECT * FROM self_personal_calendar WHERE studentid = ".$_SESSION['studentid'];

$statement = $connect->prepare($query);

$statement->execute();

$result = $statement->fetchAll();

foreach($result as $row)
{
 $data[] = array(
  'id'   => $row["id"],
  'title'   => $row["title"],
  'start'   => $row["datetime_start"],
  'end'   => $row["datetime_end"]
 );
}

echo json_encode($data);
}





?>
