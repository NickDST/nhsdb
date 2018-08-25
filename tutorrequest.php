<?php
//index.php
session_start();
//starting a session

//making user is logged in
if ( !isset( $_SESSION[ 'username' ] ) ) {
	header( 'Location: requestlogin.php' );
	exit;
}

//takes variable from session
if ( isset( $_SESSION[ 'username' ] ) ) {
	$username = $_SESSION[ 'username' ];

	
	?>
	<?php
} else {
	//echo "nothing yet";
}



require_once( 'includes/dbh.inc.php' );
include 'emailheader.php';


//Taking the information from the account
$sql1 = "SELECT * FROM requestlogin WHERE username = '$username'";
	$result = mysqli_query( $connection, $sql1 );
	while ( $requestee = $result->fetch_assoc() ): 

$requesteename = $requestee['full_name'];
$requestee_user = $requestee['username'];
$requestee_contact = $requestee['contact'];
$parent_or_student = $requestee['parent_or_student'];
$requestee_age = $requestee['age'];

endwhile;

?>




<!DOCTYPE html>
<html>
<head>
	<br>
	<title>Tutor Request</title>



	<div style="text-align: center">
		<h1>Make A Tutor Request</h1>
	</div>

	<div class="content">

		<div class="container-fluid">
			<div class="row">

				<div class="col-md-8">
					<div class="card">

						<div class="header" style="margin-left:20px; margin-top:10px;">

<!--this is the HTML for the calendar. The calendar is where the id = calendar-->
							<h2 class="title"></h2>
							<h4 class="category"></h4>
						</div>
						<div class="" style="padding-left:15px;">
							<div class="container">
								<div id="calendar"></div>

							</div>
						</div>
					</div>
				</div>

				<div class="col-md-4">
					<div class="card">


						<div class="header" style="margin-left:20px; margin-top:10px;">

<!--	error messages when i redirect people to the page with the appropriate error message						-->
						<?php 	if ( isset( $_GET[ 'error' ] ) ) {
									$fmsg = $_GET[ 'error' ]; }

							?>


							<?php if(isset($smsg)){ ?>
							<div class="alert alert-success" role="alert" style="margin-top: 20px;">
								<?php echo $smsg; ?> </div>
							<?php } ?>
							<?php if(isset($fmsg)){ ?>
							<div class="alert alert-danger" role="alert" style="margin-top: 20px;">
								<?php echo $fmsg; ?> </div>
							<?php } ?>





							<!--                                <h2 class="title"></h2>-->
							<!--								<br>-->
							<?php
					
							
								if(isset($_SESSION['subjectname'])) {
	echo "<h4>Currently displaying open dates for: </h4><br><h3>".$_SESSION['subjectname']."</h3>";
								}
								?>
							<br>
							<p>Select a Field:</p>
							<form method="POST">
								<select name="subjectname" id="">
									<option>Choose a Field</option>
									<option value="Group Study">Group Study</option>
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

								<button type="submit" name="setsubject" class="btn btn-warning">Submit Subject</button>
								<br>
								<br>
								<p>Then click on the date you want</p>
								<a href="requesthub.php">or go back</a>
								<hr>
								<!--                                <p class="category">Click a cell to set a time where you are available</p>-->
						</div>
						<div class="" style="padding-left:15px; padding-bottom:20px;">
							<!--								-->

							
<!--	Set the subject the student wants to look for. Then it reloads the page. to load the information on the current session for subject.			-->
							<?php
							if ( isset( $_POST[ 'setsubject' ] ) & !empty( isset( $_POST[ 'setsubject' ] ) ) ) {
								$subjectname = $_POST[ "subjectname" ];
								$_SESSION[ 'subjectname' ] = $subjectname;
								unset( $_SESSION[ "tutortime" ] );
								echo '<script>window.location.href = "tutorrequest.php?";</script>';

							}


							?>

