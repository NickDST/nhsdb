<?php include 'requesthubheader.php';?>
<!--The requesthubheader.php has all the repetitive session and layout info, to keep consistency and make it easier to change, all request hub interfaces just link to it.-->


<div style="padding-left:30px; ">




	<div>
		<h1>Requestee Hub</h1>
	</div>
	<hr>

</div>
<div class="content">
	<div class="container-fluid">
		<div class="row">

			<div class="col-md-12">
				<div class="card">

					<div class="header">
						<h4 class="title"><strong>My Tutoring Events</strong></h4>
						<p class="category">Please View Your Active Requests</p>
					</div>
					<div class="" style="padding-left:15px; padding-bottom:20px;">
						<br>

						<!--				This is where you can give some information to the entering tutorers				-->
						<p>This is where you can make tutor requests and verify tutor events!!</p>
						<p>On the left bar you can make tutor requests!</p>
						<p>After the tutor event, make sure to verify the tutoring so our students can get their service hours!</p>
						<p>If you have any questions, email nicholas2019108@concordiashanghai.org</p>



					</div>
				</div>
			</div>
			<!--New block section-->

			<div class="col-md-12">
				<div class="card">

					<div class="header">
						<h4 class="title">All my Tutoring Events</h4>
						<p class="category">Please View Your Active Requests</p>
					</div>
					<div class="" style="padding-left:15px; padding-bottom:20px;">
						<br>

						<!--Querying to find the information for the user for all their tutor requests -->
						<?php
						/*Pending requests*/
						$pendingsql = "SELECT * FROM request WHERE request_username = '$username' ORDER BY datetime_start";
						$Presultsql = mysqli_query( $connection, $pendingsql );

						$pendingCheck = mysqli_num_rows( $Presultsql );


						if ( $pendingCheck > 0 ) {

							while ( $pendingrequest = $Presultsql->fetch_assoc() ):

								?>
						<?php echo "Name: ".$pendingrequest['requestee'];?> <br>


						<?php echo"Time Start: ". $pendingrequest['datetime_start'];?> <br>
						<?php echo"Time End: ". $pendingrequest['datetime_end'];?> <br>
						<?php echo"Subject: ". nl2br($pendingrequest['subject']."\r\n");?>
						<hr>



						<!-- End While -->
						<?php endwhile;
				} else {
					echo "Nothing Here!";
				}
				?>






					</div>
				</div>
			</div>
			<!--					New section-->

			<div class="col-md-12">
				<div class="card">

					<div class="header">
						<h4 class="title">Waiting to be notified</h4>
						<p class="category">Currently Active are displayed</p>
					</div>
					<div class="" style="padding-left:15px; padding-bottom: 5px; ">
						<!--There are two kinds of statuses for tutor requests, active or inactive. It is activated when a tutorer goes into their account to verify it. Right now this will generate the list of 'inactive' requests	-->




						<?php
						/*Pending requests*/
						$pendingsql = "SELECT * FROM request WHERE status = 'inactive' AND request_username = '$username' ORDER BY datetime_start";
						$Presultsql = mysqli_query( $connection, $pendingsql );

						$pendingCheck = mysqli_num_rows( $Presultsql );


						if ( $pendingCheck > 0 ) {

							while ( $pendingrequest = $Presultsql->fetch_assoc() ):

								?>


						<?php echo "Name: ".$pendingrequest['requestee'];?> <br>


						<?php echo"Time Start: ". $pendingrequest['datetime_start'];?> <br>
						<?php echo"Time End: ". $pendingrequest['datetime_end'];?> <br>
						<?php echo"Subject: ". nl2br($pendingrequest['subject']."\r\n");?>
						<hr>



						<!-- End While -->
						<?php endwhile;
				} else {
					echo "Nothing waiting to be verified!";
				}
				?>




					</div>
				</div>
			</div>



		</div>
	</div>
</div>


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
			</script> Honor Help
		</p>
	</div>
</footer>

</div>
</div>


</body>


</html>