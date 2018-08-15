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
	<form action="servicesearch.php" method = "POST">
		<input type="text" name="search" placeholder="Search">
		<button type="submit" name = "submit-search">Submit</button>
	</form>
	
	<h1>All Projects</h1>
	<h2>Search for the project you want to add yourself to</h2>
	
	<div class = "article-container">
		<hr>
		<?php
		$sql = "SELECT * FROM project_list";
		$result = mysqli_query($connection, $sql);
		$queryResults = mysqli_num_rows($result);
		if ($queryResults > 0) {
			while ($row = mysqli_fetch_assoc($result)) {
				echo "
				<div>
					<h3>".$row['project_name']."</h3>
					<p>".$row['project_description']."</p>
				</div>
				<hr>";
			}
			
			
		}
		
		?>

	</div>
	

</body>
</html>


