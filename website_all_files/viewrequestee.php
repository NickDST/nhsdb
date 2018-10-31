<?php include 'adminhubheader.php'; ?>

<!doctype html>
<html>
<head>
	<meta charset="UTF-8">
	<title>View Requestee</title>
</head>

<body>
	<div class="content">
		<div class="container-fluid">
			<div class="row">

				<div class="col-md-12">
					<div class="card">

						<div class="header">
							<h4 class="title"><strong>List of Requestee Accounts in the Database</strong></h4>
							<p class="category"></p>
						</div>
						<div class="" style="padding-left:15px; padding-bottom:20px;">

							<div class="row">
								<?php// echo $view_society; ?>



								<table class="table table-light project-table table-hover">
									<tr style="background-color:ghostwhite;">
										<th>ID</th>
										<th>Username</th>
										<th>Full Name</th>
										<th>Contact</th>
										<th>Parent/Student</th>
										


									</tr>
									<?php




									$sql = "SELECT * FROM requestlogin ORDER BY username";
									$result = mysqli_query( $connection, $sql );


									$resultCheck = mysqli_num_rows( $result );
									if ( $resultCheck > 0 ) {
										while ( $row = mysqli_fetch_assoc( $result ) ) {

										




											echo "<tr>
    <td>" . $row[ "request_login_id" ] . "</td>
    <td>" . $row[ "username" ] . "</td>
    <td>" . $row[ 'full_name' ] . "</td>
    <td>" . $row[ "contact" ] . "</td>
    <td>" . $row[ "parent_or_student" ] . "</td>
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