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
	
	
<!--Checking if student is in NHS	-->
<?php								
$societysql = "SELECT * FROM students_in_societies WHERE studentid = '$id' AND honor_society = 'NHS'";
				$societyresult = mysqli_query( $connection, $societysql );

				$societycheck = mysqli_num_rows($societyresult);
				if ($societycheck > 0) { 		
				while ( $in_society = $societyresult->fetch_assoc() ):
				$in_nhs = "yes";
				//	echo "in nhs";
				endwhile;	
				}
	
?>
<!--Checking if student is in SNHS	-->
<?php	
$societysql = "SELECT * FROM students_in_societies WHERE studentid = '$id' AND honor_society = 'SNHS'";
				$societyresult = mysqli_query( $connection, $societysql );

				$societycheck = mysqli_num_rows($societyresult);
				if ($societycheck > 0) { 		
				while ( $in_society = $societyresult->fetch_assoc() ):
				$in_snhs = "yes";	
				//	echo "in snhs";
				endwhile;	
				} else {
				//	echo "nothing";
				}
	
?>	
	
<?php	
$sqlhours = "SELECT SUM(service_hours) FROM students_in_projects WHERE studentid = '$id'";
//echo $id;
$resulthours = mysqli_query($connection, $sqlhours);
while ($totalhours = $resulthours->fetch_assoc()): ?>	

	
		 <div class="content">
            <div class="container-fluid">
                <div class="row">
					
                    <div class="col-md-12">
                        <div class="card">

                            <div class="header">
                                <h4 class="title">Projects + Service Hours</h4>
                                <p class="category">These are all your past/current projects and service</p>
								<h3>Current total: <?=$totalhours['SUM(service_hours)']?></h3>
								<?php endwhile ?>
								

								
								
								
								
<!--NHS HOURS-->
									
<?php
if($in_nhs=='yes')	{
$sqlhours = "SELECT SUM(service_hours) FROM students_in_projects WHERE studentid = '$id' AND affiliated_group_for_servicehours = 'NHS'";
//echo $id;
$resulthours = mysqli_query($connection, $sqlhours);
	
$numCheck = mysqli_num_rows($resulthours);
while ($snhstotalhours = $resulthours->fetch_assoc()): 		
			
if (isset($nhstotalhours['SUM(service_hours)'])) {?>							
								
								
<h3>Total Hours for SNHS: <?=$nhstotalhours['SUM(service_hours)'];?></h3>
							
								
<?php } else {
echo "<h3>Total Hours for NHS: 0</h3>";								

}
endwhile;
}	?>			

								
								
								
<!--SNHS HOURS								-->
								
<?php	
if($in_snhs=='yes')	{	
$sqlhours = "SELECT SUM(service_hours) FROM students_in_projects WHERE studentid = '$id' AND affiliated_group_for_servicehours = 'SNHS'";
//echo $id;
$resulthours = mysqli_query($connection, $sqlhours);
	
$numCheck = mysqli_num_rows($resulthours);
while ($snhstotalhours = $resulthours->fetch_assoc()): 		
			
if (isset($snhstotalhours['SUM(service_hours)'])) {?>							
								
								
<h3>Total Hours for SNHS: <?=$snhstotalhours['SUM(service_hours)'];?></h3>
							
								
<?php } else {
echo "<h3>Total Hours for SNHS: 0</h3>";								

}
endwhile;
}								?>		

	
<?php endwhile;?>										
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
					<?php echo "Description:  ". $projectinfo['project_description'];?> <br><br>
					<?php echo "Datetime started: ".$projectinfo['datetime_start'];?> <br>
					<?php echo "Datetime ended: ".$projectinfo['datetime_end'];?> <br><br>
					<?php echo "Requestee: ".$projectinfo['requestee'];?> <br>
					<?php echo "Requestee Email: ".$projectinfo['requestee_email'];?> <br><br>			
					<?php echo "Affiliated Group: ".$projectinfo['affiliated_group'];?> <br><br>	
					<?php echo "Service Hours Count towards: ".$projectinfo['affiliated_group_for_servicehours'];?> <br>	
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




