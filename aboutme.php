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
<title>Untitled Document</title>
</head>

<body>
	
	
	<h3>Welcome <?= $student['name'] ?> To About Me</h3>

	<!--heads back-->
	<a href="hub.php">back to hub</a>
	
	

	
	
	<h4>My Info</h4>

				<?php
				/*For all previous service hours and projects*/
				$studentsql = "SELECT students_in_subjects.*, students.* FROM students_in_subjects, students WHERE students.studentid = students_in_subjects.studentid AND students.studentid = '$id' LIMIT  1";
				$resultsql = mysqli_query( $connection, $studentsql );

				$resultCheck = mysqli_num_rows($resultsql); ?>
			
	<?php
	

				if ($resultCheck > 0) {
					
					while ( $studentinfo = $resultsql->fetch_assoc() ): ?>
 
	
						<?php echo "Name: ".$studentinfo['name'];?> <br>
						<?php echo "Year: ".$studentinfo['year'];?> <br>

	
					<?php
					endwhile; } ?>
					
					<?php
					$fieldsql = "SELECT students_in_subjects.*, students.* FROM students_in_subjects, students WHERE students.studentid = students_in_subjects.studentid AND students.studentid = '$id'";
				$fieldresultsql = mysqli_query( $connection, $fieldsql );

				$fieldresultCheck = mysqli_num_rows($fieldresultsql); 
				
				echo "Fields I'm tutoring in: ";
				if ($fieldresultCheck > 0) {
					
					while ( $fieldinfo = $fieldresultsql->fetch_assoc() ): ?>
	
					<?php echo $fieldinfo['subject']. ",";?> 
					
					
					<?php endwhile;  ?>
					
					
			<?php	
				} else {
					echo "Nothing Entered Yet";
				}
				?>

					
	
	
	
<?php endwhile; ?> 
				<hr>
				
				
		
	
	
	
	
	
	
	
	
	
</body>
</html>


