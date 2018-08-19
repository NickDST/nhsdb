<?php

include 'hubheader.php'
?>



<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Add Service</title>
</head>

<body>
	
	 <div class="content">
            <div class="container-fluid">
                <div class="row">
					
                    <div class="col-md-12">
                        <div class="card">

                            <div class="header">
                                <h2 class="title">All Projects</h2>
                                <h3 class="category">Search Project</h3>
                            </div>
							<br>
                            <div class = "" style= "padding-left:15px;">
	<form action="searchproject2.php" method = "POST">
		<input type="text" name="search" placeholder="Search">
		<button type="submit" name = "submit-search">Submit</button>
	</form>
	

	
	<div class = "article-container">
		<hr>
		<?php
		$sql = "SELECT * FROM project_list WHERE type != 'tutor'";
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
                        </div>
                    </div>     </div>
                        </div>
                    </div>
	</div>
	

</body>
</html>


