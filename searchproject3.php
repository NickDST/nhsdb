<?php

include 'hubheader.php';
?>



<!doctype html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Untitled Document</title>
</head>

<body>



	<div class="content">
		<div class="container-fluid">
			<div class="row">

				<div class="col-md-12">
					<div class="card">

						<div class="header">
							<h4 class="title">Project Information</h4>
							<p class="category">Specific Information Regarding This Project</p>
						</div>
						<div class="" style="padding-left:15px; padding-bottom:20px;">

							<div class="article-container">
								<hr>
								<?php
								$name = mysqli_real_escape_string( $connection, $_GET[ 'name' ] );
								$startdate = mysqli_real_escape_string( $connection, $_GET[ 'startdate' ] );
								$projectid = mysqli_real_escape_string( $connection, $_GET[ 'id' ] );
							//	echo $projectid;
								$sql = "SELECT * FROM project_list WHERE project_name = '$name' AND datetime_start = '$startdate' AND projectid = '$projectid' AND type != 'tutor'";
								$result = mysqli_query( $connection, $sql );
								$queryResults = mysqli_num_rows( $result );
								if ( $queryResults > 0 ) {
									while ( $row = mysqli_fetch_assoc( $result ) ) {?>
										
								<h4>	<?php echo "Project Name: ". $row['project_name'];?></h4>
								<h5>	<?php echo "Description: ". $row['project_description'];?></h5>
								<hr>
								<br>
								<h5>	<?php echo "Datetime Start: ". $row['datetime_start'];?></h5>
								<h5>	<?php echo "Datetime End: ". $row['datetime_end'];?></h5>
								<h5>	<?php echo "Project ID: ". $row['projectid'];?></h5>
								<h5>	<?php echo "Requestee: ". $row['requestee'];?></h5>
								<h5>	<?php echo "Requestee Contact: ". $row['requestee_contact'];?></h5>
								<h5>	<?php echo "Teacher: ". $row['teacher_name'];?></h5>
								<h5>	<?php echo "Teacher Contact: ". $row['teacher_contact'];?></h5>
								<h5>	<?php echo "Requestee: ". $row['requestee'];?></h5>
								<h5>	<?php echo "Affiliated Group: ". $row['affiliated_group'];?></h5>
					
	
								
								
								
							<?php		}


								}

								?>
							</div>
						</div>
					</div>
		</div>
					