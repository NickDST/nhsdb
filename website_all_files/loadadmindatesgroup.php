<?php
include "includes/dbhcal.inc.php";
session_start();

if (!isset($_SESSION['studentid'])) {
	header('Location: login.php');
  exit;
}

include "includes/dbh.inc.php";
$sql = "SELECT * FROM students WHERE studentid = ".$_SESSION['studentid'];
$result = mysqli_query($connection, $sql);
while ($student = $result->fetch_assoc()): 
$view_society =	$student['officer_log'];
//echo $view_society;
endwhile;

//$studentsql = "SELECT available_times.*, students_in_societies.* FROM available_times, students_in_societies WHERE students_in_societies.studentid = available_times.studentid AND students_in_societies.honor_society = 'NHS'";




//load.php
//$connect = new PDO('mysql:host=localhost;dbname=nhsdb', 'root', 'sql2019');

$data = array();

$query = "SELECT available_times.*, students_in_societies.* FROM available_times, students_in_societies WHERE students_in_societies.studentid = available_times.studentid AND students_in_societies.honor_society = '$view_society'";

$statement = $connect->prepare($query);

$statement->execute();

$result = $statement->fetchAll();

foreach($result as $row)
{
 $data[] = array(
  'id'   => $row["id"],
  'title'   => $row["grouporone"],
  'start'   => $row["datetime_start"],
  'end'   => $row["datetime_end"]
 );
}

echo json_encode($data);

?>
