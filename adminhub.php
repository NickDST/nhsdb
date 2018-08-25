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
						<br>
						<?php
						/*Pending requests*/
						$pendingsql = "SELECT * FROM request WHERE datetime_start > NOW() ORDER BY datetime_start";
						$Presultsql = mysqli_query( $connection, $pendingsql );

						$pendingCheck = mysqli_num_rows( $Presultsql );


						if ( $pendingCheck > 0 ) {

							while ( $pendingrequest = $Presultsql->fetch_assoc() ):

								?>


						<?php echo "Name: ".$pendingrequest['requestee'];?> <br>
						<?php echo "Request Sent to: ".$pendingrequest['studentid'];?> <br>

						<?php echo "Contact: ".$pendingrequest['contact'];?> <br>
						<?php echo "Datetime Start: ".$pendingrequest['datetime_start'];?> <br>
						<?php echo "Datetime End: ".$pendingrequest['datetime_end'];?> <br>
						<?php echo "Subject: ".nl2br($pendingrequest['subject']."\r\n");?>

						<hr>

						<!-- End While -->
						<?php endwhile; 
				} else {
					echo "No Pending Requests";
				}
				?>


					</div>
				</div>
			</div>
			<!--					New section-->

			<div class="col-md-12">
				<div class="card">

					<div class="header">
						<h4 class="title">Latest Activity</h4>
						<p class="category">Currently Active are displayed</p>
					</div>
					<div class="" style="padding-left:15px; padding-bottom: 5px; ">
						<?php
						/*Projects where status = ongoing*/
						$studentsql = "SELECT project_list.*, students_in_projects.*, students.* FROM project_list, students_in_projects, students WHERE students.studentid = students_in_projects.studentid AND students_in_projects.projectid = project_list.projectid AND datetime_end > NOW()";
						$resultsql = mysqli_query( $connection, $studentsql );

						$resultCheck = mysqli_num_rows( $resultsql );


						if ( $resultCheck > 0 ) {

							while ( $projectinfo = $resultsql->fetch_assoc() ):

								?>
						<?php echo"Name: ".$projectinfo['name'];?> <br>
						<?php echo"Project Name: ". $projectinfo['project_name'];?> <br>
						<?php echo"Requestee: ". $projectinfo['requestee'];?> <br>
						<?php echo "Role: ".nl2br($projectinfo['role']."\r\n");?>

						<hr>



						<!-- End While for project ID -->
						<?php endwhile; 
				} else {
					echo "No Projects Entered Yet";
				}
				?>






					</div>
				</div>
			</div>

			<!--New Section-->
			<div class="col-md-12">
				<div class="card">

					<div class="header">
						<h4 class="title">Upcoming Projects</h4>
						<p class="category">A Graph here maybe</p>


					</div>
					<div class="" style="padding-left:15px; padding-bottom: 10px;">

						<hr>




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
			</script> NHS DB
		</p>
	</div>
</footer>

</div>
</div>

<?php//endwhile ?>
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