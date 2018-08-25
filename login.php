<?php

session_start();

require_once( 'includes/dbh.inc.php' );
?>

		<?php 	if ( isset( $_GET[ 'error' ] ) ) {
			$fmsg = $_GET[ 'error' ]; } ?>
		<?php 	if ( isset( $_GET[ 'success' ] ) ) {
			$smsg = $_GET[ 'success' ]; } ?>
		
							<?php if(isset($smsg)){ ?>
							<div class="alert alert-success" role="alert" style="margin-top: 20px;">
								<?php echo $smsg; ?> </div>
							<?php } ?>
							<?php if(isset($fmsg)){ ?>
							<div class="alert alert-danger" role="alert" style="margin-top: 20px;">
								<?php echo $fmsg; ?> </div>
							<?php } ?>


<?php

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
		//echo "Invalid Username/Password";
		echo '<script>window.location.href = "login.php?error=Invalid Username/Password";</script>';	

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
	
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link href='https://fonts.googleapis.com/css?family=Roboto:400,500' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">

	<link rel="stylesheet" href="css/loginstyle.css">
	    <!-- Bootstrap core CSS     -->
<!--    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />-->






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
	
	    <!--   Core JS Files   -->
    <script src="assets/js/jquery.3.2.1.min.js" type="text/javascript"></script>
	<script src="assets/js/bootstrap.min.js" type="text/javascript"></script>



</html>