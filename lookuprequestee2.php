<?php

include 'adminhubheader.php';

?>



<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Search Page</title>
</head>

<body>
	<div style = "padding-left:30px;">
	<h1>Search Page</h1>
	</div>
		 <div class="content">
            <div class="container-fluid">
                <div class="row">
					
                    <div class="col-md-12">
                        <div class="card">

                            <div class="header">
                                <h2 class="title">All Projects</h2>
                                <h3 class="category">Search for the Project</h3>
                            </div>
							<br>
                            <div class = "" style= "padding-left:15px;">
	
	<div class = "article-container">
	
		
		<?php
		if (isset($_POST['submit-search'])) {
			$search = mysqli_real_escape_string($connection, $_POST['search']);
			$sql = "SELECT * FROM requestlogin WHERE (username LIKE '%$search%' OR full_name LIKE '%$search%' OR parent_or_student LIKE '%$search%')";
			
			$result = mysqli_query($connection, $sql);
			$queryResult = mysqli_num_rows($result);
			
			//SELECT * FROM project_list WHERE type != 'tutor' AND (project_name LIKE '%nhs%' OR requestee LIKE '%nhs%' OR project_description LIKE '%nhs%' OR affiliated_group LIKE '%nhs%' OR datetime_start LIKE '%nhs%')
			
			
			
			
			
			echo "There are ".$queryResult. " results <hr>";
			
			
			if ($queryResult > 0) {
				while ($row = mysqli_fetch_assoc($result)) {
					echo "
				
					<div>
					<h3>Username: ".$row['username']."</h3>
					<p>Full Name: ".$row['full_name']."</p>
					<p>Full Name: ".$row['request_login_id']."</p>
					</div>
					<a href = 'lookuprequestee3.php?username=".$row['username']."&name=".$row['full_name']."&id=".$row['request_login_id']."'>More Info</a>
					<hr>";
					
				/*	<a href = 'confirmpending.php?name=".$row['requestee']."&startdate=".$row['datetime_start']."&id=".$row['requestid']."'>More Info
					</a> */
					
				}
				
			} else {
				echo "There are no results matching your search.";
			}
		}
		
		?>
		
		
		<h5>Don't see anything matching your search? <a href="newproject.php">add a new project</a></h5>
		<br>
	</div>
	   </div>
                        </div>
                    </div>     </div>
                        </div>
                    </div>
	</div>
	
	
</body>
</html>












