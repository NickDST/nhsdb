<?php

include 'hubheader.php';
?>



<!doctype html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Adding Me to a Project</title>
</head>

<body>



	<div class="content">
		<div class="container-fluid">
			<div class="row">

				<div class="col-md-12">
					<div class="card">

						<div class="header">
							<h4 class="title">Project Information</h4>
							<p class="category">General Info</p>
						</div>
						<div class="" style="padding-left:15px;">

							<div class="article-container">
								<hr>
								<?php
								$name = mysqli_real_escape_string( $connection, $_GET[ 'name' ] );
								$startdate = mysqli_real_escape_string( $connection, $_GET[ 'startdate' ] );
								$projectid = mysqli_real_escape_string( $connection, $_GET[ 'id' ] );
							//	echo $projectid;
								$sql = "SELECT * FROM project_list WHERE project_name = '$name' AND datetime_start = '$startdate' AND type != 'tutor'";
								$result = mysqli_query( $connection, $sql );
								$queryResults = mysqli_num_rows( $result );
								if ( $queryResults > 0 ) {
									while ( $row = mysqli_fetch_assoc( $result ) ) {
										echo "
				<div>
					<h3>" . $row[ 'project_name' ] . "</h3>
					<p>" . $row[ 'project_description' ] . "</p>
					
				</div>
				<hr>";
									}


								}

								?>
							</div>
						</div>
					</div>
		</div>
					

						<div class="content">
							<div class="container-fluid">
								<div class="row">

									<div class="col-md-12">
										<div class="card">

											<div class="header">
												<h3 class="title" style="text-align:center;">Add me to this project</h3>
												<h5 class="category" style="text-align:center;">Enter the correct information below</h5>
											</div>
											<div class="" style="padding-left:15px;">
												
												<form method="post">
													<br>
													<input type="number" name="service_hours" class="form-control" placeholder="Number of Service Hours" required maxlength = 100>
													<br>
													<input type="text" name="role" class="form-control" placeholder="My Role" required maxlength = 100>
													<br>
													
													<select name="affiliated_group_for_servicehours" id="">
													<option>Where do the hours count towards?</option>
										 			<option value="NHS">NHS</option>
										  			<option value="SNHS">SNHS</option>
														

										 
													</select>
													<br>
													<br>
													<button class="btn btn-success" name='add' type="submit" value='add'>Add Me To this Project</button>
												</form>

												<!--Adding a student to the project-->
												<?php

												if ( isset( $_POST[ 'add' ] ) == 'add' & !empty( $_POST[ 'add' ] ) ) {
													
													$affiliated_group_for_servicehours = $_POST["affiliated_group_for_servicehours"];	

													$alreadysql = "SELECT * FROM students_in_projects WHERE projectid = '$projectid' AND studentid = '$id'";
													//echo $alreadysql;
													$alreadyresult = mysqli_query( $connection, $alreadysql );
													$alreadyqueryResults = mysqli_num_rows( $alreadyresult );
													
													
													if ( $alreadyqueryResults == 0 ) {

														$service_hours = mysqli_real_escape_string( $connection, $_POST[ "service_hours" ] );
														$role = mysqli_real_escape_string( $connection, $_POST[ "role" ] );


														$addstudentsql = "INSERT INTO students_in_projects (projectid, studentid, service_hours, role, affiliated_group_for_servicehours) VALUES ('$projectid', '$id', '$service_hours' , '$role', '$affiliated_group_for_servicehours');";
														//echo $addstudentsql;



														$addstudentresult = mysqli_query( $connection, $addstudentsql );
														if ( $addstudentresult ) {
															//echo "Entry successfully added";
															echo '<script>window.location.href = "addmyselfproject.php?success=Entry added";</script>';	
															
															if ($_POST[ "service_hours" ] > 100) {
																echo " Wow! That's a lot of service hours! An email has been sent to Chapman/Gordon to confirm this.";
															}


														} else {
															//echo "Error: " . $sql . "<br>" . mysqli_error($conn);
															//echo "Entry failed to be added";
															echo '<script>window.location.href = "addmyselfproject.php?error=Entry failed to be added";</script>';	
														}

													} else {
														echo '<script>window.location.href = "addmyselfproject.php?error=Student is already in the Project";</script>';	
														//echo "student is already in the project";
													}
													
												}
												?>
											</div>
											<hr>

		
										</div>
									</div>
								</div>
							</div>

						</div>

</body>
</html>