<!--Only if the student has clicked on a time from available subjects that the student can advance beyond this point-->



							<?php
							//if(isset($_SESSION['subjectname']))	{
							//	echo "Please Click on a Date"; }


							if ( !isset( $_SESSION[ 'tutortime' ] ) ) {


								if ( isset( $_GET[ 'message' ] ) ) {
									$smsg = "Your project has been sent in! Thank you!";
							if(isset($smsg)){ ?>
							<div class="alert alert-success" role="alert" style="margin-top: 20px;">
								<?php echo $smsg; ?> </div>
							<?php } ?>

								<?php

								} else {
									//		echo "Please Click on a Date<br>";
								}



							} else {



								if ( isset( $_SESSION[ 'subjectname' ] ) ) {
									 $subjectname = $_SESSION[ 'subjectname' ];
									 //echo "THIS IS SUBJECTNAME".$subjectname;
									//echo "Please Click on a Date";

									if ( isset( $_SESSION[ 'tutortime' ] ) ) {
										//echo "Event ID = ";
										$id = $_SESSION[ 'tutortime' ];
										//echo $id;
										?>
										<?php
										} else {
											//echo "nothing yet";
										}




							$sql1 = "SELECT * FROM available_times WHERE id = $id ";
							$result = mysqli_query( $connection, $sql1 );
							while ( $tutor = $result->fetch_assoc() ): ?>
							
							
						

							<form method="POST">
								<h3 class="">Send in a tutoring request!</h3>
								
								
								<?php 
									
									if ($tutor['grouporone'] == "group study") {
									echo "<br><h5>This is a group study session: ".$tutor['group_subject']."</h5>" ;
									echo "<h5>Description: ".$tutor['group_desc']."</h5>" ;
									//echo "";
									echo "<br>Affiliated: ".$tutor['affiliated'] ;
									echo "<br>";
									echo "<br>";
								}
									
									
									if ($parent_or_student == "parent") {
										
									
								?>

								

								<h3 class="">As a parent, please fill out your child's information.</h3>

								<?php
//If it is a group session, then information regarding the group session will be displayed
									
								





								?>




								<input type="text" name="requestee" id="" class="form-control" placeholder="Your Name" maxlength="100">
								<br>
								<input type="email" name="contact" id="" class="form-control" placeholder="Email" maxlength="100">
								<br>
								<input type="number" name="age" id="" class="form-control" placeholder="Age">
								<br>
								
								<?php }  else {
										
										echo "<h5>As a student your information is already prepared!</h5>";
										
										echo"Name: ". $requesteename;
										echo "<br>";
										echo"Email: ". $requestee_contact;
										echo "<br>";
										echo"Age: ". $requestee_age;
										echo"<br>";
										echo "<br>";
										
									}
								
								
								?>

<!--Displaying start and ending information for the student-->
								
								<h5>Time Start: <?= $tutor['datetime_start'] ?></h5>
								<h5>Time End: <?= $tutor['datetime_end'] ?></h5>
								<!--				<h5>Student: <?= $tutor['studentid'] ?></h5>-->

								<?php
		//setting up variables that will be used later since the while loop ends after the variables are set							
		$datetime_start = $tutor['datetime_start'];
		$datetime_end = $tutor['datetime_end'];
		$studentid = $tutor['studentid'];
		$grouporone = $tutor['grouporone'];
		$affiliated = $tutor['affiliated'];

	endwhile; ?>


<!--continuing the HTML form-->
								<br>
								<input type="text" name="subject_level" id="" class="form-control" placeholder="Topic i.e Fractions" maxlength="100">

								<br>

								<button class="btn btn-success" type="submit" name="submitbtn">submit</button>

							</form>



						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	</div>

	
	
<!--Only after the student has pressed the submit butten that they can advance after this	-->
	<?php

	if ( isset( $_POST[ 'submitbtn' ] ) & !empty( isset( $_POST[ 'submitbtn' ] ) ) ) {

		//if ( !empty(isset( $_POST[ 'requestee' ] )) & !empty(isset( $_POST[ 'contact' ] ) ) & !empty(isset( $_POST[ 'subject_level' ] ) ) & !empty(isset( $_POST[ 'age' ] ) ) ) {

	//This is how warning messages are currently set. This one is for age	
		if($_POST['age'] > 18) {
			echo '<script>window.location.href = "tutorrequest.php?error=Sorry We only tutor individuals up to 18 years old";</script>';


		} else {


		if ( $parent_or_student == 'student' or (!( $_POST[ 'requestee' ]=="" ) or !( $_POST[ 'contact' ]=="" ) or !( $_POST[ 'subject_level' ]=="" ) or !( $_POST[ 'age' ]=="" ))) {

		//Setting up mysqli_real_escape_string to attempt to avoid SQL injections...	
		//Putting the POSTs into variables	
		$requestee = mysqli_real_escape_string( $connection, $_POST[ "requestee" ] );
		$contact = mysqli_real_escape_string( $connection, $_POST[ "contact" ] );
		$subject_level = mysqli_real_escape_string( $connection, $_POST[ "subject_level" ] );
		$age = mysqli_real_escape_string( $connection, $_POST[ "age" ] );
			
			if ($parent_or_student == 'student') {
				$requestee = $requesteename;
				$contact = $requestee_contact;
				$age = $requestee_age;
			}



		//$subject = "$subjectname";



		//checking if the affiliated group session is with NHS or SNHS. It will notify the party. This won't be entered into the database, emails should suffice for group events.
		if ( $grouporone == "group study" ) {

			if ( $affiliated == "NHS" ) {

				$to = $vpemail;
				$subject = "NHS JOINING GROUP SESSION";
				$message = "A new Request has been submitted \r\nRequestee name: '$requestee' \r\nThey are joining the for the time starting at '$datetime_start'";

				$headers = 'From: NHS  <NHS@database.com>' . PHP_EOL .
				'Reply-To: NHS <NHS@database.com>' . PHP_EOL .
				'X-Mailer: PHP/' . phpversion() . "Content-type: text/html";

				//$headers = "Content-type: text/html\r\n";
				mail( $to, $subject, $message, $headers );
				echo "email to Project Manager sent";
			}


			if ( $affiliated == "SNHS" ) {

				$to = $snhsemail;
				$subject = "SNHS JOINING GROUP SESSION";
				$message = "A new Request has been submitted \r\nRequestee name: '$requestee' \r\nThey are joining the for the time starting at '$datetime_start'";

				$headers = 'From: SNHS  <SNHS@database.com>' . PHP_EOL .
				'Reply-To: SNHS <SNHS@database.com>' . PHP_EOL .
				'X-Mailer: PHP/' . phpversion() . "Content-type: text/html";

				//$headers = "Content-type: text/html\r\n";
				mail( $to, $subject, $message, $headers );
				echo "email to Project Manager sent";
			}
			unset( $_SESSION[ "tutortime" ] );
			echo '<script>window.location.href = "tutorrequest.php?message=success";</script>';


		} else {




			//Inserting the data into the projects...
			$sql = "INSERT INTO request (requestee, contact, datetime_start, datetime_end, subject, tutor_diff, type, studentid, age, request_username) VALUES ('$requestee', '$contact', '$datetime_start' , '$datetime_end' , '$subjectname', '$subject_level', 'tutor', '$studentid', '$age', '$username');";

			//echotest
			echo $sql;

	

			$result = mysqli_query( $connection, $sql );
			if ( $result ) {



				$smsg = "Request successfully sent!";

				$sql2 = "UPDATE available_times SET hold = 'hold', title = 'on hold' WHERE id = '$id'";
				$result2 = mysqli_query( $connection, $sql2 );
				if ( $result ) {

				$smsg = "Successfully Entered";



					$sql3 = "SELECT * FROM students WHERE studentid = '$studentid'";
					$resultsql3 = mysqli_query( $connection, $sql3 );
					$resultCheck3 = mysqli_num_rows( $resultsql3 );

					if ( $resultCheck3 > 0 ) {

						while ( $row = $resultsql3->fetch_assoc() ):

							$studentcontact = $row[ 'contact' ];


						endwhile;
					} else {
						$fmsg = "Something went wrong on our part!";
					}




//emailing the student and the vice president so far. Will add emailing the requestee as notifying.
//email echotest

					//Automated Email Test. The email variables are in the emailheader.php

					$to = $vpemail;
					$subject = "A tutor Request has been submitted!!";
					$message = "A new Request has been submitted \r\nRequestee name: '$requestee' \r\nThey are requesting for the time starting at '$datetime_start'";

					$headers = 'From: NHS  <NHS@database.com>' . PHP_EOL .
					'Reply-To: NHS <NHS@database.com>' . PHP_EOL .
					'X-Mailer: PHP/' . phpversion() . "Content-type: text/html";

					//$headers = "Content-type: text/html\r\n";
					mail( $to, $subject, $message, $headers );
					echo "email to Project Manager sent";

				} else {
					echo "Request to Project Manager failed to send";
				}



				$to = $studentcontact;
				$subject = "";
				$message = "<h1> Someone has requested for you to tutor them in $subject </h1> <p> Requestee name: $requestee <br> They are requesting for the time starting at $datetime_start to $datetime_end<p> <h3>Log into the NHS database to verify this request They are $age years old</h3>";

				$headers = 'From: Honor Help <system@honorhelp.com>' . PHP_EOL .
				'Reply-To: Honor Help <reply@honorhelp.com>' . PHP_EOL .
				'X-Mailer: PHP/' . phpversion() . 'Content-type: text/html; charset: utf8\r\n' . 'MIME-Version: 1.0';

				mail( $to, $subject, $message, $headers );
				echo "email to student tutor sent";



				unset( $_SESSION[ "tutortime" ] );
				echo '<script>window.location.href = "tutorrequest.php?message=success";</script>';

			} else {
				$fmsg = "Request failed to send";
				echo '<script>window.location.href = "tutorrequest.php?error=request failed to send";</script>';
			}






		}

	} else {

			echo '<script>window.location.href = "tutorrequest.php?error=Please fill out the fields";</script>';

		}

	}
}
}
	?>


	<?php } ?>




