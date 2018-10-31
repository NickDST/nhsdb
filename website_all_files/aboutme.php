<?php
include 'hubheader.php';

?>





<!--	<a href="hub.php">back to hub</a> -->
<div class="content">
	<div class="container-fluid">
		<div class="row">

			<div class="col-md-12">
				<div class="card">

					<div class="header">
						<h2 class="title">My Info</h2>
						<p class="category">The tutoring fields and student information</p>
					</div>
					<div class="" style="padding-left:15px; padding-bottom:20px;">
						<br>



						<?php
						/*For all previous service hours and projects*/
						$studentsql = "SELECT students_in_subjects.*, students.* FROM students_in_subjects, students WHERE students.studentid = students_in_subjects.studentid AND students.studentid = '$id' LIMIT  1";
						$resultsql = mysqli_query( $connection, $studentsql );

						$resultCheck = mysqli_num_rows( $resultsql );
						?>

						<?php


						if ( $resultCheck > 0 ) {

							while ( $studentinfo = $resultsql->fetch_assoc() ): ?>


						<?php echo "Name: ".$studentinfo['name'];?> <br>
						<?php echo "Year: ".$studentinfo['year'];?> <br>


						<?php
						endwhile;
						}
						?>

						<?php
						$fieldsql = "SELECT students_in_subjects.*, students.* FROM students_in_subjects, students WHERE students.studentid = students_in_subjects.studentid AND students.studentid = '$id'";
						$fieldresultsql = mysqli_query( $connection, $fieldsql );

						$fieldresultCheck = mysqli_num_rows( $fieldresultsql );

						echo "Fields I'm tutoring in: ";
						if ( $fieldresultCheck > 0 ) {

							while ( $fieldinfo = $fieldresultsql->fetch_assoc() ): ?>

						<?php echo $fieldinfo['subject']. ",";?>


						<?php endwhile;  ?>


						<?php
						} else {
							echo "Nothing Entered Yet";
						}
						?>
						<br>
						<br>
						<a href="changeaccountinfo.php" class="btn btn-warning">Change these tutoring fields</a>



					</div>
				</div>
			</div>

		</div>
	</div>
</div>



<?php// endwhile; ?>
<hr>










</body>
</html>