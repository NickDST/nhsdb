<?php
session_start();

if (!isset($_SESSION['studentid'])) {
	header('Location: login.php');
  exit;
}


//load.php
$connect = new PDO('mysql:host=localhost;dbname=nhsdb', 'root', 'sql2019');

$data = array();

$query = "SELECT * FROM available_times WHERE studentid = ".$_SESSION['studentid'];

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

?>
