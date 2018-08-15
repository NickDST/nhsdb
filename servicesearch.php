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
//yoyos are cool

?>



<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Search Page</title>
</head>

<body>
	<h1>Search Page</h1>
	
	<div class = "article-container">
		
		<?php
		if (isset($_POST['submit-search'])) {
			$search = mysqli_real_escape_string($connection, $_POST['search']);
			$sql = "SELECT * FROM project_list WHERE project_name LIKE '%$search%' OR requestee LIKE '%$search%' OR project_description LIKE '%$search%' OR affiliated_group LIKE '%$search%' OR datetime_start LIKE '%$search%' OR type LIKE '%$search%'";
			
			$result = mysqli_query($connection, $sql);
			$queryResult = mysqli_num_rows($result);
			
			echo "There are ".$queryResult. " results <hr>";
			
			
			if ($queryResult > 0) {
				while ($row = mysqli_fetch_assoc($result)) {
					echo "
					<a href = 'addmyselfproject.php?name=".$row['project_name']."&startdate=".$row['datetime_start']."&id=".$row['projectid']."'>
					<div>
					<h3>".$row['project_name']."</h3>
					<p>".$row['project_description']."</p>
					<p>".$row['datetime_start']."</p>
					</div>
					<a>
					<hr>";
					
				}
				
			} else {
				echo "There are no results matching your search.";
			}
		}
		
		?>
		
		
		<h5>Don't see anything matching your search? <a href="newproject.php">add a new project</a></h5>
	</div>
	
	
</body>
</html>












