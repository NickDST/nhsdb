<?php include 'requesthubheader.php';?>




<div class="content">
			<div class="container-fluid">
				<div class="row">

					<div class="col-md-12">
						<div class="card">

							<div class="header">
								<h4 class="title"><strong>Withdraw Requests</strong></h4>
								<p class="category">Please View Your Active Requests</p>
							</div>
							<div class="" style="padding-left:15px; padding-bottom:20px;">
								<?php
								$name = mysqli_real_escape_string( $connection, $_GET[ 'name' ] );
								$startdate = mysqli_real_escape_string( $connection, $_GET[ 'startdate' ] );
								$requestid = mysqli_real_escape_string( $connection, $_GET[ 'id' ] );
								//echo $projectid;
								$sql = "SELECT * FROM request WHERE requestid = '$requestid'";
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

										$requestee = $row[ 'requestee' ];
										$datetime_start = $row[ 'datetime_start' ];
										$datetime_end = $row[ 'datetime_end' ];
										$requestee_email = $row[ 'contact' ];
										$studentid = $row[ 'studentid' ];
									}


								}
								?>
								
								
								<hr>
								
								
								<form method="POST">
									<label for=""> Type "DELETE", in caps, in the designated box to delete this request. </label>
									<input type="text" name="deny" id="" class="form-control" placeholder="Type it" required>
									<br>
									<label for="">Enter reason for withdrawing the request</label>
									<br>
									<textarea name="reason" rows="5" cols="40" required></textarea>
									<br>
									<button type="submit" name="DELETE" class="btn btn-danger">Delete Event</button>
								</form>
								
									<?php
								//REJCTION

					/* Rejection */
					if ( isset( $_POST[ 'DELETE' ] ) & !empty( isset( $_POST[ 'DELETE' ] ) ) ) {
						$deny = mysqli_real_escape_string( $connection, $_POST[ "deny" ] );
						if ( $deny == "DELETE" ) {

							$reason = mysqli_real_escape_string( $connection, $_POST[ "reason" ] );

							$sqlremove = "DELETE FROM request WHERE studentid = '$studentid' AND requestid = '$requestid'";

							$removeresult = mysqli_query( $connection, $sqlremove );
							if ( $removeresult ) {
								echo "Entry successfully removed";


							} else {

								echo "Entry failed to be removed";
							}





							//querying to look for the student email		
							$sql3 = "SELECT * FROM students WHERE studentid = '$studentid'";
							$resultsql3 = mysqli_query( $connection, $sql3 );
							$resultCheck3 = mysqli_num_rows( $resultsql3 );

							if ( $resultCheck3 > 0 ) {

								while ( $row = $resultsql3->fetch_assoc() ):

								$studentcontact = $row[ 'contact' ];
								$studentname = $row[ 'name' ];


								endwhile;
							} else {
								echo "Student has no email";
							}


							$to = $studentcontact;
							$subject = "EMAIL TO Student Contact";
							$message = "$requestee has withdrawn their request to you that you have not accepted.";

							$headers = 'From: NHS Organizer <NHS@database.com>' . PHP_EOL .
							'Reply-To: NHS <NHS@database.com>' . PHP_EOL .
							'X-Mailer: PHP/' . phpversion() . "Content-type: text/html";

							mail( $to, $subject, $message, $headers );
							echo "Message sent hopefully";
						

						}
					}



					?>
							
							</div>
						</div>
					</div>
				
							</div>
						</div>
					</div>