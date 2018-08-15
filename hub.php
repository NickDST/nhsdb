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



$sql = "SELECT * FROM students WHERE studentid = '$id'";
echo $id;
$result = mysqli_query($connection, $sql);
while ($student = $result->fetch_assoc()): ?>


<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Hub</title>
</head>

<body>
	
	<h3>Welcome <?= $student['name'] ?></h3>
	<!--This code will sift through the project database and if we can't find the corresponding one
	then will give you the option to create a new project-->
	<a href="addservicemain.php">Add Service Hours</a>
	<br>
	<!--availability for tutoring-->
	<a href="availability.php">Tutoring Availability</a>
	<br>
	<!--More info regarding your projects-->
	<a href="myprojects">My Projects</a>
	<br>
	<!--Where you can alter details about yourself including the fields you are willing to teach-->
	<a href="aboutme.php">About Me</a>
	<br>
	<!--Where the student activates the pending request, an extra verification step-->
	<a href="activatepending.php">Pending Requests</a>
	<br>
	<a href="removeself.php">Remove myself from a project</a>
	<br>
	<!--heads back-->
	<a href="index.php">back</a>
	
	
	<h4> Pending Requests: </h4>

				<?php
				/*Pending requests*/
				$pendingsql = "SELECT * FROM request WHERE datetime_start > NOW() AND studentid = '$id' ORDER BY datetime_start";
				$Presultsql = mysqli_query( $connection, $pendingsql );

				$pendingCheck = mysqli_num_rows($Presultsql);
		
			
				if ($pendingCheck > 0) {
					
					while ( $pendingrequest = $Presultsql->fetch_assoc() ):


					?>

					<?php echo $pendingrequest['requestee'];?> <br>
					<?php echo $pendingrequest['contact'];?> hours - 
					<?php echo nl2br($pendingrequest['subject']."\r\n");?> 



					<!-- End While for project ID -->
					<?php endwhile; 
				} else {
					echo "No Pending Requests";
				}
				?>
				
				<hr>
	
	<h4> Ongoing Projects </h4>

				<?php
				/*Projects where status = ongoing*/
				$studentsql = "SELECT project_list.*, students_in_projects.*, students.* FROM project_list, students_in_projects, students WHERE students.studentid = students_in_projects.studentid AND students_in_projects.projectid = project_list.projectid AND students.studentid = '$id' AND project_list.status = 'ongoing'";
				$resultsql = mysqli_query( $connection, $studentsql );

				$resultCheck = mysqli_num_rows($resultsql);
		
			
				if ($resultCheck > 0) {
					
					while ( $projectinfo = $resultsql->fetch_assoc() ):


					?>

					<?php echo $projectinfo['project_name'];?> <br>
					<?php echo "Role: ".nl2br($projectinfo['role']."\r\n");?> 



					<!-- End While for project ID -->
					<?php endwhile; 
				} else {
					echo "No Projects Entered Yet";
				}
				?>
				
				<hr>
				
	
	
	
	
	
	
	
	
	
	
	
	<h4> Projects + Service Hours involved in: </h4>

				<?php
				/*For all previous service hours and projects*/
				$studentsql = "SELECT project_list.*, students_in_projects.*, students.* FROM project_list, students_in_projects, students WHERE students.studentid = students_in_projects.studentid AND students_in_projects.projectid = project_list.projectid AND students.studentid = '$id'";
				$resultsql = mysqli_query( $connection, $studentsql );

				$resultCheck = mysqli_num_rows($resultsql);
		
			
				if ($resultCheck > 0) {
					
					while ( $projectinfo = $resultsql->fetch_assoc() ):


					?>

					<?php echo $projectinfo['project_name'];?> <br>
					<?php echo $projectinfo['service_hours'];?> hours - 
					<?php echo nl2br($projectinfo['role']."\r\n");?> 
	<br>



					<!-- End While for project ID -->
					<?php endwhile; 
				} else {
					echo "No Projects Entered Yet";
				}
				?>
				
				<hr>
				
				
		
	
	
	
	
	
	
	
	
	
</body>
</html>


<?php endwhile; ?> 

