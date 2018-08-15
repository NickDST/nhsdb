<?php

session_start();
require_once('includes/dbh.inc.php');
if (!isset($_SESSION['studentid'])) {
	header('Location: login.php');
  exit;
}

if (isset($_SESSION['studentid'])) {
	$id = $_SESSION['studentid'];
	
	?> 	 <?php	 
} else {
	echo "nothing yet";
}

?>



<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Untitled Document</title>
</head>

<body>
<a href="hub.php">Back to Hub</a>
	
	<h1>Project</h1>

	
	<div class = "article-container">
		<hr>
		<?php
		$name = mysqli_real_escape_string($connection, $_GET['name']);
		$startdate = mysqli_real_escape_string($connection, $_GET['startdate']);
		$projectid = mysqli_real_escape_string($connection, $_GET['id']);
		//echo $projectid;
		$sql = "SELECT project_list.*, students_in_projects.*, students.* FROM project_list, students_in_projects, students WHERE students.studentid = students_in_projects.studentid AND students_in_projects.projectid = project_list.projectid AND students.studentid = '$id' AND project_list.projectid = '$projectid'";
		$result = mysqli_query($connection, $sql);
		$queryResults = mysqli_num_rows($result);
		if ($queryResults > 0) {
			while ($row = mysqli_fetch_assoc($result)) {
				echo "
				<div>
					<h3>".$row['project_name']."</h3>
					<p>".$row['project_description']."</p>
					<p>".$row['datetime_start']."</p>
					<p>".$row['datetime_end']."</p>
				    <p> I am the ".$row['role']."</p>
				</div>
				<hr>";
			}
			
			
		}
		?>
		

<form method="post">
		<label for=""> Type "remove me" in the designated box</label>
		<input type="text" name="confirm" id="" class= "form-control" placeholder = "Type it"  required >
	<button type="submit">Remove Me From This Project</button>	
</form>		
		

		
<?php
if(isset($_POST) & !empty($_POST)){
	$confirm = mysqli_real_escape_string($connection, $_POST["confirm"]);
	if ($confirm == "remove me") {
		
		$sql = "DELETE FROM students_in_projects WHERE studentid = '$id' AND projectid = '$projectid'";
		
		$result = mysqli_query($connection, $sql);
		if ($result) {
			echo "Entry successfully removed";


		} else {
		
			echo "Entry failed to be removed";
		}

		
	}

}
		
?>
		
		