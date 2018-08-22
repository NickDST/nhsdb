<?php include 'requesthubheader.php';?>
		<div style="padding-left:30px; ">



			
			<hr>

		</div>
		<div class="content">
			<div class="container-fluid">
				<div class="row">

					<div class="col-md-12">
						<div class="card">

							<div class="header">
								<h4 class="title"><strong>Verify Student Tutoring</strong></h4>
								<p class="category">Please View Your Active Requests</p>
							</div>
							<div class="" style="padding-left:15px; padding-bottom:20px;">
								<br>
                <p>Make sure the tutoring event took place</p>

                <?php
            			//$search = mysqli_real_escape_string($connection, $_POST['search']);
            			$sql = "SELECT * FROM request WHERE request_username = '$username' AND status = 'active' ORDER BY datetime_start";

            			$result = mysqli_query($connection, $sql);
            			$queryResult = mysqli_num_rows($result);

            			echo "You have ".$queryResult. " tutoring event(s) to verify <hr>";


            			if ($queryResult > 0) {
            				while ($row = mysqli_fetch_assoc($result)) {
            					echo "

            					<div>
            					<h3>".$row['requestee']."</h3>
            					<p>".$row['datetime_start']."</p>
            					<p>".$row['datetime_end']."</p>
            					</div>
            					<a href = 'verifytutoring2.php?name=".$row['requestee']."&startdate=".$row['datetime_start']."&id=".$row['requestid']."'>More Info
            					</a>
            					<hr>";

            				}

            			} else {
            				echo "All tutoring events verified!";
            			}


            		?>





							</div>
						</div>
					</div>
					<!--					

					<div class="col-md-12">
						<div class="card">

							<div class="header">
								<h4 class="title">X</h4>
								<p class="category">Currently Active are displayed</p>
							</div>
							<div class="" style="padding-left:15px; padding-bottom: 5px; ">




							</div>
						</div>
					</div> -->

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

	<?php// endwhile ?>
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
