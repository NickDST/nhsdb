<?php

session_start();
//starting a session in order to allow the user to log in

require_once( 'includes/dbh.inc.php' );

if ( isset( $_POST ) & !empty( $_POST ) ) {
	$username = mysqli_real_escape_string( $connection, $_POST[ 'username' ] );
	//$studentid = mysqli_real_escape_string( $connection, $_POST[ 'studentid' ] );
	$password = md5( $_POST[ 'password' ] );

	//selecting from the table requestlogin for the username and the password. If there is a match then it allows them through



	$sql = "SELECT * FROM `requestlogin` WHERE username = '$username' AND password = '$password';";
	$result = mysqli_query( $connection, $sql );
	$count = mysqli_num_rows( $result );
	if ( $count == 1 ) {
		
//automatically creating the session the student can go into
		$_SESSION[ 'username' ] = $username;
		//	echo $_SESSION['studentid'];
		
		
//redirecting user to the hub automatically
		echo '<script>window.location.href = "requesthub.php";</script>';


	} else {
		//echo "Invalid Username/Password";
		echo "echo '<script>window.location.href = 'requestlogin.php?error=Invalid Username/Password';</script>';";

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
	
		
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link href='https://fonts.googleapis.com/css?family=Roboto:400,500' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">

	<link rel="stylesheet" href="css/loginstyle2.css">




<!--This is the HTML... If you are already logged in then it'll try to just redirect you.-->

	<body>

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
<!--		echo '<script>window.location.href = "tutorrequest.php?message=success";</script>';-->

		<div class="login-container">
			<section class="login" id="login">


				<?php
				if ( isset( $_SESSION[ 'username' ] ) ) {
					?>

				<header style="padding-bottom:30px ;"> <br>
					<?php

					echo "Currently Logged in as " . $_SESSION[ 'username' ];
					echo '<script>window.location.href = "requesthub.php";</script>';
					}
					else {
						?>
					<header>

						<h2>Requestee Login</h2>
						<h4>Login</h4>

						<?php }?>

						
<!--Here is the HTML form						-->
					</header>

					<form class="login-form" action="#" method="post">
						<input type="text" name="username" class="login-input" placeholder="Username" required/>
						<input type="password" name="password" id="input Password" class="login-input" placeholder="password" required/>
						<!-- <input type="text" name="studentid" id="" class="login-input" placeholder="student id" required/> -->
						<button class="login-button">login</button>
		</div>
		</form>
		</section>
		<p class="message">Not registered? <a href="requesteeregister.php" class = "btn btn-primary">Create an account</a>
		</p>
		</div>
		<br>
		<a href="logout.php"><button class = "login-button">logout</button></a>
		<a href="index.htm"><button class = "login-button">Back</button></a>
		<br>


		<?php

		?>
	</body>
	<script src="js/loginindex.js"></script>



</html>