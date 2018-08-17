<?php
/*
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

*/

include 'hubheader.php';



$sql = "SELECT * FROM students WHERE studentid = '$id'";
//echo $id;
$result = mysqli_query($connection, $sql);
while ($student = $result->fetch_assoc()): ?>


<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Hub</title>
</head>

<body>
	
<!--	<h3>Welcome <?/*= $student['name'] */?> To Viewing Projects</h3>-->

	<!--heads back-->
<!--	<a href="hub.php">back to hub</a>-->
	
	

	
		 <div class="content">
            <div class="container-fluid">
                <div class="row">
					
                    <div class="col-md-12">
                        <div class="card">

                            <div class="header">
                                <h4 class="title">Projects + Service Hours</h4>
                                <p class="category">These are all your past/current projects and service</p>
                            </div>
                            <div class = "" style= "padding-left:15px;">
               

                     
<!--	<h4> Projects + Service Hours</h4>-->

				<?php
				/*For all previous service hours and projects*/
				$studentsql = "SELECT project_list.*, students_in_projects.*, students.* FROM project_list, students_in_projects, students WHERE students.studentid = students_in_projects.studentid AND students_in_projects.projectid = project_list.projectid AND students.studentid = '$id'";
				$resultsql = mysqli_query( $connection, $studentsql );

				$resultCheck = mysqli_num_rows($resultsql);
		
			
				if ($resultCheck > 0) {
					
					while ( $projectinfo = $resultsql->fetch_assoc() ):


					?>
					<hr>
					<?php echo $projectinfo['project_name'];?> <br>
					<?php echo "Description:  ". $projectinfo['project_description'];?> <br>
					<?php echo $projectinfo['datetime_start'];?> <br>
				
					<?php echo $projectinfo['datetime_end'];?> <br>
					<?php echo "status: ".$projectinfo['status'];?> <br>
					<?php echo $projectinfo['service_hours'];?> hours - 
					<?php echo nl2br($projectinfo['role']."\r\n");?> 



					<!-- End While for project ID -->
					<?php endwhile; 
				} else {
					echo "No Projects Entered Yet";
				}
				?>
				
				<hr>
				
				      
                            </div>
                        </div>
                    </div>
		
	
	
	
	
	
	
	
	
	
</body>
</html>


<?php endwhile; ?> 

