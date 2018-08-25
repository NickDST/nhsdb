<?php include 'requesthubheader.php'; ?>
<!--Includes header again-->
		
		<div class="content">
			<div class="container-fluid">
				<div class="row">

					<div class="col-md-12">
						<div class="card">

							<div class="header">
								<h4 class="title"><strong>Verify Student Tutoring</strong></h4>
								<p class="category">Please Verify the event</p>
							</div>
							<div class="" style="padding-left:15px; padding-bottom:20px;">
								<br>
								<p>Make sure the tutoring event took place</p>

								<hr>
								<?php
								//This page loads the information linked from verifytutoring.php. The _GET gets the information out of the link URL
								
								$name = mysqli_real_escape_string( $connection, $_GET[ 'name' ] );
								$startdate = mysqli_real_escape_string( $connection, $_GET[ 'startdate' ] );
								$requestid = mysqli_real_escape_string( $connection, $_GET[ 'id' ] );
								//echo $projectid;
								$sql = "SELECT * FROM request WHERE requestid = '$requestid'";
								//The requestid is unique, and thus it unpacks the information from the request id
								
								//Displays the information
								$result = mysqli_query( $connection, $sql );
								$queryResults = mysqli_num_rows( $result );
								if ( $queryResults > 0 ) {
									while ( $row = mysqli_fetch_assoc( $result ) ) {
										echo "
                    <div>
                      <h3>Requestee: " . $row[ 'requestee' ] . "</h3>
                      <p>Contact: " . $row[ 'contact' ] . "</p>
                      <p>Datetime Start: " . $row[ 'datetime_start' ] . "</p>
                      <p>Datetime End: " . $row[ 'datetime_end' ] . "</p>

                    </div>
                    <hr>";
//establishes a lot of variables here that will be used when entering the information
										$requestee = $row[ 'requestee' ];
										$datetime_start = $row[ 'datetime_start' ];
										$datetime_end = $row[ 'datetime_end' ];
										$requestee_email = $row[ 'contact' ];
										$requestee_username = $row['request_username'];
										
										
										//The society that these hours will be entered into. Specified by the student when they accepted the request
										$society = $row[ 'affiliated_for_service_hours' ];
										echo $studentid = $row[ 'studentid' ];
									}


								}
								?>

<!--This is the HTML form for verification-->
								<form method="POST">
									<label for=""> Type "VERIFY", in caps, in the designated box to verify this request</label>
									<input type="text" name="confirm" id="" class="form-control" placeholder="Type it" required>
									<br>
									
									<textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="feedback" placeholder="Any feedback for the system/process?" required maxlength=500 style = "resize:none;" ></textarea>
									
									<br>
									<button type="submit" name="verify" class="btn btn-success">Submit</button>
								</form>

								<br>
<!--This delete part was moved to somewhere else for inactive requests. We dont want people just deleting tutoring-->
<!--
								<form method="POST">
									<label for=""> Type "DELETE", in caps, in the designated box to delete this request. </label>
									<input type="text" name="deny" id="" class="form-control" placeholder="Type it" required>
									<br>
									<label for="">Enter reason for rejecting</label>
									<br>
									<textarea name="reason" rows="5" cols="40" required></textarea>
									<br>
									<button type="submit" name="DELETE" class="btn btn-danger">Delete Event</button>
								</form>
