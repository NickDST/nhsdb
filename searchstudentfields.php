<?php include 'adminhubheader.php'?>

<div class="content">
	<div class="container-fluid">
		<div class="row">

			<div class="col-md-12">
				<div class="card">

					<div class="header">
						<h4 class="title"><strong>Search Students in Fields</strong></h4>
						<p class="category">huuuuuuuuuuuuhhhhh</p>
					</div>
					<div class="" style="padding-left:15px; padding-bottom:20px;">
						
						
						
													<div class = "select-form">
	<form method="GET">
		<div class = "Entry-Form">
			
			<h3>Select Subject</h3>
			<select name="subjectname" id="">
									<option>Choose a Field</option>
									<option value="Biology">Biology</option>
									<option value="Physics">Physics</option>
									<option value="Chemistry">Chemistry</option>
									<option value="English">English</option>
									<option value="Reading">Reading</option>
									<option value="World History">World History</option>
									<option value="Writing">Writing</option>
									<option value="Precalculus">Precalculus</option>
									<option value="Algebra 2">Algebra 2</option>
									<option value="Geometry or Lower">Geometry or Lower</option>



								</select>
			<br>
			<br>
		
			<button class="btn btn-secondary" type="submit" name ="submitbtn">submit</button>
		</div>

	</form>
</div>
							<br>
							
							<?php


	if (isset($_GET['submitbtn'])) {
	$subjectname = mysqli_real_escape_string($connection, $_GET['subjectname']);	


	
		?>
							

							<div class="row">
								<?php// echo $view_society; ?>



								<table class="table table-light project-table table-hover">
									<tr style="background-color:ghostwhite;">
										<th>Name</th>
										<th>Student ID</th>
										<th>Year</th>
										<th>Contact</th>
										<th>Sidebar Color</th>
										<th>Tutor Subject</th>
										
										


									</tr>
									<?php
		




									//$sql = "SELECT students_in_societies.*, students.*, student_in_subjects.* from students, students_in_societies WHERE students.studentid = students_in_societies.studentid AND students_in_societies.honor_society = '$view_society' AND students_in_subjects.studentid = students.studentid AND students_in_subjects.subject = '$subjectname' ORDER BY name";
		
									$sql = "SELECT students_in_societies.*, students.*, students_in_subjects.* from students, students_in_societies, students_in_subjects WHERE students.studentid = students_in_societies.studentid AND students_in_societies.honor_society = '$view_society' AND students_in_subjects.studentid = students.studentid AND students_in_subjects.subject = '$subjectname' AND students.studentid != '1111111' ORDER BY name";
		
		
		
									$result = mysqli_query( $connection, $sql );

//
									$resultCheck = mysqli_num_rows( $result );
									if ( $resultCheck > 0 ) {
										while ( $row = mysqli_fetch_assoc( $result ) ) {

											$studentid = $row[ "studentid" ];




/*
											if ( $view_society == 'NHS' ) {
												//$sqlhours = "SELECT SUM(service_hours) FROM students_in_projects WHERE studentid = '$studentid' AND affiliated_group_for_servicehours = 'NHS'";
												//echo $id;
												
												$sqlhours = "SELECT SUM(service_hours) FROM students_in_projects, project_list WHERE students_in_projects.projectid = project_list.projectid AND students_in_projects.studentid = '$studentid' AND affiliated_group_for_servicehours = 'NHS' AND project_list.datetime_start >= '$datetime_start' AND project_list.datetime_start <='$datetime_end'";
												//echo $sqlhours;
												
												
												
												$resulthours = mysqli_query( $connection, $sqlhours );

												$numCheck = mysqli_num_rows( $resulthours );
												while ( $nhstotalhours = $resulthours->fetch_assoc() ):

													if ( $nhstotalhours[ 'SUM(service_hours)' ] == NULL ) {

														$hours = "0";

													} else {
														$hours = $nhstotalhours[ 'SUM(service_hours)' ];

													}
												endwhile;
											}


											if ( $view_society == 'SNHS' ) {
												//$sqlhours = "SELECT SUM(service_hours) FROM students_in_projects WHERE studentid = '$studentid' AND affiliated_group_for_servicehours = 'SNHS'";
												//echo $id;
												
												$sqlhours = "SELECT SUM(service_hours) FROM students_in_projects, project_list WHERE students_in_projects.projectid = project_list.projectid AND students_in_projects.studentid = '$studentid' AND affiliated_group_for_servicehours = 'SNHS' AND project_list.datetime_start >= '$datetime_start' AND project_list.datetime_start <='$datetime_end'";
												//echo $sqlhours;
												
												$resulthours = mysqli_query( $connection, $sqlhours );

												$numCheck = mysqli_num_rows( $resulthours );
												while ( $snhstotalhours = $resulthours->fetch_assoc() ):

													if ( $snhstotalhours[ 'SUM(service_hours)' ] == NULL ) {

														$hours = "0";

													} else {
														$hours = $snhstotalhours[ 'SUM(service_hours)' ];

													}
												endwhile;
											}
*/




											echo "<tr>
    <td>" . $row[ "name" ] . "</td>
    <td>" . $row[ "studentid" ] . "</td>
    <td>" . $row[ 'year' ] . "</td>
    <td>" . $row[ "contact" ] . "</td>
    <td>" . $row[ "sidecolor" ] . "</td>
	<td>" . $subjectname . "</td>
    </tr>";

										}

										echo "</table>";
									} else {
										echo "0 results";
									}
									//$hours = "0";
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