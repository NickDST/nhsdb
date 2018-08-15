<?php
/*
include "includes/dbh.inc.php";

$sql1 = "SELECT * FROM students_in_subjects WHERE subject = 'biology' ";
$result = mysqli_query($connection, $sql);
while ($student = $result->fetch_assoc()): ?>	
*/


//load.php
$connect = new PDO('mysql:host=localhost;dbname=nhsdb', 'root', 'sql2019');

$data = array();

$query = "SELECT available_times.*, students_in_subjects.* FROM available_times, students_in_subjects WHERE available_times.studentid = students_in_subjects.studentid AND students_in_subjects.subject = 'biology'";

$statement = $connect->prepare($query);

$statement->execute();

$result = $statement->fetchAll();

foreach($result as $row)
{
 $data[] = array(
  'id'   => $row["id"],
	 //taking out the titles
  'title'   => $row["title"],
  'start'   => $row["datetime_start"],
  'end'   => $row["datetime_end"]
 );
}

echo json_encode($data);

?>
