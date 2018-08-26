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
							<h4 class="title"><strong>List of Students in the Database</strong></h4>
							<p class="category">First Semester of 2018</p>
						</div>
						<div class="" style="padding-left:15px; padding-bottom:20px;">

							<div class="row">
								<?php// echo $view_society; ?>



								<table class="table table-light project-table table-hover">
									<tr style="background-color:ghostwhite;">
										<th>Name</th>
										<th>Student ID</th>
										<th>Year</th>
										<th>Contact</th>
										<th>Sidebar Color</th>
										<th>Total Hours</th>


									</tr>
									<?php




									$sql = "SELECT students_in_societies.*, students.* from students, students_in_societies WHERE students.studentid = students_in_societies.studentid AND students_in_societies.honor_society = '$view_society' AND students.studentid != '1111111' ORDER BY name";
									$result = mysqli_query( $connection, $sql );


									$resultCheck = mysqli_num_rows( $result );
									if ( $resultCheck > 0 ) {
										while ( $row = mysqli_fetch_assoc( $result ) ) {

											$studentid = $row[ "studentid" ];





											if ( $view_society == 'NHS' ) {
												$sqlhours = "SELECT SUM(service_hours) FROM students_in_projects WHERE studentid = '$studentid' AND affiliated_group_for_servicehours = 'NHS'";
												//echo $id;
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
												$sqlhours = "SELECT SUM(service_hours) FROM students_in_projects WHERE studentid = '$studentid' AND affiliated_group_for_servicehours = 'SNHS'";
												//echo $id;
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





											echo "<tr>
    <td>" . $row[ "name" ] . "</td>
    <td>" . $row[ "studentid" ] . "</td>
    <td>" . $row[ 'year' ] . "</td>
    <td>" . $row[ "contact" ] . "</td>
    <td>" . $row[ "sidecolor" ] . "</td>
	<td>" . $hours . "</td>
    </tr>";

										}

										echo "</table>";
									} else {
										echo "0 results";
									}
									//$hours = "0";

									?>








							</div>
						</div>
					</div>
				</div>
			</div>
		</div>



</body>
</html>