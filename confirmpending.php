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
	
	<h1>Activate This Project</h1>

	
	<div class = "article-container">
		<hr>
		<?php
		$name = mysqli_real_escape_string($connection, $_GET['name']);
		$startdate = mysqli_real_escape_string($connection, $_GET['startdate']);
		$requestid = mysqli_real_escape_string($connection, $_GET['id']);
		//echo $projectid;
		$sql = "SELECT * FROM request WHERE datetime_start > NOW() AND studentid = '$id' AND requestid = '$requestid'";
		$result = mysqli_query($connection, $sql);
		$queryResults = mysqli_num_rows($result);
		if ($queryResults > 0) {
			while ($row = mysqli_fetch_assoc($result)) {
				echo "
				<div>
					<h3>".$row['requestee']."</h3>
					<p>".$row['contact']."</p>
					<p>".$row['datetime_start']."</p>
					<p>".$row['datetime_end']."</p>
				 
				</div>
				<hr>";
			
		 $requestee = $row['requestee'];
		 $datetime_start = $row['datetime_start'];
		 $datetime_end = $row['datetime_end'];
		 $requestee_email = $row['contact'];
		 $studentid = $row['studentid'];
			}
			
	
		}
		?>
		

<form method="post">
		<label for=""> Type "I accept" in the designated box</label>
		<input type="text" name="confirm" id="" class= "form-control" placeholder = "Type it"  required >
	<button type="submit">Submit</button>	
</form>		
		

		
<?php
if(isset($_POST) & !empty($_POST)){
	$confirm = mysqli_real_escape_string($connection, $_POST["confirm"]);
	if ($confirm == "I accept") {
		
		$teacher_contact = 'Jennifer.chapman@concordiashanghai.org';
		$teacher_name = 'Jennifer Chapman';
		$affiliated_group = 'NHS';
		$project_description = 'This is an NHS Tutoring Request';
		
		$addsql = "INSERT INTO project_list (project_name, teacher_name, teacher_contact, datetime_start, datetime_end, affiliated_group, entered_by, project_description, requestee, requestee_email, type) VALUES ('Tutoring Request', '$teacher_name', '$teacher_contact' , '$datetime_start' , '$datetime_end', '$affiliated_group', '$id', '$project_description', '$requestee', '$requestee_email', 'tutor');";
		
		$addresult = mysqli_query($connection, $addsql);
		if ($addresult) {
			echo "Project successfully inserted ";


		} else {
		
			echo "project failed to be added";
		}
		
		//Finding the ID of the project added
		
		$findsql = "SELECT * FROM project_list WHERE datetime_start = '$datetime_start' AND requestee = '$requestee'";
		$findresult = mysqli_query($connection, $findsql);
		$findqueryResults = mysqli_num_rows($findresult);
		if ($findqueryResults > 0) {
			while ($row = mysqli_fetch_assoc($findresult)) {
				$projectid = $row['projectid'];
		
			}
		
		date_default_timezone_set('Asia/Hong_Kong');

		$diff = strtotime($datetime_end) - strtotime($datetime_start);
 		$diff_in_hrs = $diff/3600;
 		
		
		
		$addsql2 = "INSERT INTO students_in_projects (projectid, studentid, service_hours, role) VALUES ('$projectid', '$id', '$diff_in_hrs' , 'Tutorer');";
		
		$addresult2 = mysqli_query($connection, $addsql2);
		if ($addresult2) {
			echo "student in project successfully inserted";


		} else {
		
			echo "studentinproject failed to be added";
		}
		
		
		
	
		
		$sql2 = "DELETE FROM request WHERE studentid = '$id' AND requestid = '$requestid'";
		
		$result2 = mysqli_query($connection, $sql2);
		if ($result2) {
			echo "Entry successfully removed";


		} else {
		
			echo "Entry failed to be removed";
		}

		
	}

}
}
?>
		
		