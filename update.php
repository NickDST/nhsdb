<?php

//update.php

$connect = new PDO('mysql:host=localhost;dbname=nhsdb', 'root', 'sql2019');

if(isset($_POST["id"]))
{
 $query = "
 UPDATE available_times
 SET title=:title, datetime_start=:start_event, datetime_end=:end_event
 WHERE id=:id
 ";
 $statement = $connect->prepare($query);
 $statement->execute(
  array(
   ':title'  => $_POST['title'],
   ':start_event' => $_POST['start'],
   ':end_event' => $_POST['end'],
   ':id'   => $_POST['id']
  )
 );
}

?>