-->

							</div>
						</div>
					</div>

					<!--php code  -->

					<?php
					//If there is the 'post' verify and the post isnt empty and the confirmation text is correct.
					
					if ( isset( $_POST[ 'verify' ] ) & !empty( isset( $_POST[ 'verify' ] ) ) ) {
						$confirm = mysqli_real_escape_string( $connection, $_POST[ "confirm" ] );
						$feedback = mysqli_real_escape_string( $connection, $_POST[ "feedback" ] );
						if ( $confirm == "VERIFY" ) {

							$sql = "SELECT * FROM students WHERE studentid = '$studentid'";
							//echo $id;
							$result = mysqli_query( $connection, $sql );
							while ( $student = $result->fetch_assoc() ):

								//$society = $student[ 'logged_honor_society' ];
							$studentemail = $student['contact'];

							endwhile;
							
							//Checking which society the student wanted these service hours to be entered under



							if ( $society == "NHS" ) {

								$teacher_contact = 'Jennifer.chapman@concordiashanghai.org';
								$teacher_name = 'Jennifer Chapman';
								$affiliated_group = 'NHS';
								$project_description = 'This is an NHS Tutoring Request';
								$officercontact = $NHS_requestofficeremail;
							}

							if ( $society == "SNHS" ) {

								$teacher_contact = 'todd.gordon@concordiashanghai.org';
								$teacher_name = 'Todd Gordon';
								$affiliated_group = 'SNHS';
								$project_description = 'This is an SNHS Tutoring Request';
								$officercontact = $SNHS_requestofficeremail;

							}


//This officially adds the project into the master project list with all the appropriate fields from either NHS or SNSH
							$addsql = "INSERT INTO project_list (project_name, teacher_name, teacher_contact, datetime_start, datetime_end, affiliated_group, entered_by, project_description, requestee, requestee_email, type, request_username) VALUES ('Tutoring Request', '$teacher_name', '$teacher_contact' , '$datetime_start' , '$datetime_end', '$affiliated_group', '$studentid', '$project_description', '$requestee', '$requestee_email', 'tutor', '$requestee_username');";

							$addresult = mysqli_query( $connection, $addsql );
							if ( $addresult ) {
								//echo "Project successfully inserted ";


							} else {

								//echo "project failed to be added";
								echo '<script>window.location.href = "verifytutoring2.php?error=Something went wrong!";</script>';
							}

							//Finding the ID of the project added

							$findsql = "SELECT * FROM project_list WHERE datetime_start = '$datetime_start' AND requestee = '$requestee'";
							$findresult = mysqli_query( $connection, $findsql );
							$findqueryResults = mysqli_num_rows( $findresult );
							if ( $findqueryResults > 0 ) {
								while ( $row = mysqli_fetch_assoc( $findresult ) ) {
									$projectid = $row[ 'projectid' ];

								}

								date_default_timezone_set( 'Asia/Hong_Kong' );
								
//This finds the service hours by taking the difference between the datetime_start and datetime_end of the tutor event
								$diff = strtotime( $datetime_end ) - strtotime( $datetime_start );
								$diff_in_hrs = $diff / 3600;


//including the student in this "project" with the appropriate number of service hours entered as well. In order for a student to be associated with a project they need to be entered into this table
								$addsql2 = "INSERT INTO students_in_projects (projectid, studentid, service_hours, role) VALUES ('$projectid', '$studentid', '$diff_in_hrs' , 'Tutorer');";

								$addresult2 = mysqli_query( $connection, $addsql2 );
								if ( $addresult2 ) {
									//echo "student in project successfully inserted";


								} else {

									//echo "studentinproject failed to be added";
									echo '<script>window.location.href = "verifytutoring2.php?error=Something went wrong!";</script>';
								}
								
//Submitting any possible feedback into the feedback table with the request id								
								$sql6 = "INSERT INTO feedback (requestid, description) VALUES ('$requestid', '$feedback');";

								$result6 = mysqli_query( $connection, $sql6 );
								if ( $result6 ) {
									//echo "feedback successfully added";


								} else {

									//echo "feedback failed to be added";
									echo '<script>window.location.href = "verifytutoring2.php?error=Something went wrong!";</script>';
								}
								

//Removing the original request from the request table now that it is officially in the project list

								$sql2 = "DELETE FROM request WHERE studentid = '$studentid' AND requestid = '$requestid'";

								$result2 = mysqli_query( $connection, $sql2 );
								if ( $result2 ) {
									//echo "Entry successfully removed";


								} else {

									//echo "Entry failed to be removed";
									echo '<script>window.location.href = "verifytutoring2.php?error=Something went wrong!";</script>';
								}

//Deleting the original set time from the available_times table to avoid confusion
								$sql5 = "DELETE FROM available_times WHERE studentid = '$studentid' AND datetime_start = '$datetime_start' AND datetime_end = '$datetime_end'";

								$result5 = mysqli_query( $connection, $sql5 );
								if ( $result5 ) {
									//echo "date successfully removed";
									


								} else {

									//echo "Date failed to be removed";
									echo '<script>window.location.href = "verifytutoring2.php?error=Something went wrong!";</script>';
								}
								
								
								
//Emails the student that they have received their service horus
								
										
$to = $studentemail;
$subject = "Your service hours for tutoring have been added in $society";
$message = "You got $diff_in_hrs service hours for helping $requestee ";

/*								
$headers = 'From: NHS Database <NHS@database.com>' . PHP_EOL .
    'Reply-To: NHS <NHS@database.com>' . PHP_EOL .
    'X-Mailer: PHP/' . phpversion() . "Content-type: text/html"; */
								
$headers = 'From: Honor Help <honorhelp@database.com>' . PHP_EOL .
    'Reply-To: HonorHelp <honorhelp@database.com>' . PHP_EOL .
    'X-Mailer: PHP/' . phpversion() . "Content-type: text/html";								
			
mail($to, $subject, $message, $headers);
//echo "<br>email to requestee  sent";			
		

echo '<script>window.location.href = "verifytutoring2.php?success=Success!";</script>';

								
								
								
								
								
								
								
							}
						}
					}


					?>
					<!--					New section-->



				</div>
			</div>
		</div>



<!--footer stuff-->
		<footer class="footer">
			<div class="container-fluid">
				<nav class="pull-left">
					<ul>
						<li>
							<a href="hub.php">
                                Home
                            </a>
						

						</li>

					</ul>
				</nav>
				<p class="copyright pull-right">
					&copy;
					<script>
						document.write( new Date().getFullYear() )
					</script> NHS DB
				</p>
			</div>
		</footer>

	</div>
	</div>


	
</body>

<!--   Core JS Files   -->
<script src="assets/js/jquery.3.2.1.min.js" type="text/javascript"></script>
<script src="assets/js/bootstrap.min.js" type="text/javascript"></script>

<!--  Charts Plugin -->
<script src="assets/js/chartist.min.js"></script>

<!--  Notifications Plugin    -->
<script src="assets/js/bootstrap-notify.js"></script>

<!--  Google Maps Plugin    -->
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>

<!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
<script src="assets/js/light-bootstrap-dashboard.js?v=1.4.0"></script>

<!-- Light Bootstrap Table DEMO methods, don't include it in your project! -->
<!--	<script src="assets/js/demo.js"></script>-->


</html>