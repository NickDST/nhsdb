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

?>



<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Search Page</title>
</head>

<body>
<!--	<h1>Remove From Project</h1>-->
	
	<div class="content">
            <div class="container-fluid">
                <div class="row">
					
                    <div class="col-md-12">
                        <div class="card">

                            <div class="header">
                                <h2 class="title">Remove</h2>
                                <p class="category">Choose the project you want to remove yourself from</p>
                            </div>
                            <div class = "" style= "padding-left:15px;">
		
		<?php
			//$search = mysqli_real_escape_string($connection, $_POST['search']);
			$sql = "SELECT project_list.*, students_in_projects.*, students.* FROM project_list, students_in_projects, students WHERE students.studentid = students_in_projects.studentid AND students_in_projects.projectid = project_list.projectid AND students.studentid = '$id'";
			
			$result = mysqli_query($connection, $sql);
			$queryResult = mysqli_num_rows($result);
			
			echo "You are in ".$queryResult. " projects <hr>";
			
			
			if ($queryResult > 0) {
				while ($row = mysqli_fetch_assoc($result)) {
					echo "
					<a href = 'removemyselfproject.php?name=".$row['project_name']."&startdate=".$row['datetime_start']."&id=".$row['projectid']."'>
					<div>
					<h3>".$row['project_name']."</h3>
					<p>".$row['datetime_start']."</p>
					</div>
					<a>
					<hr>";
					
				}
				
			} else {
				echo "There are no results matching your search.";
			}
		
		
		?>
		                     </div>
                        </div>
                    </div>

      			</div>
       </div>
    </div>
	
	
	
	
</body>
</html>












