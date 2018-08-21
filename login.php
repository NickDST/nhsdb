<?php

session_start();

require_once( 'includes/dbh.inc.php' );
if ( isset( $_POST ) & !empty( $_POST ) ) {
	$username = mysqli_real_escape_string( $connection, $_POST[ 'username' ] );
	$studentid = mysqli_real_escape_string( $connection, $_POST[ 'studentid' ] );
	$password = md5( $_POST[ 'password' ] );

	//Querying to create sessions for each of the officers/admins


	$adminsql = "SELECT * FROM `login` WHERE username = '$username' AND studentid='$studentid' AND password = '$password' and admin_rights = 'yes';";
	$adminresult = mysqli_query( $connection, $adminsql );
	$count = mysqli_num_rows( $adminresult );
	if ( $count == 1 ) {
		$admin_rights = 'yes';

		$_SESSION[ 'admin_rights' ] = $admin_rights;
		//echo "created admin session but u cant see this anyway";

	}


	$adminsql = "SELECT * FROM `login` WHERE username = '$username' AND studentid='$studentid' AND password = '$password' and nhs_officer_rights = 'yes';";
	$adminresult = mysqli_query( $connection, $adminsql );
	$count = mysqli_num_rows( $adminresult );
	if ( $count == 1 ) {
		$nhs_officer_rights = 'yes';

		$_SESSION[ 'nhs_officer_rights' ] = $nhs_officer_rights;
		//echo "created nhs session but u cant see this anyway";

	}


	$adminsql = "SELECT * FROM `login` WHERE username = '$username' AND studentid='$studentid' AND password = '$password' and snhs_officer_rights = 'yes';";
	$adminresult = mysqli_query( $connection, $adminsql );
	$count = mysqli_num_rows( $adminresult );
	if ( $count == 1 ) {
		$snhs_officer_rights = 'yes';

		$_SESSION[ 'snhs_officer_rights' ] = $snhs_officer_rights;
		//echo "created snhs session but u cant see this anyway";

	}




	$sql = "SELECT * FROM `login` WHERE username = '$username' AND studentid='$studentid' AND password = '$password';";
	$result = mysqli_query( $connection, $sql );
	$count = mysqli_num_rows( $result );
	if ( $count == 1 ) {

		$_SESSION[ 'studentid' ] = $studentid;
		//	echo $_SESSION['studentid'];

		echo '<script>window.location.href = "hub.php";</script>';


	} else {
		echo "Invalid Username/Password";

	}


}


?>

<!doctype html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Login</title>
</head>
<head>
	<meta charset="UTF-8">
	<title>Login </title>
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link href='https://fonts.googleapis.com/css?family=Roboto:400,500' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">

	<link rel="stylesheet" href="css/loginstyle.css">






	<body>



		<div class="login-container">
			<section class="login" id="login">


				<?php
				if ( isset( $_SESSION[ 'studentid' ] ) ) {
					?>

				<header style="padding-bottom:30px ;"> <br>
					<?php

					echo "Currently Logged in as " . $_SESSION[ 'studentid' ];
					echo '<script>window.location.href = "hub.php";</script>';
					}
					else {
						?>
					<header>

						<h2>NHS DB</h2>
						<h4>Login</h4>

						<?php }?>

					</header>

					<form class="login-form" action="#" method="post">
						<input type="text" name="username" class="login-input" placeholder="Username" required/>
						<input type="password" name="password" id="input Password" class="login-input" placeholder="password" required/>
						<input type="text" name="studentid" id="" class="login-input" placeholder="student id" required/>
						<button class="login-button">login</button>
		</div>
		</form>
		</section>
		<p class="message">Not registered? <a href="register.php">Create an account</a>
		</p>
		</div>
		<br>
		<a href="logout.php"><button class = "login-button">logout</button></a>
		<a href="index.php"><button class = "login-button">Back</button></a>
		<br>


		<?php 
  
  ?>
	</body>
	<script src="js/loginindex.js"></script>



</html>