<!--This is the javascript for the calendar-->

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css"/>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/css/bootstrap.css"/>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
	<script>
		$( document ).ready( function () {
			var calendar = $( '#calendar' ).fullCalendar( {
				editable: false,
				header: {
					left: 'prev,next today',
					center: 'title',
					right: 'month,agendaWeek'
				},
				events: 'tutorload.php',
				//select a particular cell, dragging events and stuff
				//loads the things from the database
				selectable: false,
				selectHelper: false,
				select: function ( start, end, allDay ) {
					var title = prompt( "Enter Event Title" );
					if ( title ) {
						var start = $.fullCalendar.formatDate( start, "Y-MM-DD HH:mm:ss" );
						var end = $.fullCalendar.formatDate( end, "Y-MM-DD HH:mm:ss" );
						$.ajax( {
							url: "insert.php",
							//This inserts
							type: "POST",
							data: {
								title: title,
								start: start,
								end: end
							},
							success: function () {
								calendar.fullCalendar( 'refetchEvents' );
								alert( "Added Successfully" );
							}
						} )
					}
				},
				//You are allowed to edit the table....
				editable: false,
				eventResize: function ( event ) {
					var start = $.fullCalendar.formatDate( event.start, "Y-MM-DD HH:mm:ss" );
					var end = $.fullCalendar.formatDate( event.end, "Y-MM-DD HH:mm:ss" );
					var title = event.title;
					var id = event.id;
					$.ajax( {
						url: "update.php",
						type: "POST",
						data: {
							title: title,
							start: start,
							end: end,
							id: id
						},
						success: function () {
							calendar.fullCalendar( 'refetchEvents' );
							alert( 'Event Update' );
						}
					} )
				},

				eventDrop: function ( event ) {
					var start = $.fullCalendar.formatDate( event.start, "Y-MM-DD HH:mm:ss" );
					var end = $.fullCalendar.formatDate( event.end, "Y-MM-DD HH:mm:ss" );
					var title = event.title;
					var id = event.id;
					$.ajax( {
						url: "update.php",
						type: "POST",
						data: {
							title: title,
							start: start,
							end: end,
							id: id
						},
						success: function () {
							calendar.fullCalendar( 'refetchEvents' );
							alert( "Event Updated" );
						}
					} );
				},

				eventClick: function ( event ) {
					if ( confirm( "Schedule a tutor for this date?" ) ) {
						var id = event.id;
						var title = event.title;
						var studentid = event.studentid;
						$.ajax( {
							url: "dateidtophp.php",
							type: "POST",
							data: {
								id: id,
								title: title,
								studentid: studentid
							},
							success: function () {
								calendar.fullCalendar( 'refetchEvents' );
								//        alert("Parameters Set");
								document.location.reload( true )
							}
						} )
					}
				},
			} );
		} );
	</script>



	</body>
</html>










</body>
</html>
