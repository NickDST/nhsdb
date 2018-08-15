<?php


//load.php
$connect = new PDO('mysql:host=localhost;dbname=nhsdb', 'root', 'sql2019');

$data = array();

$query = "SELECT * FROM available_times";

$statement = $connect->prepare($query);

$statement->execute();

$result = $statement->fetchAll();

foreach($result as $row)
{
 $data[] = array(
  'id'   => $row["id"],
	 //taking out the titles
  'title'   => $row["studentid"],
  'start'   => $row["datetime_start"],
  'end'   => $row["datetime_end"]
 );
}

echo json_encode($data);

?>
