
<?php include 'adminhubheader.php'; ?>


	<div class="content">
		<div class="container-fluid">
			<div class="row">

				<div class="col-md-12">
					<div class="card">

						<div class="header">
							<h4 class="title"><strong>Latest Pending Requests</strong></h4>
							<p class="category">Please View Your Active Requests</p>
						</div>
						<div class="" style="padding-left:15px; padding-bottom:20px;">
							<form method="get">
								Type in Student ID: <input type="number" name="studentid" class="form-control" required max=""><br>
								<button type="submit" class="btn btn-secondary">submit</button>
							</form>





							<?php
							if ( isset( $_GET[ 'studentid' ] ) & !empty( $_GET ) ) {
								$studentid = $_GET[ 'studentid' ];


								if ( $view_society == 'NHS' ) {
									$societysql = "SELECT * FROM students_in_societies WHERE studentid = '$studentid' AND honor_society = 'NHS'";
									$societyresult = mysqli_query( $connection, $societysql );

									$societycheck = mysqli_num_rows( $societyresult );
									if ( $societycheck > 0 ) {
										while ( $in_society = $societyresult->fetch_assoc() ):
											$in_group = "yes";
										$in_nhs = "yes";
										//echo "in nhs";
										endwhile;
									}
								}
								?>
							<!--Checking if student is in SNHS	-->
							<?php
							if ( $view_society == 'SNHS' ) {
								$societysql = "SELECT * FROM students_in_societies WHERE studentid = '$studentid' AND honor_society = 'SNHS'";
								$societyresult = mysqli_query( $connection, $societysql );

								$societycheck = mysqli_num_rows( $societyresult );
								if ( $societycheck > 0 ) {
									while ( $in_society = $societyresult->fetch_assoc() ):
										$in_group = "yes";
									$in_snhs = "yes";
									//	echo "in snhs";
									endwhile;
								} else {
									//	echo "nothing";
								}
							}

							?>



							<?php


							if ( $in_group == 'yes' ) {

								//$studentsql = "SELECT students_in_subjects.*, students.* FROM students_in_subjects, students WHERE students.studentid = students_in_subjects.studentid AND students.studentid = '$studentid' LIMIT 1";
								$studentsql = "SELECT * FROM students WHERE studentid = '$studentid' LIMIT 1";
								
								$resultsql = mysqli_query( $connection, $studentsql );

								$resultCheck = mysqli_num_rows( $resultsql );
								?>

							<?php


							if ( $resultCheck > 0 ) {

								while ( $studentinfo = $resultsql->fetch_assoc() ): ?>


							<h3>
								<?php echo "Name: ".$studentinfo['name'];?>
							</h3>
							<h3>
								<?php echo "Year: ".$studentinfo['year'];?>
							</h3>




							<?php
							endwhile;
							}
							?>

							<!--NHS HOURS-->

							<?php
							//echo $view_society;									
							/*									
							if($in_nhs =='yes' && $view_society =='NHS')	{
							$sqlhours = "SELECT SUM(service_hours) FROM students_in_projects WHERE studentid = '$id' AND affiliated_group_for_servicehours = 'NHS'";
							//echo $id;
							$resulthours = mysqli_query($connection, $sqlhours);
								
							$numCheck = mysqli_num_rows($resulthours);
							while ($nhstotalhours = $resulthours->fetch_assoc()): 		
										
							if (isset($nhstotalhours['SUM(service_hours)'])) {?>


							<h3>Total Hours for NHS: <?=$nhstotalhours['SUM(service_hours)'];?></h3>


							<?php } else {
echo "<h3>Total Hours for NHS: 0</h3>";								

}
endwhile;
}	?>




							<!--SNHS HOURS								-->

							<?php
							if ( $in_snhs == 'yes'
								and $view_society = 'SNHS' ) {
								$sqlhours = "SELECT SUM(service_hours) FROM students_in_projects WHERE studentid = '$id' AND affiliated_group_for_servicehours = 'SNHS'";
								//echo $id;
								$resulthours = mysqli_query( $connection, $sqlhours );

								$numCheck = mysqli_num_rows( $resulthours );
								while ( $snhstotalhours = $resulthours->fetch_assoc() ):

									if ( isset( $snhstotalhours[ 'SUM(service_hours)' ] ) ) {
										?>


							<h3>Total Hours for SNHS: <?=$snhstotalhours['SUM(service_hours)'];?></h3>


							<?php } else {
echo "<h3>Total Hours for SNHS: 0</h3>";								

}
endwhile;
}								*/?>



							<?php 
							
											if ( $view_society == 'NHS' ) {
												$sqlhours = "SELECT SUM(service_hours) FROM students_in_projects WHERE studentid = '$studentid' AND affiliated_group_for_servicehours = 'NHS'";
												//echo $id;
												$resulthours = mysqli_query( $connection, $sqlhours );

												$numCheck = mysqli_num_rows( $resulthours );
												while ( $nhstotalhours = $resulthours->fetch_assoc() ):

													if ( $nhstotalhours[ 'SUM(service_hours)' ] == NULL ) {

														$hours = "0";
														echo"<h3>Total Hours for NHS: None </h3>";

													} else {
														$hours = $nhstotalhours[ 'SUM(service_hours)' ]; ?>
							<h3>Total Hours for NHS: <?=$nhstotalhours['SUM(service_hours)'];?></h3>
							<?php


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
										echo"<h3>Total Hours for SNHS: None </h3>";

									} else {
										$hours = $snhstotalhours[ 'SUM(service_hours)' ];
										?>
							<h3>Total Hours for SNHS: <?=$snhstotalhours['SUM(service_hours)'];?></h3>
							<?php


							}
							endwhile;
							}





							?>
							<?php
							$fieldsql = "SELECT students_in_subjects.*, students.* FROM students_in_subjects, students WHERE students.studentid = students_in_subjects.studentid AND students.studentid = '$id'";
							$fieldresultsql = mysqli_query( $connection, $fieldsql );

							$fieldresultCheck = mysqli_num_rows( $fieldresultsql );

							echo "Fields tutoring in: ";
							if ( $fieldresultCheck > 0 ) {

								while ( $fieldinfo = $fieldresultsql->fetch_assoc() ): ?>



							<span>
								<?php echo $fieldinfo['subject']. ",";?>
							</span>


							<?php endwhile;  ?>


							<?php
							} else {
								echo "No Subjects Entered Yet";
							}
							?>
							<br>
							<hr>




							<h3><strong>Involved Projects</strong></h3>

							<?php
							/*For all previous service hours and projects*/
							$studentsql = "SELECT project_list.*, students_in_projects.*, students.* FROM project_list, students_in_projects, students WHERE students.studentid = students_in_projects.studentid AND students_in_projects.projectid = project_list.projectid AND students.studentid = '$studentid' ORDER BY datetime_start asc";
							$resultsql = mysqli_query( $connection, $studentsql );

							$resultCheck = mysqli_num_rows( $resultsql );


							if ( $resultCheck > 0 ) {

								while ( $projectinfo = $resultsql->fetch_assoc() ):


									?>
							<hr>
							<?php echo "<strong>Project/Service Name: ".$projectinfo['project_name']."</strong>";?> <br>
							<?php echo "Description:  ". $projectinfo['project_description'];?> <br><br>
							<?php echo "Datetime started: ".$projectinfo['datetime_start'];?> <br>
							<?php echo "Datetime ended: ".$projectinfo['datetime_end'];?> <br><br>
							<?php echo "Requestee: ".$projectinfo['requestee'];?> <br>
							<?php echo "Requestee Email: ".$projectinfo['requestee_email'];?> <br><br>
							<?php echo "Project's Affiliated Group: ".$projectinfo['affiliated_group'];?> <br><br>
							<?php echo $projectinfo['service_hours'];?> hours -
							<?php echo nl2br($projectinfo['role']."\r\n");?>



							<!-- End While for project ID -->
							<?php endwhile; 
				} else {
					echo "No Projects Entered Yet";
				}
				?>

							<hr>

							<?php//endwhile; ?>
							<?php  } else {
									//echo "Student not registered in this honor society";
								echo '<script>window.location.href = "adminsearchstudent.php?error=Student not registered in this honor society";</script>';	
								}
								
								} ?>

						</div>
					</div>
				</div>

			</div>
		</div>
	</div>







</body>
</html>