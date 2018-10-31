<?php
require_once('includes/dbh.inc.php');
/*
	$sql = "SELECT project_id ,name, student_id_rep, date_start, date_end, status from Projects ORDER BY date_start desc";
	$result = mysqli_query($connection, $sql);

	$resultCheck = mysqli_num_rows($result);
	if ($resultCheck > 0) {
		while ($row = mysqli_fetch_assoc($result)) {
*/

function getUsersData($id)
{
	$array = array();
	$sql = "SELECT * FROM `students` WHERE `studentid`= $id";
	$result = mysqli_query($connection, $sql);
	while ($r = mysqli_fetch_assoc($result)) 
	{
		$array['studentid'] = $r['studentid'];
		$array['name'] = $r['name'];
		$array['year'] = $r['year'];
		$array['position'] = $r['position'];
		$array['contact'] = $r['contact'];
		
	}
	return $array;
	
	
}

function getId($username)
{
	$sql2 = "SELECT `studentid` FROM `login` WHERE `username`= $username";
	$result2 = mysqli_query($connection, $sql2);
	while($r = mysqli_fetch_assoc($result2))
	{
		return $r['studentid'];
	}
}











 ?>
