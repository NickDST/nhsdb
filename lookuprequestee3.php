<?php

include 'adminhubheader.php';
?>



<!doctype html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Search Project</title>
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
								$username = mysqli_real_escape_string( $connection, $_GET[ 'username' ] );
								$name = mysqli_real_escape_string( $connection, $_GET[ 'name' ] );
								$id = mysqli_real_escape_string( $connection, $_GET[ 'id' ] );
								//	echo $projectid;
								$sql = "SELECT * FROM requestlogin WHERE username = '$username'";
								$result = mysqli_query( $connection, $sql );
								$queryResults = mysqli_num_rows( $result );
								if ( $queryResults > 0 ) {
									while ( $row = mysqli_fetch_assoc( $result ) ) {
										?>

								<h4>
									<?php echo "Name: ". $row['full_name'];?>
								</h4>
								<h5>
									<?php echo "Username: ". $row['username'];?>
								</h5>
								<hr>

								<h5>
									<?php echo " ID : ". $row['request_login_id'];?>
								</h5>
								<h5>

									<hr>
									<h3>Tutor things involved in</h3>

									<?php  } 
								

									
								//$sql = "SELECT project_list.*, students_in_projects.* FROM project_list, students_in_projects WHERE project_list.projectid = students_in_projects.projectid AND project_list.requestee = '$username'";
									
									
									//echotest
								$sql = "SELECT * from project_list WHERE request_username = '$username'";	
									
									//echo $sql;
								$result = mysqli_query( $connection, $sql );
								
							

								while ( $requestee = $result->fetch_assoc() ):	
									
									$tutorid = $requestee['entered_by'];
									$studentnamesql = "SELECT name FROM students WHERE studentid = '$tutorid'";
									
										
									
									
									
										$studentnameresult = mysqli_query( $connection, $studentnamesql );
										while ( $studentname2 = $studentnameresult->fetch_assoc() ):
										$tutorname = $studentname2[ 'name' ];
									
								endwhile;?>

									<?php echo"Tutor name: ". $tutorname;?> <br>
									<?php echo"Affiliated Group: ". $requestee['affiliated_group'];?> <br>
									<?php echo $requestee['datetime_start'];?> <br>
									<?php echo $requestee['datetime_end'];?> <br>
									<br>
									<br>
									<?php
									endwhile;

									}
									?>
							</div>
						</div>
					</div>
				</div>