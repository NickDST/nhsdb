<?php

include 'hubheader.php';

?>



<!doctype html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Remove Me From This Project</title>
</head>

<body>
	<!--<a href="hub.php">Back to Hub</a>-->

	<!--	<h1>Project</h1>-->


	<div class="content">
		<div class="container-fluid">
			<div class="row">

				<div class="col-md-12">
					<div class="card">

						<div class="header">
							<h2 class="title">Project</h2>
							<p class="category">This is the project</p>
						</div>
						<div class="" style="padding-left:15px;">
							<hr>
							<?php
							$name = mysqli_real_escape_string( $connection, $_GET[ 'name' ] );
							$startdate = mysqli_real_escape_string( $connection, $_GET[ 'startdate' ] );
							$projectid = mysqli_real_escape_string( $connection, $_GET[ 'id' ] );
							//echo $projectid;
							$sql = "SELECT project_list.*, students_in_projects.*, students.* FROM project_list, students_in_projects, students WHERE students.studentid = students_in_projects.studentid AND students_in_projects.projectid = project_list.projectid AND students.studentid = '$id' AND project_list.projectid = '$projectid'";
							$result = mysqli_query( $connection, $sql );
							$queryResults = mysqli_num_rows( $result );
							if ( $queryResults > 0 ) {
								while ( $row = mysqli_fetch_assoc( $result ) ) {
									echo "
				<div>
					<h3>" . $row[ 'project_name' ] . "</h3>
					<p>" . $row[ 'project_description' ] . "</p>
					<p>" . $row[ 'datetime_start' ] . "</p>
					<p>" . $row[ 'datetime_end' ] . "</p>
				    <p> I am the " . $row[ 'role' ] . "</p>
				</div>
				<hr>";

									$type = $row[ 'type' ];
								}


							}
							?>


							<form method="post">
								<label for=""> Type "remove me", in caps, in the designated box</label>
								<input type="text" name="confirm" id="" class="form-control" placeholder="Type it" required maxlength=9>
								<br>
								<button type="submit" class="btn btn-danger">Remove Me From This Project</button>
							</form>
							<br>


							<?php
							if ( isset( $_POST ) & !empty( $_POST ) ) {
								$confirm = mysqli_real_escape_string( $connection, $_POST[ "confirm" ] );
								if ( $confirm == "REMOVE ME" ) {

									$sql = "DELETE FROM students_in_projects WHERE studentid = '$id' AND projectid = '$projectid'";

									$result = mysqli_query( $connection, $sql );
									if ( $result ) {
										//echo "Entry successfully removed";
										echo '<script>window.location.href = "removemyselfproject.php?success=Successfully removed!";</script>';


									} else {

										//echo "Entry failed to be removed";
										echo '<script>window.location.href = "removemyselfproject.php?error=Something went wrong!";</script>';
									}


									if ( $type == 'tutor' ) {
										$confirm = mysqli_real_escape_string( $connection, $_POST[ "confirm" ] );


										$sql = "DELETE FROM project_list WHERE projectid = '$projectid'";

										$result = mysqli_query( $connection, $sql );
										if ( $result ) {
											//echo "everything successfully removed";
											//echo '<script>window.location.href = "removemyselfproject.php?success=Successfully removed!";</script>';


										} else {

											//echo "everything failed to be removed";
													//echo '<script>window.location.href = "removemyselfproject.php?error=Something went wrong!";</script>';
										}
									}

								}
							}


							?>

						</div>
					</div>
				</div>

			</div>
		</div>
	</div>