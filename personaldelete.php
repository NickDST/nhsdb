<?php
include "includes/dbhcal.inc.php";
session_start();

if (!isset($_SESSION['studentid'])) {
	header('Location: login.php');
  exit;
}
//delete.php

if(isset($_POST["id"]))
{
 //$connect = new PDO('mysql:host=localhost;dbname=nhsdb', 'root', 'sql2019');
 $query = "
 DELETE from self_personal_calendar WHERE id=:id
 ";
 $statement = $connect->prepare($query);
 $statement->execute(
  array(
   ':id' => $_POST['id']
  )
 );
}

?>
