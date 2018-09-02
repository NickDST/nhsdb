<?php include 'adminhubheader.php'; ?>

<!doctype html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Admin Requirements</title>
</head>

<body>
	<div class="content">
		<div class="container-fluid">
			<div class="row">

				<div class="col-md-12">
					<div class="card">

						<div class="header">
							<h4 class="title"><strong>Quick check</strong></h4>
							<p class="category">Quick Check to see how many people set times</p>
						</div>
						


						
						
						
						<div class="" style="padding-left:15px; padding-bottom:20px;">
							
													<div class = "select-form">
	<form method="GET">
		<div class = "Entry-Form">
			
			<h3>Date Start:</h3>
			<input type="date" name="datestart" class="form-control" >
			<h3>Date End:</h3>
			<input type="date" name="dateend" class="form-control" >
			<br>
			<button class="btn btn-secondary" type="submit" name ="submitbtn">submit</button>
		</div>

	</form>
</div>
							<br>
							
							<?php


	if (isset($_GET['submitbtn'])) {
	$roomid = mysqli_real_escape_string($connection, $_GET['roomid']);	
	$datetime_start = mysqli_real_escape_string($connection, $_GET['datestart']);
	$dateend = mysqli_real_escape_string($connection, $_GET['dateend']);

		if ($_GET['datestart'] == "") {
			$datetime_start = '1010-08-10 10:41:45';
		}
		if ($_GET['dateend'] == "") {
			$datetime_end = '3020-08-10 10:41:45';
		}
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
										<th>Met Requirements?</th>
										<th>Number of Times Set</th>


									</tr>
									<?php
		




									$sql = "SELECT students_in_societies.*, students.* from students, students_in_societies WHERE students.studentid = students_in_societies.studentid AND students_in_societies.honor_society = '$view_society' AND students.studentid != '1111111' ORDER BY name";
									$result = mysqli_query( $connection, $sql );


									$resultCheck = mysqli_num_rows( $result );
									if ( $resultCheck > 0 ) {
										while ( $row = mysqli_fetch_assoc( $result ) ) {

											$studentid = $row[ "studentid" ];





											if ( $view_society == 'NHS' ) {
												//$sqlhours = "SELECT SUM(service_hours) FROM students_in_projects WHERE studentid = '$studentid' AND affiliated_group_for_servicehours = 'NHS'";
												//echo $id;
												
												//$sqlhours = "SELECT SUM(service_hours) FROM students_in_projects, project_list WHERE students_in_projects.projectid = project_list.projectid AND students_in_projects.studentid = '$studentid' AND students_in_projects.affiliated_group_for_servicehours = 'NHS' AND project_list.datetime_start >= '$datetime_start' AND project_list.datetime_start <='$datetime_end'";
												//echo $sqlhours;
												
												//$sql = "SELECT available_times.*, students_in_societies.*, students.* FROM available_times, students_in_societies, students WHERE students_in_societies.studentid = students.studentid AND available_times.studentid = students.studentid AND students.studentid = '$studentid' AND students_in_societies.honor_society = 'NHS'AND availabile_times.datetime_start >= '$datetime_start' AND available_times.datetime_start <='$datetime_end'";
												
												$sql = "SELECT available_times.*, students_in_societies.*, students.* FROM available_times, students_in_societies, students WHERE students_in_societies.studentid = students.studentid AND available_times.studentid = students.studentid AND students.studentid = '$studentid' AND students_in_societies.honor_society = 'NHS'AND available_times.datetime_start >= '$datetime_start' AND available_times.datetime_end <='$datetime_end'";
												
												
												$resulthours = mysqli_query( $connection, $sql );

												$numCheck = mysqli_num_rows( $resulthours );
												//$numCheck = $number;
												while ( $nhstotalhours = $resulthours->fetch_assoc() ):
												//$number = $nhstotalhours['COUNT(available_times)'];

												endwhile;
											}


											if ( $view_society == 'SNHS' ) {
												//$sqlhours = "SELECT SUM(service_hours) FROM students_in_projects WHERE studentid = '$studentid' AND affiliated_group_for_servicehours = 'SNHS'";
												//echo $id;
												
												//$sql = "SELECT available_times.*, students_in_societies.*, students.* FROM available_times, students_in_societies, students WHERE students_in_societies.studentid = students.studentid AND available_times.studentid = students.studentid AND students.studentid = '$studentid' AND students_in_societies.honor_society = 'SNHS'AND availabile_times.datetime_start >= '$datetime_start' AND available_times.datetime_start <='$datetime_end'";
												
												$sql = "SELECT available_times.*, students_in_societies.*, students.* FROM available_times, students_in_societies, students WHERE students_in_societies.studentid = students.studentid AND available_times.studentid = students.studentid AND students.studentid = '$studentid' AND students_in_societies.honor_society = 'SNHS'AND available_times.datetime_start >= '$datetime_start' AND available_times.datetime_end <='$datetime_end'";
												
												
												$resulthours = mysqli_query( $connection, $sql );

												$numCheck = mysqli_num_rows( $resulthours );
												//$numCheck = $number;
												while ( $snhstotalhours = $resulthours->fetch_assoc() ):
												//$number = $snhstotalhours['COUNT(available_times)'];
												

													
												endwhile;
											}
											
											if ($numCheck < 2) {
												$metrequirements = "no";
											} else {
												$metrequirements = "yes";
											}
											
											





											echo "<tr>
    <td>" . $row[ "name" ] . "</td>
    <td>" . $row[ "studentid" ] . "</td>
    <td>" . $row[ 'year' ] . "</td>
    <td>" . $row[ "contact" ] . "</td>
    <td>" . $row[ "sidecolor" ] . "</td>
	<td>" . $metrequirements . "</td>
	<td>" . $numCheck . "</td>
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